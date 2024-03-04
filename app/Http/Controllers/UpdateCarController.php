<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class UpdateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $this->validate($request, [
            'registration_number' => 'required|unique:cars|string|min:2',
            'model' => 'required|string|min:1'
        ]);

        $car = Car::find($id);
        $car->registration_number = $request->registration_number;
        $car->model = $request->model;
        $car->save();
        return redirect('profile')->with(['car' => $car]);
    }
}
