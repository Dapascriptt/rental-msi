<?php

namespace App\Http\Controllers;                 // alamat class

use App\Mail\OrderStatusMail;                   // email pemberitahuan perubahan status
use App\Models\Barang;                          // model Barang
use App\Models\Pemesanan;                       // model Pemesanan
use App\Models\PemesananDetail;                 // model detail pemesanan
use Illuminate\Http\Request;                    // pembawa data form
use Illuminate\Support\Facades\Mail;            // untuk mengirim email

class PemesananController extends Controller     // controller kelola pemesanan (area admin)
{
    public function index(Request $request)      // menampilkan daftar pemesanan (bisa difilter status)
    {
        $query = Pemesanan::latest();            // siapkan query, urut terbaru

        if ($request->has('status')) {           // jika ada filter status di URL
            $query->where('status', $request->status);
        }

        $pemesanans = $query->get();             // ambil hasil

        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()                     // form buat pemesanan manual
    {
        $barangs = Barang::all();
        return view('pemesanan.create', compact('barangs'));
    }

    public function store(Request $request)      // menyimpan pemesanan baru (input manual admin)
    {
        $pemesanan = Pemesanan::create($request->only([ // simpan data utama (ambil kolom tertentu saja)
            'nama_pemesan',
            'no_hp',
            'perusahaan',
            'alamat',
            'tanggal_mulai',
            'tanggal_selesai'
        ]));

        foreach ($request->items as $item) {     // simpan tiap item barang yang dipesan
            PemesananDetail::create([
                'pemesanan_id' => $pemesanan->id,
                'barang_id' => $item['barang_id'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'satuan' => $item['satuan'],
                'durasi' => $item['durasi'],
            ]);
        }

        return redirect()->route('pemesanan.index');
    }

    public function edit($id)                    // menampilkan detail/edit 1 pemesanan
    {
        // ambil pemesanan + relasi bertingkat (detail -> barang, detail -> units -> unit) sekaligus
        $pemesanan = Pemesanan::with('details.barang', 'details.units.unit')->findOrFail($id);
        return view('pemesanan.edit', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id) // mengubah status pemesanan + dampaknya ke unit & email
    {
        $request->validate([
            'status' => 'required|in:ongoing,confirmed,cancelled', // status hanya boleh 3 nilai ini
            'keterangan' => 'nullable|string'
        ]);

        $pemesanan = Pemesanan::with('details.units.unit')->findOrFail($id); // ambil pemesanan + unitnya
        $newStatus = $request->status;
        $keterangan = $request->keterangan;

        $pemesanan->update([                     // perbarui status pemesanan
            'status' => $newStatus,
            'keterangan' => $keterangan
        ]);

        $unitStatus = null;                      // tentukan status unit mengikuti status pemesanan
        if ($newStatus === 'ongoing') {          // jika pesanan sedang berjalan
            $unitStatus = 'booked';              // unit jadi 'booked' (tidak bisa disewa orang lain)
        } elseif ($newStatus === 'confirmed' || $newStatus === 'cancelled') { // jika selesai atau dibatalkan
            $unitStatus = 'available';           // unit kembali 'available'
        }

        if ($unitStatus) {                       // jika ada perubahan status unit
            foreach ($pemesanan->details as $detail) {      // loop tiap detail
                foreach ($detail->units as $pemesananUnit) { // loop tiap unit di detail
                    if ($pemesananUnit->unit) {
                        $pemesananUnit->unit->update([       // ubah status unit aslinya
                            'status' => $unitStatus
                        ]);
                    }
                }
            }
        }

        if (!empty($pemesanan->emails)) {        // jika pemesan punya email, kirim notifikasi perubahan status
            Mail::to($pemesanan->emails)->send(new OrderStatusMail($pemesanan, $newStatus, $keterangan));
        }

        return redirect()->back()->with('success', "Status pemesanan berhasil diubah menjadi {$newStatus} dan notifikasi telah dikirim ke customer.");
    }

    public function destroy($id)                 // menghapus pemesanan
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'pending') {  // aturan bisnis: hanya boleh hapus jika masih 'pending'
            return redirect()
                ->back()
                ->with('error', 'Pemesanan hanya bisa dihapus ketika status masih pending.');
        }

        $pemesanan->delete();

        return redirect()
            ->route('pemesanan.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }

}
