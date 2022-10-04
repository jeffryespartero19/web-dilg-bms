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

        <div class="card listDIV">

            <div class="row" style="margin-bottom: 20px;">
                <div style="float: right;">
                    <button class="btn btn-success" type="button" id="AddLABEL"><i class="fa fa-plus" aria-hidden="true"></i> ADD LABEL</button>
                </div>
            </div>
            @foreach ($title as $titles)
            <div class="card-body LabelDIV" style="margin-bottom: 30px;">
                <form method="POST" action="{{ route('create_cms_title') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="CMS_Barangay_Profile_ID" hidden value="{{$id}}">
                    <input type="text" name="Categories_ID" hidden value="{{$cat_id}}">
                    <div class="container" style="background-color: #5bc0de; width: 100%; padding: 10px 15px">
                        <a href="#" class="BTNCollapse"><span style="font-size: 18px; color:white; font-weight:bold">Title: {{$titles->Title}}</span></a>
                        <div style="float: right;">
                            <button class="btn btn-default AddIndicator" type="button"><i class="fa fa-plus" aria-hidden="true"></i> ADD INDICATOR</button>
                            <button class="btn btn-success" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                            <button class="btn btn-danger LabelRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
                        </div>
                    </div>
                    <div class="container row LblData collapse" style="background-color: white; margin: 0px; width:100%; padding:20px">
                        <input type="text" name="Title_ID[]" hidden value="{{$titles->Title_ID}}">
                        <div class="form-group col-lg-6">
                            <label>Title</label>
                            <input type="text" class="form-control" name="Title[]" value="{{$titles->Title}}" required>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>Visible</label>
                            <select class="form-control" name="Visible[]" required>
                                <option value=1 selected>Yes</option>
                                <option value=0>No</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-2">
                            <label>Min Indicator</label>
                            <input type="number" class="form-control Min_Indicator" name="Min_Indicator[]" value="{{$titles->Min_Indicator}}">
                        </div>
                        <div class="form-group col-lg-2">
                            <label>Max Indicator</label>
                            <input type="number" class="form-control Max_Indicator" name="Max_Indicator[]" value="{{$titles->Max_Indicator}}">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Instructions</label>
                            <textarea class="form-control" name="Instructions[]">{{$titles->Instructions}}</textarea>
                        </div>

                        @foreach ($indicator as $indicators)
                        @if($indicators->Title_ID == $titles->Title_ID && $indicators->Title_ID != null)
                        <div class="card-body IndicatorDIV col-lg-12" style="margin-bottom: 5px;">
                            <div class="container" style="background-color: gray; width: 100%; padding: 10px 15px">
                                <span style="font-size: 18px; color:white; font-weight:bold">Indicator</span>
                                <div style="float: right;">
                                    <button class="btn btn-danger IndicatorRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
                                </div>
                            </div>
                            <input class="Indicator_ID" type="text" hidden name="Indicator_ID[]" value="{{$indicators->Indicator_ID}}">
                            <div class="container row" style="background-color: white; margin: 0px; width:100%; padding:20px">
                                <div class="form-group col-lg-12">
                                    <label>Description</label>
                                    <textarea class="form-control" name="Indicator_Description[]">{{$indicators->Indicator_Description}}</textarea>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Answer Type</label>
                                    <select class="form-control answer_types" name="Answer_Types_ID[]" style="width: 100%;">
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($answer_type as $at)
                                        <option value="{{ $at->Answer_Type_ID }}" {{ $at->Answer_Type_ID  == $indicators->Answer_Types_ID  ? "selected" : "" }}>{{ $at->Title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Min. Answer</label>
                                    <input type="number" class="form-control" name="Min_Answer[]" value="{{$indicators->Min_Answer}}">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Max Answer</label>
                                    <input type="number" class="form-control" name="Max_Answer[]" value="{{$indicators->Max_Answer}}">
                                </div>
                                <div class="form-group col-lg-12">
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#ADD_AT_modal"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW ANSWER TYPE</button>
                                    <button class="btn btn-warning ADD_OPTIONS_modal" type="button" data-toggle="modal" data-target="#ADD_OPTIONS_modal" @if($indicators->Widget == 'RADIO' || $indicators->Widget == 'SELECT' || $indicators->Widget == 'CHECKBOX') @else hidden @endif><i class="fa fa-plus" aria-hidden="true"></i> ADD OPTIONS</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </form>
            </div>
            @endforeach
        </div>


    </div>
</div>

<div class="modal fade" id="ADD_AT_modal" tabindex="-1" role="dialog" aria-labelledby="ADD_AT_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ADD_AT_modalLabel">Add Choices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ADD_AT" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="Title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" name="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="Description" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Widget" class="col-form-label">Widget:</label>
                        <select class="form-control" name="Widget" required>
                            <option value='' disabled selected>Select Option</option>
                            <option value='RADIO'>RADIO</option>
                            <option value='CHECKBOX'>CHECKBOX</option>
                            <option value='TEXTBOX'>TEXTBOX</option>
                            <option value='TEXTAREA'>TEXTAREA</option>
                            <option value='SELECT'>SELECT</option>
                            <option value='DATEPICKER'>DATEPICKER</option>
                            <option value='DATETIMEPICKER'>DATETIMEPICKER</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="Data_Type  " class="col-form-label">Data Type:</label>
                        <select class="form-control" name="Data_Type" required>
                            <option value='' disabled selected>Select Option</option>
                            <option value='STRING'>STRING</option>
                            <option value='NUMERIC'>NUMERIC</option>
                            <option value='DECIMAL'>DECIMAL</option>
                            <option value='DATE'>DATE</option>
                            <option value='DATETIME'>DATETIME</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="Active" class="col-form-label">Active:</label>
                        <select class="form-control" name="Active" required>
                            <option value=1 selected>Yes</option>
                            <option value=0>No</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Indicator Clone DIV -->
<div class="card-body IndicatorDIV IndicatorDIVhidden col-lg-12" style="margin-bottom: 5px;" hidden>
    <div class="container" style="background-color: gray; width: 100%; padding: 10px 15px">
        <span style="font-size: 18px; color:white; font-weight:bold">Indicator</span>
        <div style="float: right;">
            <button class="btn btn-danger IndicatorRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
        </div>
    </div>
    <input type="text" hidden name="Indicator_ID[]">
    <div class="container row" style="background-color: white; margin: 0px; width:100%; padding:20px">
        <div class="form-group col-lg-12">
            <label>Description</label>
            <textarea class="form-control" name="Indicator_Description[]"></textarea>
        </div>
        <div class="form-group col-lg-4">
            <label>Answer Type</label>
            <select class="form-control answer_types" name="Answer_Types_ID[]" style="width: 100%;">
                <option value='' disabled selected>Select Option</option>
                @foreach($answer_type as $at)
                <option value="{{ $at->Answer_Type_ID }}">{{ $at->Title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label>Min. Answer</label>
            <input type="number" class="form-control" name="Min_Answer[]">
        </div>
        <div class="form-group col-lg-4">
            <label>Max Answer</label>
            <input type="number" class="form-control" name="Max_Answer[]">
        </div>
        <div class="form-group col-lg-12">
            <button class="btn btn-success" type="button" id="AddLABEL" data-toggle="modal" data-target="#ADD_AT_modal"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW ANSWER TYPE</button>
        </div>
    </div>
</div>


<!-- Label Clone DIV -->
<div class="card-body LabelDIV LabelDIVhidden" style="margin-bottom: 30px;" hidden>
    <form method="POST" action="{{ route('create_cms_title') }}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="text" name="CMS_Barangay_Profile_ID" hidden value="{{$id}}">
        <input type="text" name="Categories_ID" hidden value="{{$cat_id}}">
        <div class="container" style="background-color: #5bc0de; width: 100%; padding: 10px 15px">
            <a href="#" class="BTNCollapse"><span style="font-size: 18px; color:white; font-weight:bold">Title:</span></a>
            <div style="float: right;">
                <button class="btn btn-default AddIndicator" type="button"><i class="fa fa-plus" aria-hidden="true"></i> ADD INDICATOR</button>
                <button class="btn btn-success" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                <button class="btn btn-danger LabelRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
            </div>
        </div>
        <div class="container row LblData collapse" style="background-color: white; margin: 0px; width:100%; padding:20px">
            <input type="text" name="Title_ID[]" hidden>
            <div class="form-group col-lg-6">
                <label>Title</label>
                <input type="text" class="form-control" name="Title[]" required>
            </div>
            <div class="form-group col-lg-2">
                <label>Visible</label>
                <select class="form-control" name="Visible[]" required>
                    <option value=1 selected>Yes</option>
                    <option value=0>No</option>
                </select>
            </div>
            <div class="form-group col-lg-2">
                <label>Min Indicator</label>
                <input type="number" class="form-control Min_Indicator" name="Min_Indicator[]">
            </div>
            <div class="form-group col-lg-2">
                <label>Max Indicator</label>
                <input type="number" class="form-control Max_Indicator" name="Max_Indicator[]">
            </div>
            <div class="form-group col-lg-12">
                <label>Instructions</label>
                <textarea class="form-control" name="Instructions[]"></textarea>
            </div>

            <div class="card-body IndicatorDIV col-lg-12" style="margin-bottom: 5px;">
                <div class="container" style="background-color: gray; width: 100%; padding: 10px 15px">
                    <span style="font-size: 18px; color:white; font-weight:bold">Indicator</span>
                    <div style="float: right;">
                        <button class="btn btn-danger IndicatorRemove" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> DELETE</button>
                    </div>
                </div>
                <input type="text" hidden name="Indicator_ID[]">
                <div class="container row" style="background-color: white; margin: 0px; width:100%; padding:20px">
                    <div class="form-group col-lg-12">
                        <label>Description</label>
                        <textarea class="form-control" name="Indicator_Description[]"></textarea>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Answer Type</label>
                        <select class="form-control answer_types" name="Answer_Types_ID[]" style="width: 100%;">
                            <option value='' disabled selected>Select Option</option>
                            @foreach($answer_type as $at)
                            <option value="{{ $at->Answer_Type_ID }}">{{ $at->Title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Min. Answer</label>
                        <input type="number" class="form-control" name="Min_Answer[]">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Max Answer</label>
                        <input type="number" class="form-control" name="Max_Answer[]">
                    </div>
                    <div class="form-group col-lg-12">
                        <button class="btn btn-success" type="button" id="AddLABEL" data-toggle="modal" data-target="#ADD_AT_modal"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW ANSWER TYPE</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="ADD_OPTIONS_modal" tabindex="-1" role="dialog" aria-labelledby="ADD_OPTIONS_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ADD_Option" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="number" name="modal_Indicator_ID" id="modal_Indicator_ID" hidden>
                    <div class="form-group">
                        <button class="btn btn-success" type="button" id="AddOption"><i class="fa fa-plus" aria-hidden="true"></i> ADD OPTION</button>
                    </div>
                    <div class="Answer_list">
                        <div class="form-group Answers">
                            <label for="Answer" class="col-form-label">Option:</label>
                            <input type="text" class="form-control" name="Answer_Classification_ID[]" hidden>
                            <input type="text" class="form-control" name="Answer[]" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Clone Answers -->
<div class="form-group Answers Answers_hidden" hidden>
    <label for="Answer" class="col-form-label">Option:</label>
    <input type="text" class="form-control" name="Answer_Classification_ID[]" hidden>
    <input type="text" class="form-control" name="Answer[]" required>
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
            var div = $(".LabelDIVhidden");
            var newdiv = div.clone();

            $(".listDIV").append(newdiv);
            $(".listDIV .LabelDIV:last").prop('hidden', false).removeClass('LabelDIVhidden');
        });
    });

    $(document).on("click", ".AddIndicator", function() {
        var div_main = $(this).closest(".LabelDIV");

        var min = div_main.find('.LblData .Min_Indicator').val();
        var max = div_main.find('.LblData .Max_Indicator').val();
        var ind_count = div_main.find('.LblData .IndicatorDIV').length;

        if (max > ind_count) {
            var div_child = $(".IndicatorDIVhidden");
            var newdiv = div_child.clone();
            div_main.find(".LblData").append(newdiv);
            div_main.find('.IndicatorDIVhidden').prop('hidden', false).removeClass('IndicatorDIVhidden')
        } else {
            Swal.fire(
                'Warning',
                'Max indicator count reached',
                'warning'
            )
        }

        // alert(ind_count);

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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#ADD_AT').submit(
        function(e) {
            $.ajax({
                url: '{!! url("create_answer_type") !!}',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(result) {
                    $('#ADD_AT_modal').modal('hide');
                    $('#ADD_AT').trigger('reset');

                    $.ajax({
                        type: "GET",
                        url: "/get_answer_types/",
                        fail: function() {
                            alert("request failed");
                        },
                        success: function(data) {
                            var data = JSON.parse(data);

                            var option = " <option value='" +
                                data["Answer_Type_ID"] +
                                "'>" +
                                data["Title"] +
                                "</option>";
                            $('.answer_types').append(option);

                            Swal.fire(
                                'Saved!',
                                'New Answer Type Added',
                                'success'
                            )
                        }
                    });
                    return false;
                }
            });
            e.preventDefault();
        }
    );


    $('#ADD_Option').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: '/create_indicator_options',
            data: $(this).serialize(),
            success: function(msg) {
                $('#ADD_OPTIONS_modal').modal('hide');
                $('#ADD_Option').trigger('reset');
                Swal.fire(
                    'Saved!',
                    'New Option Added',
                    'success'
                )
                return false;
            }
        });
    });

    $(document).on("change", ".answer_types", function() {
        $id = $(this).val();
        var div_main = $(this).closest(".IndicatorDIV");

        $.ajax({
            type: "GET",
            url: "/get_answer_types_list/" + $id,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                // alert(data["Widget"]);
                if (data["Widget"] == 'RADIO' || data["Widget"] == 'SELECT' || data["Widget"] == 'CHECKBOX') {
                    div_main.find(".ADD_OPTIONS_modal").prop('hidden', false);
                } else {
                    div_main.find(".ADD_OPTIONS_modal").prop('hidden', true);
                }
            }
        });
    });

    $(document).on("click", ".ADD_OPTIONS_modal", function() {
        var div_main = $(this).closest(".IndicatorDIV");
        var Indicator_ID = div_main.find(".Indicator_ID").val();
        $('#modal_Indicator_ID').val(Indicator_ID);

        $.ajax({
            type: "GET",
            url: "/get_answer_classification/" + Indicator_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('.Answer_list').empty();
                data.forEach(element => {
                    var option = '<div class="form-group Answers">' +
                        '<label for="Answer" class="col-form-label">Option:</label>' +
                        '<input type="text" class="form-control" name="Answer_Classification_ID[]" hidden value="' + element['Answer_Classification_ID'] + '">' +
                        '<input type="text" class="form-control" name="Answer[]" required value="' + element['Answer'] + '">' +
                        '</div>';
                    $('.Answer_list').append(option);
                });
            }
        });
    });

    $(document).on("click", "#AddOption", function() {
        var div_main = $('.Answer_list');
        var div_child = $(".Answers_hidden");
        var newdiv = div_child.clone();
        div_main.append(newdiv);
        div_main.find('.Answers_hidden').prop('hidden', false).removeClass('Answers_hidden')
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