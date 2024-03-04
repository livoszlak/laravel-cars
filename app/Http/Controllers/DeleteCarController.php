<?php

namespace App\Http\Controllers;

use App\Models\Car;

class DeleteCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Car $car)
    {
        foreach ($car->laptimes as $laptime) {
            $laptime->delete();
        }
        $car->delete();
        return back();
    }
}
