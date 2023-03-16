<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class DocumentInformationExportView implements FromView
{
    protected $chk_Cash_Tendered,$chk_OR_No,$chk_SecondResident_Name,$chk_Document_Type_Name,$chk_Brgy_Cert_No,$chk_Issued_At,$chk_Issued_On,$chk_Salutation_Name,$chk_Purpose_of_Document,$chk_Remarks,$chk_Released,$chk_Resident_Name,$chk_Request_Date,$chk_Transaction_No;

    function __construct($chk_Cash_Tendered,$chk_OR_No,$chk_SecondResident_Name,$chk_Document_Type_Name,$chk_Brgy_Cert_No,$chk_Issued_At,$chk_Issued_On,$chk_Salutation_Name,$chk_Purpose_of_Document,$chk_Remarks,$chk_Released,$chk_Resident_Name,$chk_Request_Date,$chk_Transaction_No)
    {
        $this->chk_Transaction_No = $chk_Transaction_No;
        $this->chk_Request_Date = $chk_Request_Date;
        $this->chk_Resident_Name = $chk_Resident_Name;
        $this->chk_Released = $chk_Released;
        $this->chk_Remarks = $chk_Remarks;
        $this->chk_Purpose_of_Document = $chk_Purpose_of_Document;
        $this->chk_Salutation_Name = $chk_Salutation_Name;
        $this->chk_Issued_On = $chk_Issued_On;
        $this->chk_Issued_At = $chk_Issued_At;
        $this->chk_Brgy_Cert_No = $chk_Brgy_Cert_No;
        $this->chk_Document_Type_Name = $chk_Document_Type_Name;
        $this->chk_SecondResident_Name = $chk_SecondResident_Name;
        $this->chk_OR_No = $chk_OR_No;
        $this->chk_Cash_Tendered = $chk_Cash_Tendered;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $chk_Transaction_No = $this->chk_Transaction_No;
        $chk_Request_Date = $this->chk_Request_Date;
        $chk_Resident_Name = $this->chk_Resident_Name;
        $chk_Released = $this->chk_Released;
        $chk_Remarks = $this->chk_Remarks;
        $chk_Purpose_of_Document = $this->chk_Purpose_of_Document;
        $chk_Salutation_Name = $this->chk_Salutation_Name;
        $chk_Issued_On = $this->chk_Issued_On;
        $chk_Issued_At = $this->chk_Issued_At;
        $chk_Brgy_Cert_No = $this->chk_Brgy_Cert_No;
        $chk_Document_Type_Name = $this->chk_Document_Type_Name;
        $chk_SecondResident_Name = $this->chk_SecondResident_Name;
        $chk_OR_No = $this->chk_OR_No;
        $chk_Cash_Tendered = $this->chk_Cash_Tendered;

        $details = DB::table('bcpcis_brgy_document_information as a')
        ->leftjoin('bcpcis_brgy_payment_collected as b', 'a.Document_ID', '=', 'b.Document_ID')
        ->leftjoin('maintenance_bcpcis_purpose_of_document as c', 'a.Purpose_of_Document_ID', '=', 'c.Purpose_of_Document_ID')
        ->leftjoin('maintenance_bcpcis_document_type as d', 'a.Document_Type_ID', '=', 'd.Document_Type_ID')
        ->leftjoin('bips_brgy_inhabitants_information as e', 'a.Resident_ID', '=', 'e.Resident_ID')
            ->select(
                'a.Document_ID',
                'a.Transaction_No',
                'a.Brgy_Cert_No', 
                'd.Document_Type_Name',
                'c.Purpose_of_Document',  
                DB::raw('CONCAT(e.First_Name, " ",LEFT(e.Middle_Name,1),". ",e.Last_Name) AS Resident_Name'),
                'a.Request_Date',
                'a.Remarks',
                'a.Salutation_Name',
                'a.SecondResident_Name', 
                 DB::raw('(CASE WHEN a.Released = false THEN "No" ELSE "Yes" END) AS Released'),
                'a.Issued_On',
                'a.Issued_At',
                'b.OR_Date',
                'b.OR_No',
                'b.Cash_Tendered',
            )
            ->where('a.Barangay_ID', Auth::user()->Barangay_ID)
            ->get();

        return view('bcpcis_transactions.DocumentInformationExcel', compact(
            'chk_Transaction_No',
            'chk_Request_Date',
            'chk_Resident_Name',
            'chk_Released',
            'chk_Remarks',
            'chk_Purpose_of_Document',
            'chk_Salutation_Name',
            'chk_Issued_On',
            'chk_Issued_At',
            'chk_Brgy_Cert_No',
            'chk_Document_Type_Name',
            'chk_SecondResident_Name',
            'chk_OR_No',
            'chk_Cash_Tendered',
            'details'
        ));
    }
}
