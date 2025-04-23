@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Admin Dashboard') }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">User Management</h5>
                                    <p class="card-text display-4">{{ \App\Models\User::count() }}</p>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-light">Manage Users</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Business Listings</h5>
                                    <p class="card-text display-4">{{ \App\Models\Business::count() }}</p>
                                    <a href="{{ route('admin.businesses.index') }}" class="btn btn-light">Manage Listings</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Categories</h5>
                                    <p class="card-text display-4">{{ \App\Models\Category::count() }}</p>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Manage Categories</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Pending Business Approvals</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Business Name</th>
                                                    <th>Owner</th>
                                                    <th>Submitted</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse(\App\Models\Business::where('status', 'pending')->take(5)->get() as $business)
                                                <tr>
                                                    <td>{{ $business->name }}</td>
                                                    <td>{{ $business->user->name }}</td>
                                                    <td>{{ $business->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin.businesses.show', $business->id) }}" class="btn btn-info">View</a>
                                                            <button type="button" class="btn btn-success">Approve</button>
                                                            <button type="button" class="btn btn-danger">Reject</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No pending approvals</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('admin.businesses.index') }}?status=pending" class="btn btn-outline-primary btn-sm mt-2">View All Pending</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Recent User Registrations</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Joined</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td><span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'business' ? 'primary' : 'secondary') }}">{{ ucfirst($user->role) }}</span></td>
                                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm mt-2">Manage Users</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Category Management</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Main Categories</h6>
                                            <ul class="list-group">
                                                @foreach(\App\Models\Category::whereNull('parent_id')->take(5)->get() as $category)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $category->name }}
                                                    <span class="badge bg-primary rounded-pill">{{ $category->services_count ?? 0 }} services</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Quick Add Category</h6>
                                            <form>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" placeholder="Category name">
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select">
                                                        <option selected>No parent (main category)</option>
                                                        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Category</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">Manage All Categories</a>
                                    </div>
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