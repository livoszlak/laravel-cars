<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;

class UpdateLaptimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $id)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'time' => 'required|string|regex:/^\d{1,2}:\d{2}$/',
        ]);

        $laptime = Laptime::find($id);
        $laptime->date = $request->date;
        $laptime->time = $request->time;
        $laptime->save();
        return redirect('profile')->with(['laptime' => $laptime]);
    }
}
