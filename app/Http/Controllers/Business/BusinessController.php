<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Models\Service;
use App\Models\Booking;

class BusinessController extends Controller
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
     * Show the business dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $servicesCount = Service::where('business_id', $user->business->id)->count();
        $bookingsCount = Booking::whereHas('service', function ($query) use ($user) {
            $query->where('business_id', $user->business->id);
        })->count();

        return view('dashboard.business.index', compact('servicesCount', 'bookingsCount'));
    }

    /**
     * Show the business dashboard (alias for index).
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Check if user has a business
        if (!$user->business) {
            // Create a new business profile for the user
            $business = new Business();
            $business->user_id = $user->id;
            $business->name = $user->name . "'s Business";
            $business->description = "Welcome to " . $user->name . "'s business. Please update your business description.";
            $business->address = "Please update your business address";
            $business->phone = "Please update your business phone";
            $business->email = $user->email;
            $business->status = 'pending';
            $business->save();

            return redirect()->route('business.profile')->with('success', 'Please complete your business profile to get started.');
        }

        // Get services count (default to 0 if no services)
        $servicesCount = 0;
        try {
            if ($user->business) {
                $servicesCount = Service::where('business_id', $user->business->id)->count();
            }
        } catch (\Exception $e) {
            // Log the error but don't show it to the user
            \Log::error('Error fetching services count: ' . $e->getMessage());
        }

        // Get bookings count (default to 0 if no bookings)
        $bookingsCount = 0;
        try {
            if ($user->business) {
                $bookingsCount = Booking::whereHas('service', function ($query) use ($user) {
                    $query->where('business_id', $user->business->id);
                })->count();
            }
        } catch (\Exception $e) {
            // Log the error but don't show it to the user
            \Log::error('Error fetching bookings count: ' . $e->getMessage());
        }

        return view('dashboard.business.index', compact('servicesCount', 'bookingsCount'));
    }
}
