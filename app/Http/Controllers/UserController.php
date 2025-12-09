<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }
        $users = User::with('outlet')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $outlets = Outlet::all();
        return view('users.create', compact('outlets'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:30|unique:tb_user',
            'password' => 'required|string|min:6',
            'id_outlet' => 'required|exists:tb_outlet,id',
            'role' => 'required|in:admin,kasir,owner',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_outlet' => $request->id_outlet,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $user->load('outlet');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $outlets = Outlet::all();
        return view('users.edit', compact('user', 'outlets'));
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:30|unique:tb_user,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'id_outlet' => 'required|exists:tb_outlet,id',
            'role' => 'required|in:admin,kasir,owner',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}