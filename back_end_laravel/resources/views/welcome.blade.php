<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeliveBoo | Admin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style >
            body {
                height: 100vh;
                display: flex;
                align-items: center;
                font-family: 'Nunito', sans-serif;
                background-color: #6c96aa;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 2 1'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='0' x2='0' y1='0' y2='1' gradientTransform='rotate(0,0.5,0.5)'%3E%3Cstop offset='0' stop-color='%236c96aa'/%3E%3Cstop offset='1' stop-color='%2336ebff'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='0' y2='1'%3E%3Cstop offset='0' stop-color='%23b1f8ff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23b1f8ff' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' gradientUnits='userSpaceOnUse' x1='0' y1='0' x2='2' y2='2'%3E%3Cstop offset='0' stop-color='%23b1f8ff' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23b1f8ff' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='0' y='0' fill='url(%23a)' width='2' height='1'/%3E%3Cg fill-opacity='0.93'%3E%3Cpolygon fill='url(%23b)' points='0 1 0 0 2 0'/%3E%3Cpolygon fill='url(%23c)' points='2 1 2 0 0 0'/%3E%3C/g%3E%3C/svg%3E");
                background-attachment: fixed;
                background-size: cover;
                background-position-x: center;
            }
        </style>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' integrity='sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==' crossorigin='anonymous'/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                @if (Route::has('login'))
                    <div class="offset-md-2 col-md-8 shadow p-3 mb-5 bg-white rounded p-5">
                        <h1 class="mb-5 d-block text-info text-center">DeliveBoo Management System</h1>
            
                        @auth
                            <div class="dash d-flex justify-content-center"><a href="{{route('admin.home')}}" class="btn-lg btn bg-primary text-sm text-white"><i class="fas fa-tachometer-alt"></i> DASHBOARD</a></div>
                        @else
                            <div class="access-options d-flex justify-content-center">
                                <a href="{{ route('login') }}" class="btn bg-primary text-sm text-white mr-2 shadow-sm rounded">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn bg-primary textml-4 text-sm text-white ml-2 shadow-sm rounded">Register</a>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
