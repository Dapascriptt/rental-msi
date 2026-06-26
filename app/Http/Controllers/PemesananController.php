<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusMail;
use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\PemesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $pemesanans = $query->get();

        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('pemesanan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $pemesanan = Pemesanan::create($request->only([
            'nama_pemesan',
            'no_hp',
            'perusahaan',
            'alamat',
            'tanggal_mulai',
            'tanggal_selesai'
        ]));

        foreach ($request->items as $item) {
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

    public function edit($id)
    {
        $pemesanan = Pemesanan::with('details.barang', 'details.units.unit')->findOrFail($id);
        return view('pemesanan.edit', compact('pemesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:ongoing,confirmed,cancelled',
            'keterangan' => 'nullable|string'
        ]);

        $pemesanan = Pemesanan::with('details.units.unit')->findOrFail($id);
        $newStatus = $request->status;
        $keterangan = $request->keterangan;

        $pemesanan->update([
            'status' => $newStatus,
            'keterangan' => $keterangan
        ]);

        $unitStatus = null;
        if ($newStatus === 'ongoing') {
            $unitStatus = 'booked';
        } elseif ($newStatus === 'confirmed' || $newStatus === 'cancelled') {
            $unitStatus = 'available';
        }

        if ($unitStatus) {
            foreach ($pemesanan->details as $detail) {
                foreach ($detail->units as $pemesananUnit) {
                    if ($pemesananUnit->unit) {
                        $pemesananUnit->unit->update([
                            'status' => $unitStatus
                        ]);
                    }
                }
            }
        }

        if (!empty($pemesanan->emails)) {
            Mail::to($pemesanan->emails)->send(new OrderStatusMail($pemesanan, $newStatus, $keterangan));
        }

        return redirect()->back()->with('success', "Status pemesanan berhasil diubah menjadi {$newStatus} dan notifikasi telah dikirim ke customer.");
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->status !== 'pending') {
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
