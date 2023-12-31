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
    <div class="col-md-12">

        <div class="listDIV">

            @foreach ($title as $titles)
            @if($titles->Date_Start <= $currDATE && $titles->Date_End >= $currDATE)
                <div class="LabelDIV" style="margin-bottom: 30px;">
                    <form method="POST" action="{{ route('create_indicator_answer') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="CMS_Barangay_Profile_ID" hidden value="{{$id}}">
                        <input type="text" name="Categories_ID" hidden value="{{$cat_id}}">
                        <div class="card card-info collapsed-card">
                            <div class="card-header pc-view">
                                <h3 class="card-title" data-card-widget="collapse">Title: {{$titles->Title}}</h3>

                                <div class="card-tools">

                                    <button type="submit" class="btn btn-tool">
                                        <i class="fas fa-save"></i>&nbsp;Save
                                    </button>

                                </div>

                                <!-- /.card-tools -->
                            </div>
                            <div class="card-header mobile-view">
                                <h3 class="card-title">Title: {{$titles->Title}}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group col-lg-12">
                                    <label>Instructions</label>
                                    <textarea class="form-control" name="Instructions[]" disabled>{{$titles->Instructions}}</textarea>
                                </div>
                                @foreach ($indicator as $indicators)
                                @if($indicators->Title_ID == $titles->Title_ID && $indicators->Title_ID != null && $indicators->Sub_Indicator_ID == null)
                                <div style="padding: 0 20px; width:100%" class="INDetails">

                                    <input type="number" name="Indicator_ID[]" value="{{$indicators->Indicator_ID}}" hidden>
                                    <input type="number" class="Max_Answer" name="Max_Answer[]" value="{{$indicators->Max_Answer}}" hidden>
                                    <input type="number" class="Min_Answer" name="Min_Answer[]" value="{{$indicators->Min_Answer}}" hidden>
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%;">{{$indicators->Indicator_Description}}</td>
                                                <td style="width: 50%;">

                                                    @if($indicators->Widget == 'RADIO')
                                                    @foreach ($answer_classification as $ac)
                                                    @if($ac->Indicator_ID == $indicators->Indicator_ID)
                                                    <label>
                                                        <input type="radio" name="Answer[{{$indicators->Indicator_ID}}][]" value="{{$ac->Answer_Classification_ID}}">
                                                        {{$ac->Answer}}
                                                    </label>
                                                    <br>
                                                    @endif
                                                    @endforeach
                                                    @elseif($indicators->Widget == 'CHECKBOX')
                                                    @foreach ($answer_classification as $ac)
                                                    @if($ac->Indicator_ID == $indicators->Indicator_ID)
                                                    <label>
                                                        <input type="checkbox" class="Answer_CHK" value="{{$ac->Answer_Classification_ID}}" name="Answer[{{$indicators->Indicator_ID}}][]">
                                                        {{$ac->Answer}}
                                                    </label>
                                                    <br>
                                                    @endif
                                                    @endforeach
                                                    @elseif($indicators->Widget == 'TEXTBOX')
                                                    <input type="text" style="width: 100%;" name="Answer[{{$indicators->Indicator_ID}}][]">
                                                    @elseif($indicators->Widget == 'TEXTAREA')
                                                    <textarea rows="3" style="width: 100%;" name="Answer[{{$indicators->Indicator_ID}}][]"></textarea>
                                                    @elseif($indicators->Widget == 'SELECT')
                                                    <select class="form-control" name="Answer[{{$indicators->Indicator_ID}}][]" style="width: 100%;">
                                                        @foreach ($answer_classification as $ac)
                                                        @if($ac->Indicator_ID == $indicators->Indicator_ID)
                                                        <option value='{{$ac->Answer_Classification_ID}}'>{{$ac->Answer}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @elseif($indicators->Widget == 'DATEPICKER')
                                                    <input type="date" style="width: 100%;" name="Answer[{{$indicators->Indicator_ID}}][]">
                                                    @elseif($indicators->Widget == 'DATETIMEPICKER')
                                                    <input type="datetime-local" style="width: 100%;" name="Answer[{{$indicators->Indicator_ID}}][]">
                                                    @endif

                                                </td>
                                            </tr>
                                            @foreach ($indicator as $indicator2)
                                            @if($indicator2->Sub_Indicator_ID == $indicators->Indicator_ID && $indicator2->Title_ID == $titles->Title_ID && $indicator2->Title_ID != null)
                                            <tr>
                                                <td style="width: 50%;">{{$indicator2->Indicator_Description}}</td>
                                                <td style="width: 50%;">
                                                    @if($indicator2->Widget == 'RADIO')
                                                    @foreach ($answer_classification as $ac)
                                                    @if($ac->Indicator_ID == $indicator2->Indicator_ID)
                                                    <label>
                                                        <input type="radio" name="Answer[{{$indicator2->Indicator_ID}}][]" value="{{$ac->Answer_Classification_ID}}">
                                                        {{$ac->Answer}}
                                                    </label>
                                                    <br>
                                                    @endif
                                                    @endforeach
                                                    @elseif($indicator2->Widget == 'CHECKBOX')
                                                    @foreach ($answer_classification as $ac)
                                                    @if($ac->Indicator_ID == $indicator2->Indicator_ID)
                                                    <label>
                                                        <input type="checkbox" class="Answer_CHK" value="{{$ac->Answer_Classification_ID}}" name="Answer[{{$indicator2->Indicator_ID}}][]">
                                                        {{$ac->Answer}}
                                                    </label>
                                                    <br>
                                                    @endif
                                                    @endforeach
                                                    @elseif($indicator2->Widget == 'TEXTBOX')
                                                    <input type="text" style="width: 100%;" name="Answer[{{$indicator2->Indicator_ID}}][]">
                                                    @elseif($indicator2->Widget == 'TEXTAREA')
                                                    <textarea rows="3" style="width: 100%;" name="Answer[{{$indicator2->Indicator_ID}}][]"></textarea>
                                                    @elseif($indicator2->Widget == 'SELECT')
                                                    <select class="form-control" name="Answer[{{$indicator2->Indicator_ID}}][]" style="width: 100%;">
                                                        @foreach ($answer_classification as $ac)
                                                        @if($ac->Indicator_ID == $indicator2->Indicator_ID)
                                                        <option value='{{$ac->Answer_Classification_ID}}'>{{$ac->Answer}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @elseif($indicator2->Widget == 'DATEPICKER')
                                                    <input type="date" style="width: 100%;" name="Answer[{{$indicator2->Indicator_ID}}][]">
                                                    @elseif($indicator2->Widget == 'DATETIMEPICKER')
                                                    <input type="datetime-local" style="width: 100%;" name="Answer[{{$indicator2->Indicator_ID}}][]">
                                                    @endif
                                                </td>

                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                @else
                @endif
                @endforeach
        </div>


    </div>
</div>
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
        var div_child = $(".IndicatorDIVhidden");
        var newdiv = div_child.clone();
        div_main.find(".LblData").append(newdiv);
        div_main.find('.IndicatorDIVhidden').prop('hidden', false).removeClass('IndicatorDIVhidden')

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

    $(document).on("change", ".Answer_CHK", function() {
        var div_main = $(this).closest(".INDetails");
        var max = div_main.find(".Max_Answer").val();
        var ans_count = div_main.find('.Answer_CHK:checked').length;

        if (max < ans_count) {
            $(this).prop('checked', false);

            Swal.fire(
                'Warning',
                'Max answer count reached',
                'warning'
            )
        }

        // alert(ans_count);
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
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection