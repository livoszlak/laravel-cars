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
            'registration_number' => 'required|string|min:10',
            'model' => 'required|string|min:1'
        ]);

        $request->only('registration_number', 'model');
        $car = new Car;
        $car->description = $request->description;
        $car->user_id = Auth::id();
        $car->save();
        return redirect('dashboard')->with(['car' => $car]);
    }
}
