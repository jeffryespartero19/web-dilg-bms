@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12"> 
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> 
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Document Request</li>
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
                            <br>
                            <div class="col-md-12">  
                                
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Document_ID" name="Document_ID" value="{{$document[0]->Document_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <label for="Salutation_Name">Ticket Number:</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12" style="padding:0 10px">
                                                <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$document[0]->Queue_Ticket_Number}}</h1>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <label for="Requested_Date_and_Time">Requested Date and Time</label>
                                                <input type="datetime-local" class="form-control" id="Requested_Date_and_Time" name="Requested_Date_and_Time" value="{{$document[0]->Requested_Date_and_Time}}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="Requested_Date_and_Time">Note : Please take a picture/screenshot of your ticket number and your appointment date/time</label>
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



@endsection

@section('scripts')

<script>
   // Data Table
   $(document).ready(function() {
        $('#example').DataTable();

        $('.js-example-basic-single').select2();

        $(".Resident_Select2").select2({
            tags: true
        });
    });

</script>

<style>
   table {
        display: block;
        overflow-x: scroll;
    }

    .select2-selection {
        height: 32px !important;
        padding: 3px 3px;
        font: 13px;
    }
</style>

@endsection