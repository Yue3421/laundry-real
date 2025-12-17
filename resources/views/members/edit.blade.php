@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<h1>Edit Pelanggan: {{ $member->nama }}</h1>
<form action="{{ route('members.update', $member) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $member->nama }}" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required>{{ $member->alamat }}</textarea>
    </div>
    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="L" {{ $member->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ $member->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="tlp" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="tlp" name="tlp" value="{{ $member->tlp }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection