@extends('layouts.app')

@section('title', 'Edit Outlet')

@section('content')
<h1>Edit Outlet: {{ $outlet->nama }}</h1>
<form action="{{ route('outlets.update', $outlet) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Outlet</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $outlet->nama }}" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required>{{ $outlet->alamat }}</textarea>
    </div>
    <div class="mb-3">
        <label for="tlp" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="tlp" name="tlp" value="{{ $outlet->tlp }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('outlets.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection