<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Daily Life') }}</title>--}}
    <title>Daily Life</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            background-color: #046983; /* Purple color */
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
            background-color: #198dbd; /* Darker purple on hover */
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
            /*padding: 20px;*/
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
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users') }}">Users</a>
                    <a href="{{ route('user-report') }}">User Summary Report</a>
                    <a href="{{ route('financial-report') }}">Financial Report</a>
                @elseif(auth()->user()->role === 'user')
                    <a href="{{ route('user-info.index') }}" class="custom-sidebar-item">Personal Information</a>
                    <a href="{{ route('tasks.index') }}" class="custom-sidebar-item">All Tasks</a>
                    <a href="{{ route('tasks.index', ['filter' => 1]) }}" class="custom-sidebar-item">Daily Tasks</a>
                    <a href="{{ route('tasks.index', ['filter' => 2]) }}" class="custom-sidebar-item">Weekly Tasks</a>
                    <a href="{{ route('tasks.index', ['filter' => 3]) }}" class="custom-sidebar-item">Monthly Tasks</a>
                    <a href="{{ route('tasks.index', ['filter' => 4]) }}" class="custom-sidebar-item">Yearly Tasks</a>
                    <a href="{{ route('user-info.index') }}" class="accordion-item custom-sidebar-item">Personal
                        Information</a>

                    {{--<div class="accordion" id="userAccordion">
                        <a class="accordion-item" href="#tasksCollapse" data-toggle="collapse" aria-expanded="true"
                           aria-controls="tasksCollapse">Tasks
                            <svg xmlns="http://www.w3.org/2000/svg" class="accordion-icon" id="tasksCollapseIcon"
                                 width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 15.5l-6-6 1.5-1.5L12 12.5l4.5-4.5 1.5 1.5z" fill="#ffffff"/>
                                <path fill="none" d="M0 0h24v24H0z"/>
                            </svg>
                        </a>
                        <div id="tasksCollapse" class="collapse custom-sidebar-item" aria-labelledby="tasksHeading"
                             data-parent="#userAccordion">
                            <a href="{{ route('tasks.index') }}" class="accordion-item custom-sidebar-item"> <span
                                    class="ml-3">All Tasks</span></a>
                            <a href="{{ route('tasks.index', ['filter' => 1]) }}"
                               class="accordion-item custom-sidebar-item"> <span class="ml-3">Daily Tasks </span></a>
                            <a href="{{ route('tasks.index', ['filter' => 2]) }}"
                               class="accordion-item custom-sidebar-item"><span class="ml-3">Weekly Tasks</span></a>
                            <a href="{{ route('tasks.index', ['filter' => 3]) }}"
                               class="accordion-item custom-sidebar-item"><span class="ml-3">Monthly Tasks</span></a>
                            <a href="{{ route('tasks.index', ['filter' => 4]) }}"
                               class="accordion-item custom-sidebar-item"><span class="ml-3">Yearly Tasks</span></a>
                        </div>
                    </div>--}}
                @else
                    <a href="{{ route('home') }}">Home</a>
                @endif
            </div>
        @endauth

        <div class="content">
            @auth
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #9cb8d3;">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto align-items-center">
                            <li class="nav-item">
                            <span class="navbar-text">
                                Welcome, <span
                                    style="font-size: 18px; font-weight: bold">{{ Auth::user()->name }}</span>
                            </span>
                            </li>
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                                <a class="nav-link btn-outline-danger ml-2 rounded btn-sm" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            @endauth
            @yield('content')
        </div>
    </div>
</div>

{{--<script>
    $(document).ready(function () {
        $('#tasksCollapse').on('show.bs.collapse', function () {
            $('#tasksCollapseIcon').html('<path d="M12 8.5l6 6-1.5 1.5L12 11.5l-4.5 4.5-1.5-1.5z" fill="#ffffff"/><path fill="none" d="M0 0h24v24H0z"/>');
        });

        $('#tasksCollapse').on('hide.bs.collapse', function () {
            $('#tasksCollapseIcon').html('<path d="M12 15.5l-6-6 1.5-1.5L12 12.5l4.5-4.5 1.5 1.5z" fill="#ffffff"/><path fill="none" d="M0 0h24v24H0z"/>');
        });
    });
</script>--}}

@stack('js')
</body>
</html>
