<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }
        $outlets = Outlet::all();
        return view('outlets.index', compact('outlets'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('outlets.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tlp' => 'required|string|max:15',
        ]);

        Outlet::create($request->all());
        return redirect()->route('outlets.index')->with('success', 'Outlet berhasil ditambahkan!');
    }

    public function show(Outlet $outlet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('outlets.show', compact('outlet'));
    }

    public function edit(Outlet $outlet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('outlets.edit', compact('outlet'));
    }

    public function update(Request $request, Outlet $outlet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tlp' => 'required|string|max:15',
        ]);

        $outlet->update($request->all());
        return redirect()->route('outlets.index')->with('success', 'Outlet berhasil diupdate!');
    }

    public function destroy(Outlet $outlet)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $outlet->delete();
        return redirect()->route('outlets.index')->with('success', 'Outlet berhasil dihapus!');
    }
}