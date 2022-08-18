<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use DB;

use function PHPSTORM_META\type;

class PDFController extends Controller
{
    public  function convert_number_to_words($number)
    {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
  public function downloadPDF(Request $request)
    {
        $data = request()->all();

        if ($data['docType'] == 1) {
            $AsOf = $data['AsOf'];

            $detail = DB::SELECT(
                'EXEC SP_DB_rptAgingPayables ?,?',
                array($data['BranchID'], $data['PayeeID'])
            );

            //dd($detail);

            $pdf = PDF::loadView('pdf_blade.aging_payables_PDF', compact('detail', 'AsOf'));
            $daFileNeym = "Aging_Payables.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 2) {
            $From_Date = Carbon::parse($data['Acc_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['Acc_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptAccountsPayableVoucher_Summary ?,?,?,?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'], $data['DepartmentID'], $data['SectionID'], $data['Status'])
            );

            //dd($detail,$data);

            $pdf = PDF::loadView('pdf_blade.accounts_payable_summary_PDF', compact('detail', 'data'))->setPaper('a4', 'landscape');
            $daFileNeym = "Accounts_Payable_Summary.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 3) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCancelledChecks ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            //dd($detail,$data);

            $pdf = PDF::loadView('pdf_blade.cancelled_checks_PDF', compact('detail', 'data'))->setPaper('a4', 'landscape');
            $daFileNeym = "Cancelled_Checks.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 4) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckDisbursed ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            //dd($detail,$data);

            $pdf = PDF::loadView('pdf_blade.disbursed_checks_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate'))->setPaper('a4', 'landscape');
            $daFileNeym = "Disbursed_Checks.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 5) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $T_Ammount = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckIssued ?,?,?,?',
                array($From_smalldate, $To_smalldate, $data['BankID'], $data['BranchID'])
            );

            foreach ($detail as $key => $dtl) {
                $T_Ammount += floatval($detail[$key]->Amount);
            }


            //dd($detail,$data);

            $pdf = PDF::loadView('pdf_blade.checks_issued_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate', 'T_Ammount'))->setPaper('a4', 'landscape');
            $daFileNeym = "Issued_Checks.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 6) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptChecksOnHand ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            //dd($detail);

            $pdf = PDF::loadView('pdf_blade.checks_on_hand_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate'))->setPaper('a4', 'landscape');
            $daFileNeym = "Checks_on_Hand.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 7) {
            $T_Debit = 0;
            $T_Credit = 0;
            $TableID = DB::table('ACC_JournalEntryVoucher_Hdr')->where('JournalNo', $data['J_noX'])->pluck('TableID');;

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptJournalEntryVoucher ?',
                array($TableID[0])
            );

            $rowspan = count($detail);
            foreach ($detail as $key => $dtl) {
                $T_Debit += floatval($detail[$key]->Debit);
                $T_Credit += floatval($detail[$key]->Credit);
            }


            //dd($detail,$data, $T_Debit, $T_Credit);
            $pdf = PDF::loadView('printouts.journal_entry_voucher_PDF', compact('detail', 'data', 'T_Debit', 'T_Credit', 'rowspan'));
            $daFileNeym = "Journal_Entry_Voucher.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 8) {
            $TableID = DB::table('DB_DisbursementVoucher_Hdr')->where('VoucherNo', $data['DV_noX'])->pluck('TableID');
            $Amount_Due = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptDisbursementVoucher ?',
                array($TableID[0])
            );

            $rowspan = count($detail);
            foreach ($detail as $key => $dtl) {
                $Amount_Due += floatval($detail[$key]->VoucherAmount);
            }

            //dd($detail,$data);

            $pdf = PDF::loadView('printouts.disbursement_voucher_PDF', compact('detail', 'data', 'Amount_Due', 'rowspan'));
            $daFileNeym = "Disbursement_Voucher.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 9) {
            $Check_Date = Carbon::parse($data['Check_Date']);
            $Check_Date_smalldate = $Check_Date->format('M d, Y');
            $the_Bank = DB::table('Bank')->where('TableID', $data['BankID'])->get();
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $T_Amount = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckIssuedCancelled ?,?,?',
                array($data['BankID'], $data['BranchID'], $Check_Date_smalldate)
            );

            $total_no_of_checks = count($detail);
            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->Amount);
            }

            $in_words = PDFController::convert_number_to_words($T_Amount);

            //dd($detail,$data);

            $pdf = PDF::loadView('pdf_blade.ADV_Checks_PDF', compact('detail', 'data', 'the_Bank', 'the_Branch', 'T_Amount', 'total_no_of_checks', 'in_words'));
            $daFileNeym = "Advice_of_Checks_Issued_and_Cancelled.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 10) {
            $TableHdr = DB::table('VW_INV_PurchaseRequest_Hdr')->where('RequestNo', $data['PR_noX'])->get();
            $TableID = $TableHdr[0]->TableID;

            $detail = DB::table('VW_INV_PurchaseRequest_Dtl')->where('TableID_Hdr', $TableID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $TableHdr[0]->BranchID)->get();
            $the_Section = DB::table('Section')->where('TableID', $TableHdr[0]->SectionID)->get();

            $T_Amount = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->TotalCost);
            }

            $Requester = DB::table('VW_SYS_CardFile')->where('TableID', $data['rq_b'])->get();
            $Approver = DB::table('VW_SYS_CardFile')->where('TableID', $data['ap_b'])->get();

            //dd($detail,$data,$TableHdr,$T_Amount);

            $pdf = PDF::loadView('printouts.purhcase_request_PDF', compact('TableHdr', 'detail', 'data', 'the_Branch', 'T_Amount', 'the_Section', 'Requester', 'Approver'));
            $daFileNeym = "Purchase_Request.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 11) {
            $TableHdr = DB::table('VW_INV_PurchaseOrder_Hdr')->where('PurchaseOrderNo', $data['PO_noX'])->get();
            $TableID = $TableHdr[0]->TableID;

            $detail = DB::table('INV_PurchaseOrder_Dtl')->where('TableID_Hdr', $TableID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $TableHdr[0]->BranchID)->get();
            $the_Supplier = DB::table('CardFile')->where('TableID', $TableHdr[0]->SupplierID)->get();

            $ConformeX = DB::table('VW_SYS_CardFile')->where('TableID', $data['conforme_a'])->get();
            $VTY = DB::table('VW_SYS_CardFile')->where('TableID', $data['vty_a'])->get();
            $RQOD = DB::table('VW_SYS_CardFile')->where('TableID', $data['rqod_a'])->get();
            $CA_x = DB::table('VW_SYS_CardFile')->where('TableID', $data['ca_a'])->get();

            $Place_Of_Delivery = $data['PDx'];
            $Delivery_Term = $data['DTx'];
            $Payment_Term = $data['PTx'];

            $theTable2 = DB::table('INV_PurchaseOrder_Hdr')->where('PurchaseOrderNo', $data['PO_noX'])->get();
            $theCanvas = "";
            $theQuote = "";
            $theRequest = "";

            if ($theTable2[0]->CanvassID != NULL || $theTable2[0]->CanvassID != "" || $theTable2[0]->CanvassID != []) {
                $theCanvass = DB::table('INV_Canvass_Hdr')->where('TableID', $theTable2[0]->CanvassID)->get();
                $theQuote = DB::table('INV_Quotation_Hdr')->where('TableID', $theCanvass[0]->QuotationID)->get();
                $theRequest = DB::table('INV_PurchaseRequest_Hdr')->where('TableID', $theQuote[0]->RequestID)->get();
                $theMoP = DB::table('ModeofProcurement')->where('TableID', $theRequest[0]->Mode_of_Procurement_ID)->get();
            }


            $T_Amount = 0;
            $item_ids = [];
            $uom_ids = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->TotalAmount);

                $get_this_UOM = array_push($uom_ids, $detail[$key]->UOMID);
                $get_this_Item = array_push($item_ids, $detail[$key]->ItemID);
            }

            $UOM = DB::table('UnitofMeasure')->whereIn('TableID', $uom_ids)->get();
            $ItemZ = DB::table('INV_Item')->whereIn('TableID', $item_ids)->get();

            $in_words = PDFController::convert_number_to_words($T_Amount);

            //dd($UOM,$ItemZ,$T_Amount);

            $pdf = PDF::loadView('printouts.purchase_order_PDF', compact(
                'TableHdr',
                'detail',
                'data',
                'the_Branch',
                'T_Amount',
                'UOM',
                'ItemZ',
                'in_words',
                'the_Supplier',
                'ConformeX',
                'VTY',
                'RQOD',
                'CA_x',
                'Place_Of_Delivery',
                'Delivery_Term',
                'Payment_Term',
                'theMoP'
            ));
            $daFileNeym = "Purchase_Order.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 12) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptGeneralJournal ?,?,?,?',
                array($data['MonthID'], $data['Year'], $data['BranchID'], $data['FundID'])
            );

            $fund_cluster = DB::table('Fund')->WHERE('TableID', $data['FundID'])->get();

            if ($data['MonthID'] == 1) {
                $monthX = "January";
            }
            if ($data['MonthID'] == 2) {
                $monthX = "February";
            }
            if ($data['MonthID'] == 3) {
                $monthX = "March";
            }
            if ($data['MonthID'] == 4) {
                $monthX = "April";
            }
            if ($data['MonthID'] == 5) {
                $monthX = "May";
            }
            if ($data['MonthID'] == 6) {
                $monthX = "June";
            }
            if ($data['MonthID'] == 7) {
                $monthX = "July";
            }
            if ($data['MonthID'] == 8) {
                $monthX = "August";
            }
            if ($data['MonthID'] == 9) {
                $monthX = "September";
            }
            if ($data['MonthID'] == 10) {
                $monthX = "October";
            }
            if ($data['MonthID'] == 11) {
                $monthX = "November";
            }
            if ($data['MonthID'] == 12) {
                $monthX = "December";
            }

            //dd($detail);

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            $pdf = PDF::loadView('printouts.G_Journal_PDF', compact('detail', 'data', 'monthX', 'the_Branch', 'T_Amount_C', 'T_Amount_D','fund_cluster'));
            $daFileNeym = "General_Journal.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 13) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptGeneralLedger ?,?,?',
                array($data['AccountID'], $data['BranchID'],$data['FundID'])
            );

            $fund_cluster = DB::table('Fund')->WHERE('TableID', $data['FundID'])->get();

            $Acc_details = DB::table('VW_ACC_Accounts')->where('TableID', $data['AccountID'])->get();

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            $T_Amount_B = 0;
            $Balances = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount_B += floatval($detail[$key]->Debit);
                $T_Amount_B -= floatval($detail[$key]->Credit);

                array_push($Balances, $T_Amount_B);
            }

            $pdf = PDF::loadView('printouts.G_Ledger_PDF', compact(
                'detail',
                'data',
                'the_Branch',
                'T_Amount_C',
                'T_Amount_D',
                'T_Amount_B',
                'Balances',
                'Acc_details',
                'fund_cluster'
            ));
            $daFileNeym = "General_Ledger.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 14) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptSubsidiaryLedger ?,?',
                array($data['CardID'], $data['BranchID'])
            );

            $Acc_details = DB::table('CardFile')->where('TableID', $data['CardID'])->get();

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            $T_Amount_B = 0;
            $Balances = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount_B += floatval($detail[$key]->Debit);
                $T_Amount_B -= floatval($detail[$key]->Credit);

                array_push($Balances, $T_Amount_B);
            }

            //dd(compact('detail','data','the_Branch','T_Amount_C',
            //'T_Amount_D','T_Amount_B','Balances','Acc_details'));

            $pdf = PDF::loadView('printouts.S_Ledger_PDF', compact(
                'detail',
                'data',
                'the_Branch',
                'T_Amount_C',
                'T_Amount_D',
                'T_Amount_B',
                'Balances',
                'Acc_details'
            ));
            $daFileNeym = "Subsidiary_Ledger.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 15) {
            $the_AssetIssuance = DB::table('VW_AM_Issuance_Hdr')->where('IssuanceNo', $data['AI_noX'])->get();
            $Recieved_By = DB::table('VW_SYS_CardFile')->where('TableID', $data['rc_b'])->get();
            $Recieved_From = DB::table('VW_SYS_CardFile')->where('TableID', $data['rc_f'])->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_AssetIssuance[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_AM_rptARE ?',
                array($the_AssetIssuance[0]->TableID)
            );

            //dd($data, $the_AssetIssuance, $detail, $Recieved_By, $Recieved_From, $the_Branch);
            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');
            //dd($datenowX);

            $pdf = PDF::loadView('printouts.A_Issuance_PDF', compact(
                'detail',
                'data',
                'the_AssetIssuance',
                'Recieved_By',
                'Recieved_From',
                'the_Branch',
                'datenowX'
            ));
            $daFileNeym = "Asset_Issuance.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 16) {
            $the_AssetDisposal = DB::table('VW_AM_Disposal_Hdr')->where('DisposalNo', $data['AD_noX'])->get();

            $CertifiedCorrect = DB::table('VW_SYS_CardFile')->where('TableID', $data['ccX'])->get();
            $DisposalApproved = DB::table('VW_SYS_CardFile')->where('TableID', $data['daX'])->get();
            $WitnessToDisposal = DB::table('VW_SYS_CardFile')->where('TableID', $data['wtd'])->get();

            $detail = DB::SELECT(
                'EXEC SP_AM_rptDisposal ?',
                array($the_AssetDisposal[0]->TableID)
            );

            //dd($data,$the_AssetDisposal,$detail,$CertifiedCorrect,$DisposalApproved,$WitnessToDisposal );
            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Amount);
            }

            $pdf = PDF::loadView('printouts.A_Disposal_PDF', compact(
                'detail',
                'data',
                'the_AssetDisposal',
                'DisposalApproved',
                'datenowX',
                'T_Amount_D'
            ));
            $daFileNeym = "Asset_Disposal.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 17) {
            $the_RFQ = DB::table('VW_INV_Quotation_Hdr')->where('QuotationNo', $data['RQ_noX'])->get();
            $theRequest = DB::table('VW_INV_PurchaseRequest_Hdr')->where('RequestNo', $the_RFQ[0]->RequestNo)->get();
            $theRequest_details = DB::table('VW_INV_PurchaseRequest_Dtl')->where('TableID_HDR', $theRequest[0]->TableID)->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_RFQ[0]->BranchID)->get();
            $the_Department = DB::table('Department')->where('TableID', $the_RFQ[0]->DepartmentID)->get();
            $the_Canvasser = DB::table('CardFile')->where('TableID', $data['Canvasser'])->get();

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');


            $detail = DB::SELECT(
                'EXEC SP_INV_rptRFQ ?',
                array($the_RFQ[0]->TableID)
            );


            $Supplier_list = [];

            foreach ($detail as $key => $dtl) {

                $sp_find = array_push($Supplier_list, $detail[$key]->Supplier);
            }
            $all_Suppliers = collect($detail)->sortBy('Supplier')->pluck('Supplier');
            $Supplier_list = collect($Supplier_list)->unique();
            $CountX = count($Supplier_list);

            //dd($detail, $theRequest_details);

            $pdf = PDF::loadView('printouts.RFQ_PDF', compact(
                'detail',
                'data',
                'the_RFQ',
                'the_Branch',
                'datenowX',
                'the_Department',
                'the_Canvasser',
                'CountX',
                'all_Suppliers',
                'Supplier_list',
                'theRequest_details'
            ));
            $daFileNeym = "Request_For_Quotation.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 18) {
            //dd($data);
            $the_IAR = DB::table('VW_INV_IAR_Hdr')->where('IARNo', $data['IAR_Nox'])->get();
            $the_IAR2 = DB::table('INV_IAR_Hdr')->where('IARNo', $data['IAR_Nox'])->get();
            $Inspector = DB::table('CardFile')->where('TableID', $the_IAR2[0]->HeadIACID)->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_IAR2[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_INV_rptIAR ?',
                array($the_IAR[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            //dd($detail);

            $printX = 'X';

            $pdf = PDF::loadView('printouts.IAR_Report_PDF', compact(
                'detail',
                'data',
                'the_IAR',
                'the_IAR2',
                'datenowX',
                'the_Branch',
                'Inspector',
                'printX'
            ));
            $daFileNeym = "IAR_Report.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 19) {
            //dd($data);
            $the_RIS = DB::table('VW_INV_Issuance_Hdr')->where('IssuanceNo', $data['RIS_noX'])->get();

            $Approver = DB::table('CardFile')->where('TableID', $data['apby'])->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_RIS[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_INV_rptRIS ?',
                array($the_RIS[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $printX = 'X';

            $pdf = PDF::loadView('printouts.RIS_Report_PDF', compact(
                'detail',
                'data',
                'the_RIS',
                'Approver',
                'datenowX',
                'the_Branch',
                'printX'
            ));
            $daFileNeym = "RISReport.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 20) {
            $BU_slip = DB::table('VW_BGT_BudgetUtilizationSlip_Hdr')->where('SerialNo', $data['BU_Nox'])->get();

            $the_Branch = DB::table('Company')->where('TableID', $BU_slip[0]->BranchID)->get();

            $FundCluster = $data['F_Cluster'];

            $SignatoryA = DB::table('CardFile')->where('TableID', $data['SigA'])->get();
            $SigA_Position = DB::table('Position')->where('TableID', $SignatoryA[0]->PositionID)->get();


            $SignatoryB = DB::table('CardFile')->where('TableID', $data['SigB'])->get();
            $SigB_Position = DB::table('Position')->where('TableID', $SignatoryB[0]->PositionID)->get();

            $detail = DB::SELECT(
                'EXEC SP_BGT_rptOBR ?',
                array($BU_slip[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $T_Amount = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->Amount);
            }

            $printX = 'X';

            $pdf = PDF::loadView('printouts.BU_Report_PDF', compact(
                'detail',
                'data',
                'BU_slip',
                'datenowX',
                'the_Branch',
                'printX',
                'T_Amount',
                'SignatoryA',
                'SignatoryB',
                'FundCluster',
                'SigA_Position',
                'SigB_Position',
                'FundCluster'
            ));
            $daFileNeym = "BU_Report.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 22) {
            $AsOf = $data['TBDate'];
            $FundID = $data['FundID'];
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptTrialBalance ?,?,?',
                array($data['BranchID'], $data['FundID'], $data['TBDate'])
            );

            //dd($detail);

            $pdf = PDF::loadView('pdf_blade.Trial_Balance_PDF', compact('detail', 'AsOf', 'the_Branch', 'FundID'));
            $daFileNeym = "Trial_Balance.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 25) {
            $AsOf = $data['BAYear'];
            $FundID = $data['FundID'];
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptBudgetVsActual ?,?,?',
                array($data['BAYear'], $data['FundID'], $data['BranchID'])
            );

            //dd($detail);

            $pdf = PDF::loadView('pdf_blade.Budget_VS_Actual_PDF', compact('detail', 'AsOf', 'the_Branch', 'FundID'));
            $daFileNeym = "Budget_VS_Actual.pdf";
            return $pdf->download($daFileNeym);
        }
        

        if($data['docType']==26){

            $CV_detail=DB::table('INV_Canvass_Dtl')->where('TableID_Hdr',$data['AoQ_noX'])->get();
            $Supplier_IDs=[];
            foreach ($CV_detail as $key => $cvd) {
                $S_list = array_push($Supplier_IDs, $CV_detail[$key]->SupplierID);
            }

            $bid_colspan=count($CV_detail);
            $Suppliers=DB::table('CardFile')->whereIn('TableID',$Supplier_IDs)->get();
       
            $detail=DB::SELECT('EXEC SP_INV_rptCanvass ?', 
                ARRAY($data['AoQ_noX'])
            );
            $Chairman=DB::table('CardFile')->where('TableID',$data['C_man'])->get();

            $Vice_Chairman=DB::table('CardFile')->where('TableID',$data['VC_man'])->get();

            $Secretary=DB::table('CardFile')->where('TableID',$data['Secretary'])->get();

            $Member1=DB::table('CardFile')->where('TableID',$data['mem1'])->get();

            $Member2=DB::table('CardFile')->where('TableID',$data['mem2'])->get();

            $Member3=DB::table('CardFile')->where('TableID',$data['mem3'])->get();

            $Head_of_Agency=DB::table('CardFile')->where('TableID',$data['HoA'])->get();

            $pdf = PDF::loadView('printouts.AoQ_Report_PDF',compact('detail','Chairman','Vice_Chairman','Secretary',
                                'Member1','Member2','Member3','Head_of_Agency','CV_detail','Suppliers','bid_colspan'))->setPaper('a4', 'landscape');
            $daFileNeym="AoQ_Report.pdf";
            return $pdf->download($daFileNeym);

        }
        if($data['docType']==27){
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');

            $theAPP=DB::table('INV_APP_Hdr')->where('APPNo',$data['APP_Nox'])->get();
            
            $detail=DB::SELECT('EXEC SP_INV_rptAPP ?', 
                ARRAY($theAPP[0]->TableID)
            );
            $ChairSec=DB::table('CardFile')->where('TableID',$data['ChairSec'])->get();

            $ChairInfra=DB::table('CardFile')->where('TableID',$data['ChairInfra'])->get();

            $ChiefAcct=DB::table('CardFile')->where('TableID',$data['ChiefAcct'])->get();

            $VCAF=DB::table('CardFile')->where('TableID',$data['VCAF'])->get();

            $Chancellor=DB::table('CardFile')->where('TableID',$data['Chancellor'])->get();

            $pdf = PDF::loadView('printouts.APP_Infra_PDF',compact('detail','ChairSec','ChairInfra','ChiefAcct',
                                'VCAF','Chancellor','yearnowX'))->setPaper('a4', 'landscape');
            $daFileNeym="APP_Infra_Report.pdf";
            return $pdf->download($daFileNeym);
        }

        if($data['docType']==28){
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');

            $thePPMP=DB::table('BGT_BudgetYearSetup_Hdr')->where('TransactionNo',$data['BUS_Nox'])->get();

            $detail=DB::SELECT('EXEC SP_BGT_rptPPMP ?', 
                ARRAY($thePPMP[0]->TableID)
            );

            $AccountsX = [];

            foreach ($detail as $key => $dtl) {
                $Accounts_list = array_push($AccountsX, $detail[$key]->AccountName);
            }

            $AccountsX_list = collect( $AccountsX )->unique();
            $dataList  = collect( $detail )->groupBy('AccountName');

            $PreparedBy=DB::table('CardFile')->where('TableID',$data['ppmp_PrepBy'])->get();

            $SubmittedBy=DB::table('CardFile')->where('TableID',$data['ppmp_SubBy'])->get();

            $ApprovedBy=DB::table('CardFile')->where('TableID',$data['ppmp_AprvBy'])->get();


            $pdf = PDF::loadView('printouts.PPMP_Infra_PDF',compact('detail','PreparedBy','SubmittedBy','ApprovedBy',
                                 'yearnowX','dataList','AccountsX_list'))->setPaper('a4', 'landscape');
            $daFileNeym="PPMP_Infra_Report.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 24) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptBalanceSheet ?,?,?,?',
                array($data['YearID'], $data['MonthID'], $data['BranchID'], $data['FundID'])
            );

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $pdf = PDF::loadView('printouts.SFPOS_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds'
            ));
            $daFileNeym = "SFPOS.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 25) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptIncomeStatement ?,?,?,?',
                array($data['YearID'], $data['MonthID'], $data['BranchID'], $data['FundID'])
            );

            $pdf = PDF::loadView('printouts.SFPER_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds'
            ));
            $daFileNeym = "SFPER.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 29) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCashDisbursementJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCashDisbursementJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $pdf = PDF::loadView('printouts.CashDJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps'
            ));
            $daFileNeym = "CashDJ.pdf";
            $pdf->set_paper('legal','landscape');
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 30) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCheckDisbursementJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCheckDisbursementJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $pdf = PDF::loadView('printouts.CheckDJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps',
                'previewer'
            ));
            $daFileNeym = "CheckDJ.pdf";
            $pdf->set_paper('legal','landscape');
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 1101) {
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');
            $ordinalX=$datenow->format('jS');
            $FullMonthX=$datenow->format('F');

            $theAR=DB::table('VW_AM_Return_Hdr')->where('ReturnNo',$data['AR_noX'])->get();

            $detail=DB::SELECT('EXEC SP_AM_rptReturn ?', 
                ARRAY($theAR[0]->TableID)
            );

            $Returned_To=DB::table('CardFile')->where('TableID',$data['AR_RT'])->get();

            $Recieved_From=DB::table('CardFile')->where('TableID',$data['AR_RF'])->get();

            $The_Item=DB::table('CardFile')->where('TableID',$data['AR_itd_A'])->get();

            $The_Item2=DB::table('CardFile')->where('TableID',$data['AR_itd_B'])->get();

            //dd($detail);

            $pdf = PDF::loadView('printouts.AR_report_PDF',compact('detail','theAR','Returned_To','Recieved_From',
                                 'The_Item','The_Item2','ordinalX','FullMonthX','yearnowX'));
            $daFileNeym="Asset_Return_Report.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 1102) {
           
            $theRepair=DB::table('VW_AM_Repair_Hdr')->where('RepairNo',$data['Repair_noX'])->get();

            $detail=DB::SELECT('EXEC SP_AM_rptAssetRepair ?', 
                ARRAY($theRepair[0]->TableID)
            );

            $Prepared_by=DB::table('CardFile')->where('TableID',$data['Repair_PB'])->get();
            $Approved_by=DB::table('CardFile')->where('TableID',$data['Repair_AB'])->get();

            $pdf = PDF::loadView('printouts.ARepair_report_PDF',compact('detail','theRepair','Prepared_by','Approved_by'));
            $daFileNeym="Asset_Repair_Report.pdf";
            return $pdf->download($daFileNeym);
        }
        if ($data['docType'] == 1103) {

            $theFund=DB::table('Fund')->where('TableID',$data['SCNAE_F_Cluster'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptSCNAE ?,?', 
                ARRAY($data['SCNAE_year'],$data['SCNAE_F_Cluster'])
            );

            $Prepared_by=DB::table('CardFile')->where('TableID',$data['SCNAE_PB'])->get();
            $Prepared_by_POS=DB::table('Position')->where('TableID',$Prepared_by[0]->PositionID)->get();

            $Certified_by=DB::table('CardFile')->where('TableID',$data['SCNAE_CB'])->get();
            $Certified_POS=DB::table('Position')->where('TableID',$Certified_by[0]->PositionID)->get();

            //dd($data,$detail);

            $RB_Amount=0;
            $CNC_Amount=0;
            $TRR_Amount=0;
            $OtherX_Amount=0;

                foreach ($detail as $key => $dtl) {
                    if($dtl->Group1 == 'Restated Balance'){
                        $RB_Amount += floatval($detail[$key]->Amount);
                    }
                    if($dtl->Group1 == 'Changes in Net Assets/Equity for the Calendar Year'){
                        $CNC_Amount += floatval($detail[$key]->Amount);
                    }
                    if($dtl->Header == 'Others'){
                        $OtherX_Amount += floatval($detail[$key]->Amount);
                    }

                    $TRR_Amount += floatval($detail[$key]->Amount);
                    
                }
            $TBC_Amount = $RB_Amount+$TRR_Amount+$OtherX_Amount;

            $pdf = PDF::loadView('printouts.SCNAE_Report_PDF',compact('detail','data','Prepared_by','Certified_by','theFund',
                                 'Prepared_by_POS','Certified_POS','RB_Amount',
                                 'CNC_Amount','TRR_Amount','OtherX_Amount','TBC_Amount'))->setPaper('a4', 'landscape');
            $daFileNeym="SCNAE_Report.pdf";
            }
        if ($data['docType'] == 40) {
            $AsOf = $data['BAYear'];
            $CategoryID = $data['Category_ID'];
            $CategoryDTL = DB::table('INV_Category')->where('TableID', $CategoryID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_INV_rptPhysicalCount ?,?,?',
                array($data['Category_ID'], $data['BranchID'], $data['BAYear'])
            );

            //dd($detail);

            $pdf = PDF::loadView('pdf_blade.Physical_Count_PDF', compact('detail', 'AsOf', 'the_Branch', 'CategoryID', 'CategoryDTL'));
            $daFileNeym = "Physical_Count.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 1104) {
            if($data['ATS_Rp_Type']==1){
                $From_Date = Carbon::parse($data['ATS_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['ATS_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptAccountsSummary ?,?,?', 
                ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
            );

            $Debit_Total=0;
            $Credit_Total=0;
            $Balance_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Debit_Total += floatval($detail[$key]->Debit);
                    $Credit_Total += floatval($detail[$key]->Credit);
                    $Balance_Total += floatval($detail[$key]->Balance);
                    
                }

            $pdf = PDF::loadView('printouts.ATS_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                                 'Debit_Total','Credit_Total','Balance_Total'));
            $daFileNeym="Account_Transaction_Summary_Report.pdf";
            return $pdf->download($daFileNeym);
            }

            if($data['ATS_Rp_Type']==2){
                $From_Date = Carbon::parse($data['ATS_From']);
                $From_smalldate = $From_Date->format('M d, Y');

                $To_Date = Carbon::parse($data['ATS_To']);
                $To_smalldate = $To_Date->format('M d, Y');

                $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

                $detail=DB::SELECT('EXEC SP_ACC_rptAccountsDetailed ?,?,?', 
                    ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
                );

                $Debit_Total=0;
                $Credit_Total=0;

                    foreach ($detail as $key => $dtl) {

                        $Debit_Total += floatval($detail[$key]->Debit);
                        $Credit_Total += floatval($detail[$key]->Credit);
                        
                    }

                $pdf = PDF::loadView('printouts.ATD_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                                    'Debit_Total','Credit_Total'))->setPaper('a4', 'landscape');
                $daFileNeym="Account_Transaction_Summary_Report.pdf";
                return $pdf->download($daFileNeym);
            }
            
        }

        if ($data['docType'] == 1105) {
            $From_Date = Carbon::parse($data['ATS_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['ATS_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptAccountsDetailed ?,?,?', 
                ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
            );

            $Debit_Total=0;
            $Credit_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Debit_Total += floatval($detail[$key]->Debit);
                    $Credit_Total += floatval($detail[$key]->Credit);
                    
                }

            $pdf = PDF::loadView('printouts.ATD_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                                 'Debit_Total','Credit_Total'))->setPaper('a4', 'landscape');
            $daFileNeym="Account_Transaction_Summary_Report.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 1106) {
            $the_BankR = DB::table('VW_ACC_BankReconciliation_Hdr')->where('TransactionNo', $data['BankR_noX'])->get();
            $the_Branch = DB::table('Company')->where('TableID', $the_BankR[0]->BranchID)->get();

            $Prep_by = DB::table('VW_SYS_CardFile')->where('TableID', $data['BankRX_PrepBy'])->get();
            $Cert_by = DB::table('VW_SYS_CardFile')->where('TableID', $data['BankRX_CertBy'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptBankRecon ?', 
                ARRAY($the_BankR[0]->TableID)
            );

            $Agency_Total=0;
            $Bank_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Agency_Total += floatval($detail[$key]->Agency);
                    $Bank_Total += floatval($detail[$key]->Bank);
                    
                }


            $pdf = PDF::loadView('printouts.BankR_Report_PDF',compact('detail','the_BankR','the_Branch','Prep_by',
                                 'Cert_by','Agency_Total','Bank_Total'));
            $daFileNeym="Bank_Reconciliation_Report.pdf";
            return $pdf->download($daFileNeym);
        }

        if ($data['docType'] == 41) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCashReceiptJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCashReceiptJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $pdf = PDF::loadView('printouts.CashRJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps'
            ));
            $daFileNeym = "CashJ.pdf";
            return $pdf->download($daFileNeym);
        }
    }

    public function viewPDF(Request $request)
    {
        $data = request()->all();
        $previewer = 1;

        if ($data['docType'] == 1) {
            $AsOf = $data['AsOf'];

            $detail = DB::SELECT(
                'EXEC SP_DB_rptAgingPayables ?,?',
                array($data['BranchID'], $data['PayeeID'])
            );

            //dd($detail);

            return view('pdf_blade/aging_payables_PDF', compact('detail', 'AsOf', 'previewer'));
        }

        if ($data['docType'] == 2) {
            $From_Date = Carbon::parse($data['Acc_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['Acc_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptAccountsPayableVoucher_Summary ?,?,?,?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'], $data['DepartmentID'], $data['SectionID'], $data['Status'])
            );

            //dd($detail,$data);
            return view('pdf_blade/accounts_payable_summary_PDF', compact('detail', 'data', 'previewer'));
        }

        if ($data['docType'] == 3) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCancelledChecks ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            //dd($detail,$data);

            return view('pdf_blade/cancelled_checks_PDF', compact('detail', 'data', 'previewer'));
        }

        if ($data['docType'] == 4) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckDisbursed ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            //dd($detail,$data);

            return view('pdf_blade/disbursed_checks_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate', 'previewer'));
        }
        if ($data['docType'] == 5) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');
            $T_Ammount = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckIssued ?,?,?,?',
                array($From_smalldate, $To_smalldate, $data['BankID'], $data['BranchID'])
            );

            foreach ($detail as $key => $dtl) {
                $T_Ammount += floatval($detail[$key]->Amount);
            }

            //dd($From_smalldate,$To_smalldate,$detail,$data);

            return view('pdf_blade/checks_issued_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate', 'T_Ammount', 'previewer'));
        }
        if ($data['docType'] == 6) {
            $From_Date = Carbon::parse($data['CX_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['CX_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $detail = DB::SELECT(
                'EXEC SP_DB_rptChecksOnHand ?,?,?',
                array($From_smalldate, $To_smalldate, $data['BranchID'])
            );

            // dd($detail,$data);

            return view('pdf_blade/checks_on_hand_PDF', compact('detail', 'data', 'From_smalldate', 'To_smalldate', 'previewer'));
        }
        if ($data['docType'] == 7) {
            $T_Debit = 0;
            $T_Credit = 0;
            $TableID = DB::table('ACC_JournalEntryVoucher_Hdr')->where('JournalNo', $data['J_noX2'])->pluck('TableID');;

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptJournalEntryVoucher ?',
                array($TableID[0])
            );

            $rowspan = count($detail);
            foreach ($detail as $key => $dtl) {
                $T_Debit += floatval($detail[$key]->Debit);
                $T_Credit += floatval($detail[$key]->Credit);
            }


            //dd($detail,$data, $T_Debit, $T_Credit);
            return view('printouts.journal_entry_voucher_PDF', compact('detail', 'data', 'T_Debit', 'T_Credit', 'rowspan', 'previewer'));
        }
        if ($data['docType'] == 8) {
            $TableID = DB::table('DB_DisbursementVoucher_Hdr')->where('VoucherNo', $data['DV_noX2'])->pluck('TableID');
            $Amount_Due = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptDisbursementVoucher ?',
                array($TableID[0])
            );

            $rowspan = count($detail);
            foreach ($detail as $key => $dtl) {
                $Amount_Due += floatval($detail[$key]->VoucherAmount);
            }

            //dd($detail,$data);
            return view('printouts.disbursement_voucher_PDF', compact('detail', 'data', 'Amount_Due', 'rowspan', 'previewer'));
        }
        if ($data['docType'] == 9) {
            $Check_Date = Carbon::parse($data['Check_Date']);
            $Check_Date_smalldate = $Check_Date->format('M d, Y');
            $the_Bank = DB::table('Bank')->where('TableID', $data['BankID'])->get();
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $T_Amount = 0;

            $detail = DB::SELECT(
                'EXEC SP_DB_rptCheckIssuedCancelled ?,?,?',
                array($data['BankID'], $data['BranchID'], $Check_Date_smalldate)
            );

            $total_no_of_checks = count($detail);
            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->Amount);
            }

            $in_words = PDFController::convert_number_to_words($T_Amount);

            //dd($detail,$data,$the_Bank,$the_Branch,$in_words);

            return view('pdf_blade/ADV_Checks_PDF', compact('detail', 'data', 'the_Bank', 'the_Branch', 'T_Amount', 'total_no_of_checks', 'in_words', 'previewer'));
        }
        if ($data['docType'] == 10) {
            $TableHdr = DB::table('VW_INV_PurchaseRequest_Hdr')->where('RequestNo', $data['PR_noX2'])->get();
            $TableID = $TableHdr[0]->TableID;

            $detail = DB::table('VW_INV_PurchaseRequest_Dtl')->where('TableID_Hdr', $TableID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $TableHdr[0]->BranchID)->get();
            $the_Section = DB::table('Section')->where('TableID', $TableHdr[0]->SectionID)->get();

            $T_Amount = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->TotalCost);
            }

            $Requester = DB::table('VW_SYS_CardFile')->where('TableID', $data['rq_b'])->get();
            $Approver = DB::table('VW_SYS_CardFile')->where('TableID', $data['ap_b'])->get();

            //dd($detail,$data,$TableHdr,$T_Amount);

            return view('printouts.purhcase_request_PDF', compact('TableHdr', 'detail', 'data', 'the_Branch', 'T_Amount', 'the_Section', 'Requester', 'Approver', 'previewer'));
        }
        if ($data['docType'] == 11) {
            $TableHdr = DB::table('VW_INV_PurchaseOrder_Hdr')->where('PurchaseOrderNo', $data['PO_noX2'])->get();
            //dd($TableHdr);
            $TableID = $TableHdr[0]->TableID;

            $detail = DB::table('INV_PurchaseOrder_Dtl')->where('TableID_Hdr', $TableID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $TableHdr[0]->BranchID)->get();
            $the_Supplier = DB::table('CardFile')->where('TableID', $TableHdr[0]->SupplierID)->get();

            $ConformeX = DB::table('VW_SYS_CardFile')->where('TableID', $data['conforme_a2'])->get();
            $VTY = DB::table('VW_SYS_CardFile')->where('TableID', $data['vty_a2'])->get();
            $RQOD = DB::table('VW_SYS_CardFile')->where('TableID', $data['rqod_a2'])->get();
            $CA_x = DB::table('VW_SYS_CardFile')->where('TableID', $data['ca_a2'])->get();

            $Place_Of_Delivery = $data['PDx2'];
            $Delivery_Term = $data['DTx2'];
            $Payment_Term = $data['PTx2'];

            $theTable2 = DB::table('INV_PurchaseOrder_Hdr')->where('PurchaseOrderNo', $data['PO_noX2'])->get();
            $theCanvas = "";
            $theQuote = "";
            $theRequest = "";



            if ($theTable2[0]->CanvassID != NULL || $theTable2[0]->CanvassID != "" || $theTable2[0]->CanvassID != []) {
                $theCanvass = DB::table('INV_Canvass_Hdr')->where('TableID', $theTable2[0]->CanvassID)->get();
                $theQuote = DB::table('INV_Quotation_Hdr')->where('TableID', $theCanvass[0]->QuotationID)->get();
                $theRequest = DB::table('INV_PurchaseRequest_Hdr')->where('TableID', $theQuote[0]->RequestID)->get();
                $theMoP = DB::table('ModeofProcurement')->where('TableID', $theRequest[0]->Mode_of_Procurement_ID)->get();
            }

            $T_Amount = 0;
            $item_ids = [];
            $uom_ids = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->TotalAmount);

                $get_this_UOM = array_push($uom_ids, $detail[$key]->UOMID);
                $get_this_Item = array_push($item_ids, $detail[$key]->ItemID);
            }

            $UOM = DB::table('UnitofMeasure')->whereIn('TableID', $uom_ids)->get();
            $ItemZ = DB::table('INV_Item')->whereIn('TableID', $item_ids)->get();

            $in_words = PDFController::convert_number_to_words($T_Amount);

            //dd($UOM,$ItemZ,$T_Amount);

            return view('printouts.purchase_order_PDF', compact(
                'TableHdr',
                'detail',
                'data',
                'the_Branch',
                'T_Amount',
                'UOM',
                'ItemZ',
                'in_words',
                'the_Supplier',
                'ConformeX',
                'VTY',
                'RQOD',
                'CA_x',
                'Place_Of_Delivery',
                'Delivery_Term',
                'Payment_Term',
                'theMoP',
                'previewer'
            ));
        }

        if ($data['docType'] == 12) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptGeneralJournal ?,?,?,?',
                array($data['MonthID'], $data['Year'], $data['BranchID'], $data['FundID'])
            );

            $fund_cluster = DB::table('Fund')->WHERE('TableID', $data['FundID'])->get();

            if ($data['MonthID'] == 1) {
                $monthX = "January";
            }
            if ($data['MonthID'] == 2) {
                $monthX = "February";
            }
            if ($data['MonthID'] == 3) {
                $monthX = "March";
            }
            if ($data['MonthID'] == 4) {
                $monthX = "April";
            }
            if ($data['MonthID'] == 5) {
                $monthX = "May";
            }
            if ($data['MonthID'] == 6) {
                $monthX = "June";
            }
            if ($data['MonthID'] == 7) {
                $monthX = "July";
            }
            if ($data['MonthID'] == 8) {
                $monthX = "August";
            }
            if ($data['MonthID'] == 9) {
                $monthX = "September";
            }
            if ($data['MonthID'] == 10) {
                $monthX = "October";
            }
            if ($data['MonthID'] == 11) {
                $monthX = "November";
            }
            if ($data['MonthID'] == 12) {
                $monthX = "December";
            }

            //dd($detail);

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            return view('printouts.G_Journal_PDF', compact('detail', 'data', 'monthX', 'the_Branch', 'T_Amount_C', 'T_Amount_D', 'previewer','fund_cluster'));
        }

        if ($data['docType'] == 13) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptGeneralLedger ?,?,?',
                array($data['AccountID'], $data['BranchID'],$data['FundID'])
            );
            // dd($detail);

            $fund_cluster = DB::table('Fund')->WHERE('TableID', $data['FundID'])->get();
            $Acc_details = DB::table('VW_ACC_Accounts')->where('TableID', $data['AccountID'])->get();

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            $T_Amount_B = 0;
            $Balances = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount_B += floatval($detail[$key]->Debit);
                $T_Amount_B -= floatval($detail[$key]->Credit);

                array_push($Balances, $T_Amount_B);
            }

            return view('printouts.G_Ledger_PDF', compact(
                'detail',
                'data',
                'the_Branch',
                'T_Amount_C',
                'T_Amount_D',
                'Acc_details',
                'T_Amount_B',
                'Balances',
                'previewer',
                'fund_cluster'
            ));
        }

        if ($data['docType'] == 14) {
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();

            $detail = DB::SELECT(
                'EXEC SP_ACC_rptSubsidiaryLedger ?,?',
                array($data['CardID'], $data['BranchID'])
            );

            $Acc_details = DB::table('CardFile')->where('TableID', $data['CardID'])->get();

            $T_Amount_C = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_C += floatval($detail[$key]->Credit);
            }

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Debit);
            }

            $T_Amount_B = 0;
            $Balances = [];

            foreach ($detail as $key => $dtl) {
                $T_Amount_B += floatval($detail[$key]->Debit);
                $T_Amount_B -= floatval($detail[$key]->Credit);

                array_push($Balances, $T_Amount_B);
            }

            return view('printouts.S_Ledger_PDF', compact(
                'detail',
                'data',
                'the_Branch',
                'T_Amount_C',
                'T_Amount_D',
                'Acc_details',
                'T_Amount_B',
                'Balances',
                'previewer'
            ));
        }

        if ($data['docType'] == 15) {
            $the_AssetIssuance = DB::table('VW_AM_Issuance_Hdr')->where('IssuanceNo', $data['AI_noX2'])->get();
            $Recieved_By = DB::table('VW_SYS_CardFile')->where('TableID', $data['rc_b2'])->get();
            $Recieved_From = DB::table('VW_SYS_CardFile')->where('TableID', $data['rc_f2'])->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_AssetIssuance[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_AM_rptARE ?',
                array($the_AssetIssuance[0]->TableID)
            );

            //dd($data, $the_AssetIssuance, $detail, $Recieved_By, $Recieved_From, $the_Branch);
            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');
            //dd($datenowX);

            return view('printouts.A_Issuance_PDF', compact(
                'detail',
                'data',
                'the_AssetIssuance',
                'Recieved_By',
                'Recieved_From',
                'the_Branch',
                'datenowX',
                'previewer'
            ));
        }

        if ($data['docType'] == 16) {
            $the_AssetDisposal = DB::table('VW_AM_Disposal_Hdr')->where('DisposalNo', $data['AD_noX2'])->get();

            $CertifiedCorrect = DB::table('VW_SYS_CardFile')->where('TableID', $data['ccX2'])->get();
            $DisposalApproved = DB::table('VW_SYS_CardFile')->where('TableID', $data['daX2'])->get();
            $WitnessToDisposal = DB::table('VW_SYS_CardFile')->where('TableID', $data['wtd2'])->get();

            $detail = DB::SELECT(
                'EXEC SP_AM_rptDisposal ?',
                array($the_AssetDisposal[0]->TableID)
            );

            //dd($data,$the_AssetDisposal,$detail,$CertifiedCorrect,$DisposalApproved,$WitnessToDisposal );
            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $T_Amount_D = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount_D += floatval($detail[$key]->Amount);
            }

            return view('printouts.A_Disposal_PDF', compact(
                'detail',
                'data',
                'the_AssetDisposal',
                'DisposalApproved',
                'datenowX',
                'T_Amount_D',
                'previewer'
            ));
        }

        if ($data['docType'] == 17) {
            $the_RFQ = DB::table('VW_INV_Quotation_Hdr')->where('QuotationNo', $data['RQ_noX2'])->get();
            $theRequest = DB::table('VW_INV_PurchaseRequest_Hdr')->where('RequestNo', $the_RFQ[0]->RequestNo)->get();
            $theRequest_details = DB::table('VW_INV_PurchaseRequest_Dtl')->where('TableID_HDR', $theRequest[0]->TableID)->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_RFQ[0]->BranchID)->get();
            $the_Department = DB::table('Department')->where('TableID', $the_RFQ[0]->DepartmentID)->get();
            $the_Canvasser = DB::table('CardFile')->where('TableID', $data['Canvasser2'])->get();

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');


            $detail = DB::SELECT(
                'EXEC SP_INV_rptRFQ ?',
                array($the_RFQ[0]->TableID)
            );


            $Supplier_list = [];

            foreach ($detail as $key => $dtl) {

                $sp_find = array_push($Supplier_list, $detail[$key]->Supplier);
            }
            $all_Suppliers = collect($detail)->sortBy('Supplier')->pluck('Supplier');
            $Supplier_list = collect($Supplier_list)->unique();
            $CountX = count($Supplier_list);
            //dd($all_Suppliers);   

            return view('printouts.RFQ_PDF', compact(
                'detail',
                'data',
                'the_RFQ',
                'the_Branch',
                'datenowX',
                'the_Department',
                'the_Canvasser',
                'previewer',
                'CountX',
                'all_Suppliers',
                'Supplier_list',
                'theRequest_details'
            ));
        }

        if ($data['docType'] == 18) {
            //dd($data);
            $the_IAR = DB::table('VW_INV_IAR_Hdr')->where('IARNo', $data['IAR_Nox2'])->get();
            $the_IAR2 = DB::table('INV_IAR_Hdr')->where('IARNo', $data['IAR_Nox2'])->get();
            $Inspector = DB::table('CardFile')->where('TableID', $the_IAR2[0]->HeadIACID)->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_IAR2[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_INV_rptIAR ?',
                array($the_IAR[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            //dd($detail);

            $printX = 'X';

            return view('printouts.IAR_Report_PDF', compact(
                'detail',
                'data',
                'the_IAR',
                'the_IAR2',
                'datenowX',
                'the_Branch',
                'Inspector',
                'printX',
                'previewer'
            ));
        }

        if ($data['docType'] == 19) {
            //dd($data);
            $the_RIS2 = DB::table('VW_INV_Issuance_Hdr')->where('IssuanceNo', $data['RIS_noX2'])->get();
            //dd($the_RIS2);

            $Approver = DB::table('CardFile')->where('TableID', $data['apby2'])->get();

            $the_Branch = DB::table('Company')->where('TableID', $the_RIS2[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_INV_rptRIS ?',
                array($the_RIS2[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $printX = 'X';

            return view('printouts.RIS_Report_PDF', compact(
                'detail',
                'data',
                'the_RIS2',
                'Approver',
                'datenowX',
                'the_Branch',
                'printX',
                'previewer'
            ));
        }

        if ($data['docType'] == 20) {
            $BU_slip = DB::table('VW_BGT_BudgetUtilizationSlip_Hdr')->where('SerialNo', $data['BU_Nox2'])->get();

            $FundCluster = $data['F_Cluster2'];

            $SignatoryA = DB::table('CardFile')->where('TableID', $data['SigA2'])->get();
            $SigA_Position = DB::table('Position')->where('TableID', $SignatoryA[0]->PositionID)->get();


            $SignatoryB = DB::table('CardFile')->where('TableID', $data['SigB2'])->get();
            $SigB_Position = DB::table('Position')->where('TableID', $SignatoryB[0]->PositionID)->get();

            $the_Branch = DB::table('Company')->where('TableID', $BU_slip[0]->BranchID)->get();

            $detail = DB::SELECT(
                'EXEC SP_BGT_rptOBR ?',
                array($BU_slip[0]->TableID)
            );

            $datenow = Carbon::now();
            $datenowX = $datenow->format('M d, Y');

            $T_Amount = 0;

            foreach ($detail as $key => $dtl) {
                $T_Amount += floatval($detail[$key]->Amount);
            }

            $printX = 'X';

            return view('printouts.BU_Report_PDF', compact(
                'detail',
                'data',
                'BU_slip',
                'datenowX',
                'the_Branch',
                'printX',
                'T_Amount',
                'previewer',
                'SignatoryA',
                'SignatoryB',
                'FundCluster',
                'SigA_Position',
                'SigB_Position',
                'FundCluster'
            ));
        }
        if ($data['docType'] == 22) {
            $AsOf = $data['TBDate'];
            $FundID = $data['FundID'];
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptTrialBalance ?,?,?',
                array($data['BranchID'], $data['FundID'], $data['TBDate'])
            );


            return view('pdf_blade.Trial_Balance_PDF', compact('detail', 'AsOf', 'FundID', 'the_Branch', 'previewer'));
        }

        if($data['docType']==21){

            $FundCluster=$data['F_Cluster'];

            $detail=DB::SELECT('EXEC SP_INV_rptStockCard ?,?', 
                ARRAY($data['BranchID_SC'],$data['ItemID_SC'])
            );

            // if(count($detail)<1){
            //     return redirect('/home')->with('alert', 'no records found for this item');   
            // }

            return view('printouts.SC_Report_PDF',compact('FundCluster','previewer','detail'));
        }

        if($data['docType']==26){

            $CV_detail=DB::table('INV_Canvass_Dtl')->where('TableID_Hdr',$data['AoQ_noX2'])->get();
            $Supplier_IDs=[];
            foreach ($CV_detail as $key => $cvd) {
                $S_list = array_push($Supplier_IDs, $CV_detail[$key]->SupplierID);
            }
            
            $bid_colspan=count($CV_detail);
            $Suppliers=DB::table('CardFile')->whereIn('TableID',$Supplier_IDs)->get();
       
            $detail=DB::SELECT('EXEC SP_INV_rptCanvass ?', 
                ARRAY($data['AoQ_noX2'])
            );

            $Chairman=DB::table('CardFile')->where('TableID',$data['C_man2'])->get();

            $Vice_Chairman=DB::table('CardFile')->where('TableID',$data['VC_man2'])->get();

            $Secretary=DB::table('CardFile')->where('TableID',$data['Secretary2'])->get();

            $Member1=DB::table('CardFile')->where('TableID',$data['mem1B'])->get();

            $Member2=DB::table('CardFile')->where('TableID',$data['mem2B'])->get();

            $Member3=DB::table('CardFile')->where('TableID',$data['mem3B'])->get();

            $Head_of_Agency=DB::table('CardFile')->where('TableID',$data['HoA2'])->get();

            return view('printouts.AoQ_Report_PDF',compact('detail','Chairman','Vice_Chairman','Secretary',
                        'Member1','Member2','Member3','Head_of_Agency','previewer','CV_detail','bid_colspan','Suppliers'));
        }

        if($data['docType']==27){
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');

            $theAPP=DB::table('INV_APP_Hdr')->where('APPNo',$data['APP_Nox2'])->get();

            $detail=DB::SELECT('EXEC SP_INV_rptAPP ?', 
                ARRAY($theAPP[0]->TableID)
            );

            $ChairSec=DB::table('CardFile')->where('TableID',$data['ChairSec2'])->get();

            $ChairInfra=DB::table('CardFile')->where('TableID',$data['ChairInfra2'])->get();

            $ChiefAcct=DB::table('CardFile')->where('TableID',$data['ChiefAcct2'])->get();

            $VCAF=DB::table('CardFile')->where('TableID',$data['VCAF2'])->get();

            $Chancellor=DB::table('CardFile')->where('TableID',$data['Chancellor2'])->get();

            return view('printouts.APP_Infra_PDF',compact('detail','ChairSec','ChairInfra','ChiefAcct',
                         'VCAF','Chancellor','yearnowX','previewer'));
         
        }

        if($data['docType']==28){
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');

            $thePPMP=DB::table('BGT_BudgetYearSetup_Hdr')->where('TransactionNo',$data['BUS_Nox2'])->get();

            $detail=DB::SELECT('EXEC SP_BGT_rptPPMP ?', 
                ARRAY($thePPMP[0]->TableID)
            );

            $AccountsX = [];

            foreach ($detail as $key => $dtl) {
                $Accounts_list = array_push($AccountsX, $detail[$key]->AccountName);
            }

            $AccountsX_list = collect( $AccountsX )->unique();
            $dataList  = collect( $detail )->groupBy('AccountName');

            $PreparedBy=DB::table('CardFile')->where('TableID',$data['ppmp_PrepBy2'])->get();

            $SubmittedBy=DB::table('CardFile')->where('TableID',$data['ppmp_SubBy2'])->get();

            $ApprovedBy=DB::table('CardFile')->where('TableID',$data['ppmp_AprvBy2'])->get();

            return view('printouts.PPMP_Infra_PDF',compact('detail','PreparedBy','SubmittedBy','ApprovedBy',
                        'yearnowX','previewer','dataList','AccountsX_list'));
        }

        if ($data['docType'] == 25) {
            $AsOf = $data['BAYear'];
            $FundID = $data['FundID'];
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_ACC_rptBudgetVsActual ?,?,?',
                array($data['BAYear'], $data['FundID'], $data['BranchID'])
            );


            return view('pdf_blade.Budget_VS_Actual_PDF', compact('detail', 'AsOf', 'FundID', 'the_Branch', 'previewer'));
        }

        if ($data['docType'] == 24) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptBalanceSheet ?,?,?,?',
                array($data['YearID'], $data['MonthID'], $data['BranchID'], $data['FundID'])
            );

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            return view('printouts.SFPOS_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'previewer'
            ));
        }

        if ($data['docType'] == 25) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptIncomeStatement ?,?,?,?',
                array($data['YearID'], $data['MonthID'], $data['BranchID'], $data['FundID'])
            );

            return view('printouts.SFPER_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'previewer'
            ));
        }

        if ($data['docType'] == 29) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCashDisbursementJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCashDisbursementJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            return view('printouts.CashDJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps',
                'previewer'
            ));
        }

        if ($data['docType'] == 30) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCheckDisbursementJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCheckDisbursementJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            return view('printouts.CheckDJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps',
                'previewer'
            ));
        }

        if ($data['docType'] == 1101) {
            $datenow=Carbon::now();
            $datenowX=$datenow->format('M d, Y');
            $yearnowX=$datenow->format('Y');
            $ordinalX=$datenow->format('jS');
            $FullMonthX=$datenow->format('F');

            $theAR=DB::table('VW_AM_Return_Hdr')->where('ReturnNo',$data['AR_noX2'])->get();

            $detail=DB::SELECT('EXEC SP_AM_rptReturn ?', 
                ARRAY($theAR[0]->TableID)
            );

            $Returned_To=DB::table('CardFile')->where('TableID',$data['AR_RT2'])->get();

            $Recieved_From=DB::table('CardFile')->where('TableID',$data['AR_RF2'])->get();

            $The_Item=DB::table('CardFile')->where('TableID',$data['AR_itd_A2'])->get();

            $The_Item2=DB::table('CardFile')->where('TableID',$data['AR_itd_B2'])->get();

            //dd($detail);

            return view('printouts.AR_report_PDF', compact('detail','theAR','Returned_To','Recieved_From',
                            'The_Item','The_Item2','ordinalX','FullMonthX','yearnowX','previewer'));
        }

        if ($data['docType'] == 1102) {
           
            $theRepair=DB::table('VW_AM_Repair_Hdr')->where('RepairNo',$data['Repair_noX2'])->get();

            $detail=DB::SELECT('EXEC SP_AM_rptAssetRepair ?', 
                ARRAY($theRepair[0]->TableID)
            );

            $Prepared_by=DB::table('CardFile')->where('TableID',$data['Repair_PB2'])->get();
            $Approved_by=DB::table('CardFile')->where('TableID',$data['Repair_AB2'])->get();


            return view('printouts.ARepair_report_PDF',compact('detail','theRepair','Prepared_by','Approved_by','previewer'));
        }

        if ($data['docType'] == 1103) {

            $theFund=DB::table('Fund')->where('TableID',$data['SCNAE_F_Cluster'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptSCNAE ?,?', 
                ARRAY($data['SCNAE_year'],$data['SCNAE_F_Cluster'])
            );

            $Prepared_by=DB::table('CardFile')->where('TableID',$data['SCNAE_PB'])->get();
            $Prepared_by_POS=DB::table('Position')->where('TableID',$Prepared_by[0]->PositionID)->get();

            $Certified_by=DB::table('CardFile')->where('TableID',$data['SCNAE_CB'])->get();
            $Certified_POS=DB::table('Position')->where('TableID',$Certified_by[0]->PositionID)->get();

            //dd($data,$detail);

            $RB_Amount=0;
            $CNC_Amount=0;
            $TRR_Amount=0;
            $OtherX_Amount=0;

                foreach ($detail as $key => $dtl) {
                    if($dtl->Group1 == 'Restated Balance'){
                        $RB_Amount += floatval($detail[$key]->Amount);
                    }
                    if($dtl->Group1 == 'Changes in Net Assets/Equity for the Calendar Year'){
                        $CNC_Amount += floatval($detail[$key]->Amount);
                    }
                    if($dtl->Header == 'Others'){
                        $OtherX_Amount += floatval($detail[$key]->Amount);
                    }

                    $TRR_Amount += floatval($detail[$key]->Amount);
                    
                }
            $TBC_Amount = $RB_Amount+$TRR_Amount+$OtherX_Amount;


            return view('printouts.SCNAE_Report_PDF',compact('detail','data','Prepared_by','Certified_by','theFund',
                            'Prepared_by_POS','Certified_POS','previewer',
                            'RB_Amount','CNC_Amount','TRR_Amount','OtherX_Amount','TBC_Amount'));
            }
            
        if ($data['docType'] == 40) {
            $AsOf = $data['BAYear'];
            $Category_ID = $data['Category_ID'];
            $CategoryDTL = DB::table('INV_Category')->where('TableID', $Category_ID)->get();
            $the_Branch = DB::table('Company')->where('TableID', $data['BranchID'])->get();
            $detail = DB::SELECT(
                'EXEC SP_INV_rptPhysicalCount ?,?,?',
                array($data['Category_ID'], $data['BranchID'], $data['BAYear'] )
            );


            return view('pdf_blade.Physical_Count_PDF', compact('detail', 'AsOf', 'Category_ID', 'the_Branch', 'CategoryDTL', 'previewer'));
        }

        if ($data['docType'] == 1104) {
            if($data['ATS_Rp_Type']==1){
                $From_Date = Carbon::parse($data['ATS_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['ATS_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptAccountsSummary ?,?,?', 
                ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
            );

            $Debit_Total=0;
            $Credit_Total=0;
            $Balance_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Debit_Total += floatval($detail[$key]->Debit);
                    $Credit_Total += floatval($detail[$key]->Credit);
                    $Balance_Total += floatval($detail[$key]->Balance);
                    
                }

            return view('printouts.ATS_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                        'Debit_Total','Credit_Total','Balance_Total','previewer'));
            }
        
            if($data['ATS_Rp_Type']==2){
                $From_Date = Carbon::parse($data['ATS_From']);
                $From_smalldate = $From_Date->format('M d, Y');

                $To_Date = Carbon::parse($data['ATS_To']);
                $To_smalldate = $To_Date->format('M d, Y');

                $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

                $detail=DB::SELECT('EXEC SP_ACC_rptAccountsDetailed ?,?,?', 
                    ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
                );
//dd($detail);
                $group_dtl= collect($detail)->sortBy('AccountNo');
 //dd($group_dtl);
                $Debit_Total=0;
                $Credit_Total=0;

                    foreach ($group_dtl as $key => $dtl) {

                        $Debit_Total += floatval($group_dtl[$key]->Debit);
                        $Credit_Total += floatval($group_dtl[$key]->Credit);
                        
                    }

                return view('printouts.ATD_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                            'Debit_Total','Credit_Total','group_dtl','previewer'));
            }
            
        }

        if ($data['docType'] == 1105) {
            $From_Date = Carbon::parse($data['ATS_From']);
            $From_smalldate = $From_Date->format('M d, Y');

            $To_Date = Carbon::parse($data['ATS_To']);
            $To_smalldate = $To_Date->format('M d, Y');

            $the_Branch = DB::table('Company')->where('TableID', $data['ATS_BranchID'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptAccountsDetailed ?,?,?', 
                ARRAY($From_smalldate,$To_smalldate,$data['ATS_BranchID'])
            );

            $Debit_Total=0;
            $Credit_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Debit_Total += floatval($detail[$key]->Debit);
                    $Credit_Total += floatval($detail[$key]->Credit);
                    
                }

            return view('printouts.ATD_Report_PDF',compact('detail','the_Branch','From_Date','To_Date',
                        'Debit_Total','Credit_Total','previewer'));
        }

        if ($data['docType'] == 1106) {
            $the_BankR = DB::table('VW_ACC_BankReconciliation_Hdr')->where('TransactionNo', $data['BankR_noX2'])->get();
            $the_Branch = DB::table('Company')->where('TableID', $the_BankR[0]->BranchID)->get();

            $Prep_by = DB::table('VW_SYS_CardFile')->where('TableID', $data['BankRX_PrepBy2'])->get();
            $Cert_by = DB::table('VW_SYS_CardFile')->where('TableID', $data['BankRX_CertBy2'])->get();

            $detail=DB::SELECT('EXEC SP_ACC_rptBankRecon ?', 
                ARRAY($the_BankR[0]->TableID)
            );

            $Agency_Total=0;
            $Bank_Total=0;

                foreach ($detail as $key => $dtl) {

                    $Agency_Total += floatval($detail[$key]->Agency);
                    $Bank_Total += floatval($detail[$key]->Bank);
                    
                }

            return view('printouts.BankR_Report_PDF',compact('detail','the_BankR','the_Branch','Prep_by',
            'Cert_by','Agency_Total','Bank_Total','previewer'));
        }

        if ($data['docType'] == 41) {

            $request->validate([
                'YearID' => 'required',
                'MonthID' => 'required',
                'BranchID' => 'required',
                'FundID' => 'required',
            ]);

            $year = $data['YearID'];
            $month = date("F", mktime(0, 0, 0, $data['MonthID'], 10));
            $branch = DB::table('Company')->where('TableID', $data['BranchID'])->distinct()->get();

            $funds =  DB::table('Fund')
                ->SELECT(DB::RAW('Fund,TableID'))
                ->WHERE('TableID', $data['FundID'])
                ->ORDERBY('Fund')
                ->get();

            $details = DB::SELECT(
                'EXEC SP_ACC_rptCashReceiptJournal ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            $recaps = DB::SELECT(
                'EXEC SP_ACC_rptCashReceiptJournal_Recapitulation ?,?,?,?',
                array($data['BranchID'], $data['FundID'], $data['MonthID'], $data['YearID'])
            );

            return view('printouts.CashRJ_report', compact(
                'details',
                'branch',
                'year',
                'month',
                'funds',
                'recaps',
                'previewer'
            ));
        }
    }
    
}