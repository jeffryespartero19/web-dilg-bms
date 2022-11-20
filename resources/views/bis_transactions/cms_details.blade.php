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
    <input type="number" id="User_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
        <form id="newHousehold" method="POST" action="{{ route('create_cms') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <input type="text" id="CMS_Barangay_Profile_ID" name="CMS_Barangay_Profile_ID" value="{{$Barangay_Profile[0]->CMS_Barangay_Profile_ID}}" hidden>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12" style="text-align: right;">
                            <div style="margin-bottom:10px">
                                @if (Auth::user()->User_Type_ID == 5)
                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0)
                                <a href="{{ url('cms_details/0') }}" class="btn btn-info" style="width: 100px;" aria-hidden="true">New</a>
                                @else
                                @endif

                                <button class="btn btn-success" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i> @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0) UPDATE @else SAVE @endif</button>
                                @endif

                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">INDICATOR SETUP &nbsp;
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach($bp_categories as $bp)
                                        <a id="Indicator_Setup" class="dropdown-item" href="{{ url('cms_indicator/'.$bp->CMS_Barangay_Profile_ID.'/'.$bp->Categories_ID) }}">{{$bp->Categories}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                @endif

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="Title">Title</label>
                            <input type="text" class="form-control" id="Title" name="Title" value="{{$Barangay_Profile[0]->Title}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="Description">Description</label>
                            <textarea class="form-control" rows="4" id="Description" name="Description" required>{{$Barangay_Profile[0]->Description}}</textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Date_Updated">Date</label>
                            <input type="datetime-local" class="form-control" id="Date_Updated" name="Date_Updated" value="{{$Barangay_Profile[0]->Date_Updated}}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Frequency_ID">Frequency</label>
                            <select class="form-control" id="Frequency_ID" name="Frequency_ID" required>
                                <option value='' disabled selected>Select Option</option>
                                @foreach($frequency as $fm)
                                <option value="{{ $fm->Frequency_ID }}" {{ $fm->Frequency_ID  == $Barangay_Profile[0]->Frequency_ID  ? "selected" : "" }}>{{ $fm->Frequency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Status">Status</label>
                            <input type="text" class="form-control" id="Status" name="Status" value="{{$Barangay_Profile[0]->Status}}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Categories_ID">Categories</label>
                            <select class="form-control select2" id="Categories_ID" name="Categories_ID[]" multiple="multiple" required>
                                @foreach($categories as $fm)
                                <option value="{{ $fm->Categories_ID }}" @foreach($bp_categories as $bp) {{ $fm->Categories_ID  == $bp->Categories_ID  ? "selected" : "" }} @endforeach>{{ $fm->Categories }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Region_ID">Region</label>
                            <select class="form-control" id="Region_ID" name="Region_ID" required>
                                <option value='' disabled selected>Select Option</option>
                                @foreach($region as $region)
                                <option value="{{ $region->Region_ID }}" {{ $region->Region_ID  == $Barangay_Profile[0]->Region_ID  ? "selected" : "" }}>{{ $region->Region_Name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Province_ID">Province</label>
                            <select class="form-control" id="Province_ID" name="Province_ID" required>
                                <option value='' disabled selected>Select Option</option>
                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                @else
                                @foreach($province as $province)
                                <option value="{{ $province->Province_ID }}" {{ $province->Province_ID  == $Barangay_Profile[0]->Province_ID  ? "selected" : "" }}>{{ $province->Province_Name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="City_Municipality_ID">City/Municipality</label>
                            <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                <option value='' disabled selected>Select Option</option>
                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                @else
                                @foreach($city_municipality as $city_municipality)
                                <option value="{{ $city_municipality->City_Municipality_ID }}" {{ $city_municipality->City_Municipality_ID  == $Barangay_Profile[0]->City_Municipality_ID  ? "selected" : "" }}>{{ $city_municipality->City_Municipality_Name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="Barangay_ID">Barangay</label>
                            <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                <option value='' disabled selected>Select Option</option>
                                @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID == 0)
                                @else
                                @foreach($barangay as $barangay)
                                <option value="{{ $barangay->Barangay_ID }}" {{ $barangay->Barangay_ID  == $Barangay_Profile[0]->Barangay_ID  ? "selected" : "" }}>{{ $barangay->Barangay_Name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                    </div>


                    <!-- @if($Barangay_Profile[0]->CMS_Barangay_Profile_ID != 0)

                    <div class="container" style="background-color: white; margin: 0px; width: 100%">
                        <br>
                        <ul class="nav nav-tabs">
                            @foreach($bp_categories as $bp)
                            <li><a data-toggle="tab" href="#menu{{$bp->Categories_ID}}">{{$bp->Categories}}</a></li>
                            @endforeach

                        </ul>
                        <div class="tab-content">
                            @foreach($bp_categories as $bp)
                            <div id="menu{{$bp->Categories_ID}}" class="tab-pane fade table-responsive" style="padding: 20px 20px">
                                <table class="table table-striped table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th hidden>Resident_ID</th>
                                            <th style="width: 300px;">TITLE</th>
                                            <th style="width: 200px;">IS VISIBLE</th>
                                            <th style="width: 200px;">MIN RECORD ANSWER</th>
                                            <th style="width: 200px;">MAX RECORD ANSWER</th>
                                            <th style="width: 200px;">CHOICE GROUP</th>
                                            <th style="width: 200px;">CHOICE COUNT</th>
                                            <th style="width: 200px;">DEFAULT CHOICES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td hidden>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                            <td>Sample</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    @endif -->
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
        $('.select2').select2();
    });

    $(document).ready(function() {
        $User_ID = $('#User_ID').val();

        if($User_ID != 5) {
            $("#Title").prop("disabled", true);
            $("#Description").prop("disabled", true);
            $("#Frequency_ID").prop("disabled", true);
            $("#Status").prop("disabled", true);
            $("#Categories_ID").prop("disabled", true);
            $("#Region_ID").prop("disabled", true);
            $("#Province_ID").prop("disabled", true);
            $("#City_Municipality_ID").prop("disabled", true);
            $("#Barangay_ID").prop("disabled", true);
            $("#Date_Updated").prop("disabled", true);
        }
        
        
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
</script>


@endsection