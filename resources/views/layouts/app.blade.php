<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edg
    
    e">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Slabo+27px" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/base.css?v=2') }}">
    <link rel="stylesheet" href="/lib/datepicker/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="css/main.css?v={{ uniqid() }}">
 
    
</head>
<body>
    <div id="app">
       @include('partials.navigation')
        <main class="py-4">
            @if(session('message'))
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-{ session('message')[0] }}">
                        <h3>{{ __('Mensaje informativo') }}</h3>
                        <p>{{ session('message')[1] }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places" ></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>

    <script type="text/javascript" src="/lib/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
const pathurl = '{{ env('APP_URL')}}';
</script>
<script src="/js/main.js?v={{ uniqid() }}" defer></script>
   
</body>
</html>
