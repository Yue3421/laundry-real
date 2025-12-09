@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<h1>Daftar Pelanggan</h1>
<a href="{{ route('members.create') }}" class="btn btn-primary mb-3"><i class="bi bi-plus"></i> Tambah Pelanggan</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->alamat }}</td>
                <td>{{ $member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $member->tlp }}</td>
                <td>
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection