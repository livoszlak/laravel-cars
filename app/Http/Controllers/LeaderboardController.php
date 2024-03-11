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

        return view('leaderboard', ['user' => $user, 'laptimes' => $laptimes, 'tracks' => $tracks]);
    }
}
