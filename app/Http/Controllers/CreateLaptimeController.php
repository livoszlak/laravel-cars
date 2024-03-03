<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateLaptimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required',
            'track_id' => 'required',
            'date' => 'required|date',
            'time' => 'required|string|regex:/^\d{1,2}:\d{2}$/',
        ]);

        /* $input = $request->only('date', 'time'); */
        $laptime = new Laptime;
        $laptime->user_id = Auth::id();
        $laptime->car_id = $request->car_id;
        $laptime->track_id = $request->track_id;
        $laptime->date = $request->date;
        $laptime->time = $request->time;
        $laptime->save();
        return redirect('profile')->with(['laptime' => $laptime]);
    }
}
