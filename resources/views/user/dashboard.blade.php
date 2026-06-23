@extends('layouts.layout')

@section('title', 'Watch TV - Aimbot TV')

@section('content')
<!-- Include Hls.js and Shaka Player CDNs -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/4.3.5/shaka-player.compiled.js"></script>

<div class="dashboard-container">
    <!-- Channel Selection Catalog -->
    <div class="catalog-section">
        <div class="catalog-header">
            <h2 style="font-size: 1.5rem; font-weight: 700; background: linear-gradient(45deg, #ffffff, var(--text-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                Channels List
            </h2>
            <span style="font-size: 0.85rem; color: var(--text-secondary); background: rgba(255,255,255,0.05); padding: 0.3rem 0.8rem; border-radius: 20px; border: 1px solid var(--border-color);">
                {{ $channels->count() }}
            </span>
        </div>

        <!-- Favorites Toggle Filter Tabs -->
        <div style="display: flex; gap: 0.5rem; margin-top: 1rem; margin-bottom: 1.5rem;">
            <a href="{{ route('user.dashboard') }}" 
               class="btn-secondary" 
               style="padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem; flex: 1; text-align: center; border-color: {{ !$showFavorites ? 'var(--primary)' : 'var(--border-color)' }}; background: {{ !$showFavorites ? 'rgba(157, 78, 221, 0.1)' : 'transparent' }};">
               All Channels
            </a>
            <a href="{{ route('user.dashboard', ['filter' => 'favorites']) }}" 
               class="btn-secondary" 
               style="padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.85rem; flex: 1; text-align: center; border-color: {{ $showFavorites ? 'var(--primary)' : 'var(--border-color)' }}; background: {{ $showFavorites ? 'rgba(157, 78, 221, 0.1)' : 'transparent' }};">
               ⭐ Favorites
            </a>
        </div>

        <div class="channels-grid">
            @forelse($channels as $channel)
                <a href="{{ route('user.dashboard', ['channel' => $channel->id, 'filter' => $showFavorites ? 'favorites' : null]) }}" 
                   class="channel-card {{ ($selectedChannel && $selectedChannel->id == $channel->id) ? 'active' : '' }}"
                   style="text-decoration: none;">
                    <div class="channel-logo-container">
                        @if($channel->logo_url)
                            <img src="{{ $channel->logo_url }}" alt="{{ $channel->name }}">
                        @else
                            <div class="channel-logo-fallback">{{ substr($channel->name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="channel-name">{{ $channel->name }}</div>
                </a>
            @empty
                <div style="grid-column: 1/-1; text-align: center; color: var(--text-secondary); padding: 3rem 1rem; border: 1px dashed var(--border-color); border-radius: 16px;">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin-bottom: 0.5rem; opacity: 0.5;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5"></path>
                    </svg>
                    <p style="font-size: 0.95rem;">
                        @if($showFavorites)
                            No favorite channels yet.
                        @else
                            No channels active.
                        @endif
                    </p>
                    @if($showFavorites)
                        <a href="{{ route('user.dashboard') }}" style="color: var(--primary); font-size: 0.85rem; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 0.5rem;">Browse all channels &rarr;</a>
                    @else
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" style="color: var(--primary); font-size: 0.85rem; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 0.5rem;">Add some now &rarr;</a>
                            @endif
                        @endauth
                    @endif
                </div>
            @endforelse
        </div>
    </div>

    <!-- Live Stream Video Player -->
    <div class="player-section">
        <h2 style="font-size: 1.5rem; font-weight: 700; background: linear-gradient(45deg, #ffffff, var(--text-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Live Stream Player
        </h2>

        <div class="player-wrapper">
            @if($selectedChannel)
                <video id="video" class="video-element" controls autoplay></video>
            @else
                <div class="player-placeholder">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path>
                    </svg>
                    <h3>No Channel Selected</h3>
                    <p>Choose an IPTV stream from the list on the left to start live playback.</p>
                </div>
            @endif
        </div>

        @if($selectedChannel)
            <div class="channel-info-bar">
                <div class="channel-info-left">
                    <div style="width: 50px; height: 50px; border-radius: 10px; background: rgba(255,255,255,0.05); display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--border-color);">
                        @if($selectedChannel->logo_url)
                            <img src="{{ $selectedChannel->logo_url }}" alt="Logo" style="max-width: 80%; max-height: 80%; object-fit: contain;">
                        @else
                            <span style="font-weight: 700; color: var(--primary); font-size: 1rem;">{{ substr($selectedChannel->name, 0, 2) }}</span>
                        @endif
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 700;">{{ $selectedChannel->name }}</h3>
                            <span style="font-size: 0.75rem; background: rgba(157, 78, 221, 0.2); border: 1px solid var(--primary); padding: 0.1rem 0.5rem; border-radius: 4px; color: #d4a373; font-weight: 600;">
                                {{ strtoupper($selectedChannel->type) }}
                            </span>
                            @if($selectedChannel->group)
                                <span style="font-size: 0.75rem; background: rgba(255,255,255,0.05); padding: 0.1rem 0.5rem; border-radius: 4px; color: var(--text-secondary);">
                                    {{ $selectedChannel->group }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <!-- Quality Selector -->
                    <div style="display: flex; align-items: center; gap: 0.4rem; background: rgba(255,255,255,0.05); padding: 0.35rem 0.6rem; border-radius: 8px; border: 1px solid var(--border-color);">
                        <label for="quality-selector" style="font-size: 0.75rem; color: var(--text-secondary); margin-bottom: 0; white-space: nowrap;">Quality:</label>
                        <select id="quality-selector" style="background: transparent; border: none; color: white; font-size: 0.8rem; font-family: var(--font-main); outline: none; cursor: pointer;">
                            <option value="auto" style="background: var(--bg-dark); color: white;">Auto</option>
                        </select>
                    </div>

                    <!-- Favorite Toggle Button -->
                    <form action="{{ route('user.channels.favorite', $selectedChannel->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; cursor: pointer; color: {{ Auth::user()->favoriteChannels->contains($selectedChannel->id) ? '#ffb703' : 'var(--text-secondary)' }}; transition: var(--transition); display: flex; align-items: center; justify-content: center;" title="Favorite Channel">
                            @if(Auth::user()->favoriteChannels->contains($selectedChannel->id))
                                <!-- Filled Star -->
                                <svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @else
                                <!-- Outline Star -->
                                <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            @endif
                        </button>
                    </form>
                    <span class="badge badge-active" style="animation: glow-pulse 2s infinite;">● Live</span>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var video = document.getElementById('video');
                    if (!video) return;

                    var streamUrl = '{!! $selectedChannel->stream_url !!}';
                    var streamType = '{{ $selectedChannel->type }}';
                    var drmKid = '{{ $selectedChannel->drm_kid }}';
                    var drmKey = '{{ $selectedChannel->drm_key }}';
                    var qualitySelector = document.getElementById('quality-selector');

                    if (streamType === 'dash') {
                        // Use Shaka Player for DASH/DRM
                        shaka.polyfill.installAll();
                        if (shaka.Player.isBrowserSupported()) {
                            var player = new shaka.Player(video);
                            
                            // Buffer & performance configurations to prevent buffering
                            var shakaConfig = {
                                streaming: {
                                    bufferingGoal: 30, // seconds
                                    rebufferingGoal: 8, // seconds
                                    bufferBehind: 30, // seconds
                                    retryParameters: {
                                        maxAttempts: 5,
                                        timeout: 10000,
                                        backoffFactor: 2
                                    }
                                }
                            };
                            
                            if (drmKid && drmKey) {
                                var clearKeys = {};
                                clearKeys[drmKid] = drmKey;
                                shakaConfig.drm = {
                                    clearKeys: clearKeys
                                };
                            }
                            player.configure(shakaConfig);

                            player.load(streamUrl).then(function() {
                                console.log('DASH/DRM Stream loaded successfully with Shaka Player!');
                                
                                // Clear existing options except first
                                while (qualitySelector.options.length > 1) {
                                    qualitySelector.remove(1);
                                }
                                qualitySelector.options[0].textContent = 'Auto';

                                // Populate quality control dropdown
                                var tracks = player.getVariantTracks();
                                // Sort by height descending
                                tracks.sort(function(a, b) { return b.height - a.height; });
                                var seenHeights = {};
                                tracks.forEach(function(track) {
                                    if (track.height && !seenHeights[track.height]) {
                                        seenHeights[track.height] = true;
                                        var option = document.createElement('option');
                                        option.value = track.id;
                                        option.textContent = track.height + 'p';
                                        option.style.backgroundColor = '#080710';
                                        option.style.color = 'white';
                                        qualitySelector.appendChild(option);
                                    }
                                });

                                qualitySelector.onchange = function() {
                                    var autoOption = qualitySelector.options[0];
                                    if (qualitySelector.value === 'auto') {
                                        player.configure({ abr: { enabled: true } });
                                    } else {
                                        player.configure({ abr: { enabled: false } });
                                        var trackId = parseInt(qualitySelector.value);
                                        var selectedTrack = tracks.find(function(t) { return t.id === trackId; });
                                        if (selectedTrack) {
                                            player.selectVariantTrack(selectedTrack, true);
                                        }
                                        autoOption.textContent = 'Auto';
                                    }
                                };

                                // Listen to variant changes to update Auto text with current playing quality
                                player.addEventListener('variantchanged', function() {
                                    var autoOption = qualitySelector.options[0];
                                    if (qualitySelector.value === 'auto') {
                                        var activeTrack = player.getVariantTracks().find(function(t) { return t.active; });
                                        if (activeTrack && activeTrack.height) {
                                            autoOption.textContent = 'Auto (' + activeTrack.height + 'p)';
                                        } else {
                                            autoOption.textContent = 'Auto';
                                        }
                                    } else {
                                        autoOption.textContent = 'Auto';
                                    }
                                });

                                video.play().catch(function(e) {
                                    console.log("Autoplay blocked by browser. User interaction required.", e);
                                });
                            }).catch(function(error) {
                                console.error('Error loading DASH stream: ', error);
                            });
                        } else {
                            console.error('Browser does not support Shaka Player.');
                        }
                    } else {
                        // Use Hls.js for HLS streams
                        if (Hls.isSupported()) {
                            var hls = new Hls({
                                enableWorker: true,
                                lowLatencyMode: false, // turn off low latency to enable larger buffer cushion
                                backBufferLength: 60,
                                maxBufferLength: 30,
                                maxMaxBufferLength: 60,
                                liveSyncDurationCount: 4, // 4 segment durations behind live edge for safety
                                liveMaxLatencyDurationCount: 12,
                                manifestLoadingMaxRetry: 6,
                                levelLoadingMaxRetry: 6,
                                fragLoadingMaxRetry: 6
                            });
                            hls.loadSource(streamUrl);
                            hls.attachMedia(video);
                            
                            hls.on(Hls.Events.MANIFEST_PARSED, function() {
                                // Clear existing options except first
                                while (qualitySelector.options.length > 1) {
                                    qualitySelector.remove(1);
                                }
                                qualitySelector.options[0].textContent = 'Auto';

                                // Populate quality control dropdown
                                hls.levels.forEach(function(level, index) {
                                    var name = level.name || (level.height ? level.height + 'p' : 'Level ' + index);
                                    var option = document.createElement('option');
                                    option.value = index;
                                    option.textContent = name;
                                    option.style.backgroundColor = '#080710';
                                    option.style.color = 'white';
                                    qualitySelector.appendChild(option);
                                });

                                qualitySelector.onchange = function() {
                                    var autoOption = qualitySelector.options[0];
                                    if (qualitySelector.value === 'auto') {
                                        hls.currentLevel = -1;
                                    } else {
                                        hls.currentLevel = parseInt(qualitySelector.value);
                                        autoOption.textContent = 'Auto';
                                    }
                                };

                                video.play().catch(function(e) {
                                    console.log("Autoplay blocked: ", e);
                                });
                            });

                            // Listen to level switch events to update Auto text with current playing quality
                            hls.on(Hls.Events.LEVEL_SWITCHED, function(event, data) {
                                var autoOption = qualitySelector.options[0];
                                if (qualitySelector.value === 'auto') {
                                    var activeLevel = hls.levels[data.level];
                                    if (activeLevel && activeLevel.height) {
                                        autoOption.textContent = 'Auto (' + activeLevel.height + 'p)';
                                    } else {
                                        autoOption.textContent = 'Auto';
                                    }
                                } else {
                                    autoOption.textContent = 'Auto';
                                }
                            });
                            
                            hls.on(Hls.Events.ERROR, function(event, data) {
                                if (data.fatal) {
                                    switch(data.type) {
                                        case Hls.ErrorTypes.NETWORK_ERROR:
                                            console.log("Network error, trying to recover...");
                                            hls.startLoad();
                                            break;
                                        case Hls.ErrorTypes.MEDIA_ERROR:
                                            console.log("Media error, trying to recover...");
                                            hls.recoverMediaError();
                                            break;
                                        default:
                                            console.log("Fatal player error. Cannot recover stream.");
                                            break;
                                    }
                                }
                            });
                        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                            video.src = streamUrl;
                            video.addEventListener('loadedmetadata', function() {
                                video.play().catch(function(e) {
                                    console.log("Autoplay blocked: ", e);
                                });
                            });
                        }
                    }
                });
            </script>
        @endif
    </div>
</div>

<style>
@keyframes glow-pulse {
    0%, 100% { box-shadow: 0 0 5px rgba(0, 245, 212, 0.4); }
    50% { box-shadow: 0 0 15px rgba(0, 245, 212, 0.8); }
}
</style>
@endsection
