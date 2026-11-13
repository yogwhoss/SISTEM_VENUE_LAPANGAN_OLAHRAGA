<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title', 'Pelanggan & Member')</title>
</head>
<body>

    @auth
        <div class="topbar">
            <span>Masuk sebagai <strong>{{ auth()->user()->name }}</strong>
                <span class="badge badge-{{ auth()->user()->role }}">{{ auth()->user()->role }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    @endauth

    @yield('content')

</body>
</html>
