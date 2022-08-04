@extends('layouts.default')

@section('content')

<script src="{{ asset('/js/homeX.js') }}" defer></script>
<link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
<div class="theContent">
    <div class="justify-content-center">
        <div class="col-md-9 middlePane">
            <div class="flexer justifier">
                @auth 
                <div class="newPost"> 
                    <div class="cardTitle"><h2>New Post</h2></div>
                    <div class="padder5">
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
                    </div>
                </div>
                @endauth
            </div>
            <div class="flexer justifier">
                <div class="newsFeed"> 
                    <div class="cardTitle"><h2>News Feed</h2></div>
                    @isset($posts)
                    @foreach ($posts as $p)
                        <div class="commentPoster borderSmoothen">
                            <div class="flexer spacer_xxs_down padder10_all">
                                <div class="Absolute-Center">
                                    <img src="{{ asset('/css/img/profileDefault_xs.jpg') }}" class="profilePic">
                                </div>
                                <div>
                                    <div>
                                        <div class="posterName">
                                            @foreach($usersX as $urx)
                                                @if($p->Encoder_ID == $urx->id){{ $urx->name }}@endif
                                            @endforeach
                                        </div>
                                        <div class="posterDate"> {{ ($p->Date_Stamp) }} </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id == $p->Encoder_ID)
                                <div class="Absolute-Center padder5"> 
                                    <button class="a-btns editZ" data-toggle="modal" data-target="#editPost" value="{{$p->News_ID}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                    &nbsp;
                                    <button class="a-btns" value="{{$p->News_ID}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </div>
                                @endif
                            </div>
                            
                            <div class="postContainer">
                                <h4><u>{{$p->News_Title}}</u></h4>
                                <br>
                                <p>{{$p->News_Description}}</p>
                            </div>
                            
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
                        
                    @endforeach
                    @endisset

                </div>
            </div>
        </div>
        <div class="col-md-3 rightPane">
            <div class="flexer justifier ">
                <div class="cardTitle width100 txtCtr"><h3>Events / Announcements</h3></div>
            </div>
            @auth 
                <div class="btnAnn_new_container"><button data-toggle="modal" data-target="#createAnn">New</button></div>
            @endauth

            @isset($EV_AN)
            @foreach($EV_AN as $ex)
            <div class="flexer justifier EventContainer">
                <div class="E_Loop_container"> 
                    <img src="{{ asset('/css/img/MegaPhone_PNG.png') }}" width="45" style="margin-left: -30px;">
                </div>
                <div class="EVtxtcontainer">
                    <form method="GET" action="{{ route('viewAnnouncement') }}" autocomplete="off">
                        <input name="thisAnnouncement" value="{{$ex->Announcement_ID}}" hidden>
                        <button style="border: none; background-color:transparent; text-align:left;">
                            <div class="cardTitle EVtitle"><h4>{{ $ex->Announcement_Title }}</h4></div>
                            <div class="EVtext">
                                <p>{{ $ex->Announcement_Description }}</p>
                            </div>
                        </button>
                    </form>
                    <div class="moreInfo width100 txtCtr" style="margin-top:3px;"> Click for More Info</div>
                </div>
            </div>
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Post</h4>
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
                                        <option value="">Type 1</option>
                                        <option value="">Type 2</option>
                                        <option value="">Type 3</option>
                                    </select>
                                    <select id="postStatus" name="postStatus">
                                        <option value="" hidden selected>Status Type</option>
                                        <option value="">Status 1</option>
                                        <option value="">Status 2</option>
                                        <option value="">Status 3</option>
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
                                <input id="FUpload" type="file"  name="FUpload">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                                <span class="tooltipX">File</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="imgUpload" type="file"  name="imgUpload">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                <span class="tooltipX">Image</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="vidUpload" type="file"  name="vidUpload">
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title flexer justifier">Create Announcement</h4>
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
                                        <option value="">Type 1</option>
                                        <option value="">Type 2</option>
                                        <option value="">Type 3</option>
                                    </select>
                                    <select id="annType" name="annStatus">
                                        <option value="" hidden selected>Status Type</option>
                                        <option value="">Status 1</option>
                                        <option value="">Status 2</option>
                                        <option value="">Status 3</option>
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
                                <input id="FUpload2" type="file"  name="FUpload2">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                                <span class="tooltipX">File</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="imgUpload2" type="file"  name="imgUpload2">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                <span class="tooltipX">Image</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="vidUpload2" type="file"  name="vidUpload2">
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
                                        <option value="">Type 1</option>
                                        <option value="">Type 2</option>
                                        <option value="">Type 3</option>
                                    </select>
                                    <select id="postStatus_edit" name="postStatus_edit">
                                        <option id="this_postStatus" value="" hidden selected>Status Type</option>
                                        <option value="">Status 1</option>
                                        <option value="">Status 2</option>
                                        <option value="">Status 3</option>
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
                                <input id="FUpload_edit" type="file"  name="FUpload_edit">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                                <span class="tooltipX">File</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="imgUpload_edit" type="file"  name="imgUpload_edit">
                                <i class="fa fa-camera" aria-hidden="true"></i>
                                <span class="tooltipX">Image</span>
                            </label>
                            <label class="custom-file-upload">
                                <input id="vidUpload_edit" type="file"  name="vidUpload_edit">
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
