<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Tingsapp</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>

    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;400&display=swap'); */
        html,
        body {
            height: 100% !important;
            min-height: 100% !important;
            height:100%;
            width: 100%;
            /* padding: 30px;
            background-color: #f5f5f7 !important; */
        }
        .container{
            max-width: 660px;
            /* padding-left: 30px !important;
            padding-right: 30px !important; */
            border-radius: 10px !important;
        }
        .header{
            display: flex !important;
            align-items: center !important;
            justify-content: start;
            margin-bottom: 60px;
        }
        .logo{
            width: 140px;
        }
        .footer{
            margin-top: 160px;
            color: grey !important;
        }
        .button{
            background: #8ab4f9 !important;
            padding: 16px 25px 14px 25px;
            text-decoration: none !important;
            border-radius: 50px !important;
        }
        .button:hover{
            background: #83adf3 !important;
        }
        .outline-button{
            border: 1px solid #8ab4f9 !important;
            padding: 16px 25px 14px 25px;
            text-decoration: none !important;
            border-radius: 50px !important;
        }
        .outline-button:hover{
            background: #8ab4f9 !important;
        }
        span{
            color: #000 !important;
        }
        .mx-5{
            width: 60px !important;
        }
        @media only screen and (min-width: 550px) {
            p,span,td,li{font-size: 17px !important;}
            h1{font-size: 60px !important;font-weight: 700 !important;}
            h2{font-size: 24px !important;}
            h3{font-size: 22px !important;}
            h4{font-size: 20px !important;}
            h5{font-size: 18px !important;}
            h6{font-size: 16px !important;}
            .footer p{
                font-size: 14px !important;
            }
        }
    </style>
</head>

<body" style="padding-top:30px;padding-bottom:20px;">
    <div  class="container d-flex flex-column justify-content-between">

       <div class="header" >
            <img class="logo" src="https://exptradies.com/images/home/logo_text.png" alt="Exptradies logo" width="140">
       </div>

        @yield('content')

        <div class="footer">
            <a  href="https://exptradies.com/help"><p>Contact</p></a>
            <p >© 2023 Exptradies </p>
            <p >Unit 1/71 harrow rd Auburn NSW 2144, Sydney, Australia</p>
        </div>
    </div>
</body>

</html>
