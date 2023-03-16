@extends('layouts.default')

@section('content')
<script src="{{ asset('/js/maintenance.js') }}" defer></script>
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Allocated Fund</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item"><a href="{{route('other_transaction_list')}}">Other Transaction List(BDRIS)</a></li>
                        <li class="breadcrumb-item active">Allocated Fund</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                        <input type="number" id="User_Type_ID" value="{{Auth::user()->User_Type_ID}}" hidden>
                            <br>
                            <div class="col-md-12">
                                <form id="newBrgy_Document_Information" method="POST" action="{{ route('create_allocated_fund_source') }}" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input type="text" class="form-control" id="Allocated_Fund_ID" name="Allocated_Fund_ID" value="{{$allocated_fund[0]->Allocated_Fund_ID}}" hidden>
                                        <div class="row">
                                            <div class="form-group col-lg-7" style="padding:0 10px">
                                                <label for="Allocated_Fund_Name">Allocated Fund Name</label>
                                                <input type="text" class="form-control" id="Allocated_Fund_Name" name="Allocated_Fund_Name" value="{{$allocated_fund[0]->Allocated_Fund_Name}}">
                                            </div>
                                            <div class="form-group col-lg-7" style="padding:0 10px">
                                                <label for="Amount">Amount</label>
                                                <input type="text"  onkeypress="validate(event)" class="form-control fancyformat" value="{{number_format((float)$allocated_fund[0]->Amount, 2, '.', ',')}}">
                                                <input type="number" step="0.01" class="form-control fancyformat" id="Amount" name="Amount" value="{{$allocated_fund[0]->Amount}}" hidden>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3" style="padding:0 10px">
                                                <span><b>Active:</b></span><br>
                                                <select class="modal_input1 form-control" name="Active" id="Active">
                                                    <option hidden selected>Is Active?</option>
                                                    <option value=0 {{ 0 == $allocated_fund[0]->Active  ? "selected" : "" }}>No</option>
                                                    <option value=1 {{ 1 == $allocated_fund[0]->Active  ? "selected" : "" }}>Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-bottom: 100px;">
                                        <center>
                                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-primary" style="width: 200px;">Save</button>
                                        </center>
                                    </div>
                                    
                            </div>
                            
                            </form>
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


<!-- Create Announcement_Status END -->







@endsection

@section('scripts')

<script>
    // Data Table
    $(document).ready(function() {
        $('#example').DataTable();
    });


    

     // Disable Form if DILG USER
     $(document).ready(function() {
        var User_Type_ID = $('#User_Type_ID').val();
        if (User_Type_ID == 3 || User_Type_ID == 4) {
            $("#newBrgy_Document_Information :input").prop("disabled", true);
        }
    });

    
    // Side Bar Active
    $(document).ready(function() {
        $('.otherTrans').addClass('active');
        $('.disaster_menu').addClass('active');
        $('.disaster_main').addClass('menu-open');
    });

    $(document).on("focusout",'.fancyformat', function(e) {
            var disVal=$(this).val();
            var num2 = parseFloat(disVal).toLocaleString();
            var num3 =  parseFloat(disVal);
            
            $(this).val(num2);
            $(this).next().val(num3);
            //alert(num2);
        });
     
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

<style>
    table {
        display: block;
        overflow-x: scroll;
    }
</style>

@endsection