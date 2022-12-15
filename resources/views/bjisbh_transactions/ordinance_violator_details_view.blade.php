@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ordinance Violator Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('ordinance_violator_list')}}">Ordinance Violator List</a></li>
                        <li class="breadcrumb-item active">Ordinance Violator Details</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <br>
                            <div class="col-md-12">
                                <form id="newForm" method="POST" action="{{ route('create_ordinance_violator') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="number" class="form-control" id="Ordinance_Violators_ID" name="Ordinance_Violators_ID" value="{{$violator[0]->Ordinance_Violators_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Name</label>
                                                <br>
                                                <select class="form-control js-example-basic-single Resident_Select2 mySelect2" name="Resident_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($resident as $rs)
                                                    <option value="{{ $rs->Resident_ID }}" {{ $rs->Resident_ID  == $violator[0]->Resident_ID  ? "selected" : "" }}>{{ $rs->Last_Name }}, {{ $rs->First_Name }} {{ $rs->Middle_Name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Ordinance</label>
                                                <br>
                                                <select id="Ordinance_ID" class="form-control" name="Ordinance_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($ordinance as $bs)
                                                    <option value="{{ $bs->Ordinance_Resolution_ID }}" {{ $bs->Ordinance_Resolution_ID  == $violator[0]->Ordinance_ID  ? "selected" : "" }}>{{ $bs->Ordinance_Resolution_Title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Penalty</label>
                                                <br>
                                                <select id="Types_of_Penalties_ID" class="form-control" name="Types_of_Penalties_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($penalties as $pt)
                                                    <option value="{{ $pt->Types_of_Penalties_ID }}" {{ $pt->Types_of_Penalties_ID  == $violator[0]->Types_of_Penalties_ID  ? "selected" : "" }}>{{ $pt->Type_of_Penalties }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Violation Status</label>
                                                <br>
                                                <select id="Violation_Status_ID" class="form-control" name="Violation_Status_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($violation_status as $vs)
                                                    <option value="{{ $vs->Violation_Status_ID }}" {{ $vs->Violation_Status_ID  == $violator[0]->Violation_Status_ID  ? "selected" : "" }}>{{ $vs->Violation_Status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Violation Date</label>
                                                <input type="datetime-local" class="form-control" id="Vilotation_Date" name="Vilotation_Date" required value="{{$violator[0]->Vilotation_Date}}">
                                            </div>
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Compiled Date</label>
                                                <input type="date" class="form-control" id="Complied_Date" name="Complied_Date" required value="{{$violator[0]->Complied_Date}}">
                                            </div>
                                        </div>
                                    </div>

                                </form>

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



<!-- Create Announcement_Status END -->

@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
        $("#newForm :input").prop("disabled", true);
    });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        // $(".Resident_Select2").select2({
        //     tags: true
        // });
    });

    
    // Disable Form if DILG USER
    $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3) {
            $("#newForm :input").prop("disabled", true);
        }
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.OrdinanceViolator').addClass('active');
        $('.justice_menu').addClass('active');
        $('.justice_main').addClass('menu-open');
    });
</script>

<style>
    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection