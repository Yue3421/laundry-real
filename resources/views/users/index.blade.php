@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<h1>Daftar Pengguna</h1>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Pengguna</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Outlet</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->outlet->nama }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pengguna ini?')"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection