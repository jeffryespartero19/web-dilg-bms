@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Proceeding Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('proceeding_list')}}">Proceeding List</a></li>
                        <li class="breadcrumb-item active">Proceeding Details</li>
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
                                <form id="newForm" method="POST" action="{{ route('create_proceeding') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="number" class="form-control" id="Summons_ID" name="Summons_ID" value="{{$Blotter_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-6" style="padding:0 10px">
                                                <label for="exampleInputEmail1">Blotter Number</label>
                                                <br>
                                                <select id="Blotter_ID" class="form-control  js-example-basic-single mySelect2" name="Blotter_ID" style="width: 100%;">
                                                    <option value='' disabled selected>Select Option</option>
                                                    @foreach($blotter as $bs)
                                                    <option value="{{ $bs->Blotter_ID }}" {{ $bs->Blotter_ID == $Blotter_ID  ? "selected" : "" }}>{{ $bs->Blotter_Number }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <br>
                                            <div class="form-group col-lg-12 table-responsive" style="padding:0 10px;" id="CaseDetails">

                                                <table id="CaseTBL" class="table table-striped table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th>Proceeding Status</th>
                                                            <th>Type of Action</th>
                                                            <th>Proceeding Date</th>
                                                            <th>Settlement</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="CSBody">
                                                        @foreach ($proceeding as $proceedings)
                                                        <tr class="CSDetails">
                                                            <td hidden></td>
                                                            <td>
                                                                <select class="form-control" name="Proceedings_Status_ID[]" style="width: 250px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($proceeding_status as $ps)
                                                                    <option value="{{ $ps->Proceedings_Status_ID }}" {{ $ps->Proceedings_Status_ID == $proceedings->Proceedings_Status_ID  ? "selected" : "" }}>{{ $ps->Type_of_Action }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="Type_of_Action_ID[]" style="width: 250px;">
                                                                    <option value='' disabled selected>Select Option</option>
                                                                    @foreach($type_of_action as $ta)
                                                                    <option value="{{ $ta->Type_of_Action_ID }}" {{ $ta->Type_of_Action_ID == $proceedings->Type_of_Action_ID  ? "selected" : "" }}>{{ $ta->Type_of_Action }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="datetime-local" class="form-control" style="width: 250px;" name="Proceedings_Date[]" value="{{$proceedings->Proceedings_Date}}">
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" style="width: 400px;" name="Settlement[]">{{$proceedings->Settlement}}</textarea>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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

        $(".Resident_Select2").select2({
            tags: true
        });
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
        $('.Proceedings').addClass('active');
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