<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation\Reservation;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //bookings
    public function bookings()
    {
        $bookings = Reservation::where('user_id', Auth::user()->id)
            ->orderBy('id', 'asc')->get();

        return view('users.bookings', compact('bookings'));
    }
}
