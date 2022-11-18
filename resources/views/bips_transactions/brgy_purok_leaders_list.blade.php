@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brgy. Purok Leader List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Brgy. Purok Leader List</li>
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

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if (Auth::user()->User_Type_ID == 3)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <div class="form-group col-lg-6">
                                <label for="CM_ID">City/Municipality</label>
                                <select class="form-control" id="CM_ID" name="CM_ID" required>
                                    <option value='' disabled selected>Select Option</option>

                                    @foreach($city1 as $city_municipality)
                                    <option value="{{ $city_municipality->City_Municipality_ID }}">{{ $city_municipality->City_Municipality_Name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-lg-6">
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
                                <div style="padding: 2px;"><button data-toggle="modal" class="btn btn-success" data-target="#createBrgy_Purok_Leader" style="width: 100px;">New</button></div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="col-md-12 table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Term From</th>
                                            <th>Term To</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($db_entries as $x)
                                        <tr>
                                            <td class="sm_data_col txtCtr">{{$x->Last_Name}} {{$x->First_Name}}, {{$x->Middle_Name}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Term_From}}</td>
                                            <td class="sm_data_col txtCtr">{{$x->Term_To}}</td>
                                            <td class="sm_data_col txtCtr">
                                                <button class="edit_brgy_purok_leader" value="{{$x->Brgy_Purok_Leader_ID}}" data-toggle="modal" data-target="#Update_Brgy_Purok_Leader">Edit</button>
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

<!-- Create Announcement_Status Modal  -->

<div class="modal fade" id="createBrgy_Purok_Leader" role="dialog" aria-labelledby="Create_Inhabitant" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Create Brgy. Purok_Leader</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newInhabitant" method="POST" action="{{ route('create_brgy_purok_leader') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_ID">Name</label>
                                <select class="form-control js-example-basic-single" id="Resident_IDs" name="Resident_IDs">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Term_From">Term From</label>
                                <input class="form-control" type="number" id="Term_From" name="Term_From" max="3000" min="1900">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Term_To">Term To</label>
                                <input class="form-control" type="number" id="Term_To" name="Term_To" max="3000" min="1900">
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Create Announcement_Status END -->




<div class="modal fade" id="Update_Brgy_Purok_Leader" role="dialog" aria-labelledby="Update_Brgy_Purok_Leader" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title flexer justifier">Edit Brgy. Official</h4>
                <button type="button" class="close modal-close" data-dismiss="modal">&times;</button>
            </div>
            <form id="newBrgy_Official" method="POST" action="{{ route('update_brgy_purok_leader') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <h3>Resident Information</h3>
                        <br>
                        <div class="row">
                            <input type="text" class="form-control" id="Brgy_Purok_Leader_ID" name="Brgy_Purok_Leader_ID" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Resident_IDs2">Name</label>
                                <select class="form-control js-example-basic-single" id="Resident_IDs2" name="Resident_IDs2">
                                    <option value='' disabled selected>Select Option</option>
                                    @foreach($name as $bt)
                                    <option value="{{ $bt->Resident_ID }}">{{ $bt->Last_Name }} {{ $bt->First_Name }}, {{ $bt->Middle_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Term_From2">Term From</label>
                                <input class="form-control" type="number" id="Term_From2" name="Term_From2" max="3000" min="1900">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Term_To2">Term To</label>
                                <input class="form-control" type="number" id="Term_To2" name="Term_To2" max="3000" min="1900">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    });

    $(document).on('click', '.modal-close', function(e) {
        $('#newInhabitant').trigger("reset");
    });




    // Edit Button Display Modal
    $(document).on('click', ('.edit_brgy_purok_leader'), function(e) {

        var disID = $(this).val();

        // alert(disID);
        $.ajax({
            url: "/get_brgy_purok_leader",
            type: 'GET',
            data: {
                id: disID
            },
            fail: function() {
                alert('request failed');
            },
            success: function(data) {

                // alert(data);
                // alert(data['theEntry'][0]['Term_From']);
                $('#Brgy_Purok_Leader_ID').val(data['theEntry'][0]['Brgy_Purok_Leader_ID']);
                $('#Resident_IDs2').val(data['theEntry'][0]['Resident_ID']);
                $('#Resident_IDs2').val(data['theEntry'][0]['Resident_ID']).trigger('change');
                $('#Term_From2').val(data['theEntry'][0]['Term_From']);
                $('#Term_To2').val(data['theEntry'][0]['Term_To']);
            }
        });


    });

    $(document).on("change", "#CM_ID", function() {

        // var City_Municipality_ID = $(this).val();
        var City_Municipality_ID = '01';

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

    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newBrgy_Official :input").prop("disabled", true);
        }
    });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    $('#updateBrgy_Official').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    })
</script>


@endsection