<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Track;

class ProfileShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tracks = Track::all();

        return view('profile', [
            'user' => $user,
            'tracks' => $tracks,
        ]);
    }
}
