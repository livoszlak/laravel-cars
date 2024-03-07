<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CreateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $messages = [
            'registration_number.required' => 'The registration number must be filled in.',
            'registration_number.unique' => 'The car with this registration number has already been registered.',
            'registration_number.min' => 'The registration number must be at least 2 characters.',
            'registration_number.max' => 'The registration number must be under 12 characters.',
            'model.required' => 'The car model name must be filled in.',
            'model.min' => 'The car model name must be at least 1 character.',
            'model.max' => 'The car model name must be under 70 characters.',
        ];

        $this->validate($request, [
            'registration_number' => 'required|unique:cars|string|min:2|max:12',
            'model' => 'required|string|min:1'
        ], $messages);

        try {
            $car = new Car;
            $car->registration_number = $request->registration_number;
            $car->model = $request->model;
            $car->user_id = Auth::id();
            $car->save();
            return redirect('your-cars')->with(['car' => $car]);
        } catch (ValidationException $e) {
            return redirect('register-car')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect('register_car')->withErrors('An unexpected error occurred.');
        }
    }
}
