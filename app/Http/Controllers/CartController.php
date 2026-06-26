<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Unit;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use App\Models\PemesananUnit;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminCheckoutNotification;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'units' => 'required|array',
            'units.*' => 'exists:units,id'
        ]);

        $barangId = $request->barang_id;
        $unitIds = $request->units;

        $cart = session()->get('cart', []);

        if (isset($cart[$barangId])) {
            $cart[$barangId]['units'] = array_unique(array_merge($cart[$barangId]['units'], $unitIds));
        } else {
            $cart[$barangId] = [
                'units' => $unitIds
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Unit berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return response()->json($cart); 
    }

    public function checkout()
    {
        $cartSession = session()->get('cart', []);
        
        if (empty($cartSession)) {
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda kosong!');
        }

        $barangIds = array_keys($cartSession);
        $cartItems = Barang::whereIn('id', $barangIds)->get()->map(function($brg) use ($cartSession) {
            $brg->selected_units = Unit::whereIn('id', $cartSession[$brg->id]['units'])->get();
            return $brg;
        });

        return view('landing-page.katalog.checkout', compact('cartItems'));
    }

    // Proses Submit Checkout ke DB
    public function processCheckout(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'perusahaan' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'emails' => 'required|email|max:255',
        ]);

        $cartSession = session()->get('cart', []);
        if (empty($cartSession)) {
            return redirect()->route('units.katalog')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $pemesanan = Pemesanan::create([
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'emails' => $request->emails,
                'status' => 'pending',
            ]);

            foreach ($cartSession as $barangId => $cartData) {
                $barang = Barang::with('hargaBarangs')->find($barangId);
                $qty = count($cartData['units']);
                
                $hargaRef = $barang->hargaBarangs->first();
                $harga = $hargaRef && is_numeric($hargaRef->harga) ? $hargaRef->harga : 0;
                
                $validSatuan = ['jam', 'hari', 'minggu', 'bulan', 'tahun'];
                $satuan = ($hargaRef && in_array(strtolower($hargaRef->satuan), $validSatuan)) ? strtolower($hargaRef->satuan) : 'jam';

                $detail = PemesananDetail::create([
                    'pemesanan_id' => $pemesanan->id,
                    'barang_id' => $barangId,
                    'qty' => $qty,
                    'harga' => $harga,
                    'satuan' => $satuan,
                    'durasi' => 1,
                ]);

                foreach ($cartData['units'] as $unitId) {
                    PemesananUnit::create([
                        'pemesanan_detail_id' => $detail->id,
                        'unit_id' => $unitId
                    ]);
                }
            }

            DB::commit(); 
            
           
            $adminEmail = config('mail.admin_address');
            
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new AdminCheckoutNotification($pemesanan));
            }
            

            session()->forget('cart');

           return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat! Tim kami akan segera menghubungi Anda.');

        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function removeItem($barangId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$barangId])) {
            unset($cart[$barangId]);
            session()->put('cart', $cart);
        }

        if (empty(session()->get('cart'))) {
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda sudah kosong.');
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('units.katalog')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function removeUnit($barangId, $unitId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$barangId])) {
            $units = $cart[$barangId]['units'];
            
            $key = array_search($unitId, $units);
            
            if ($key !== false) {
                unset($units[$key]);
                
                if (count($units) > 0) {
                    $cart[$barangId]['units'] = array_values($units); 
                } else {
                    unset($cart[$barangId]);
                }
                
                session()->put('cart', $cart);
            }
        }

        if (empty(session()->get('cart'))) {
            return redirect()->route('units.katalog')->with('error', 'Keranjang Anda sudah kosong.');
        }

        return back()->with('success', '1 Unit berhasil dihapus dari keranjang.');
    }

    public function success()
    {
        return view('landing-page.katalog.checkout-success');
    }
}