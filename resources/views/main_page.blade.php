<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DILG_BIS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('css/logos/DILG_logo.png') }}">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <!-- Scripts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/global.js') }}" defer></script>

    <script type="text/javascript">
        (function() {
            var css = document.createElement('link');
            css.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>

    <script>
        var msg = '{{Session::get('
        alert ')}}';
        var exist = '{{Session::has('
        alert ')}}';
        if (exist) {
            alert(msg);
        }
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('css/logos/DILG_logo.png') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="{{ asset('css/global.css') }}" rel="stylesheet">

    <script src="{{ asset('/js/homeX.js') }}" defer></script>
    <link href="{{ asset('/css/homeX.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/general.css') }}" rel="stylesheet">
</head>

<body class="">
    <div id="main_public">
        <div class="top-right links" style="z-index: 999">

            <a href="" class="text_hoverable">FAQ</a>
            <a href="{{ route('login') }}" class="text_hoverable">Login</a>

            @if (Route::has('register'))
            <a href="{{ url('registers') }}" class="text_hoverable">Register</a>
            @endif

        </div>
        <div class="theContent">
            <div class=" justify-content-center" style="width: 100%;">
                <div class="col-md-12 topBanner">
                    <div class="bannerTitle">
                        <span class="intro_txt txtHide firstln">Barangay</span><br>
                        <span class="intro_txt txtHide secondln">Online Web Services</span><br>
                        <span class="intro_txt txtHide thirdln"></span><br>
                    </div>
                </div>

                <div class="col-md-9 middlePane">
                    <div class="flexer justifier">

                    </div>
                    <div class="flexer justifier">

                    </div>
                </div>
                <div class="col-md-3 rightPane">
                    <div>
                        <form id="BRGYFilter" action="{{ route('main') }}">
                            @csrf
                            <h2>Filters</h2>
                            <br>
                            <div class="row">
                                <div class="form-group" style="padding:0 10px">
                                    <label for="exampleInputEmail1">Region</label>
                                    <select class="form-control" id="Region_ID" name="Region_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                        @foreach($region as $region)
                                        <option value="{{ $region->Region_ID }}">{{ $region->Region_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="padding:0 10px">
                                    <label for="exampleInputEmail1">Province</label>
                                    <select class="form-control" id="Province_ID" name="Province_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                    </select>
                                </div>
                                <div class="form-group" style="padding:0 10px">
                                    <label for="City_Municipality_ID">City/Municipality</label>
                                    <select class="form-control" id="City_Municipality_ID" name="City_Municipality_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                    </select>
                                </div>
                                <div class="form-group" style="padding:0 10px">
                                    <label for="Barangay_ID">Barangay</label>
                                    <select class="form-control" id="Barangay_ID" name="Barangay_ID" required>
                                        <option value='' disabled selected>Select Option</option>
                                    </select>
                                </div>
                                <div class="form-group" style="padding:0 10px; text-align:right">
                                    <button type="submit" id="b_id" value="0">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <footer class="">
            <div>
                <span style="font-size: 11px;"> Wizzard Technologies, Inc. DILG-BIS</span>
            </div>
        </footer> --}}

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

        $(document).on("change", "#Barangay_ID", function() {
            var Barangay_ID = $(this).val();

            $('#b_id').val(Barangay_ID);


        });

        // $(document).on("click", "#b_id", function() {
        //     var b_id = $(this).val();

        //     $.ajax({
        //         type: "get",
        //         url: "/main/" +
        //             b_id,
        //         fail: function() {
        //             alert("request failed");
        //         },
        //         success: function(data) {

        //         },
        //     });
        // });
    </script>
</body>

</html>