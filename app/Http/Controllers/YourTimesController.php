<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YourTimesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tracks = Track::all();
        $laptimes = Laptime::where('user_id', $user->id)->paginate(10);

        return view('your-times', [
            'user' => $user,
            'tracks' => $tracks,
            'laptimes' => $laptimes
        ]);
    }
}
