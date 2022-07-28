@auth

@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/homeX.js') }}" defer></script>
<link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
<div>
    <h3 style="text-align: center"><u>{{$announcement[0]->Announcement_Title}}</u></h3>
    <br>
    <div class="AnnouncementBody"> 
        {{$announcement[0]->Announcement_Description}}
    </div>
    <div class="Absolute-Center ">
        @if($uploads !=[])
        @foreach($uploads as $up)
            @if($up->File_Type == 'File' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
            <a href="{{ asset('/assets/uploads/FileX').'/'.$up->File_Name }}"> {{$up->File_Name}} </a>
            @endif
            @if($up->File_Type == 'Image' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
            <img src="{{ asset('/assets/uploads/imgX').'/'.$up->File_Name }}" class="maxDimensions">
            @endif
            @if($up->File_Type == 'Video' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
            <video width="70%" height="70%" controls class="Absolute-Center ">
                <source src="{{ asset('/assets/uploads/videoX').'/'.$up->File_Name }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            @endif
            @if($up->File_Type == 'GIF' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
            <img width="70%" height="70%" src="{{ asset('/assets/uploads/gifX').'/'.$up->File_Name }}">
            @endif
        @endforeach
        @endif

    </div>
</div>
@endsection

@else 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DILG_BIS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('css/logos/DILG_logo.png') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <!-- Scripts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/global.js') }}" defer></script>

        <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>

        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
            alert(msg);
            }
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('css/logos/DILG_logo.png') }}">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <link href="{{ asset('css/global.css') }}" rel="stylesheet">

         <script src="{{ asset('/js/homeX.js') }}" defer></script>
         <link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
         <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="main_public">
            <div class="top-right links" style="z-index: 999">

                <a href="/" class="text_hoverable">Home</a>
                <a href="" class="text_hoverable">FAQ</a>
                <a href="{{ route('login') }}" class="text_hoverable">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text_hoverable">Register</a>
                @endif
                
            </div>
            <div class="theContent">
                <div style="text-align: center; font-size:24px"><u>{{$announcement[0]->Announcement_Title}}</u></div>
                <br>
                <div class="AnnouncementBody"> 
                    {{$announcement[0]->Announcement_Description}}
                </div>
                <div class="Absolute-Center ">
                    @if($uploads !=[])
                    @foreach($uploads as $up)
                        @if($up->File_Type == 'File' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
                        <a href="{{ asset('/assets/uploads/FileX').'/'.$up->File_Name }}"> {{$up->File_Name}} </a>
                        @endif
                        @if($up->File_Type == 'Image' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
                        <img src="{{ asset('/assets/uploads/imgX').'/'.$up->File_Name }}" class="maxDimensions">
                        @endif
                        @if($up->File_Type == 'Video' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
                        <video width="70%" height="70%" controls class="Absolute-Center ">
                            <source src="{{ asset('/assets/uploads/videoX').'/'.$up->File_Name }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @endif
                        @if($up->File_Type == 'GIF' && $up->Announcement_ID == $announcement[0]->Announcement_ID)
                        <img width="70%" height="70%" src="{{ asset('/assets/uploads/gifX').'/'.$up->File_Name }}">
                        @endif
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </body>
</html>
@endauth