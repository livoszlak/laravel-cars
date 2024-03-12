<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CarController extends Controller
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
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $id = $request->input('id');

        $messages = [
            'registration_number.filled' => 'The registration number field must be filled in.',
            'registration_number.unique' => 'The registration number must be unique.',
            'registration_number.min' => 'The registration number must be at least 2 characters.',
            'model.filled' => 'The model name must be filled in.',
            'model.min' => 'The model name must be at least 1 character.',
        ];

        $rules = [
            'registration_number' => 'sometimes|filled|unique:cars,registration_number,' . $id . '|string|min:2',
            'model' => 'sometimes|filled|string|min:1'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('your-cars')->withErrors($validator);
        }

        try {
            $car = Car::findOrFail($id);
            $car->fill($request->only('registration_number', 'model'));
            $car->save();
            return redirect('your-cars')->with(['car' => $car]);
        } catch (\Exception $e) {
            return redirect('your-cars')->withErrors("An unexpected error occurred.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        foreach ($car->laptimes as $laptime) {
            $laptime->delete();
        }
        $car->delete();
        return redirect('your-cars');
    }

    public function toggleActive(Request $request)
    {
        $id = $request->input('car_id');

        try {
            $car = Car::findOrFail($id);
            if ($car->active) {
                $car->active = false;
            } else if (!$car->active) {
                $car->active = true;
            }
            $car->save();
            return redirect('your-cars')->with(['car' => $car]);
        } catch (\Exception $e) {
            return redirect('your-cars')->withErrors('An unexpected error occurred.');
        }
    }
}
