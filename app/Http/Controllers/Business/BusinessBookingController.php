<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Service;

class BusinessBookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:business');
    }

    /**
     * Display a listing of the bookings for this business.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;

        $bookings = Booking::whereHas('service', function ($query) use ($business) {
            $query->where('business_id', $business->id);
        })->with(['user', 'service'])->latest()->get();

        return view('business.bookings.index', compact('bookings'));
    }

    /**
     * Update the status of a booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Verify this booking belongs to the business
        $user = Auth::user();
        $business = $user->business;

        if ($booking->service->business_id != $business->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->status = $validated['status'];
        $booking->save();

        return back()->with('success', 'Booking status updated successfully!');
    }
}
