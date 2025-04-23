<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;

class BusinessProfileController extends Controller
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
     * Show the business profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;
        return view('business.profile', compact('business'));
    }

    /**
     * Update the business profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $business = $user->business;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
        ]);

        $business->update($validated);
        $business->status = 'active';
        $business->save();

        return redirect()->route('business.dashboard')->with('success', 'Business profile updated successfully!');
    }
}
