<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
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
     * Display a listing of the services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $services = Service::where('business_id', $user->business->id)->get();
        $categories = Category::all();
        return view('business.services.index', compact('services', 'categories'));
    }
    
    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|in:yoga.png,meal.png,gardening.png,forest.png',
        ]);
        
        // Handle image
        if ($request->has('image')) {
            $validated['image'] = $request->image;
        }
        
        // Create service
        $service = new Service($validated);
        $service->business_id = $user->business->id;
        $service->save();
        
        return redirect()->route('business.services')->with('success', 'Service added successfully!');
    }
}