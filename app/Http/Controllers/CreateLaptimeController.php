<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CreateLaptimeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $messages = [
                'car_id.required' => 'The car ID field must be filled in.',
                'track_id.required' => 'The track field must be filled in.',
                'date.required' => 'The date field must be filled in.',
                'date.date' => 'The date must be a valid date.',
                'time.required' => 'The time field must be filled in.',
                'time.regex' => 'The time must be in the format mm:ss:msmsms.',
            ];

            $this->validate($request, [
                'car_id' => 'required',
                'track_id' => 'required',
                'date' => 'required|date',
                'time' => 'required|string|regex:/^\d{2}:\d{2}:\d{3}$/',
            ], $messages);

            $laptime = new Laptime;
            $laptime->user_id = Auth::id();
            $laptime->car_id = $request->car_id;
            $laptime->track_id = $request->track_id;
            $laptime->date = $request->date;
            $laptime->time = $request->time;
            $laptime->save();

            return redirect('your-times')->with(['laptime' => $laptime]);
        } catch (ValidationException $e) {
            return redirect('register-time')->withErrors($e->errors());
        } catch (\Exception $e) {
            return redirect('register-time')->withErrors('An unexpected error occurred.');
        }
    }
}
