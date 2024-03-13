<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LaptimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($parameter)
    {
        $user = Auth::user();
        $laptimes = Laptime::where('user_id', $user->id)->orderBy($parameter, 'asc')->get();
        view('your-times', ['user' => $user, 'laptimes' => $laptimes]);
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
                'time.regex' => 'The time must be in the format mm:ss:msmsms and cannot be over 59:59:999.',
            ];

            $this->validate($request, [
                'car_id' => 'required',
                'track_id' => 'required',
                'date' => 'required|date',
                'time' => ['required', 'string', 'regex:/^([0-5][0-9]):([0-5][0-9]):([0-9]{3})$/'],
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
        $id = $request->input('id');

        if ($laptime === null) {
            return redirect('your-times')->withErrors("Laptime not found.");
        }

        $messages = [
            'date.filled' => 'The date field must be filled in.',
            'date.date' => 'The date must be a valid date.',
            'time.filled' => 'The time field must be filled in.',
            'time.regex' => 'The time must be in the format mm:ss:msmsms and cannot be over 59:59:999.',
            'track_id.filled' => 'The track field must be filled in.',
        ];

        $rules = [
            'date' => 'sometimes|filled|date',
            'time' => ['sometimes', 'string', 'regex:/^([0-5][0-9]):([0-5][0-9]):([0-9]{3})$/'],
            'track_id' => 'sometimes|filled'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('your-cars')->withErrors($validator);
        }

        try {
            $laptime = Laptime::find($id);
            /*             $laptime->date = $request->date;
            $laptime->time = $request->date;
            $laptime->track_id = $request->track_id; */
            $laptime->fill($request->only('date', 'time', 'track_id'));
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
