@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <div class="col-md-6 titleXZ"> Barangay Information </div>
    <div class="col-md-6 breadcrumbXZ">
        <ol class="breadcrumb">
            <a href="{{route('home')}}">
                <li>DILG_BMS / </li>
            </a>
            <li> &nbsp;Barangay Information</li>
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
        <form id="newHousehold" method="POST" action="{{ route('create_blotter') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card listDIV">
                <div class="row" style="margin-bottom: 20px;">
                    <div style="float: right;">
                        <button class="btn btn-success" type="button" id="AddLABEL"><i class="fa fa-plus" aria-hidden="true"></i> ADD LABEL</button>
                    </div>
                </div>

                <div class="card-body LabelDIV" style="margin-bottom: 30px;">
                    
                        <div class="container" style="background-color: #5bc0de; width: 100%; padding: 10px 15px">
                        <a href="#" class="BTNCollapse"><span style="font-size: 18px; color:white; font-weight:bold">Label</span></a>
                            <div style="float: right;">
                                <button class="btn btn-default AddIndicator" type="button"><i class="fa fa-plus" aria-hidden="true"></i> ADD INDICATOR</button>
                                <button class="btn btn-danger LabelRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
                            </div>
                        </div>
                    

                    <div class="container row LblData collapse" style="background-color: white; margin: 0px; width:100%; padding:20px">
                        <div class="form-group col-lg-12">
                            <label>Title</label>
                            <input type="text" class="form-control" name="Title" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Visible</label>
                            <input type="text" class="form-control" name="Visible" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Min Indicator</label>
                            <input type="number" class="form-control" name="Min Indicator" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Max Indicator</label>
                            <input type="number" class="form-control" name="Max Indicator" placeholder="Email">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Instructions</label>
                            <textarea class="form-control" name="Instructions"></textarea>
                        </div>

                        <div class="card-body IndicatorDIV col-lg-12" style="margin-bottom: 5px;">
                            <hr>
                            <div class="container" style="background-color: gray; width: 100%; padding: 10px 15px">
                                <span style="font-size: 18px; color:white; font-weight:bold">Label</span>
                                <div style="float: right;">
                                    <button class="btn btn-danger IndicatorRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
                                </div>
                            </div>
                            <div class="container row" style="background-color: white; margin: 0px; width:100%; padding:20px">
                                <div class="form-group col-lg-12">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="Title" placeholder="Email">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Visible</label>
                                    <input type="text" class="form-control" name="Visible" placeholder="Email">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Min Indicator</label>
                                    <input type="number" class="form-control" name="Min Indicator" placeholder="Email">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Max Indicator</label>
                                    <input type="number" class="form-control" name="Max Indicator" placeholder="Email">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Instructions</label>
                                    <textarea class="form-control" name="Instructions"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
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
    // $(document).ready(function() {
    //     $('#example').DataTable();
    // });

    //Select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });

    $(document).on("click", ".LabelRemove", function() {
        $(this).closest(".LabelDIV").remove();
    });

    $(document).on("click", ".IndicatorRemove", function() {
        $(this).closest(".IndicatorDIV").remove();
    });

    $(document).ready(function() {
        $("#AddLABEL").click(function() {
            var div = $(".LabelDIV:last");
            var newdiv = div.clone();

            $(".listDIV").append(newdiv);
        });
    });

    $(document).on("click", ".AddIndicator", function() {
        var div_main = $(this).closest(".LabelDIV");
        var div_child = div_main.find(".IndicatorDIV:last")
        var newdiv = div_child.clone();
        div_main.find(".LblData").append(newdiv);
    });

    $(document).on("click", ".BTNCollapse", function() {
        var div_main = $(this).closest(".LabelDIV");
        var collapse = div_main.find(".collapse");

        if (collapse.hasClass("in")) {
            collapse.removeClass('in');
        } else {
            collapse.addClass('in');
        }
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