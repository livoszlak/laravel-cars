<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UpdateLaptimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $id = $request->input('laptime_id');

        $messages = [
            'date.required' => 'The date field must be filled in.',
            'date.date' => 'The date must be a valid date.',
            'time.required' => 'The time field must be filled in.',
            'time.regex' => 'The time must be in the format mm:ss:msmsms.',
        ];

        $this->validate($request, [
            'date' => 'required|date',
            'time' => 'required|string|regex:/^\d{2}:\d{2}:\d{3}$/',
            'track_id' => 'required',
        ], $messages);

        try {
            $laptime = Laptime::find($id);
            $laptime->date = $request->date;
            $laptime->time = $request->time;
            $laptime->track_id = $request->track_id;
            $laptime->save();
            return redirect('your-times')->with(['laptime' => $laptime]);
        } catch (ValidationException $e) {
            return redirect('your-times')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect('your-times')->withErrors("An unexpected error occurred.");
        }
    }
}
