<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-modal');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,business',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'active'
        ]);

        Auth::login($user);

        $message = $user->role === 'business' 
            ? 'Business account registered successfully!' 
            : 'User account registered successfully!';

        return response()->json([
            'success' => true,
            'message' => $message,
            'redirect' => $this->getRedirectUrl($user)
        ]);
    }

    protected function getRedirectUrl($user)
    {
        return $user->role === 'business' 
            ? route('business.dashboard') 
            : route('dashboard');
    }
}