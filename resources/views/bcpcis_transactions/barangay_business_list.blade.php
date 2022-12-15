@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">
 
<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Business Information List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Barangay Business Information List</li>
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->User_Type_ID == 3  || Auth::user()->User_Type_ID == 4)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-3">
                                <label for="R_ID">Region</label>
                                <select class="form-control" id="R_ID" name="R_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($region1 as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="P_ID">Province</label>
                                <select class="form-control" id="P_ID" name="P_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="B_ID">Barangay</label>
                                <select class="form-control" id="B_ID" name="B_ID" required>
                                    <option value='' disabled selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: right;">
                            <div class="btn-group">
                                @if (Auth::user()->User_Type_ID == 1)
                                <div style="padding: 2px;"><a href="{{ url('barangay_business_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            
                                            <th >Business Name</th>
                                            <th >Business Type</th>
                                            <th >Business Tin</th>
                                            <th >Business Owner</th>
                                            <th >Business Address</th>
                                            <th >Mobile No</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            
                                            <td class="sm_data_col txtCtr" >{{$x->Business_Name}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Business_Type}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Business_Tin}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Business_Owner}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Business_Address}}</td>  
                                            <td class="sm_data_col txtCtr" >{{$x->Mobile_No}}</td>
                                            <td class="sm_data_col txtCtr">
                                            @if (Auth::user()->User_Type_ID == 1)
                                                <a class="btn btn-success" href="{{ url('barangay_business_details/'.$x->Business_ID) }}">Edit</a>
                                                <a class="btn btn-success" href="{{ url('view_barangay_business_details/'.$x->Business_ID) }}">View</a>
                                            @endif
                                            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
                                                <a class="btn btn-success" href="{{ url('barangay_business_details/'.$x->Business_ID) }}">View</a>
                                            @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->



@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

    });
    $(document).on("change", "#R_ID", function() {

var Region_ID = $(this).val();

$.ajax({
type: "GET",
url: "/get_province/" + Region_ID,
fail: function() {
    alert("request failed");
},
success: function(data) {
    var data = JSON.parse(data);
    $('#P_ID').empty();
    $('#CM_ID').empty();
    $('#B_ID').empty();

    var option1 =
        " <option value='' disabled selected>Select Option</option>";
    $('#P_ID').append(option1);
    $('#CM_ID').append(option1);
    $('#B_ID').append(option1);

    data.forEach(element => {
        var option = " <option value='" +
            element["Province_ID"] +
            "'>" +
            element["Province_Name"] +
            "</option>";
        $('#P_ID').append(option);
    });
}
});
});

$(document).on("change", "#P_ID", function() {
var Province_ID = $(this).val();

$.ajax({
    type: "GET",
    url: "/get_city/" + Province_ID,
    fail: function() {
        alert("request failed");
    },
    success: function(data) {
        var data = JSON.parse(data);
        $('#CM_ID').empty();
        $('#B_ID').empty();

        var option1 =
            " <option value='' disabled selected>Select Option</option>";
        $('#CM_ID').append(option1);
        $('#B_ID').append(option1);

        data.forEach(element => {
            var option = " <option value='" +
                element["City_Municipality_ID"] +
                "'>" +
                element["City_Municipality_Name"] +
                "</option>";
            $('#CM_ID').append(option);
        });
    }
});
});

$(document).on("change", "#CM_ID", function() {
var City_Municipality_ID = $(this).val();

$.ajax({
    type: "GET",
    url: "/get_barangay/" + City_Municipality_ID,
    fail: function() {
        alert("request failed");
    },
    success: function(data) {
        var data = JSON.parse(data);

        $('#B_ID').empty();

        var option1 =
            " <option value='' disabled selected>Select Option</option>";
        $('#B_ID').append(option1);

        data.forEach(element => {
            
            var option = " <option value='" +
                element["Barangay_ID"] +
                "'>" +
                element["Barangay_Name"] +
                "</option>";
            $('#B_ID').append(option);
        });
    }
});
});


$(document).on("change", "#B_ID", function() {
var Barangay_ID = $(this).val();

$.ajax({
    type: "GET",
    url: "/get_brgy_business_list/" + Barangay_ID,
    fail: function() {
        alert("request failed");
    },
    success: function(data) {
        var data = JSON.parse(data);

        $('#example').dataTable().fnClearTable();
        $('#example').dataTable().fnDraw();
        $('#example').dataTable().fnDestroy();

        data.forEach(element => {
            
            $('#example').DataTable().row.add([
                element["Business_Name"],
                element["Business_Type"],
                element["Business_Tin"],
                element["Business_Owner"],
                element["Business_Address"],
                element["Mobile_No"],
                "<a class='btn btn-success' href='barangay_business_details/" + element["Business_ID"] + "'>View</a>",
            ]).draw();
        });
    }
});
});
    
</script>

<style>
 

   
</style>

@endsection