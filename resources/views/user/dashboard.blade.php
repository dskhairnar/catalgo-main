@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    <h2>Welcome, {{ Auth::user()->name }}!</h2>
                    <p>You are logged in as a User.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">My Bookings</h5>
                                    <p class="card-text">View your property bookings</p>
                                    <a href="{{ route('user.bookings') }}" class="btn btn-primary">View Bookings</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Saved Properties</h5>
                                    <p class="card-text">View your saved properties</p>
                                    <a href="{{ route('user.saved') }}" class="btn btn-primary">View Saved</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">My Profile</h5>
                                    <p class="card-text">Update your profile information</p>
                                    <a href="{{ route('user.profile') }}" class="btn btn-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 