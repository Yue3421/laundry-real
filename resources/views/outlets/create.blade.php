@extends('layouts.app')

@section('title', 'Tambah Outlet')

@section('content')
<h1>Tambah Outlet Baru</h1>
<form action="{{ route('outlets.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Outlet</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
    </div>
    <div class="mb-3">
        <label for="tlp" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="tlp" name="tlp" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('outlets.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection