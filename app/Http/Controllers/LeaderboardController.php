<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($track_id)
    {
        $user = Auth::user();
        $tracks = Track::all();
        $laptimes = Laptime::where('track_id', $track_id)
            ->orderBy('time', 'asc')
            ->take(10)
            ->get();
        $currentTrack = Track::find($track_id);

        // Calculate laptime average of current track (using custom function from app/helpers.php)
        $laptimeAverage = calculate_average_laptime($laptimes);

        return view('leaderboard', ['user' => $user, 'laptimes' => $laptimes, 'tracks' => $tracks, 'currentTrack' => $currentTrack->track_name, 'laptimeAverage' => $laptimeAverage]);
    }
}
