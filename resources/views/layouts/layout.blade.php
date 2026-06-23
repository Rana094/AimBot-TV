<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Aimbot TV - Premium IPTV & Stream Player')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="https://img.icons8.com/nolan/64/television.png" type="image/png">
</head>
<body>
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <header>
        <div class="nav-container">
            <a href="{{ route('landing') }}" class="logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="url(#logoGrad)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <defs>
                        <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#9d4edd" />
                            <stop offset="100%" stop-color="#00f5d4" />
                        </linearGradient>
                    </defs>
                    <rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect>
                    <polyline points="17 2 12 7 7 2"></polyline>
                </svg>
                Aimbot <span>TV</span>
            </a>
            <nav class="nav-links">
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    @endif
                    <a href="{{ route('user.dashboard') }}">Watch TV</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-secondary">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <div class="container" style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
            @if(session('success'))
                <div class="alert alert-success" style="margin-top: 2rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="margin-top: 2rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Aimbot TV. All rights reserved. Created for IPTV & M3U Web Integration Course.</p>
        </div>
    </footer>
</body>
</html>
