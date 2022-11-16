@extends('layouts.default')

@section('content')

<script src="{{ asset('/js/homeX.js') }}" defer></script>
<link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
<link href="{{ asset('/css/general.css') }}" rel="stylesheet">
<div class="row" style="padding: 20px;">
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">New Post</h5>
            </div>
            @auth

            <div class="flexer justifier">
                <div class="Absolute-Center">
                    <img src="{{ asset('/assets/img/profileDefault_xs.jpg') }}" class="profilePic">
                </div>
                <div class="Absolute-Center">
                    <div>
                        <div class="posterName">{{Auth::user()->name}}</div>
                        <div class="posterDate"> {{ ($currDATE)->format('M. d, Y') }} </div>
                    </div>
                </div>
                <div class="postContainer">
                    <button class="postArea" data-toggle="modal" data-target="#createPost">What's on your mind, {{Auth::user()->name}} ?</button>
                </div>
            </div>

            @endauth
        </div>
        <div class="timeline">
            @isset($posts)
            @foreach ($posts as $p)
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-green">{{ date('M. d, Y', strtotime($p->Date_Stamp)) }}</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
                @if($uploads !=[])
                @foreach($uploads as $up)
                @if($up->File_Type == 'File' && $up->News_ID == $p->News_ID)
                <i class="fas fa-file bg-info"></i>
                @elseif($up->File_Type == 'Image' && $up->News_ID == $p->News_ID)
                <i class="fa fa-camera bg-purple"></i>
                @elseif($up->File_Type == 'Video' && $up->News_ID == $p->News_ID)
                <i class="fas fa-video bg-maroon"></i>
                @elseif($up->File_Type == 'GIF' && $up->News_ID == $p->News_ID)
                <i class="fas fa-film bg-green"></i>
                @endif
                @endforeach
                @endif
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ date('h:i a', strtotime($p->Date_Stamp)) }}</span>
                    <h3 class="timeline-header"><img src="{{ asset('/css/img/profileDefault_xs.jpg') }}" class="profilePic" style="height: 30px; width:30px"><a href="#"> @foreach($usersX as $urx)
                            @if($p->Encoder_ID == $urx->id){{ $urx->name }}@endif
                            @endforeach</a></h3>

                    <div class="timeline-body">
                        {{$p->News_Title}}
                    </div>
                    <div class="timeline-body">
                        <div class="Absolute-Center ">
                            @if($uploads !=[])
                            @foreach($uploads as $up)
                            @if($up->File_Type == 'File' && $up->News_ID == $p->News_ID)
                            <a href="{{ asset('/assets/uploads/FileX').'/'.$up->File_Name }}"> {{$up->File_Name}} </a>
                            @endif
                            @if($up->File_Type == 'Image' && $up->News_ID == $p->News_ID)
                            <img src="{{ asset('/assets/uploads/imgX').'/'.$up->File_Name }}" class="maxDimensions">
                            @endif
                            @if($up->File_Type == 'Video' && $up->News_ID == $p->News_ID)
                            <video width="70%" height="70%" controls class="Absolute-Center ">
                                <source src="{{ asset('/assets/uploads/videoX').'/'.$up->File_Name }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                            @if($up->File_Type == 'GIF' && $up->News_ID == $p->News_ID)
                            <img width="70%" height="70%" src="{{ asset('/assets/uploads/gifX').'/'.$up->File_Name }}">
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>

                    @if(Auth::user()->id == $p->Encoder_ID)
                    <div class="timeline-footer">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPost" value="{{$p->News_ID}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                        <button class="btn btn-danger btn-sm a-btns" value="{{$p->News_ID}}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </div>
                    @endif
                </div>
            </div>
            <!-- END timeline item -->
            @endforeach
            @endisset
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div>


    </div>
    <div class="col-lg-4">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Events / Announcements</h5>
            </div>

            @auth
            <div class="btnAnn_new_container"><button data-toggle="modal" data-target="#createAnn">New</button></div>
            @endauth
            @isset($EV_AN)
            @foreach($EV_AN as $ex)
            <div class="card-body">
                <div class="flexer justifier EventContainer">
                    <div class="E_Loop_container">
                        <img src="{{ asset('/css/img/MegaPhone_PNG.png') }}" width="45" style="margin-left: -30px;">
                    </div>
                    <div class="EVtxtcontainer">
                        <form method="GET" action="{{ route('viewAnnouncement') }}" autocomplete="off">
                            <input name="thisAnnouncement" value="{{$ex->Announcement_ID}}" hidden>
                            <button style="border: none; background-color:transparent; text-align:left;">
                                <div class="cardTitle EVtitle">
                                    <h4>{{ $ex->Announcement_Title }}</h4>
                                </div>
                                <div class="EVtext">
                                    <p>{{ $ex->Announcement_Description }}</p>
                                </div>
                            </button>
                        </form>
                        <div class="moreInfo width100 txtCtr" style="margin-top:3px;"> Click for More Info</div>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
            @endisset

        </div>
    </div>
</div>

<!-- Create NF Post Modal -->
<div class="modal fade" id="createPost" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Post</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="userPost" method="POST" action="{{ route('createPost') }}" autocomplete="off" enctype="multipart/form-data">
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
                                        <select id="postType" name="postType">
                                            <option value="" hidden selected>News Type</option>
                                            @foreach($NewsType_list as $ntl)
                                            <option value="{{$ntl->News_Type_ID}}">{{$ntl->News_Type_Name}}</option>
                                            @endforeach
                                        </select>
                                        <select id="postStatus" name="postStatus">
                                            <option value="" hidden selected>Status Type</option>
                                            @foreach($NewsStatus_list as $nsl)
                                            <option value="{{$nsl->News_Status_ID}}">{{$nsl->News_Status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input id="postTitle" name="postTitle" placeholder="Title" class="postTitle">
                    </div>
                    <div>
                        <textarea id="postActual" name="postActual" class="postActual" placeholder="What's on your mind, {{Auth::user()->name}} ?"></textarea>
                    </div>
                    <input id="up1_only" name="up1_only" type="text" hidden>
                    <div class="flexer">
                        <div class="add2Post">Add to your Post</div>
                        <div class="attBTNs">
                            <div class="att_inner">
                                <label class="custom-file-upload">
                                    <input id="FUpload" type="file" name="FUpload">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="tooltipX">File</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="imgUpload" type="file" name="imgUpload">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Image</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="vidUpload" type="file" name="vidUpload">
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Video</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="gifUpload" type="file" name="gifUpload">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    <span class="tooltipX">GIF</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn postThis">Post</button>
            </div>
        </div>

    </div>
</div>

<!-- Create NF Post Modal END -->

<!-- Create E/A Announcement Modal  -->
<div class="modal fade" id="createAnn" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Announcement</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="annPost" method="POST" action="{{ route('createAnnouncement') }}" autocomplete="off" enctype="multipart/form-data">
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
                                        <select id="annType" name="annType">
                                            <option value="" hidden selected>Announcement Type</option>
                                            @foreach($AnnouncementType_list as $atl)
                                            <option value="{{$atl->Announcement_Type_ID}}">{{$atl->Announcement_Type_Name}}</option>
                                            @endforeach
                                        </select>
                                        <select id="annStatus" name="annStatus">
                                            <option value="" hidden selected>Status Type</option>
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
                        <input id="annTitle" name="annTitle" placeholder="Title" class="postTitle">
                    </div>
                    <div>
                        <textarea id="anActual" name="annActual" class="postActual" placeholder="What's on your mind, {{Auth::user()->name}} ?"></textarea>
                    </div>
                    <input id="up1_only2" name="up1_only2" type="text" hidden>
                    <div class="flexer">
                        <div class="add2Post">Add to your Announcement</div>
                        <div class="attBTNs">
                            <div class="att_inner">
                                <label class="custom-file-upload">
                                    <input id="FUpload2" type="file" name="FUpload2">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="tooltipX">File</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="imgUpload2" type="file" name="imgUpload2">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Image</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="vidUpload2" type="file" name="vidUpload2">
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Video</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="gifUpload2" type="file" name="gifUpload2">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    <span class="tooltipX">GIF</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn postThisAnn">Post</button>
            </div>
        </div>

    </div>
</div>

<!-- Create E/A Announcement Modal END -->

<!-- Edit NF Post Modal -->
<div class="modal fade" id="editPost" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title flexer justifier">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form id="editPost_form" method="POST" action="{{ route('updatePost') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="flexer">
                        <div class="Absolute-Center">
                            <img src="{{ asset('/assets/img/profileDefault_xs.jpg') }}" class="profilePic">
                        </div>
                        <div class="">

                            <div>
                                <div id="posterName_edit" class="posterName_edit"></div>
                                <div class="who_seePost" style="font-size: 12px">
                                    <div class="who_seePost">
                                        <select id="postType_edit" name="postType_edit">
                                            <option id="this_postType" value="" hidden selected>News Type</option>
                                            @foreach($NewsType_list as $ntl)
                                            <option value="{{$ntl->News_Type_ID}}">{{$ntl->News_Type_Name}}</option>
                                            @endforeach
                                        </select>
                                        <select id="postStatus_edit" name="postStatus_edit">
                                            <option id="this_postStatus" value="" hidden selected>Status Type</option>
                                            @foreach($NewsStatus_list as $nsl)
                                            <option value="{{$nsl->News_Status_ID}}">{{$nsl->News_Status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <input id="this_postTitle" name="postTitle_edit" placeholder="Title" class="postTitle">
                        <input id="this_postID" name="postID_edit" hidden>
                    </div>
                    <div>
                        <textarea id="this_postActual" name="postActual_edit" class="postActual"></textarea>
                    </div>
                    <input id="up1_only_edit" name="up1_only_edit" type="text" hidden>

                    <div class="att_table">
                        <table class="table-bordered table_gen" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="attached_items">

                            </tbody>
                        </table>
                    </div>

                    <div class="flexer edit_hidden" hidden>
                        <div class="add2Post edit_hidden" hidden>Add to your Post</div>

                        <div class="attBTNs edit_hidden" hidden>
                            <div class="att_inner">
                                <label class="custom-file-upload">
                                    <input id="FUpload_edit" type="file" name="FUpload_edit">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="tooltipX">File</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="imgUpload_edit" type="file" name="imgUpload_edit">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Image</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="vidUpload_edit" type="file" name="vidUpload_edit">
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    <span class="tooltipX">Video</span>
                                </label>
                                <label class="custom-file-upload">
                                    <input id="gifUpload_edit" type="file" name="gifUpload_edit">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    <span class="tooltipX">GIF</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn postThis_edit">Save</button>
            </div>
        </div>

    </div>
</div>

<!-- Edit NF Post Modal END -->

@endsection