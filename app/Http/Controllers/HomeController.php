<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get all categories
        $categories = Category::all();
        
        // Get featured services with their categories
        $featuredServices = Service::with('category')
            ->where('status', 'active')
            ->take(3)
            ->get();
            
        return view('welcome', compact('categories', 'featuredServices'));
    }

    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Show the services page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function services()
    {
        // Get all categories for the filter
        $categories = Category::all();
        
        // Get services with pagination and eager load categories
        $services = Service::with('category')
            ->where('status', 'active')
            ->paginate(6);
            
        return view('services', compact('services', 'categories'));
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact');
    }
    
    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Show a specific service.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showService(Service $service)
    {
        $service->load(['category', 'business']);
        return view('service-details', compact('service'));
    }
}