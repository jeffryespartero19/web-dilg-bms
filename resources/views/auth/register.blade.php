@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="newInhabitant" method="POST" action="{{ route('create_inhabitants_application_information') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <h3>Name</h3>
                        <div class="row">
                            <input type="text" class="form-control" id="B_ID" name="B_ID" value="{{$Barangay_ID}}" hidden>
                            <input type="text" class="form-control" id="Resident_ID" name="Resident_ID" value="applicant" hidden>
                            <input type="text" class="form-control" id="Application_Status" name="Application_Status" value="0" hidden>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Prefix</label>
                                <select class="form-control" id="Name_Prefix_ID" name="Name_Prefix_ID">
                                    <option value='' selected>Select Option</option>
                                    @foreach($name_prefix as $bt)
                                    <option value="{{ $bt->Name_Prefix_ID }}">{{ $bt->Name_Prefix }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control" id="Last_Name" name="Last_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="First_Name">First Name</label>
                                <input type="text" class="form-control" id="First_Name" name="First_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Middle_Name">Middle Name</label>
                                <input type="text" class="form-control" id="Middle_Name" name="Middle_Name" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Name_Suffix_ID">Suffix</label>
                                <select class="form-control" id="Name_Suffix_ID" name="Name_Suffix_ID">
                                    <option value='' selected>Select Option</option>
                                    @foreach($suffix as $bt)
                                    <option value="{{ $bt->Name_Suffix_ID }}">{{ $bt->Name_Suffix }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>





                        <hr>
                        <h3>Address</h3>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Country</label>
                                <select class="form-control" id="Country_ID" name="Country_ID" required>
                                    <option value='' selected>Select Option</option>
                                    @foreach($country as $countrys)
                                    <option value="{{ $countrys->Country_ID }}">{{ $countrys->Country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Region</label>
                                <select class="form-control" id="Region_ID" name="Region_ID" required>
                                    <option value='' selected>Select Option</option>
                                    @foreach($region as $region)
                                    <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Province</label>
                                <select class="form-control" id="Province_ID" name="Province_ID" required>
                                    <option value='' selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="City_Municipality_ID">City/Municipality</label>
                                <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                    <option value='' selected>Select Option</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Barangay_ID">Barangay</label>
                                <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                    <option value='' selected>Select Option</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h3>Personal Information</h3>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Birthdate</label>
                                <input type="date" class="form-control" id="Birthdate" name="Birthdate" required>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Birthplace">Birthplace</label>
                                <input type="text" class="form-control" id="Birthplace" name="Birthplace">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Religion_ID">Religion</label>
                                <select class="form-control" id="Religion_ID" name="Religion_ID" required>
                                    <option value='' selected>Select Option</option>
                                    @foreach($religion as $religions)
                                    <option value="{{ $religions->Religion_ID }}">{{ $religions->Religion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Blood Type</label>
                                <select class="form-control" id="Blood_Type_ID" name="Blood_Type_ID" required>
                                    <option value='' selected>Select Option</option>
                                    @foreach($blood_type as $bt)
                                    <option value="{{ $bt->Blood_Type_ID }}">{{ $bt->Blood_Type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Sex</label>
                                <select class="form-control" id="Sex" name="Sex" required>
                                    <option value='' selected>Select Option</option>
                                    <option value='1'>Male</option>
                                    <option value='2'>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Weight">Weight</label>
                                <input type="number" class="form-control" id="Weight" name="Weight" placeholder="kg">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Height">Height</label>
                                <input type="number" class="form-control" id="Height" name="Height" placeholder="cm">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Civil Status</label>
                                <select class="form-control" id="Civil_Status_ID" name="Civil_Status_ID" required>
                                    <option value='0' selected>Select Option</option>
                                    @foreach($civil_status as $cs)
                                    <option value="{{ $cs->Civil_Status_ID }}">{{ $cs->Civil_Status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Mobile No</label>
                                <input type="text" class="form-control" id="Mobile_No" name="Mobile_No">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Telephone No</label>
                                <input type="text" class="form-control" id="Telephone_No" name="Telephone_No">
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="Salary">Salary</label>
                                <input type="text" class="form-control" id="Salary" name="Salary">
                            </div>

                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="PhilSys_Card_No">PhilSys_Card_No</label>
                                <input type="text" class="form-control" id="PhilSys_Card_No" name="PhilSys_Card_No">
                            </div>
                        </div>
                        <hr>
                        <h3>Additional Information</h3>
                        <div class="row">
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Solo Parent</label>
                                <select class="form-control" id="Solo_Parent" name="Solo_Parent">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">OFW</label>
                                <select class="form-control" id="OFW" name="OFW">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">Indigent</label>
                                <select class="form-control" id="Indigent" name="Indigent">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="padding:0 10px">
                                <label for="exampleInputEmail1">4Ps Beneficiary</label>
                                <select class="form-control" id="4Ps_Beneficiary" name="4Ps_Beneficiary">
                                    <option value='' selected>Select Option</option>
                                    <option value=1>Yes</option>
                                    <option value=0>No</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h3>Login Credentials</h3>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <hr>
                        <div style="text-align: center;">
                            <!-- <button type="button" class="btn btn-danger modal-close" style="width: 200px;" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary postThis_Inhabitant_Info" style="width: 200px;">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<script>
    // Populate Province
    $(document).on("change", "#Region_ID", function() {
        // alert('test');
        var Region_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_province/" + Region_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Province_ID').empty();
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();


                var option1 =
                    "<option value='' disabled selected>Select Option</option>";
                $('#Province_ID').append(option1);
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Province_ID"] +
                        "'>" +
                        element["Province_Name"] +
                        "</option>";
                    $('#Province_ID').append(option);
                });
            }
        });
    });

    // Populate City
    $(document).on("change", "#Province_ID", function() {
        var Province_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_city/" + Province_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#City_Municipality_ID').empty();
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#City_Municipality_ID').append(option1);
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["City_Municipality_ID"] +
                        "'>" +
                        element["City_Municipality_Name"] +
                        "</option>";
                    $('#City_Municipality_ID').append(option);
                });
            }
        });
    });


    // Populate Barangay
    $(document).on("change", "#City_Municipality_ID", function() {
        var City_Municipality_ID = $(this).val();

        $.ajax({
            type: "GET",
            url: "/get_barangay/" + City_Municipality_ID,
            fail: function() {
                alert("request failed");
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#Barangay_ID').empty();

                var option1 =
                    " <option value='' disabled selected>Select Option</option>";
                $('#Barangay_ID').append(option1);

                data.forEach(element => {
                    var option = " <option value='" +
                        element["Barangay_ID"] +
                        "'>" +
                        element["Barangay_Name"] +
                        "</option>";
                    $('#Barangay_ID').append(option);
                });
            }
        });
    });
</script>


@endsection