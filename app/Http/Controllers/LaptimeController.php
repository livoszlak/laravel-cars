<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LaptimeController extends Controller
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
    public function create(Request $request)
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
    public function show(Laptime $laptime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laptime $laptime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laptime $laptime)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laptime $laptime)
    {
        $laptime->delete();
        return redirect('your-times');
    }
}
