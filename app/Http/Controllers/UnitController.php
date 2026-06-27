<?php

namespace App\Http\Controllers;                 // alamat class

use App\Models\Barang;                          // model Barang
use App\Models\Tipe;                            // model Tipe
use App\Models\Unit;                            // model Unit
use Illuminate\Http\Request;                    // pembawa data form

class UnitController extends Controller
{
    public function index(Request $request)     // menampilkan daftar unit (dengan filter & ringkasan)
    {
        $barangs = Barang::all();               // semua barang (untuk dropdown filter)

        $query = Unit::with('barang');          // siapkan query unit + data barangnya

        if ($request->barang_id) {              // jika user memilih filter barang tertentu
            $query->where('barang_id', $request->barang_id); // saring berdasarkan barang itu
        }

        $units = $query->latest()->paginate(15); // urutkan terbaru, tampilkan 15 per halaman (paginasi)

        $summary = Barang::withCount([          // hitung jumlah unit per barang untuk ringkasan
            'units as total_unit',              // total semua unit
            'units as available_unit' => function ($q) { // unit yang statusnya available saja
                $q->where('status', 'available');
            }
        ])->get();

        return view('units.index', compact('units', 'barangs', 'summary'));
    }

    public function create()                    // form tambah unit
    {
        $barangs = Barang::all();
        return view('units.create', compact('barangs'));
    }

    public function store(Request $request)     // menyimpan unit baru (bisa 1 unit atau banyak sekaligus)
    {
        $request->validate([                    // validasi input
            'barang_id' => 'required|exists:barangs,id',
            'mode' => 'required|in:single,bulk', // mode: 'single' (satu) atau 'bulk' (banyak)
            'kode_unit' => 'nullable|string|max:255',
            'serial_machine' => 'nullable|string|max:255',
            'serial_engine' => 'nullable|string|max:255',
            'tahun_migrasi' => 'nullable|integer|min:1900|max:' . date('Y'), // tahun wajar, maks tahun ini
            'qty' => 'nullable|integer|min:1'
        ]);

        $barang = Barang::findOrFail($request->barang_id); // pastikan barangnya ada

        if ($request->mode === 'single') {      // MODE SATU: buat 1 unit saja
            Unit::create([
                'barang_id' => $barang->id,
                'kode_unit' => $request->kode_unit,
                'serial_machine' => $request->serial_machine,
                'serial_engine' => $request->serial_engine,
                'tahun_migrasi' => $request->tahun_migrasi,
                'status' => $request->status,
            ]);
        }

        if ($request->mode === 'bulk') {        // MODE BANYAK: buat beberapa unit + kode otomatis
            $qty = $request->qty;               // berapa unit yang mau dibuat

            // Ambil unit terakhir agar penomoran kode lanjut dari yang sudah ada
            $lastUnit = Unit::where('barang_id', $barang->id)
                ->orderBy('id', 'desc')
                ->first();

            $lastNumber = 0;                    // default mulai dari 0

            if ($lastUnit && $lastUnit->kode_unit) {
                // Ambil angka di akhir kode_unit (misal: ABC-007 -> 7)
                preg_match('/(\d+)$/', $lastUnit->kode_unit, $matches);
                $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            }

            for ($i = 1; $i <= $qty; $i++) {    // ulangi sebanyak qty
                $number = $lastNumber + $i;     // nomor urut berikutnya

                Unit::create([
                    'barang_id' => $barang->id,
                    // kode = 3 huruf pertama nama barang + nomor 3 digit (contoh: KOM-001)
                    'kode_unit' => strtoupper(substr($barang->nama_barang, 0, 3))
                                    . '-' . str_pad($number, 3, '0', STR_PAD_LEFT),
                    'status' => $request->status,
                ]);
            }
        }

        return redirect()->route('units.index');
    }

    public function edit(Unit $unit)            // form edit unit
    {
        $barangs = Barang::all();
        return view('units.create', compact('unit', 'barangs'));
    }

   public function update(Request $request, Unit $unit) // menyimpan perubahan unit
    {
        // aturan bisnis: unit yang sedang disewa (booked) tidak boleh diubah statusnya manual
        if ($unit->status === 'booked' && $request->status !== 'booked') {
            return back()->with('error', 'Unit sedang dalam masa sewa (Booked), status tidak boleh diubah manual!');
        }

        $rules = [                              // aturan validasi dasar
            'barang_id' => 'required|exists:barangs,id',
            'kode_unit' => 'required|string|max:255',
            'serial_machine' => 'nullable|string|max:255',
            'serial_engine' => 'nullable|string|max:255',
            'tahun_migrasi' => 'nullable|integer|min:1900|max:' . date('Y'),
        ];

        if ($unit->status !== 'booked') {       // status hanya boleh diubah kalau bukan booked
            $rules['status'] = 'required|in:available,maintenance';
        }

        $request->validate($rules);             // jalankan validasi

        $dataToUpdate = $request->only('barang_id', 'kode_unit', 'serial_machine', 'serial_engine', 'tahun_migrasi'); // ambil kolom tertentu saja

        if ($unit->status !== 'booked') {
            $dataToUpdate['status'] = $request->status; // ikutkan status hanya jika boleh diubah
        }

        $unit->update($dataToUpdate);           // perbarui data unit

        return redirect()->route('units.index')->with('success', 'Data unit berhasil diperbarui!');
    }

    public function destroy(Unit $unit)         // menghapus unit
    {
        if ($unit->status !== 'available') {    // hanya boleh hapus unit yang available
            return back()->withErrors([
                'error' => 'Unit tidak bisa dihapus karena tidak dalam kondisi available'
            ]);
        }

        $unit->delete();                        // hapus unit

        return back()->with('success', 'Unit berhasil dihapus');
    }

    public function bulkDelete(Request $request) // menghapus banyak unit sekaligus (centang lalu hapus)
    {
        $request->validate([
            'ids' => 'required|array',          // harus berupa array id
            'ids.*' => 'exists:units,id'        // tiap id harus ada di tabel units
        ]);

        $deleted = Unit::whereIn('id', $request->ids) // ambil unit yang dipilih
            ->where('status', 'available')      // tapi hanya yang available yang boleh dihapus
            ->delete();                         // hapus; $deleted = jumlah yang terhapus

        return back()->with('success', $deleted . ' unit berhasil dihapus');
    }
}
