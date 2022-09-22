<style>
    @page { margin: 5px; }
    .page-border { position: fixed; left: 10px; top: 10px; bottom: 10px; right: 10px; }
    .pagenum:before {
            content: 'Page ' counter(page);
        }
    .thisTD{font-size: 12px; text-align: center;}
    .thisTH{font-size: 12px;border-bottom:1px solid black;}
    .font12{font-size: 12px;}
    .font14{font-size: 14px;}
    .font16{font-size: 16px;}
    .font18{font-size: 18px;}
</style>

@isset($previewer)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .page-border {
        position:static;
        width: 50%;
    }
    body{
        display: flex;
        justify-content: center;
    }
</style>
<div class="modal-footer">
    <button type="button" class="btn btn-danger backCV" style="margin-top:-8px;margin-left:-8px;z-index:9999;position:absolute;" onclick="history.back();">Back</button>
</div>
@endisset

<div class="page-border">

    <table style="width:100%;">
        <thead>
            <tr>
                <td rowspan="4" style="width:20%;"><img src="{{asset('images/MSULOGO.png')}}" height="85" width="85"></td>
                <td style="text-align: center; width:60%;">Republic of the Philippines</td>
                <td rowspan="4" style="width:20%;"></td>
            </tr>
            <tr>
                <td class="font14" style="text-align: center"><i><b>{{$the_Branch[0]->BranchName}}</b></i></td>
            </tr>
            <tr>
                <td class="font14" style="text-align: center">@if($the_Branch[0]->IsMain ==1)MSU Main Campus @endif</td>
            </tr>
            <tr>
                <td class="font14" style="text-align: center">{{$the_Branch[0]->BranchAddress}}</td>
            </tr>
        </thead>
    </table>
    <table style="width:100%;border:1px solid black;" cellspacing="0">
        <tr>
            <td class="font16" style="text-align: center; color:salmon;">ACKNOWLEDGEMENT RECEIPT EQUIPMENT</td>
        </tr>
        <tr>
            <td class="font16" style="text-align: center">{{$detail[0]->Department}}</td>
        </tr>
        <tr>
            <td class="font16" style="text-align: center; color:salmon;">OFFICE</td>
        </tr>
    </table>
    <table style="width:100%;border:1px solid black;" cellspacing="0">
        <thead>
            <tr>
                <td style="border: 1px solid black;">Quantity</td>
                <td style="border: 1px solid black;">Unit</td>
                <td style="border: 1px solid black;">Amount</td>
                <td style="border: 1px solid black;">Description</td>
                <td style="border: 1px solid black;">Property No.</td>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $dtl)
                <tr>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">{{$dtl->Quantity}}</td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">{{$dtl->UOM}}</td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">{{number_format((float)$dtl->TotalValue, 2, '.', ',')}}</td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">{{$dtl->ItemName}} - {{$dtl->ItemDescription}}</td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">{{$dtl->AssetNo}}</td>
                </tr>
            @endforeach
            @if(count($detail) < 30)
                @for($i=0; $i < (30-count($detail)); $i++)
                    <tr>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">&nbsp;</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">&nbsp;</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">&nbsp;</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">&nbsp;</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;text-align:center;">&nbsp;</td>
              
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>
    <table style="width:100%;border:1px solid black;" cellspacing="0">
        <tr>
            <td class="font16" style="border-right: 1px solid black"> RECIEVED BY: </td>
            <td class="font16"> RECIEVED FROM:</td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center;vertical-align:bottom;" height="40"><u>&nbsp;&nbsp;{{$detail[0]->ReceivedBy}}&nbsp;&nbsp;</u></td>
            <td class="font14" style="text-align:center;vertical-align:bottom;"><u>&nbsp;&nbsp;{{$Recieved_From[0]->CardName}}&nbsp;&nbsp;</u></td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center">Signature Over Printed Name</td>
            <td class="font14" style="text-align:center">Signature Over Printed Name</td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center;vertical-align:bottom;" height="40"><u>&nbsp;&nbsp;{{$detail[0]->ReceivedByPosition}}&nbsp;&nbsp;</u>
            <td class="font14" style="text-align:center;vertical-align:bottom;"><u>&nbsp;&nbsp;{{$Recieved_From[0]->Position}}&nbsp;&nbsp;</u></td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center">Postion/Office</td>
            <td class="font14" style="text-align:center">Postion/Office</td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center;vertical-align:bottom;" height="40"><u>&nbsp;&nbsp;{{$datenowX}}&nbsp;&nbsp;</u></td>
            <td class="font14" style="text-align:center;vertical-align:bottom;"><u>&nbsp;&nbsp;{{$datenowX}}&nbsp;&nbsp;</u></td>
        </tr>

        <tr>
            <td class="font14" style="border-right: 1px solid black;text-align:center">Date</td>
            <td class="font14" style="text-align:center;vertical-align:top">Date</td>
        </tr>
    </table>
</div>