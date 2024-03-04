<?php

namespace App\Http\Controllers;

use App\Models\Laptime;

class DeleteLaptimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Laptime $laptime)
    {
        $laptime->delete();
        return back();
    }
}
