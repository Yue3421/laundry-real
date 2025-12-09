<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Outlet;

class PaketController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }
        $pakets = Paket::with('outlet')->get();
        return view('pakets.index', compact('pakets'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $outlets = Outlet::all();
        return view('pakets.create', compact('outlets'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'id_outlet' => 'required|exists:tb_outlet,id',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama_paket' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
        ]);

        Paket::create($request->all());
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function show(Paket $paket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $paket->load('outlet');
        return view('pakets.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $outlets = Outlet::all();
        return view('pakets.edit', compact('paket', 'outlets'));
    }

    public function update(Request $request, Paket $paket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'id_outlet' => 'required|exists:tb_outlet,id',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama_paket' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
        ]);

        $paket->update($request->all());
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy(Paket $paket)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Paket berhasil dihapus!');
    }
}