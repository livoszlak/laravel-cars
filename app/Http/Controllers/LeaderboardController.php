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

        // Calculate laptime average of current track
        $laptimeCount = count($laptimes);
        $laptimeTotal = 0;
        foreach ($laptimes as $laptime) :
            list($minutes, $seconds, $milliseconds) = explode(':', $laptime['time']);
            $laptimeTotal += $minutes * 60 * 1000 + $seconds * 1000 + $milliseconds;
        endforeach;
        $laptimeAverage = $laptimeTotal / $laptimeCount;
        $minutes = floor($laptimeAverage / 60000);
        $seconds = floor(($laptimeAverage % 60000) / 1000);
        $milliseconds = $laptimeAverage % 1000;
        $laptimeAverage = sprintf('%02d:%02d:%03d', $minutes, $seconds, $milliseconds);

        return view('leaderboard', ['user' => $user, 'laptimes' => $laptimes, 'tracks' => $tracks, 'currentTrack' => $currentTrack->track_name, 'laptimeAverage' => $laptimeAverage]);
    }
}
