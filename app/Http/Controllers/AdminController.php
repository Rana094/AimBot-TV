<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_channels' => Channel::count(),
            'active_channels' => Channel::where('is_active', true)->count(),
            'total_users' => User::count(),
        ];

        $channels = Channel::orderBy('created_at', 'desc')->paginate(15);
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('stats', 'channels', 'users'));
    }

    public function addChannel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo_url' => 'nullable|string|max:1000',
            'stream_url' => 'required|string|max:1000',
            'group' => 'nullable|string|max:255',
            'type' => 'required|string|in:hls,dash',
            'drm_kid' => 'nullable|string|max:255',
            'drm_key' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $streamUrl = trim($request->stream_url);
        if (str_starts_with($streamUrl, 'http://')) {
            $streamUrl = 'https://' . substr($streamUrl, 7);
        }

        $logoUrl = $request->logo_url ? trim($request->logo_url) : null;
        if ($logoUrl && str_starts_with($logoUrl, 'http://')) {
            $logoUrl = 'https://' . substr($logoUrl, 7);
        }

        Channel::create([
            'name' => $request->name,
            'logo_url' => $logoUrl,
            'stream_url' => $streamUrl,
            'group' => $request->group,
            'type' => $request->type,
            'drm_kid' => $request->drm_kid,
            'drm_key' => $request->drm_key,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);

        return back()->with('success', 'Channel added successfully!');
    }

    public function uploadM3u(Request $request)
    {
        $request->validate([
            'm3u_file' => 'required|file',
        ]);

        $file = $request->file('m3u_file');
        $content = file_get_contents($file->getRealPath());
        
        $lines = preg_split('/\r\n|\r|\n/', $content);
        $imported = 0;
        $currentChannel = [];
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            if (str_starts_with($line, '#EXTINF:')) {
                // Extract logo
                $logoUrl = null;
                if (preg_match('/tvg-logo=["\']([^"\']+)["\']/i', $line, $matches)) {
                    $logoUrl = trim($matches[1]);
                    if (str_starts_with($logoUrl, 'http://')) {
                        $logoUrl = 'https://' . substr($logoUrl, 7);
                    }
                }
                
                // Extract group
                $group = null;
                if (preg_match('/group-title=["\']([^"\']+)["\']/i', $line, $matches)) {
                    $group = trim($matches[1]);
                }
                
                // Extract name
                $name = 'Unnamed Channel';
                $commaPos = strrpos($line, ',');
                if ($commaPos !== false) {
                    $name = trim(substr($line, $commaPos + 1));
                } elseif (preg_match('/tvg-name=["\']([^"\']+)["\']/i', $line, $matches)) {
                    $name = trim($matches[1]);
                }
                
                $currentChannel = [
                    'name' => $name,
                    'logo_url' => $logoUrl,
                    'group' => $group,
                ];
            } elseif (!str_starts_with($line, '#')) {
                if (!empty($currentChannel)) {
                    // Determine type (DASH if url contains .mpd, HLS otherwise)
                    $type = 'hls';
                    if (preg_match('/\.mpd(\?|$)/i', $line)) {
                        $type = 'dash';
                    }
                    
                    $streamUrl = trim($line);
                    if (str_starts_with($streamUrl, 'http://')) {
                        $streamUrl = 'https://' . substr($streamUrl, 7);
                    }
                    
                    Channel::create([
                        'name' => $currentChannel['name'],
                        'logo_url' => $currentChannel['logo_url'],
                        'stream_url' => $streamUrl,
                        'group' => $currentChannel['group'],
                        'type' => $type,
                        'is_active' => true,
                    ]);
                    $imported++;
                    $currentChannel = [];
                }
            }
        }
        
        return back()->with('success', "Imported {$imported} channels from M3U playlist successfully!");
    }

    public function deleteChannel($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return back()->with('success', 'Channel deleted successfully!');
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'User added successfully!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return back()->with('success', 'User account deleted successfully!');
    }
}
