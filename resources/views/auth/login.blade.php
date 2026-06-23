@extends('layouts.layout')

@section('title', 'Login - Aimbot TV')

@section('content')
<div class="glass-card">
    <h2>Welcome Back</h2>
    <p class="subtitle">Sign in to access your IPTV streaming catalog</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div style="font-size: 0.9rem;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif


    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
        </div>

        <label class="form-check">
            <input type="checkbox" name="remember" id="remember">
            <span>Remember me</span>
        </label>

        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.8rem; border-radius: 12px; font-size: 1rem; margin-bottom: 1.5rem;">
            Sign In
        </button>
    </form>


</div>
@endsection
