<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;

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
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the businesses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::paginate(15);
        return view('admin.businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new business.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.businesses.create');
    }

    /**
     * Store a newly created business in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation and business creation logic
    }

    /**
     * Display the specified business.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::findOrFail($id);
        return view('admin.businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified business.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business = Business::findOrFail($id);
        return view('admin.businesses.edit', compact('business'));
    }

    /**
     * Update the specified business in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation and business update logic
    }

    /**
     * Remove the specified business from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Business deletion logic
    }

    /**
     * Approve a business.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $business = Business::findOrFail($id);
        $business->status = 'approved';
        $business->save();

        return back()->with('success', 'Business approved successfully!');
    }

    /**
     * Reject a business.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $business = Business::findOrFail($id);
        $business->status = 'rejected';
        $business->save();

        return back()->with('success', 'Business rejected successfully!');
    }
}
