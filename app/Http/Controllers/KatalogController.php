<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tipe;
use App\Models\Unit;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function katalog(Request $request)
    {
        $tipes = Tipe::all();

        $barangs = Barang::with('tipe')
            ->when($request->tipe_id, function ($q) use ($request) {
                $q->where('tipe_id', $request->tipe_id);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhereHas('units', function ($q2) use ($request) {
                        $q2->where('kode_unit', 'like', '%' . $request->search . '%');
                    });
                });
            })
            ->latest()
            ->get();

        return view('landing-page.katalog.katalog', compact('tipes', 'barangs'));
    }

    public function showByBarang(Barang $barang)
    {
        $barang->load('tipe', 'units', 'spesifikasis', 'hargaBarangs');
        
        $barangLainnya = Barang::where('tipe_id', $barang->tipe_id)
            ->where('id', '!=', $barang->id)
            ->latest()
            ->limit(4) 
            ->get();

        $cartSession = session()->get('cart', []);
        $cartItems = [];
        
        if (!empty($cartSession)) {
            $barangIds = array_keys($cartSession);
            $cartItems = Barang::with('hargaBarangs')->whereIn('id', $barangIds)->get()->map(function($brg) use ($cartSession) {
                $brg->selected_units = Unit::whereIn('id', $cartSession[$brg->id]['units'])->get();
                return $brg;
            });
        }

        return view('landing-page.katalog.detail', compact('barang', 'barangLainnya', 'cartItems'));
    }
}