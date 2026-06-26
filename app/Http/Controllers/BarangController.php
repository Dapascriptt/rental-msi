<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tipe;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('tipe')->get();

        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        $tipes = Tipe::all();

        return view('barangs.create', compact('tipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tipe_id' => 'required|exists:tipes,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

            $validated['image'] = $filename;
        }

        Barang::create($validated);

        return redirect()->route('barangs.index');
    }

    public function edit(Barang $barang)
    {
        $tipes = Tipe::all();

        return view('barangs.create', compact('barang', 'tipes'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tipe_id' => 'required|exists:tipes,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {
            if ($barang->image && file_exists(public_path('images/' . $barang->image))) {
                unlink(public_path('images/' . $barang->image));
            }

            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

            $validated['image'] = $filename;
        }

        $barang->update($validated);

        return redirect()->route('barangs.index');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->image && file_exists(public_path('images/' . $barang->image))) {
            unlink(public_path('images/' . $barang->image));
        }

        $barang->delete();

        return back();
    }
}