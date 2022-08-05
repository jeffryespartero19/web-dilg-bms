@auth

@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/homeX.js') }}" defer></script>
<link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
<div class="Absolute-Center">
    <div class="AnnouncementContainer">
        <div style="text-align: center"><u style="font-size: 24px;">{{$announcement[0]->Announcement_Title}}</u>&nbsp; <button class="editZ2" data-toggle="modal" data-target="#editAnn">Edit</button></div>
        <br>
        <div class="AnnouncementBody"> 
            {{$announcement[0]->Announcement_Description}}
        </div>
        <div class="Absolute-Center">
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

<!-- Edit E/A Announcement Modal  -->
<div class="modal fade" id="editAnn" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Edit Announcement</h4>
        </div>
        <div class="modal-body">
            <form id="editAnn_form" method="POST" action="{{ route('updateAnnouncement') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="flexer">
                    <div class="Absolute-Center">
                        <img src="{{ asset('/assets/img/profileDefault_xs.jpg') }}" class="profilePic">
                    </div>
                    <div class="">
                        <div>
                            <div class="posterName">{{Auth::user()->name}}</div>
                            <div class="who_seePost" style="font-size: 12px">
                                <div class="who_seePost">
                                    <select id="annType_edit2" name="annType_edit2">
                                        <option value="{{$announcement[0]->Announcement_Type}}" hidden selected>
                                            @if(!$thisAnnType->isEmpty()){{$thisAnnType[0]->Announcement_Type_Name}}@endif
                                        </option>
                                        @foreach($AnnouncementType_list as $atl)
                                            <option value="{{$atl->Announcement_Type_ID}}">{{$atl->Announcement_Type_Name}}</option>
                                        @endforeach
                                    </select>
                                    <select id="annStatus_edit2" name="annStatus_edit2">
                                        <option value="{{$announcement[0]->Announcement_Status_ID}}" hidden selected>
                                            @if(!$thisAnnStatus->isEmpty()){{$thisAnnStatus[0]->Announcement_Status}}@endif
                                        </option>
                                        @foreach($AnnouncementStatus_list as $asl)
                                            <option value="{{$asl->Announcement_Status_ID}}">{{$asl->Announcement_Status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input id="annTitle_edit2" name="annTitle_edit2" placeholder="Title" class="postTitle" value="{{$announcement[0]->Announcement_Title}}">
                    <input id="this_annID" name="annID_edit" value="{{$announcement[0]->Announcement_ID}}" hidden>
                </div>
                <div>
                    <textarea id="annActual_edit2" name="annActual_edit2" class="postActual">{{$announcement[0]->Announcement_Description}}</textarea>
                </div>
                <input id="up1_only_edit2" name="up1_only_edit2" type="text" hidden>
            
                <div class="att_table"> 
                    <table class="table-bordered table_gen" cellspacing="0">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="attached_items">
                            @foreach($uploads as $u)
                                <tr>
                                    <td>{{$u->File_Name}}</td>
                                    <td style="text-align: center">
                                        <button class="change_att">Change</button>
                                        <button class="remove_att" value="{{$announcement[0]->Announcement_Status_ID}}">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="flexer edit_hidden" hidden>
                    <div class="add2Post edit_hidden" hidden>Add to your Post</div>
                    
                    <div class="attBTNs edit_hidden" hidden> 
                        <div class="att_inner">
                            <label class="custom-file-upload">
                                <input id="FUpload_edit" type="file"  name="FUpload_edit2">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                                <span class="tooltipX">File</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="imgUpload_edit" type="file"  name="imgUpload_edit2">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                <span class="tooltipX">Image</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="vidUpload_edit" type="file"  name="vidUpload_edit2">
                                <i class="fa fa-video-camera" aria-hidden="true"></i>
                                <span class="tooltipX">Video</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="gifUpload_edit" type="file" name="gifUpload_edit2">
                                <i class="fa fa-window-restore" aria-hidden="true"></i>
                                <span class="tooltipX">GIF</span>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn updateThisAnn modal_sb_button">Save</button>
        </div>
      </div>
      
    </div>
</div>

<!-- Edit E/A Announcement Modal END -->

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
            <div class="Absolute-Center">
                <div class="AnnouncementContainer2">
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
            </div>
        </div>
    </body>
</html>
@endauth