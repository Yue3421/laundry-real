@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<h1>Edit Pengguna: {{ $user->nama }}</h1>
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="mb-3">
        <label for="id_outlet" class="form-label">Outlet</label>
        <select class="form-select" id="id_outlet" name="id_outlet" required>
            @foreach($outlets as $outlet)
                <option value="{{ $outlet->id }}" {{ $user->id_outlet == $outlet->id ? 'selected' : '' }}>{{ $outlet->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" id="role" name="role" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
            <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection