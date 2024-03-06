<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'registration_number' => 'required|unique:cars|string|min:2',
            'model' => 'required|string|min:1'
        ]);

        /* $input = $request->only('registration_number', 'model'); */
        $car = new Car;
        $car->registration_number = $request->registration_number;
        $car->model = $request->model;
        $car->user_id = Auth::id();
        $car->save();
        return redirect('your-cars')->with(['car' => $car]);
    }
}
