<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class RegisterCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        return view('register-car', [
            'user' => $user,
        ]);
    }
}
