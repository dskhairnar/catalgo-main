<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get featured services to display on the welcome page
        $services = Service::all()->take(3); // Get first 3 services as featured
        return view('welcome', compact('services'));
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
        // Get services with pagination (6 per page)
        $services = Service::paginate(6);
        return view('services', compact('services'));
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
        return view('service-details', compact('service'));
    }
}