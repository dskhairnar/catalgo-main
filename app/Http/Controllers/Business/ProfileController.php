<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the business profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('business.profile');
    }
    
    /**
     * Update the business profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:1000',
            'categories' => 'nullable|array',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:password|current_password',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $user->business_name = $validated['business_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->website = $validated['website'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->city = $validated['city'] ?? null;
        $user->state = $validated['state'] ?? null;
        $user->zip = $validated['zip'] ?? null;
        $user->description = $validated['description'] ?? null;
        
        if (isset($validated['categories'])) {
            $user->categories = json_encode($validated['categories']);
        }
        
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('business_logos', 'public');
            $user->logo = $logoPath;
        }
        
        if (isset($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        
        $user->save();
        
        return redirect()->route('business.profile')->with('success', 'Profile updated successfully!');
    }
}