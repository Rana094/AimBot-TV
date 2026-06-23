@extends('layouts.layout')

@section('title', 'Admin Dashboard - Aimbot TV')

@section('content')
<div class="admin-header">
    <div>
        <h1 style="font-size: 2.2rem; font-weight: 800;">Admin Panel</h1>
        <p style="color: var(--text-secondary); margin-top: 0.25rem;">Manage IPTV streams and bulk import playlists</p>
    </div>
    <div>
        <a href="{{ route('user.dashboard') }}" class="btn-primary">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            Watch Mode
        </a>
    </div>
</div>

<div class="admin-grid">
    <!-- Main Channel Management Section -->
    <div>
        <!-- Stats Row -->
        <div class="stats-container">
            <div class="stat-card">
                <span class="value">{{ $stats['total_channels'] }}</span>
                <span class="label">Total Channels</span>
            </div>
            <div class="stat-card">
                <span class="value" style="color: var(--primary);">{{ $stats['active_channels'] }}</span>
                <span class="label">Active Streams</span>
            </div>
            <div class="stat-card">
                <span class="value" style="color: var(--accent);">{{ $stats['total_users'] }}</span>
                <span class="label">Registered Users</span>
            </div>
        </div>

        <!-- Channels Table -->
        <div class="table-card">
            <div class="table-header">
                <h3>Streams Catalog</h3>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 80px;">Logo</th>
                            <th style="width: 60px; text-align: center;">Fav</th>
                            <th>Channel Name</th>
                            <th>Group</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th style="width: 100px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($channels as $channel)
                            <tr>
                                <td>
                                    <div style="width: 45px; height: 45px; border-radius: 8px; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--border-color);">
                                        @if($channel->logo_url)
                                            <img src="{{ $channel->logo_url }}" alt="Logo" style="max-width: 80%; max-height: 80%; object-fit: contain;">
                                        @else
                                            <span style="font-weight: 700; color: var(--primary); font-size: 0.9rem;">{{ substr($channel->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('user.channels.favorite', $channel->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; cursor: pointer; color: {{ Auth::user()->favoriteChannels->contains($channel->id) ? '#ffb703' : 'var(--text-secondary)' }}; transition: var(--transition); display: flex; align-items: center; justify-content: center; margin: 0 auto;" title="Favorite Channel">
                                            @if(Auth::user()->favoriteChannels->contains($channel->id))
                                                <!-- Filled Star -->
                                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                </svg>
                                            @else
                                                <!-- Outline Star -->
                                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <div style="font-weight: 600;">{{ $channel->name }}</div>
                                    <div style="color: var(--text-secondary); font-family: monospace; font-size: 0.75rem; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 0.25rem;">
                                        {{ $channel->stream_url }}
                                    </div>
                                </td>
                                <td>
                                    <span style="color: var(--text-secondary); font-size: 0.9rem;">
                                        {{ $channel->group ?? 'None' }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-size: 0.75rem; background: rgba(157, 78, 221, 0.15); border: 1px solid var(--primary); padding: 0.15rem 0.5rem; border-radius: 4px; color: #d4a373; font-weight: 600;">
                                        {{ strtoupper($channel->type) }}
                                    </span>
                                </td>
                                <td>
                                    @if($channel->is_active)
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('admin.channels.delete', $channel->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this channel?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: 3rem;">
                                    No channels found. Add some manually or upload an M3U playlist.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($channels->hasPages())
                <div style="padding: 1.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">
                        Showing {{ $channels->firstItem() }} to {{ $channels->lastItem() }} of {{ $channels->total() }} streams
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        @if($channels->onFirstPage())
                            <span class="btn-secondary" style="opacity: 0.5; cursor: not-allowed;">Previous</span>
                        @else
                            <a href="{{ $channels->previousPageUrl() }}" class="btn-secondary">Previous</a>
                        @endif

                        @if($channels->hasMorePages())
                            <a href="{{ $channels->nextPageUrl() }}" class="btn-primary">Next</a>
                        @else
                            <span class="btn-primary" style="opacity: 0.5; cursor: not-allowed; box-shadow: none; background: #5a189a;">Next</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Users Table -->
        <div class="table-card" style="margin-top: 2rem;">
            <div class="table-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3>Registered Users</h3>
                <span style="font-size: 0.85rem; color: var(--text-secondary); background: rgba(255,255,255,0.05); padding: 0.2rem 0.6rem; border-radius: 20px; border: 1px solid var(--border-color);">
                    {{ count($users) }}
                </span>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User Details</th>
                            <th>Role</th>
                            <th style="width: 100px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $user->name }}</div>
                                    <div style="color: var(--text-secondary); font-size: 0.8rem; margin-top: 0.15rem;">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <span style="font-size: 0.75rem; background: {{ $user->role == 'admin' ? 'rgba(0, 245, 212, 0.15)' : 'rgba(255, 255, 255, 0.05)' }}; border: 1px solid {{ $user->role == 'admin' ? 'var(--secondary)' : 'var(--border-color)' }}; padding: 0.15rem 0.5rem; border-radius: 4px; color: {{ $user->role == 'admin' ? 'var(--secondary)' : 'var(--text-secondary)' }}; font-weight: 600;">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <span style="font-size: 0.8rem; color: var(--text-secondary); font-style: italic;">Active Self</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Side Addition Forms -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <!-- Add Manually -->
        <div class="glass-card" style="margin: 0; max-width: 100%; padding: 2rem;">
            <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Stream Manually
            </h3>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem;">Input stream details and player configurations</p>

            <form action="{{ route('admin.channels.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Channel Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Discovery HD" required>
                </div>
                <div class="form-group">
                    <label for="logo_url">Logo URL (Optional)</label>
                    <input type="url" name="logo_url" id="logo_url" class="form-control" placeholder="e.g. https://logo.com/img.png">
                </div>
                <div class="form-group">
                    <label for="stream_url">Stream URL (.m3u8 / .mpd)</label>
                    <input type="text" name="stream_url" id="stream_url" class="form-control" placeholder="e.g. https://stream.m3u8" required>
                </div>
                <div class="form-group">
                    <label for="group">Group / Category (Optional)</label>
                    <input type="text" name="group" id="group" class="form-control" placeholder="e.g. Sports">
                </div>
                <div class="form-group">
                    <label for="type">Stream Type / Player</label>
                    <select name="type" id="type" class="form-control" style="background: rgba(8, 7, 16, 0.95); color: white;" onchange="toggleDrmFields(this.value)">
                        <option value="hls" selected>HLS (Hls.js / Native)</option>
                        <option value="dash">MPEG-DASH (Shaka Player)</option>
                    </select>
                </div>

                <!-- DASH DRM Panel -->
                <div id="drm-fields" style="display: none; border-left: 2px solid var(--primary); padding-left: 1rem; margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.9rem; font-weight: 600; margin-bottom: 0.8rem; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">ClearKey DRM</h4>
                    <div class="form-group">
                        <label for="drm_kid">Key ID (HEX)</label>
                        <input type="text" name="drm_kid" id="drm_kid" class="form-control" placeholder="e.g. f8b207c10f3f76aeba32a360ec52b9e4">
                    </div>
                    <div class="form-group">
                        <label for="drm_key">Content Key (HEX)</label>
                        <input type="text" name="drm_key" id="drm_key" class="form-control" placeholder="e.g. afad49d20eb39670e93e371c1d669921">
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.7rem; border-radius: 10px; font-size: 0.95rem;">
                    Add Channel
                </button>
            </form>
        </div>

        <!-- M3U Playlist Bulk Import -->
        <div class="glass-card" style="margin: 0; max-width: 100%; padding: 2rem;">
            <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--secondary)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                Bulk Upload M3U
            </h3>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem;">Upload an .m3u file to extract multiple channels instantly</p>

            <form action="{{ route('admin.channels.upload-m3u') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="file-upload-wrapper">
                        <input type="file" name="m3u_file" id="m3u_file" accept=".m3u,.txt" required onchange="updateFileName(this)">
                        <div class="file-upload-label" id="file-label">
                            <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V4a2 2 0 012-2h6l2 2h6a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Choose M3U playlist file</span>
                            <span style="font-size: 0.75rem; opacity: 0.7;">Accepts .m3u, .txt files</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.7rem; border-radius: 10px; font-size: 0.95rem; background: linear-gradient(135deg, var(--secondary) 0%, #00bbf9 100%); box-shadow: 0 4px 15px var(--secondary-glow);">
                    Import Playlist
                </button>
            </form>
        </div>

        <!-- Add User Directly -->
        <div class="glass-card" style="margin: 0; max-width: 100%; padding: 2rem;">
            <h3 style="font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--accent)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create User Account
            </h3>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem;">Directly register a new User or Admin account</p>

            <form action="{{ route('admin.users.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_name">Full Name</label>
                    <input type="text" name="name" id="user_name" class="form-control" placeholder="e.g. Alice Smith" required>
                </div>
                <div class="form-group">
                    <label for="user_email">Email Address</label>
                    <input type="email" name="email" id="user_email" class="form-control" placeholder="e.g. alice@example.com" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" name="password" id="user_password" class="form-control" placeholder="Minimum 6 characters" required>
                </div>
                <div class="form-group">
                    <label for="user_role">Account Role</label>
                    <select name="role" id="user_role" class="form-control" style="background: rgba(8, 7, 16, 0.95); color: white;">
                        <option value="user" selected>Standard User</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.7rem; border-radius: 10px; font-size: 0.95rem; background: linear-gradient(135deg, var(--accent) 0%, #d80032 100%); box-shadow: 0 4px 15px rgba(255, 0, 127, 0.3);">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const label = document.getElementById('file-label');
    if(input.files && input.files[0]) {
        label.innerHTML = `
            <svg width="32" height="32" fill="none" stroke="var(--secondary)" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span style="color: white; font-weight: 600;">\${input.files[0].name}</span>
            <span style="font-size: 0.75rem; color: var(--text-secondary);">Ready to upload</span>
        `;
    }
}

function toggleDrmFields(val) {
    document.getElementById('drm-fields').style.display = (val === 'dash') ? 'block' : 'none';
}
</script>
@endsection
