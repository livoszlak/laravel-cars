<?php

namespace App\Http\Controllers;

use App\Models\Laptime;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class YourTimesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $tracks = Track::all();
        $sort = $request->query('sort');
        $order = $request->query('order', 'asc') === 'asc' ? 'desc' : 'asc';

        switch ($sort) {
            case 'car_model':
                $laptimes = Laptime::where('laptimes.user_id', $user->id)->join('cars', 'laptimes.car_id', '=', 'cars.id')->select('laptimes.*')->orderBy('cars.model', $order)->paginate(10);
                break;
            case 'time':
                $laptimes = Laptime::where('user_id', $user->id)->orderBy('time', $order)->paginate(10);
                break;
            case 'track':
                $laptimes = Laptime::where('laptimes.user_id', $user->id)->join('tracks', 'laptimes.track_id', '=', 'tracks.id')->select('laptimes.*')->orderBy('tracks.track_name', $order)->paginate(10);
                break;
            case 'registration_number':
                $laptimes = Laptime::where('laptimes.user_id', $user->id)->join('cars', 'laptimes.car_id', '=', 'cars.id')->select('laptimes.*')->orderBy('cars.registration_number', $order)->paginate(10);
                break;
            case 'date':
                $laptimes = Laptime::where('user_id', $user->id)->orderBy('date', $order)->paginate(10);
                break;
            default:
                $laptimes = Laptime::where('user_id', $user->id)->paginate(10);
                break;
        }

        return view('your-times', [
            'user' => $user,
            'tracks' => $tracks,
            'laptimes' => $laptimes,
            'sort' => $sort,
            'order' => $order
        ]);
    }
}
