<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $showFavorites = $request->query('filter') === 'favorites';

        if ($showFavorites) {
            $channels = $request->user()->favoriteChannels()->where('is_active', true)->orderBy('name', 'asc')->get();
        } else {
            $channels = Channel::where('is_active', true)->orderBy('name', 'asc')->get();
        }

        // Selected channel
        $selectedChannel = null;
        if ($request->has('channel')) {
            $selectedChannel = Channel::where('id', $request->channel)
                                      ->where('is_active', true)
                                      ->first();
        }

        // If no channel is selected but channels exist, select the first one by default
        if (!$selectedChannel && $channels->count() > 0) {
            $selectedChannel = $channels->first();
        }

        return view('user.dashboard', compact('channels', 'selectedChannel', 'showFavorites'));
    }

    public function toggleFavorite(Request $request, $id)
    {
        $channel = Channel::findOrFail($id);
        $user = $request->user();

        $user->favoriteChannels()->toggle($channel->id);

        return back()->with('success', 'Favorite status updated!');
    }
}
