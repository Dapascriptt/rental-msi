<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    public function index()
    {
        $tipes = Tipe::all();
        return view('tipes.index', compact('tipes'));
    }

    public function create()
    {
        return view('tipes.create');
    }

    public function store(Request $request)
    {
        Tipe::create($request->all());
        return redirect()->route('tipes.index');
    }

    public function edit(Tipe $tipe)
    {
        return view('tipes.create', compact('tipe'));
    }

    public function update(Request $request, Tipe $tipe)
    {
        $tipe->update($request->all());
        return redirect()->route('tipes.index');
    }

    public function destroy(Tipe $tipe)
    {
        $tipe->delete();
        return back();
    }
}
