@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container mt-5">
    <h2 class="text-center mb-4">Login Aplikasi Laundry</h2>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-3">Role: Admin, Kasir, atau Owner</p> <!-- Optional reminder -->
</div>
@endsection