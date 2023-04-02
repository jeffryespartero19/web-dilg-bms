@extends('layouts.default')

@section('content')
<link href="{{ asset('/css/maintenance.css') }}" rel="stylesheet">

<div class="page_title_row col-md-12">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document Request Pending List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">DILG_BMS</a></li>
                        <li class="breadcrumb-item active">Document Request Pending List</li>
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
                    <div class="card-header" style="background-color:#e7ad52; color:white">
                        <h3 class="card-title">Pending</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 table-responsive">
                            <div>
                                <div class="table-responsive">
                                    <table id="example11" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Queue Ticket Number</th>
                                                <th>Requested Date and Time</th>
                                                <th>Resident Name</th>
                                                <th>Document Type Name</th>
                                                <th>Purpose of Document</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchFilter searchFilter1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchFilter searchFilter2" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchFilter searchFilter3" style="min-width: 400px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter4" id="Document_Type_ID" name="Document_Type_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchFilter searchFilter5" id="Purpose_of_Document_ID" name="Purpose_of_Document_ID" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListData"> 
                                            @include('bcpcis_transactions.document_request_pending_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries->links() !!}
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
                                </div>
                            </div>
                            <hr>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#198754; color:white">
                        <h3 class="card-title">Approved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <div>
                                    <table id="example11" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Queue Ticket Number</th>
                                                <th>Requested Date and Time</th>
                                                <th>Resident Name</th>
                                                <th>Document Type Name</th>
                                                <th>Purpose of Document</th>
                                                <th>Actions</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchApproved searchApproved1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchApproved searchApproved2" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchApproved searchApproved3" style="min-width: 400px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchApproved searchApproved4" id="Document_Type_IDA" name="Document_Type_IDA" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchApproved searchApproved5" id="Purpose_of_Document_IDA" name="Purpose_of_Document_IDA" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListDataApproved"> 
                                            @include('bcpcis_transactions.document_request_approved_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries2->links() !!}
                                    <input type="hidden" name="hidden_pageApproved" id="hidden_pageApproved" value="1">
                                </div>
                            </div>
                            <hr>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#ed5170; color:white">
                        <h3 class="card-title">Disapproved</h3>
                    </div>
                    <div class="card-body">
                        <div class="tableX_row col-md-12 up_marg5">
                            <div class="table-responsive">
                                <div>
                                    <table id="example11" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Queue Ticket Number</th>
                                                <th>Requested Date and Time</th>
                                                <th>Resident Name</th>
                                                <th>Document Type Name</th>
                                                <th>Purpose of Document</th>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control searchDisApproved searchDisApproved1" style="min-width: 200px;" type="text"></td>
                                                <td><input class="form-control searchDisApproved searchDisApproved2" style="min-width: 200px;" type="date"></td>
                                                <td><input class="form-control searchDisApproved searchDisApproved3" style="min-width: 400px;" type="text"></td>
                                                <td>
                                                    <select class="form-control searchDisApproved searchDisApproved4" id="Document_Type_IDD" name="Document_Type_IDD" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control searchDisApproved searchDisApproved5" id="Purpose_of_Document_IDD" name="Purpose_of_Document_IDD" style="min-width: 300px;">
                                                    </select>
                                                </td>
                                                <td style="min-width: 200px;"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="ListDataDisApproved"> 
                                            @include('bcpcis_transactions.document_request_disapproved_data')
                                        </tbody>
                                    </table>
                                    {!! $db_entries3->links() !!}
                                    <input type="hidden" name="hidden_pageDisApproved" id="hidden_pageDisApproved" value="1">
                                </div>    
                            </div>
                            <div hidden>
                                <form id="Approved_Inhabitant" method="POST" action="{{ route('approve_disapprove_document_request_pending') }}" autocomplete="off" enctype="multipart/form-data">@csrf
                                    <input type="number" class="form-control" id="Document_ID" name="Document_ID">
                                    <input type="number" class="form-control" id="Request_Status_ID" name="Request_Status_ID">
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
        $('#example2').DataTable();
        $('#example3').DataTable();


        $("#Document_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
                dataType: "json",
            }
        });

        $("#Purpose_of_Document_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentpurpose',
                dataType: "json",
            }
        });

        $("#Document_Type_IDA").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
                dataType: "json",
            }
        });

        $("#Purpose_of_Document_IDD").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentpurpose',
                dataType: "json",
            }
        });

        $("#Document_Type_IDD").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
                dataType: "json",
            }
        });

        $("#Purpose_of_Document_IDA").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentpurpose',
                dataType: "json",
            }
        });
    });

    $(document).ready(function() {


        $("#Document_Type_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documenttype',
                dataType: "json",
            }
        });

        $("#Purpose_of_Document_ID").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/search_documentpurpose',
                dataType: "json",
            }
        });
    });

    // Approve Inhabitants
    $(document).on('click', ('.approve_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Document_ID').val(disID);
        $('#Request_Status_ID').val(1);

        $('#Approved_Inhabitant').submit();

    });

    // Disapprove Inhabitants
    $(document).on('click', ('.disapprove_inhabitants'), function(e) {

        var disID = $(this).val();
        $('#Document_ID').val(disID);
        $('#Request_Status_ID').val(2);

        $('#Approved_Inhabitant').submit();
    });

    // Side Bar Active
    $(document).ready(function() {
        $('.documentRequest').addClass('active');
        $('.certification_menu').addClass('active');
        $('.certification_main').addClass('menu-open');
    });

    $(".searchFilter").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchFilter1').val();
        var param2 = $('.searchFilter2').val();
        var param3 = $('.searchFilter3').val();
        var param4 = $('.searchFilter4').val();
        var param5 = $('.searchFilter5').val();
        var page = $('#hidden_page').val();


        $.ajax({
            url: "/search_documentrequestpending_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            // url: "/search_documentrequestpending_fields?page=" + page + "&param1=" + param1 ,
            success: function(data) {
                $('#ListData').html('');
                $('#ListData').html(data);
            }
        });

    }

    $(".searchApproved").change(function() {
        SearchData2();
    });

    function SearchData2() {
        // alert('test');
        var param1 = $('.searchApproved1').val();
        var param2 = $('.searchApproved2').val();
        var param3 = $('.searchApproved3').val();
        var param4 = $('.searchApproved4').val();
        var param5 = $('.searchApproved5').val();
        var page = $('#hidden_pageApproved').val();


        $.ajax({
            url: "/search_documentrequestapproved_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            // url: "/search_documentrequestpending_fields?page=" + page + "&param1=" + param1 ,
            success: function(data) {
                $('#ListDataApproved').html('');
                $('#ListDataApproved').html(data);
            }
        });

    }

    $(".searchDisApproved").change(function() {
        SearchData3();
    });

    function SearchData3() {
        // alert('test');
        var param1 = $('.searchDisApproved1').val();
        var param2 = $('.searchDisApproved2').val();
        var param3 = $('.searchDisApproved3').val();
        var param4 = $('.searchDisApproved4').val();
        var param5 = $('.searchDisApproved5').val();
        var page = $('#hidden_pageDisApproved').val();


        $.ajax({
            url: "/search_documentrequestdisapproved_fields?page=" + page + "&param1=" + param1 + "&param2=" + param2 + "&param3=" + param3 + "&param4=" + param4 + "&param5=" + param5,
            // url: "/search_documentrequestpending_fields?page=" + page + "&param1=" + param1 ,
            success: function(data) {
                $('#ListDataDisApproved').html('');
                $('#ListDataDisApproved').html(data);
            }
        });

    }
   
</script>

<style>
    /* table {
        display: inline-block;
        overflow-x: scroll;
    } */
</style>

@endsection