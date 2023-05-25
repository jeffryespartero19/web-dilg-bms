@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barangay Projects Monitoring List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BPMS</a></li>
                        <li class="breadcrumb-item active">Barangay Projects Monitoring List</li>
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
            @if (Auth::user()->User_Type_ID == 3 || Auth::user()->User_Type_ID == 4)
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
                                <div style="padding: 2px;"><a href="{{ url('brgy_project_monitoring_details/0') }}" class="btn btn-success" style="width: 100px;">New</a></div>
                                <!-- <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('view_Project') }}" target="_blank" class="btn btn-warning" style="width: 100px;">Print</a></div>
                                <div class="txtRight" style="margin-left: 5px;"><a href="{{ url('print_Project') }}" target="_blank" class="btn btn-info" style="width: 100px;">Download</a></div> -->
                                @endif
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-warning" data-target="#print_filter" style="width: 100px;">Export</button></div>
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-info" data-target="#download_filter" style="width: 100px;">Download</button></div>
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <div>
                                    <table id="example11" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Project Number</th>
                                                <th>Project Name</th>
                                                <th>Total Project Cost</th>
                                                <th>Exact Location</th>
                                                <th>Actual Project Start</th>
                                                <th>Contractor Name</th>
                                                <th>Project Type</th>
                                                <th>Project Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter3" style="min-width: 300px;" type="number"></td>
                                                <td><input class="form-control searchFilter searchFilter4" style="min-width: 300px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter5" style="min-width: 300px;" type="date"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter6" id="Contractor_ID" name="Contractor_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter7" id="Project_Type_ID" name="Project_Type_ID" style="min-width: 200px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter8" id="Project_Status_ID" name="Project_Status_ID" style="min-width: 200px;">
                                                    </select>
                                                </td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bpms_transactions.brgy_projects_monitoring_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                                </div>
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


<div class="modal fade" id="download_filter" tabindex="-1" role="dialog" aria-labelledby="Create_BrgyBusinessPermit" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="download_report" method="POST" action="{{ route('promon_downloadPDF') }}" autocomplete="off" enctype="multipart/form-data">
            <!-- <form id="download_report" method="POST"  autocomplete="off" enctype="multipart/form-data"> -->
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-4" style="padding:0 0px">
                                <input type="checkbox" id="chk_Project_Number" name="chk_Project_Number">
                                <label for="chk_Project_Number">Project Number</label><br>
                                <input type="checkbox" id="chk_Project_Name" name="chk_Project_Name">
                                <label for="chk_Project_Name">Project Name</label><br>
                                <input type="checkbox" id="chk_Total_Project_Cost" name="chk_Total_Project_Cost">
                                <label for="chk_Total_Project_Cost">Total Project Cost</label><br>
                                <input type="checkbox" id="chk_Exact_Location" name="chk_Exact_Location">
                                <label for="chk_Exact_Location">Exact Location</label><br>
                                <input type="checkbox" id="chk_Actual_Project_Start" name="chk_Actual_Project_Start">
                                <label for="chk_Actual_Project_Start">Actual Project Start</label><br>
                                <input type="checkbox" id="chk_Contractor_Name" name="chk_Contractor_Name">
                                <label for="chk_Contractor_Name">Contractor Name</label><br>
                                <input type="checkbox" id="chk_Project_Type_Name" name="chk_Project_Type_Name">
                                <label for="chk_Project_Type_Name">Project Type Name</label><br>
                                <input type="checkbox" id="chk_Project_Status_Name" name="chk_Project_Status_Name">
                                <label for="chk_Project_Status_Name">Project Status Name</label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary postThis_Inhabitant_Info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="print_filter" tabindex="-1" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier" id="Modal_Title">Filter</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="print_report" method="GET" action="{{ route('projectmonitoring_export') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="checkbox" id="SelectAll" name="SelectAll">
                                <label for="SelectAll">Select All</label><br>
                            </div>  
                            <div class="form-group col-lg-12" style="padding:0 10px">
                                <input type="checkbox" class="ChkBOX1" id="chk_Project_Number" name="chk_Project_Number">
                                <label for="chk_Project_Number">Project Number</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Project_Name" name="chk_Project_Name">
                                <label for="chk_Project_Name">Project Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Total_Project_Cost" name="chk_Total_Project_Cost">
                                <label for="chk_Total_Project_Cost">Project Cost</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Exact_Location" name="chk_Exact_Location">
                                <label for="chk_Exact_Location">Exact Location</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Actual_Project_Start" name="chk_Actual_Project_Start">
                                <label for="chk_Actual_Project_Start">Actual Project Start</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Contractor_Name" name="chk_Contractor_Name">
                                <label for="chk_Contractor_Name">Contractor Name</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Project_Type_Name" name="chk_Project_Type_Name">
                                <label for="chk_Project_Type_Name">Project Type</label><br>
                                <input type="checkbox" class="ChkBOX1" id="chk_Project_Status_Name" name="chk_Project_Status_Name">
                                <label for="chk_Project_Status_Name">Project Status</label><br>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>





@endsection

@section('scripts')

<script>
 

    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();

        $("#Contractor_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_contractor',
                dataType: "json",
            }
        });
        
        $("#Project_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_projecttype',
                dataType: "json",
            }
        });

        $("#Project_Status_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_projectstatus',
                dataType: "json",
            }
        });

    });

    // Disable Form if DILG USER
    $(document).ready(function() {
        alert(nativeNR);
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newBrgy_Projects_Monitoring :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.projectMonitoring').addClass('active');
        $('.project_menu').addClass('active');
        $('.project_main').addClass('menu-open');
    });

    // Delete Projects
    $(document).on('click', ('.delete_projects'), function(e) {
        var disID = $(this).val();

        Swal.fire({
            title: 'Are you sure you want to delete this brgy projects monitoring?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete_projects",
                    type: 'GET',
                    data: {
                        id: disID
                    },
                    fail: function() {
                        alert('request failed');
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Deleted',
                            text: "Brgy Projects Monitoring has been deleted.",
                            icon: 'success',
                            showConfirmButton: false,
                        });
                        location.reload();
                    }
                });

            }
        });
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
    url: "/get_project_monitoring_list/" + Barangay_ID,
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
                element["Project_Number"],
                element["Project_Name"],
                element["Total_Project_Cost"],
                element["Exact_Location"],
                element["Actual_Project_Start"],
                element["Contractor_Name"],
                element["Project_Type_Name"],
                element["Project_Status_Name"],
                "<a class='btn btn-success' href='brgy_project_monitoring_details/" + element["Brgy_Projects_ID"] + "'>View</a>",
            ]).draw();
        });
    }
});
});

$(document).on('click', '#SelectAll', function(e) {
        $('.ChkBOX1').prop('checked', this.checked);
    });

    $(".searchFilter").change(function() {
        Search();
        // alert('test');
        
    });

    function Search() {
        // alert('test');
       
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var param6 = $('.searchFilter6').val();
        var param7 = $('.searchFilter7').val();
        var param8 = $('.searchFilter8').val();
        var page = $('#hidden_page').val();

        $.ajax({
            url: "/search_projects_monitoring_fields?page=" + page + "& param1=" + param1 + "& param2=" + param2 + "& param3=" + param3 + "& param4=" + param4 + "& param5=" + param5 + "& param6=" + param6 + "& param7=" + param7 + "& param8=" + param8,
            // url: "/search_projects_monitoring_fields?page=" + page + "& param1=" + param1 + "& param2=" + param2,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });
    }
</script>



@endsection