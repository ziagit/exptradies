<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
       <!-- Meta charset -->
     <meta charset="utf-8">
    <!-- Title -->
    <title>Exptradies: Connecting Australias with local professional trades.</title>
    <!-- Meta description -->
    <meta name="description" content="Schedule your handyman in a few steps, ExpTradies connecting you with local professional trade.">
    <!-- Meta keywords -->
    <meta name="keywords" content="Employee, Employers,Trades,Traders, Austaria, Business, Customer, Quotation">
    <!-- Meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
    <!-- Fabicon -->
    <link rel="shortcut icon" type="image/ico" href="{{ asset('images/home/logo.png') }}">
    <!-- Internet explorar -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Exptradies</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background-color: #f9f8f7  !important;
        }
        .navbar{
            background: #f9f8f7 !important;
            box-shadow: none !important;
            margin-bottom: 100px;
            padding-top: 47px;
            padding-bottom: 47px;
        }
        .search{
            min-width: 500px;
        }
        .content{
            min-height: calc(100vh - 100px);
            margin-bottom: 130px;
        }
        .post-img{
            max-height: 211px;
        }
        .card-img-top{
            max-height: 100px;
        }
        .comment-input{
            max-width: 500px;
            margin-top: 30px;
        }
        .comment-container{
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #ddd;
        }
        .footer{
            height: 300px;
            width: 100%;
            background: #e1f0ff;
            padding-top: 30px;
            padding-bottom: 10px;
        }
        .footer ul{
            padding: 0 !important;
        }
        .footer ul li{
            list-style-type: none !important;
        }
        .back-btn{
            position: fixed;
            bottom: 20px;
            left: 20px;
        }
        @media only screen and (max-width: 768px) {
            .post-img{
                width: 100% !important;
                max-height: 400px !important;
            }
            .back-btn{
                left: unset !important;
                right: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div >
        @yield('content')
        @include('blog.footer')
    </div>
</body>
</html>
