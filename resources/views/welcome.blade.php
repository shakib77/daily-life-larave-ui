<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Your Title</title>
    <style>
        body {
            background-color: #2d3748;
            overflow: hidden;
        }

        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            animation: floatAnimation 1s infinite alternate; /* Floating animation */
        }

        @keyframes floatAnimation {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-10px); /* Adjust as needed for the floating height */
            }
        }

        .custom-card {
            width: 300px; /* You can adjust the width as needed */
        }
    </style>
</head>
<body>

<div class="card-container">
    <div class="card custom-card">
        <div class="card-body">
            @if (Route::has('login'))
                <div class="text-center">
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary ml-2">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
