<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;        
use App\Models\Category;       
use App\Models\Booking;        // Add this import
use Illuminate\Http\Request;   

class AdminController extends Controller
{
    public function index()
    {
        // Get summary statistics for admin dashboard
        $stats = [
            'total_users' => User::count(),
            'total_businesses' => User::where('role', 'business')->count(),
            'total_listings' => Listing::count(),
            'total_bookings' => Booking::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_listings' => Listing::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);
        return view('dashboard.admin.users.index', compact('users'));       
    }

    public function editUser(User $user)
    {
        return view('dashboard.admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,    
            'role' => 'required|in:user,business,admin',
            'status' => 'required|in:active,inactive'
        ]);

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $user->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User status updated successfully'
            ]);
        }

        return back()->with('success', 'User status updated successfully'); 
    }

    public function categories()
    {
        $categories = Category::withCount('listings')->paginate(15);
        return view('dashboard.admin.categories.index', compact('categories'));
    }

    public function analytics()
    {
        // Monthly statistics
        $monthlyStats = [
            'users' => User::monthly()->count(),
            'listings' => Listing::monthly()->count(),
            'bookings' => Booking::monthly()->count(),
        ];

        // Weekly data for the line chart
        $weeklyData = [
            'users' => [
                User::whereBetween('created_at', [now()->startOfMonth(), now()->startOfMonth()->addWeek()])->count(),
                User::whereBetween('created_at', [now()->startOfMonth()->addWeek(), now()->startOfMonth()->addWeeks(2)])->count(),
                User::whereBetween('created_at', [now()->startOfMonth()->addWeeks(2), now()->startOfMonth()->addWeeks(3)])->count(),
                User::whereBetween('created_at', [now()->startOfMonth()->addWeeks(3), now()->endOfMonth()])->count(),
            ],
            'listings' => [
                Listing::whereBetween('created_at', [now()->startOfMonth(), now()->startOfMonth()->addWeek()])->count(),
                Listing::whereBetween('created_at', [now()->startOfMonth()->addWeek(), now()->startOfMonth()->addWeeks(2)])->count(),
                Listing::whereBetween('created_at', [now()->startOfMonth()->addWeeks(2), now()->startOfMonth()->addWeeks(3)])->count(),
                Listing::whereBetween('created_at', [now()->startOfMonth()->addWeeks(3), now()->endOfMonth()])->count(),
            ],
            'bookings' => [
                Booking::whereBetween('created_at', [now()->startOfMonth(), now()->startOfMonth()->addWeek()])->count(),
                Booking::whereBetween('created_at', [now()->startOfMonth()->addWeek(), now()->startOfMonth()->addWeeks(2)])->count(),
                Booking::whereBetween('created_at', [now()->startOfMonth()->addWeeks(2), now()->startOfMonth()->addWeeks(3)])->count(),
                Booking::whereBetween('created_at', [now()->startOfMonth()->addWeeks(3), now()->endOfMonth()])->count(),
            ],
        ];

        // User distribution data
        $userDistribution = [
            'regular' => User::where('role', 'user')->count(),
            'business' => User::where('role', 'business')->count(),
            'admin' => User::where('role', 'admin')->count(),
        ];

        // Category distribution data
        $categories = Category::withCount('listings')
            ->orderBy('listings_count', 'desc')
            ->take(10)
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->listings_count,
                ];
            });

        return view('dashboard.admin.analytics', compact(
            'monthlyStats',
            'weeklyData',
            'userDistribution',
            'categories'
        ));
    }

    public function updateListingStatus(Listing $listing)
    {
        $listing->update(['status' => request('status')]);
        return back()->with('success', 'Listing status updated successfully');
    }
}