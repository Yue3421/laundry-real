@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<h1>Tambah Pengguna Baru</h1>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="id_outlet" class="form-label">Outlet</label>
        <select class="form-select" id="id_outlet" name="id_outlet" required>
            @foreach($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="owner">Owner</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection