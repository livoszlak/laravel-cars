<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $messages = [
            'name.required' => 'The name field must be filled in.',
            'email.required' => 'The email field must be filled in.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been registered.',
            'password.required' => 'The password field must be filled in.',
        ];

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required'
        ], $messages);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/')->with(['user' => $user]);
        } catch (Exception $e) {
            return redirect('/')->withErrors('An unexpected error occurred.');
        }
    }
}
