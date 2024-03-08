<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
      <!-- Meta charset -->
    <meta charset="utf-8">
    <!-- Title -->
    <title>Exptradies: Connecting Australians with local professional trades.</title>
    <!-- Meta description -->
    <meta name="description" content="Schedule your handyman in a few steps, Exptradies connecting you with local professional trade.">
    <!-- Meta keywords -->
    <meta name="keywords" content="Employee, Employers,Trades,Traders, Australia, Business, Customer, Quotation, Cleaner, Painter,">
    <!-- Meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
    <!-- Fabicon -->
    @if (config('app.env') === 'local')
    <link rel="shortcut icon" type="image/ico" href="http://localhost:8000/images/logo.png">
    @else
    <link rel="shortcut icon" type="image/ico" href="https://exptradies.com/images/logo.png">
    @endif
    <!-- Internet explorar -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google site verification -->
    <meta name="google-site-verification" content="" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbcpF6GlIsLXXGLr3PVHTA2pEZsjUhw64&callback=Function.prototype"></script>
    <script src="https://js.stripe.com/v3/"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #f9f8f7 !important;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11402878909"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11402878909');
</script>

<body>
    <div id="app">
        <app-component />
    </div>
    
    @if (config('app.env') === 'local')
    <script src="{{ asset('js/app.js') }}"></script>
    @else
        <script src="{{ secure_asset('js/app.js') }}"></script>
    @endif
</body>

</html>