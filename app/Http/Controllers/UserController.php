<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $messages = [
            'name.required' => 'Username must be filled in.',
            'email.required' => 'Email must be filled in.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been registered.',
            'password.required' => 'Password must be filled in.',
            'password.regex' => 'The password must be at least 8 characters long, and must contain at least one uppercase letter and at least 2 digits.'
        ];

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:rfc|unique:users,email',
            'password' => ['required', 'regex:/^(?=.*[A-Z])(?=.*\d{2,}).{8,}$/']
        ], $messages);

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('login')->with(['user' => $user]);
        } catch (ValidationException $e) {
            return redirect('/')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect('/')->withErrors('An unexpected error occurred.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
