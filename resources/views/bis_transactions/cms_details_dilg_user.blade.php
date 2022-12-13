@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('cms_list')}}">Case Management System</a></li>
                        <li class="breadcrumb-item active">Barangay Information</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="tableX_row col-md-12 up_marg5">

    <br>
    <div class="col-md-12" style="margin-bottom: 30px;">
        <form id="newHousehold" method="POST" action="{{ route('create_cms') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <input type="text" id="CMS_Barangay_Profile_ID" name="CMS_Barangay_Profile_ID" value="{{$Barangay_Profile[0]->CMS_Barangay_Profile_ID}}" hidden>
                <div class="card-body">
                    <div style="float: right;">
                        <ul>
                            <li class="dropdown">
                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0)
                                <a class="btn btn-warning dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="width: 150px;"><i class="fa fa-pencil" aria-hidden="true"></i> Update &nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach($bp_categories as $bp)
                                    <li><a href="{{ url('cms_indicator/'.$bp->CMS_Barangay_Profile_ID.'/'.$bp->Categories_ID) }}">{{$bp->Categories}}</a></li>
                                    @endforeach
                                </ul>
                                @else
                                @endif



                            </li>
                        </ul>

                    </div>
                    <table id="example3" class="table table-striped table-bordered" style="width:100%">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Title</th>
                                <td><input type="text" class="form-control" id="Title" name="Title" value="{{$Barangay_Profile[0]->Title}}" disabled></td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Description</th>
                                <td><textarea class="form-control" rows="4" id="Description" name="Description" disabled>{{$Barangay_Profile[0]->Description}}</textarea></td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Date</th>
                                <td><input type="datetime-local" class="form-control" id="Date_Updated" name="Date_Updated" value="{{$Barangay_Profile[0]->Date_Updated}}" disabled></td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Frequency</th>
                                <td>
                                    <select class="form-control" id="Frequency_ID" name="Frequency_ID" disabled>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($frequency as $fm)
                                        <option value="{{ $fm->Frequency_ID }}" {{ $fm->Frequency_ID  == $Barangay_Profile[0]->Frequency_ID  ? "selected" : "" }}>{{ $fm->Frequency }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Status</th>
                                <td><input type="text" class="form-control" id="Status" name="Status" value="{{$Barangay_Profile[0]->Status}}" disabled></td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Categories</th>
                                <td>
                                    <select class="form-control js-example-basic-multiple" id="Categories_ID" name="Categories_ID[]" multiple="multiple" disabled>

                                        @foreach($categories as $fm)
                                        <option value="{{ $fm->Categories_ID }}" @foreach($bp_categories as $bp) {{ $fm->Categories_ID  == $bp->Categories_ID  ? "selected" : "" }} @endforeach>{{ $fm->Categories }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Region</th>
                                <td>
                                    <select class="form-control" id="Region_ID" name="Region_ID" disabled>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($region as $region)
                                        <option value="{{ $region->Region_ID }}" {{ $region->Region_ID  == $Barangay_Profile[0]->Region_ID  ? "selected" : "" }}>{{ $region->Region_Name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Province</th>
                                <td>
                                    <select class="form-control" id="Province_ID" name="Province_ID" disabled>
                                        <option value='' disabled selected>Select Option</option>
                                        @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                        @else
                                        @foreach($province as $province)
                                        <option value="{{ $province->Province_ID }}" {{ $province->Province_ID  == $Barangay_Profile[0]->Province_ID  ? "selected" : "" }}>{{ $province->Province_Name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">City/Municipality</th>
                                <td>
                                    <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" disabled>
                                        <option value='' disabled selected>Select Option</option>
                                        @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                        @else
                                        @foreach($city_municipality as $city_municipality)
                                        <option value="{{ $city_municipality->City_Municipality_ID }}" {{ $city_municipality->City_Municipality_ID  == $Barangay_Profile[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $city_municipality->City_Municipality_Name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px;">Barangay</th>
                                <td>
                                    <select class="form-control" id="Barangay_ID" name="Barangay_ID" disabled>
                                        <option value='' disabled selected>Select Option</option>
                                        @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                        @else
                                        @foreach($barangay as $barangay)
                                        <option value="{{ $barangay->Barangay_ID }}" {{ $barangay->Barangay_ID  == $Barangay_Profile[0]->Barangay_ID  ? "selected" : "" }}>{{ $barangay->Barangay_Name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0)

                    <div class="container" style="background-color: white; margin: 0px; width: 100%">
                        <br>
                        <ul class="nav nav-tabs">
                            @foreach($bp_categories as $bp)
                            <!-- <li><a href="{{ url('cms_indicator/'.$bp->CMS_Barangay_Profile_ID.'/'.$bp->Categories_ID) }}">{{$bp->Categories}}</a></li> -->
                            <li><a data-toggle="tab" href="#menu{{$bp->Categories_ID}}">{{$bp->Categories}}</a></li>
                            @endforeach

                        </ul>
                        <div class="tab-content">
                            @foreach($bp_categories as $bp)
                            <div id="menu{{$bp->Categories_ID}}" class="tab-pane fade table-responsive" style="padding: 20px 20px">
                                <table class="table table-striped table-bordered" style="width: 100%;">
                                    <tbody>
                                        @foreach($bp_title as $bt)
                                        @if($bt->Categories_ID == $bp->Categories_ID)
                                        <tr style="background-color: lightblue;">
                                            <th colspan="2">{{$bt->Title}}</th>
                                        </tr>

                                        @foreach($bp_indicator as $bi)
                                        @if($bt->Title_ID == $bi->Title_ID)
                                        <tr>
                                            <td>{{$bi->Indicator_Description}}</td>

                                            <td>
                                                @foreach($bp_answers as $ba)
                                                @if($ba->Indicator_ID == $bi->Indicator_ID)

                                                @if($ba->Answer_Classification_ID != 0)

                                                @foreach($answer_class as $ac)
                                                @if($ac->Answer_Classification_ID == $ba->Answer_Classification_ID)
                                                {{$ac->Answer}}
                                                <br>
                                                @else
                                                @endif
                                                @endforeach

                                                @else
                                                {{$ba->Answer}}
                                                <br>
                                                @endif

                                                @else
                                                @endif
                                                @endforeach
                                            </td>

                                        </tr>
                                        @else
                                        @endif
                                        @endforeach

                                        @else
                                        @endif
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    @endif
                    <br>
                </div>
            </div>
        </form>

    </div>
</div>



<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    // Populate Province
    $(document).on("change", "#Region_ID", function() {
        // alert('test');
        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Province_ID').empty();
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();


                var option1 =
                    "<option value='' disabled selected>Select Option</option>";
                $('#Province_ID').append(option1);
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#Province_ID').append(option);
                });
            }
        });
    });

    // Populate City
    $(document).on("change", "#Province_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#City_Municipality_ID').append(option);
                });
            }
        });
    });


    // Populate Barangay
    $(document).on("change", "#City_Municipality_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#Barangay_ID').append(option);
                });
            }
        });
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.ContentManageDILG').addClass('active');
        $('.cms_dilg_menu').addClass('active');
        $('.cms_dilg_main').addClass('menu-open');
    });
</script>

<style>
    .select2-selection {
        height: 42px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection