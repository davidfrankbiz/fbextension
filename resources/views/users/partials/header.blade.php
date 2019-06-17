@if(Auth::user()->is_admin != '0')
    <script>window.location = "{{ URL::previous() }}";</script>

    @endif

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title> Lemonade Cash Club</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="{{ asset('frontimages/favi.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('frontimages/apple-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontimages/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontimages/favicon/apple-icon-114x114.png') }}">
    <!-- Bootstrap v3.3.4 Grid Styles-->

    <style></style><!-- Load CSS & WebFonts Main Function-->
    <link rel="stylesheet" href="{{ asset('users/grid.css') }}">  
    <link rel="stylesheet" href="{{ asset('users/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('users/min.css') }}">
    <link rel="stylesheet" href="{{ asset('users/header.min.css') }}">
    <link rel="stylesheet" href="{{ asset('users/main.min.css') }}">     
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <style type="text/css">
        header .header-top-wrapper {
            margin: 40px 0 50px;
        }

        footer {
            clear: both;
            position: relative;
            z-index: 10;
            height: 3em;
            margin-top: -3em;
        }

        html, body {
            height: 100%;
        }

        .wrap {
            min-height: 100% !important;
        }

        .wrap:after {
            content: "";
            display: block;
        }

        footer, .wrap:after {
            height: 100px;
        }
        @media (min-width: 1200px) {
            .container {
                width: 1190px !important;
            }
        }

  
         .logo img {
    width: 195%;
    height: 100px;
}
    </style>


    <script type="text/javascript" src="{{ asset('users/clipboard.min.js') }}"></script>

    
    <link href="{{ asset('users/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/core.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/components.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/pages.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/menu.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('users/responsive.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        header.navbar-custom {
            margin-bottom: 30px;
        }
    </style>
    <style>
        #topnav {
            position: inherit;
            min-height: inherit;
        }

        .alert-warning {
            color: #FF834A;
        }

        .alert-info {
            color: #34C2EB;
        }


    </style>
</head>
<body>
<div class="wrap" id="topnav">
    <div class="my-preloader hidden">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="navbar-custom">
        <div class="container">
            <div class="header-top-wrapper">
                <div class="row">
                    <div class="col-sm-3 hidden-xs">
                        <div class="logo"><a href="{{url('/')}}"><img src="{{url('frontimages/logo_fbd.png')}}" alt="Lemonade Cash Club"
                                                           style="border: none"></a></div>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <ul class="menu">
                            <li class="logo"><img src="logo_fbd.png" alt="The Bucks Club"></li>

                                                            <li class="gotot"><a href="{{url('dashboard')}}">Dashboard</a></li>

                                                                <li><a href="{{url('profile')}}">Profile</a></li>
                                <li class="logoutlog"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    Logout</a></li>
                                                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>



                              
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>