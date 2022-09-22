@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Proceeding Details </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Proceeding Details</li>
        </ol>
    </div>
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
    <div class="col-md-12">
        <form id="newHousehold" method="POST" action="{{ route('create_proceeding') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="number" class="form-control" id="Summons_ID" name="Summons_ID" value="0" hidden>
                <div class="row">
                    <div class="form-group col-lg-6" style="padding:0 10px">
                        <label for="exampleInputEmail1">Blotter Number</label>
                        <br>
                        <select id="Blotter_ID" class="form-control  js-example-basic-single mySelect2" name="Blotter_ID" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($blotter as $bs)
                            <option value="{{ $bs->Blotter_ID }}">{{ $bs->Blotter_Number }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="row">
                    <a onclick="addrow();" style="float: right; cursor:pointer; margin-right:10px">+ Add</a>
                    <br>
                    <div class="form-group col-lg-12" style="padding:0 10px; overflow-x:auto;" id="CaseDetails">

                        <table id="CaseTBL" class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Proceeding Status</th>
                                    <th>Type of Action</th>
                                    <th>Proceeding Date</th>
                                    <th>Settlement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="CSBody">
                                <tr class="CSDetails">
                                    <td>
                                        <select class="form-control" name="Proceedings_Status_ID[]" style="width: 250px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($proceeding_status as $ps)
                                            <option value="{{ $ps->Proceedings_Status_ID }}">{{ $ps->Type_of_Action }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="Type_of_Action_ID[]" style="width: 250px;">
                                            <option value='' disabled selected>Select Option</option>
                                            @foreach($type_of_action as $ta)
                                            <option value="{{ $ta->Type_of_Action_ID }}">{{ $ta->Type_of_Action }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="datetime-local" class="form-control" style="width: 250px;" name="Proceedings_Date[]">
                                    </td>
                                    <td>
                                        <textarea class="form-control" style="width: 400px;" name="Settlement[]"></textarea>
                                    </td>
                                    <td style="text-align: center; width:10%">
                                        <button type="button" class="btn btn-danger CSRemove">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="col-lg-12" style="margin-bottom: 100px;">
                <center>
                    <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary" style="width: 200px;">Create</button>
                </center>
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

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });

    function addrow() {
        var row = $("#CaseTBL tr:last");

        row.find(".js-example-basic-single").each(function(index) {
            $(this).select2('destroy');
        });

        var newrow = row.clone();

        $("#CaseTBL").append(newrow);

        $("select.js-example-basic-single").select2();


    }

    // Option Case Remove
    $(".CSBody").on("click", ".CSRemove", function() {
        $(this).closest(".CSDetails").remove();
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