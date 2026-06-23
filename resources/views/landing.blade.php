@extends('layouts.layout')

@section('title', 'Aimbot TV - Next Generation IPTV & M3U Stream Player')

@section('content')
<div class="hero">
    <h1>Aimbot TV Stream Hub</h1>
    <p>Experience ultra-responsive, high-definition IPTV streaming directly in your web browser. Import M3U playlists, manage channels, and play HLS streams using state-of-the-art Web-HLS rendering.</p>
    
    <div style="margin-top: 1rem; display: flex; gap: 1rem; justify-content: center;">
        @auth
            <a href="{{ route('user.dashboard') }}" class="btn-primary" style="font-size: 1.1rem; padding: 0.8rem 2.5rem;">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Launch Player
            </a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary" style="font-size: 1.1rem; padding: 0.8rem 2.5rem;">
                    Admin Panel
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn-primary" style="font-size: 1.1rem; padding: 0.8rem 2.5rem;">
                Get Started / Login
            </a>
        @endauth
    </div>
</div>

<div class="features-section" style="max-width: 1200px; margin: 4rem auto 8rem; padding: 0 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
    <div class="glass-card" style="margin: 0; max-width: 100%;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(0, 245, 212, 0.1); border: 1px solid var(--secondary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
            <svg width="24" height="24" fill="none" stroke="var(--secondary)" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.8rem;">M3U Playlist Parsing</h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6;">Upload any standard .m3u playlist file. The admin dashboard parses metadata, extracts stream links and logos, and automatically imports channels.</p>
    </div>

    <div class="glass-card" style="margin: 0; max-width: 100%;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(157, 78, 221, 0.1); border: 1px solid var(--primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
            <svg width="24" height="24" fill="none" stroke="var(--primary)" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.8rem;">Advanced HLS Playback</h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6;">Leverages the industry-standard Hls.js library to transcode and display high-bitrate live video streams smoothly within your web player.</p>
    </div>

    <div class="glass-card" style="margin: 0; max-width: 100%;">
        <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255, 0, 127, 0.1); border: 1px solid var(--accent); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
            <svg width="24" height="24" fill="none" stroke="var(--accent)" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h3 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.8rem;">Role-Based Dashboards</h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6;">Secure channels management for administrators and a highly-focused interactive entertainment grid player for standard users.</p>
    </div>
</div>
@endsection
