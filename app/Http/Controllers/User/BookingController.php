<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display the user's bookings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.bookings');
    }
}