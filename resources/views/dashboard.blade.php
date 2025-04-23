@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 class="mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt fa-3x mb-3 text-primary"></i>
                                    <h5 class="card-title">My Bookings</h5>
                                    <p class="card-text">View and manage your service bookings</p>
                                    <a href="#" class="btn btn-primary">View Bookings</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-leaf fa-3x mb-3 text-success"></i>
                                    <h5 class="card-title">Explore Services</h5>
                                    <p class="card-text">Discover eco-friendly and sustainable services</p>
                                    <a href="{{ route('services') }}" class="btn btn-success">Browse Services</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-user fa-3x mb-3 text-info"></i>
                                    <h5 class="card-title">My Profile</h5>
                                    <p class="card-text">Update your personal information</p>
                                    <a href="#" class="btn btn-info">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Recent Activity</div>
                                <div class="card-body">
                                    <p class="text-muted text-center">No recent activity to display.</p>
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