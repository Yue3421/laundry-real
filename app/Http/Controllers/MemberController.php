<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403, 'Akses ditolak!');
        }
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        return view('members.create');
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|string|max:15',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function show(Member $member)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|string|max:15',
        ]);

        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy(Member $member)
    {
        if (!in_array(auth()->user()->role, ['admin', 'kasir'])) {
            abort(403);
        }
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}