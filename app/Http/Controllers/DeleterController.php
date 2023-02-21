<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DeleterController extends Controller
{
    // Delete
    public function del_rec(Request $request)
    {
        $data = request()->all();

        $table_ref='';

        //BINS
        if($data['del_ident']==1) {$table_ref='maintenance_bins_unit_of_measure'; $columnX='Unit_of_Measure_ID';}
        if($data['del_ident']==2) {$table_ref='maintenance_bins_borrowed_equipment_status'; $columnX='Borrowed_Equipment_Status_ID';}
        if($data['del_ident']==3) {$table_ref='maintenance_bins_item_classification'; $columnX='Item_Classification_ID';}
        if($data['del_ident']==4) {$table_ref='maintenance_bins_item_status'; $columnX='Item_Status_ID';}
        if($data['del_ident']==5) {$table_ref='maintenance_bins_item_category'; $columnX='Item_Category_ID';} 
        if($data['del_ident']==6) {$table_ref='bins_inventory_begbal'; $columnX='Inventory_BegBal_ID';}
        if($data['del_ident']==7) {$table_ref='bins_item_inspection'; $columnX='Item_Inspection_ID';}
        if($data['del_ident']==8) {$table_ref='bins_received_item';  $columnX='Received_Item_ID';}
        if($data['del_ident']==9) {$table_ref='bins_physical_count'; $columnX='Physical_Count_ID';}
        if($data['del_ident']==10){$table_ref='bins_inventory_for_disposal'; $columnX='Disposal_Inventory_ID';}
        if($data['del_ident']==11){$table_ref='bins_inhabitants_equipment_borrow_request'; $columnX='Equipment_Request_ID';}
        // if($data['del_ident']==12){$table_ref='bins_received_item';}
        if($data['del_ident']==13){$table_ref='bins_brgy_inventory'; $columnX='Inventory_ID';}

        //BFAS
        if($data['del_ident']==14){$table_ref='maintenance_bfas_type_of_fee'; $columnX='Type_of_Fee_ID';}
        if($data['del_ident']==15){$table_ref='maintenance_bfas_card_type'; $columnX='Card_Type_ID';}
        if($data['del_ident']==16){$table_ref='maintenance_bfas_account_type'; $columnX='Account_Type_ID';}
        if($data['del_ident']==17){$table_ref='maintenance_bfas_fund_type'; $columnX='Fund_Type_ID';}
        if($data['del_ident']==18){$table_ref='maintenance_bfas_bank_account'; $columnX='Bank_Account_ID';}
        if($data['del_ident']==19){$table_ref='maintenance_bfas_voucher_status'; $columnX='Voucher_Status_ID';}
        if($data['del_ident']==20){$table_ref='maintenance_bfas_tax_code'; $columnX='Tax_Code_ID';}
        if($data['del_ident']==21){$table_ref='maintenance_bfas_tax_type'; $columnX='Tax_Type_ID';}
        if($data['del_ident']==22){$table_ref='maintenance_bfas_journal_type'; $columnX='Journal_Type_ID';}
        if($data['del_ident']==23){$table_ref='maintenance_bfas_account_code'; $columnX='Account_Code_ID';}
        if($data['del_ident']==24){$table_ref='maintenance_bfas_expenditure_type'; $columnX='Expenditure_Type_ID';}
        if($data['del_ident']==25){$table_ref='maintenance_bfas_appropriation_type'; $columnX='Appropriation_Type_ID';}
        if($data['del_ident']==26){$table_ref='bfas_card_file'; $columnX='Card_File_ID';}
        if($data['del_ident']==28){$table_ref='bfas_accounts_information'; $columnX='Accounts_Information_ID';}
        if($data['del_ident']==29){$table_ref='bfas_jev_collection'; $columnX='JEV_Collection_ID';}
        if($data['del_ident']==30){$table_ref='bfas_jev_disbursement'; $columnX='JEV_Disbursement_ID';}
        if($data['del_ident']==31){$table_ref='bfas_disbursement_voucher'; $columnX='Disbursement_Voucher_ID';}
        if($data['del_ident']==32){$table_ref='bfas_check_preparation'; $columnX='Check_Preparation_ID';}
        if($data['del_ident']==33){$table_ref='bfas_check_status_cleared'; $columnX='Check_Status_Cleared_ID';}
        if($data['del_ident']==34){$table_ref='bfas_check_status_released'; $columnX='Check_Status_Released_ID';}
        if($data['del_ident']==35){$table_ref='bfas_payment_collection'; $columnX='Payment_Collection_ID';}
        if($data['del_ident']==36){$table_ref='bfas_budget_appropriation'; $columnX='Budget_Appropriation_ID';}
        if($data['del_ident']==37){$table_ref='bfas_obligation_request'; $columnX='Obligation_Request_ID';}
        if($data['del_ident']==38){$table_ref='bfas_SAAODBA'; $columnX='SAAODBA_ID';}
        if($data['del_ident']==39){$table_ref='bfas_budget_appropriation_accounts'; $columnX='Budget_Appropriation_Accounts_ID';}
        if($data['del_ident']==40){$table_ref='bfas_obr_accounts'; $columnX='OBR_Accounts_ID';}
        if($data['del_ident']==41){$table_ref='bfas_dv_obligation_request'; $columnX='Multiple_OBR_ID';}
    
//dd($data,$table_ref,$columnX);

        DB::table($table_ref)->where($columnX, $data['id_del'])->delete();

        if($data['del_ident']==11){
            DB::table('bins_equipment_borrowed')->where('Equipment_Request_ID', $data['id_del'])->delete();
        }
        if($data['del_ident']==36){
            DB::table('bfas_budget_appropriation_accounts')->where('Budget_Appropriation_ID', $data['id_del'])->delete();
        }
        if($data['del_ident']==37){
            DB::table('bfas_obligation_request')->where('Obligation_Request_ID', $data['id_del'])->delete();
        }

        return redirect()->back()->with('alert','Entry Deleted');
    }
}