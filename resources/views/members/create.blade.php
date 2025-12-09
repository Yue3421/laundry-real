@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<h1>Tambah Pelanggan Baru</h1>
<form action="{{ route('members.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
    </div>
    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tlp" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="tlp" name="tlp" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection