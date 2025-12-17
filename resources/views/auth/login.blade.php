<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"> <!-- Untuk icon -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
        body {
            background-color: #343a40; 
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
        }
        .login-container {
            max-width: 400px; 
            padding: 20px;
            background-color: white; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }
        .form-label {
            color: black;
        }
        .alert-danger {
            color: #dc3545; 
        }
        li{
            list-style: none;
            text-align: left;
        }
        .bi-cart {
            font-size: 3rem;
            color: #343a40;
            display: block;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <i class="bi bi-cart"></i>
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
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            });
        @endif
    </script>
</body>
</html>