<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $id = $request->input('car_id');

        $messages = [
            'registration_number.required' => 'The registration number field must be filled in.',
            'registration_number.unique' => 'The registration number must be unique.',
            'registration_number.min' => 'The registration number must be at least 2 characters.',
            'model.required' => 'The model name must be filled in.',
            'model.min' => 'The model name must be at least 1 character.',
        ];

        $this->validate($request, [
            'registration_number' => 'required|unique:cars,registration_number,' . $id . '|string|min:2',
            'model' => 'required|string|min:1'
        ], $messages);

        try {
            $car = Car::find($id);
            $car->registration_number = $request->registration_number;
            $car->model = $request->model;
            $car->save();
            return redirect('your-cars')->with(['car' => $car]);
        } catch (ValidationException $e) {
            return redirect('your-cars')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect('your-cars')->withErrors("An unexpected error occurred.");
        }
    }
}
