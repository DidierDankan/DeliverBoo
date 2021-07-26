<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DeliveBoo | Admin</title>

        <!-- Fonts -->
        

        <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap"
      rel="stylesheet"
    />

        <!-- Styles -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style >
            body {
                height: 100vh;
                display: flex;
                align-items: center;
                font-family: 'Roboto Condensed', sans-serif;
                background-color: #6c96aa;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1920' height='1080' preserveAspectRatio='none' viewBox='0 0 1920 1080'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1115%26quot%3b)' fill='none'%3e%3crect width='1920' height='1080' x='0' y='0' fill='rgba(43%2c 204%2c 188%2c 1)'%3e%3c/rect%3e%3cpath d='M 0%2c665 C 384%2c581.8 1536%2c332.2 1920%2c249L1920 1080L0 1080z' fill='rgba(208%2c 235%2c 153%2c 1)'%3e%3c/path%3e%3cpath d='M 0%2c415 C 384%2c519.8 1536%2c834.2 1920%2c939L1920 1080L0 1080z' fill='rgba(27%2c 126%2c 138%2c 1)'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1115'%3e%3crect width='1920' height='1080' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
                background-attachment: fixed;
                background-size: cover;
                background-position-x: center;
            }

            .btn-primary {
    background-color: #1b7e8a !important;
    border: 1px solid #1b7e8a !important;
    transition: all 400ms;
    
}
.btn-primary:hover {
        background-color: #135961 !important;
    }

.btn-warning {
    background-color: #2bccbc !important;
    border: 1px solid #2bccbc !important;
    transition: all 400ms;
    color: white !important;
}

.btn-warning:hover {
    background-color: #11a092 !important;
    border: 1px solid #11a092 !important;
}
.btn-danger {
    background-color: #9b0e6c !important;
    border: 1px solid #9b0e6c !important;
    transition: all 400ms;
    color: white !important;
}
.btn-danger:hover {
    background-color: #7c0c57 !important;
    border: 1px solid #7c0c57 !important;
}
.text-welcome{
    color: #434848;
}
</style>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' integrity='sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==' crossorigin='anonymous'/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                @if (Route::has('login'))
                    <div class="offset-md-2 col-md-8 shadow p-3 mb-5 bg-white rounded p-5">
                        <h1 class="mb-5 d-block text-welcome text-center">DeliveBoo Management System</h1>
            
                        @auth
                            <div class="dash d-flex justify-content-center"><a href="{{route('admin.home')}}" class="btn-lg btn bg-info text-sm text-white"><i class="fas fa-tachometer-alt"></i> DASHBOARD</a></div>
                        @else
                            <div class="access-options d-flex justify-content-center">
                                <a href="{{ route('login') }}" class="btn btn-primary text-sm text-white mr-2 shadow-sm rounded">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary textml-4 text-sm text-white ml-2 shadow-sm rounded">Register</a>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
