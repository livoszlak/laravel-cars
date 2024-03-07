<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

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
    public function create()
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function toggleActive(Request $request)
    {
        $id = $request->input('car_id');

        try {
            $car = Car::find($id);
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
