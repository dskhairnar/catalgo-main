<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Healthy Habitat Network</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-sidebar {
            width: 250px;
            background-color: #2F4F4F;
            color: white;
            padding: 1.5rem;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .dashboard-logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            display: block;
            color: white;
            text-decoration: none;
        }
        
        .dashboard-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .dashboard-menu li {
            margin-bottom: 0.5rem;
        }
        
        .dashboard-menu a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .dashboard-menu a:hover, .dashboard-menu a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .dashboard-content {
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
        }
        
        .dashboard-header {
            margin-bottom: 2rem;
        }
        
        .dashboard-header h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card h3 {
            color: #2F4F4F;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 0.75rem;
        }
        
        .logout-btn {
            margin-top: 2rem;
            display: block;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 4px;
        }
        
        .logout-btn:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-sidebar">
        <a href="{{ route('home') }}" class="dashboard-logo">
            <i class="fas fa-leaf"></i> Healthy Habitat
        </a>
        
        <ul class="dashboard-menu">
            @yield('sidebar-menu')
        </ul>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn" style="background: none; border: none; width: 100%; text-align: left;">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
    
    <div class="dashboard-content">
        <div class="dashboard-header">
            <h1>@yield('header')</h1>
        </div>
        
        @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>