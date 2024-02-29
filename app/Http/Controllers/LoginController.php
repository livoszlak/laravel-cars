<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        $input = $request->only('email', 'password');
        if (Auth::attempt($input)) {
            return redirect('/dashboard');
        } else {
            return back()->withErrors("Woops! Wrong credentials! Please try again.");
        }
    }
}
