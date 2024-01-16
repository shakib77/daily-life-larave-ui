<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Daily Life') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-fluid {
            flex: 1;
            display: flex;
            padding-left: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #6a1b9a; /* Purple color */
            color: #ffffff;
            transition: width 0.3s;
            overflow-y: auto;
            position: fixed;
            height: 100%;
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            color: #ffffff;
            display: block;
            transition: background-color 0.3s;
        }

        .custom-sidebar-item {
            border-bottom: 1px solid #ffffff; /* White border */
        }

        .sidebar a:hover {
            background-color: #4a148c; /* Darker purple on hover */
        }

        .sidebar-heading {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 20px;
            color: #ffffff;
            border-bottom: 2px solid #fff;
        }

        /* Content Area */
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container-fluid">
        @auth
            <div class="sidebar">
                <div class="sidebar-heading">Dashboard</div>
                <a href="{{ route('tasks.index') }}" class="custom-sidebar-item">Tasks</a>
                <a href="{{ route('tasks.index') }}" class="custom-sidebar-item">History</a>
                <!-- Add more sidebar items as needed -->
            </div>
        @endauth

        <!-- Dynamic Content Area -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
