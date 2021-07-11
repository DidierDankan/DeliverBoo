<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style >
            body {
                font-family: 'Nunito', sans-serif;

            }

            .modal-parent{
                height: 100vh;
                background-color: #6c96aa;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 2 1'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='0' x2='0' y1='0' y2='1' gradientTransform='rotate(0,0.5,0.5)'%3E%3Cstop offset='0' stop-color='%236c96aa'/%3E%3Cstop offset='1' stop-color='%2336ebff'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0' stop-color='%23b1f8ff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23b1f8ff' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='2' y2='2'%3E%3Cstop offset='0' stop-color='%23b1f8ff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23b1f8ff' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='0' y='0' fill='url(%23a)' width='2' height='1'/%3E%3Cg fill-opacity='0.93'%3E%3Cpolygon fill='url(%23b)' points='0 1 0 0 2 0'/%3E%3Cpolygon fill='url(%23c)' points='2 1 2 0 0 0'/%3E%3C/g%3E%3C/svg%3E");
                background-attachment: fixed;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <div class="modal-parent d-flex justify-content-center align-items-lg-center">
            @if (Route::has('login'))
                <div class="d-flex flex-column justify-content-center align-items-lg-center shadow p-3 mb-5 bg-white rounded p-5">
                    <h1 class="mb-5 d-block text-info">DeliveBoo Management System</h1>
                    
                    @auth
                        <a href="{{route('admin.home')}}" class="btn bg-primary text-sm text-white">DASHBOARD</a>
                    @else
                        <div class="access-options d-flex">
                            <a href="{{ route('login') }}" class="btn bg-primary text-sm text-white mr-2 shadow-sm rounded">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn bg-primary textml-4 text-sm text-white ml-2 shadow-sm rounded">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
                
            
        </div>
    </body>
</html>
