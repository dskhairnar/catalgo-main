@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('My Saved Services') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($savedServices->count() > 0)
                    <div class="row">
                        @foreach($savedServices as $savedService)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($savedService->service && $savedService->service->image)
                                <img src="{{ asset('storage/' . $savedService->service->image) }}" class="card-img-top" alt="{{ $savedService->service->title }}">
                                @else
                                <div class="card-img-top bg-light text-center py-5">No Image</div>
                                @endif
                                <div class="card-body">
                                    @if($savedService->service)
                                    <h5 class="card-title">{{ $savedService->service->title }}</h5>
                                    <p class="card-text">{{ Str::limit($savedService->service->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('services.show', $savedService->service->id) }}" class="btn btn-primary">View Details</a>
                                        <form action="{{ route('saved-services.destroy', $savedService->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to remove this from your saved services?')">
                                                <i class="fas fa-heart-broken"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <p class="text-muted">This service is no longer available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-info">
                        You don't have any saved services yet. <a href="{{ route('services.index') }}">Browse services</a> to save some for later.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection