<?php

namespace App\Http\Controllers;                 // alamat class

use Illuminate\Http\Request;                    // pembawa data form
use Illuminate\Support\Facades\DB;              // untuk Database Transaction
use App\Models\Barang;                          // model Barang
use App\Models\Unit;                            // model Unit
use App\Models\Pemesanan;                       // model Pemesanan
use App\Models\PemesananDetail;                 // model detail pemesanan
use App\Models\PemesananUnit;                   // model unit per detail
use Illuminate\Support\Facades\Mail;            // untuk mengirim email
use App\Mail\AdminCheckoutNotification;         // email notifikasi ke admin

class CartController extends Controller          // controller keranjang & checkout (publik)
{
    public function addToCart(Request $request)  // menambahkan unit ke keranjang (disimpan di session)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'units' => 'required|array',         // daftar unit yang dipilih (array)
            'units.*' => 'exists:units,id'       // tiap unit harus ada di tabel units
        ]);

        $barangId = $request->barang_id;
        $unitIds = $request->units;

        $cart = session()->get('cart', []);      // ambil keranjang saat ini (kosong jika belum ada)

        if (isset($cart[$barangId])) {           // jika barang ini sudah ada di keranjang
            $cart[$barangId]['units'] = array_unique(array_merge($cart[$barangId]['units'], $unitIds)); // gabung unit, buang duplikat
        } else {                                 // jika belum ada
            $cart[$barangId] = [
                'units' => $unitIds              // simpan unit-unitnya
            ];
        }

        session()->put('cart', $cart);           // simpan kembali keranjang ke session

        return back()->with('success', 'Unit berhasil ditambahkan ke keranjang!'); // kembali + pesan sukses
    }

    public function index()                      // menampilkan isi keranjang dalam bentuk JSON
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }

    public function checkout()                   // menampilkan halaman checkout
    {
        $cartSession = session()->get('cart', []);

        if (empty($cartSession)) {               // jika keranjang kosong, tolak masuk checkout
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda kosong!');
        }

        $barangIds = array_keys($cartSession);   // ambil id semua barang di keranjang
        $cartItems = Barang::whereIn('id', $barangIds)->get()->map(function($brg) use ($cartSession) {
            $brg->selected_units = Unit::whereIn('id', $cartSession[$brg->id]['units'])->get(); // tempelkan unit yang dipilih
            return $brg;
        });

        return view('landing-page.katalog.checkout', compact('cartItems'));
    }

    // Proses Submit Checkout ke DB
    public function processCheckout(Request $request) // menyimpan pesanan ke database
    {
        $request->validate([                     // validasi data form pemesan
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'perusahaan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai', // selesai tidak boleh sebelum mulai
            'emails' => 'required|email|max:255',
        ]);

        $cartSession = session()->get('cart', []);
        if (empty($cartSession)) {               // pastikan keranjang tidak kosong
            return redirect()->route('units.katalog')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();                  // MULAI transaksi: semua atau tidak sama sekali
        try {
            $pemesanan = Pemesanan::create([     // 1) simpan data pemesanan utama
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'emails' => $request->emails,
                'status' => 'pending',           // status awal selalu 'pending'
            ]);

            foreach ($cartSession as $barangId => $cartData) { // 2) untuk tiap barang di keranjang
                $barang = Barang::with('hargaBarangs')->find($barangId);
                $qty = count($cartData['units']); // jumlah unit = banyaknya unit yang dipilih

                $hargaRef = $barang->hargaBarangs->first(); // ambil harga pertama barang ini
                $harga = $hargaRef && is_numeric($hargaRef->harga) ? $hargaRef->harga : 0; // pakai harga itu, atau 0 jika tak valid

                $validSatuan = ['jam', 'hari', 'minggu', 'bulan', 'tahun'];
                $satuan = ($hargaRef && in_array(strtolower($hargaRef->satuan), $validSatuan)) ? strtolower($hargaRef->satuan) : 'jam'; // satuan valid, default 'jam'

                $detail = PemesananDetail::create([ // simpan baris detail untuk barang ini
                    'pemesanan_id' => $pemesanan->id,
                    'barang_id' => $barangId,
                    'qty' => $qty,
                    'harga' => $harga,
                    'satuan' => $satuan,
                    'durasi' => 1,
                ]);

                foreach ($cartData['units'] as $unitId) { // 3) catat tiap unit yang dipakai
                    PemesananUnit::create([
                        'pemesanan_detail_id' => $detail->id,
                        'unit_id' => $unitId
                    ]);
                }
            }

            DB::commit();                        // semua sukses -> simpan permanen

            $adminEmail = config('mail.admin_address'); // ambil email admin dari konfigurasi

            if (!empty($adminEmail)) {           // jika email admin di-set, kirim notifikasi
                Mail::to($adminEmail)->send(new AdminCheckoutNotification($pemesanan));
            }

            session()->forget('cart');           // kosongkan keranjang setelah berhasil

           return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat! Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {                // jika ADA error di tengah jalan
            DB::rollBack();                      // batalkan SEMUA perubahan di atas
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function removeItem($barangId)        // hapus 1 barang (beserta semua unitnya) dari keranjang
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$barangId])) {
            unset($cart[$barangId]);             // hapus barang itu dari array keranjang
            session()->put('cart', $cart);
        }

        if (empty(session()->get('cart'))) {     // jika keranjang jadi kosong
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda sudah kosong.');
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function clearCart()                  // kosongkan seluruh keranjang
    {
        session()->forget('cart');
        return redirect()->route('units.katalog')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function removeUnit($barangId, $unitId) // hapus 1 unit saja dari sebuah barang di keranjang
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$barangId])) {
            $units = $cart[$barangId]['units'];

            $key = array_search($unitId, $units); // cari posisi unit di dalam array

            if ($key !== false) {
                unset($units[$key]);             // buang unit itu

                if (count($units) > 0) {         // jika masih ada unit lain
                    $cart[$barangId]['units'] = array_values($units); // rapikan ulang index array
                } else {                         // jika unitnya habis
                    unset($cart[$barangId]);     // hapus barangnya juga
                }

                session()->put('cart', $cart);
            }
        }

        if (empty(session()->get('cart'))) {
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda sudah kosong.');
        }

        return back()->with('success', '1 Unit berhasil dihapus dari keranjang.');
    }

    public function success()                    // halaman "pesanan berhasil"
    {
        return view('landing-page.katalog.checkout-success');
    }
}
