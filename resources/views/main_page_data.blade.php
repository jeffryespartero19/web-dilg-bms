@foreach($db_entries as $x)
<div class="callout callout-success">
    <div>
        <h5 style="text-align: left;">{{$x->Barangay_Name}}, {{$x->City_Municipality_Name}}, {{$x->Province_Name}}, {{$x->Region_Name}}</h5>
    </div>
    <div style="text-align: right;">
        <button class='btn btn-success EnterLink' value='{{$x->Barangay_ID}}'>Visit</button>
    </div>
</div>
@endforeach
{!! $db_entries->links() !!}