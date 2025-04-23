<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Healthy Habitat Network') }}</title>
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Main Content -->
    @yield('content')

    <!-- Auth Modals -->
    @include('auth.login-modal')
    @include('auth.register-modal')
    @include('auth.forgot-password-modal')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/auth-modals.js') }}"></script>
    @stack('scripts')

    @if ($errors->any())
        <script>
            window.errors = @json($errors->messages());
        </script>
    @endif
</body>
</html>