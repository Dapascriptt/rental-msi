<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tipe;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $barangs = Barang::all();

        $query = Unit::with('barang');

        if ($request->barang_id) {
            $query->where('barang_id', $request->barang_id);
        }

        $units = $query->latest()->paginate(15);

        $summary = Barang::withCount([
            'units as total_unit',
            'units as available_unit' => function ($q) {
                $q->where('status', 'available');
            }
        ])->get();

        return view('units.index', compact('units', 'barangs', 'summary'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('units.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'mode' => 'required|in:single,bulk',
            'kode_unit' => 'nullable|string|max:255',
            'serial_machine' => 'nullable|string|max:255',
            'serial_engine' => 'nullable|string|max:255',
            'tahun_migrasi' => 'nullable|integer|min:1900|max:' . date('Y'),
            'qty' => 'nullable|integer|min:1'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->mode === 'single') {
            Unit::create([
                'barang_id' => $barang->id,
                'kode_unit' => $request->kode_unit,
                'serial_machine' => $request->serial_machine,
                'serial_engine' => $request->serial_engine,
                'tahun_migrasi' => $request->tahun_migrasi,
                'status' => $request->status,
            ]);
        }

        if ($request->mode === 'bulk') {
            $qty = $request->qty;

            // Ambil unit terakhir berdasarkan kode_unit
            $lastUnit = Unit::where('barang_id', $barang->id)
                ->orderBy('id', 'desc')
                ->first();

            // Default mulai dari 0
            $lastNumber = 0;

            if ($lastUnit && $lastUnit->kode_unit) {
                // Ambil angka dari kode_unit (misal: ABC-007 -> 7)
                preg_match('/(\d+)$/', $lastUnit->kode_unit, $matches);
                $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            }

            for ($i = 1; $i <= $qty; $i++) {
                $number = $lastNumber + $i;

                Unit::create([
                    'barang_id' => $barang->id,
                    'kode_unit' => strtoupper(substr($barang->nama_barang, 0, 3))
                                    . '-' . str_pad($number, 3, '0', STR_PAD_LEFT),
                    'status' => $request->status,
                ]);
            }
        }

        return redirect()->route('units.index');
    }

    public function edit(Unit $unit)
    {
        $barangs = Barang::all();
        return view('units.create', compact('unit', 'barangs'));
    }

   public function update(Request $request, Unit $unit)
    {
        if ($unit->status === 'booked' && $request->status !== 'booked') {
            return back()->with('error', 'Unit sedang dalam masa sewa (Booked), status tidak boleh diubah manual!');
        }

        $rules = [
            'barang_id' => 'required|exists:barangs,id',
            'kode_unit' => 'required|string|max:255',
            'serial_machine' => 'nullable|string|max:255',
            'serial_engine' => 'nullable|string|max:255',
            'tahun_migrasi' => 'nullable|integer|min:1900|max:' . date('Y'),
        ];

        if ($unit->status !== 'booked') {
            $rules['status'] = 'required|in:available,maintenance';
        }

        $request->validate($rules);

        $dataToUpdate = $request->only('barang_id', 'kode_unit', 'serial_machine', 'serial_engine', 'tahun_migrasi');

        if ($unit->status !== 'booked') {
            $dataToUpdate['status'] = $request->status;
        }

        $unit->update($dataToUpdate);

        return redirect()->route('units.index')->with('success', 'Data unit berhasil diperbarui!');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->status !== 'available') {
            return back()->withErrors([
                'error' => 'Unit tidak bisa dihapus karena tidak dalam kondisi available'
            ]);
        }

        $unit->delete();

        return back()->with('success', 'Unit berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:units,id'
        ]);

        $deleted = Unit::whereIn('id', $request->ids)
            ->where('status', 'available')
            ->delete();

        return back()->with('success', $deleted . ' unit berhasil dihapus');
    }
}
