<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterTimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tracks = Track::all();

        return view('register-time', [
            'user' => $user,
            'tracks' => $tracks
        ]);
    }
}
