<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Booking;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    /**
     * Show the dashboard index page.
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * Show the user profile page.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            $user->{$key} = $value;
        }
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Show the user's bookings.
     */
    public function bookings()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $bookings = $user->bookings()->with(['listing'])->latest()->get();
        return view('dashboard.bookings', compact('bookings'));
    }

    /**
     * Show the user's saved services.
     */
    public function saved()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $savedServices = $user->savedServices()->with(['service'])->latest()->get();
        return view('dashboard.saved', compact('savedServices'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500',
        ]);

        $booking = new Booking([
            'service_id' => $validated['service_id'],
            'user_id' => auth()->id(),
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'notes' => $validated['notes'],
            'status' => 'pending'
        ]);

        $booking->save();

        return redirect()->route('bookings')
            ->with('success', 'Booking request submitted successfully!');
    }
}
