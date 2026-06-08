<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Car Rental System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #111827; color: white; }
        .sidebar a { color: #d1d5db; text-decoration: none; }
        .sidebar a:hover { color: #fff; }
        .card-modern { border: 0; border-radius: 18px; box-shadow: 0 8px 30px rgba(0,0,0,.06); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="{{ route('home') }}">Car Rental</a>

    <div class="ms-auto d-flex align-items-center gap-2">
        @auth
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Register</a>
        @endauth
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        @auth
            <div class="col-md-2 sidebar p-4">
                <h5 class="mb-4">Menu</h5>
                <ul class="nav flex-column gap-2">
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
                        <li class="nav-item"><a href="{{ route('admin.vehicles.index') }}">Véhicules</a></li>
                        <li class="nav-item"><a href="{{ route('admin.reservations.index') }}">Réservations</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('client.reservations.index') }}">Mes réservations</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-md-10 p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        @else
            <div class="col-12 p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        @endauth
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>