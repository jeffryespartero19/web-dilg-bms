$(document).on('click','.postThis_XYZ',function(e) {
    $('#newEntryXYZ').submit(); 
});

$(document).on('click','.updateThis_XYZ',function(e) {
    $('#updateEntryXYZ').submit(); 
});

$(document).on('click',('.tag_XYZ'),function(e) {
    var disVal = $(this).val();
    $('#this_B_IDx').val(disVal);
});

$(document).on('click','.tagThis_XYZ',function(e) {
    $('#tagEntryXYZ').submit(); 
});

$(document).on('click',('.thisAdd'),function(e) {
    $(this).next().clone().appendTo(".tagger");
});

//list province
$(document).on('change','.regionX',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_province",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            $('.provX').empty();
            $('.provX').append('<option value="" selected> Select </option>');
            $.each(data['provinceX'], function(index, value) {
                $('.provX').append('<option value="' + data['provinceX'][index]['Province_ID'] + '">' + data['provinceX'][index]['Province_Name']+ '</option>');
            });

        }
    });
});

$(document).on('change','.regionX2',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_province",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            $('.provX2').empty();
            $('.provX2').append('<option value="" selected> Select </option>');
            $.each(data['provinceX'], function(index, value) {
                $('.provX2').append('<option value="' + data['provinceX'][index]['Province_ID'] + '">' + data['provinceX'][index]['Province_Name']+ '</option>');
            });

        }
    });
});

//list province
$(document).on('change','.provX',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_city",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            $('.cityX').empty();
            $('.cityX').append('<option value="" selected> Select </option>');
            $.each(data['cityX'], function(index, value) {
                $('.cityX').append('<option value="' + data['cityX'][index]['City_Municipality_ID'] + '">' + data['cityX'][index]['City_Municipality_Name']+ '</option>');
            });

        }
    });
});
$(document).on('change','.provX2',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_city",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            $('.cityX2').empty();
            $('.cityX2').append('<option value="" selected> Select </option>');
            $.each(data['cityX'], function(index, value) {
                $('.cityX2').append('<option value="' + data['cityX'][index]['City_Municipality_ID'] + '">' + data['cityX'][index]['City_Municipality_Name']+ '</option>');
            });

        }
    });
});

//list brgy
$(document).on('change','.cityX',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_brgy",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            
            $('.brgyX').empty();
            $('.brgyX').append('<option value="" selected> Select </option>');
            $.each(data['brgyX'], function(index, value) {
                $('.brgyX').append('<option value="' + data['brgyX'][index]['Barangay_ID'] + '">' + data['brgyX'][index]['Barangay_Name']+ '</option>');
            });

        }
    });
});
$(document).on('change','.cityX2',function(e) {
    var disID = $(this).find(":selected").val();
    $.ajax({
        url: "/list_brgy",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 
            
            $('.brgyX2').empty();
            $('.brgyX2').append('<option value="" selected> Select </option>');
            $.each(data['brgyX'], function(index, value) {
                $('.brgyX2').append('<option value="' + data['brgyX'][index]['Barangay_ID'] + '">' + data['brgyX'][index]['Barangay_Name']+ '</option>');
            });

        }
    });
});


$(document).on('click',('.edit_XYZ'),function(e) {
    var ident =$('#this_identifier').val();

    if(ident == 1){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_card_file",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Card_File_ID']);

                $('#this_card_type').empty();
                $('#this_card_type').val(data['theEntry'][0]['Card_Type_ID']);
                $('#this_card_type').append(data['theEntry'][0]['Card_Type']);

                $('#this_company_name').val(data['theEntry'][0]['Company_Name']);
                $('#this_company_tin').val(data['theEntry'][0]['Company_Tin']);

                $('#this_last_name').val(data['theEntry'][0]['Last_Name']);
                $('#this_first_name').val(data['theEntry'][0]['First_Name']);
                $('#this_middle_name').val(data['theEntry'][0]['Middle_Name']);

                $('#this_phone_no').val(data['theEntry'][0]['Phone_No']);
                $('#this_contact_1').val(data['theEntry'][0]['Contact_No_1']);
                $('#this_contact_2').val(data['theEntry'][0]['Contact_No_2']);

                $('#this_billing_address').val(data['theEntry'][0]['Billing_Address']);
                $('#this_delivery_address').val(data['theEntry'][0]['Delivery_Address']);
                $('#this_email_address').val(data['theEntry'][0]['Email_Address']);

                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);

                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);

                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);

                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);

                $('#this_active').empty();
                $('#this_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_active').append('Yes');
                }else{
                    $('#this_active').append('No');
                }

            }
        });
    }
    if(ident == 2){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_accounts_information",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Accounts_Information_ID']);

                $('#this_begbal').val(data['theEntry'][0]['Beginning_Balance']);

                $('#this_acc_type').empty();
                $('#this_acc_type').val(data['theEntry'][0]['Account_Type_ID']);
                $('#this_acc_type').append(data['theEntry'][0]['Account_Type']);

                $('#this_acc_class').empty();
                $('#this_acc_class').val(data['theEntry'][0]['Account_Class']);
                $('#this_acc_class').append(data['theEntry'][0]['Account_Class']);

                $('#this_acc_name').val(data['theEntry'][0]['Account_Name']);
                $('#this_acc_no').val(data['theEntry'][0]['Account_Number']);

                $('#this_acc_lvl').empty();
                $('#this_acc_lvl').val(data['theEntry'][0]['Account_Level']);
                $('#this_acc_lvl').append('Level '+data['theEntry'][0]['Account_Level']);

                $('#this_acc_parent').empty();
                $('#this_acc_parent').val(data['theEntry'][0]['Accounts_Information_ID']);
                $('#this_acc_parent').append(data['theEntry'][0]['Account_Number']+ ' ' +data['theEntry'][0]['Account_Name']);

                var disVal = data['theEntry'][0]['Account_Level'];

                $.ajax({
                    url: "/get_acc_parents",
                    type: 'GET',
                    data: { id: disVal },
                    fail: function(){
                        alert('request failed');
                    },
                    success: function (data) { 

                        $.each(data['theEntry'], function(index, value) {
                            $('#acc_parents2').append('<option value="' + data['theEntry'][index]['Accounts_Information_ID'] + '">' +data['theEntry'][index]['Account_Number']+ ' ' +data['theEntry'][index]['Account_Name']+ '</option>');
                        });
                    }
                });
                
                $('#this_active').empty();
                $('#this_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_active').append('Yes');
                }else{
                    $('#this_active').append('No');
                }

            }
        });
    }

    if(ident == 3){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_jev_collection",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['JEV_Collection_ID']);

                $('#this_journal_number').val(data['theEntry'][0]['Journal_Number']);

                $('#this_bank_account').empty();
                $('#this_bank_account').val(data['theEntry'][0]['Bank_Account_ID']);
                $('#this_bank_account').append(data['theEntry'][0]['Bank_Account_Name']+'-('+data['theEntry'][0]['Bank_Account_No']+')');

                $('#this_journal_Type').empty();
                $('#this_journal_Type').val(data['theEntry'][0]['Journal_Type_ID']);
                $('#this_journal_Type').append(data['theEntry'][0]['Journal_Type']);

                $('#this_fund_Type').empty();
                $('#this_fund_Type').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_Type').append(data['theEntry'][0]['Fund_Type']);
                
                $('#this_particulars').val(data['theEntry'][0]['Particulars']);

                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);

                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);

                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);

                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
                
                $('#this_active').empty();
                $('#this_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_active').append('Yes');
                }else{
                    $('#this_active').append('No');
                }

            }
        });
    }

    if(ident == 4){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_jev_disbursement",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['JEV_Disbursement_ID']);
    
                $('#this_journal_number').val(data['theEntry'][0]['Journal_Number']);
    
                $('#this_bank_account').empty();
                $('#this_bank_account').val(data['theEntry'][0]['Bank_Account_ID']);
                $('#this_bank_account').append(data['theEntry'][0]['Bank_Account_Name']+'-('+data['theEntry'][0]['Bank_Account_No']+')');
    
                $('#this_journal_Type').empty();
                $('#this_journal_Type').val(data['theEntry'][0]['Journal_Type_ID']);
                $('#this_journal_Type').append(data['theEntry'][0]['Journal_Type']);
    
                $('#this_fund_Type').empty();
                $('#this_fund_Type').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_Type').append(data['theEntry'][0]['Fund_Type']);
                
                $('#this_particulars').val(data['theEntry'][0]['Particulars']);
    
                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);
    
                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);
    
                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);
    
                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
                
                $('#this_active').empty();
                $('#this_active').val(data['theEntry'][0]['Active']);
                if(data['theEntry'][0]['Active']==1){
                    $('#this_active').append('Yes');
                }else{
                    $('#this_active').append('No');
                }
    
            }
        });
    }

    if(ident == 5){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_disbursement_voucher",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Disbursement_Voucher_ID']);
    
                $('#this_transaction_no').val(data['theEntry'][0]['Transaction_No']);
                $('#this_voucher_no').val(data['theEntry'][0]['Voucher_No']);
    
                $('#this_appropriation_type_id').empty();
                $('#this_appropriation_type_id').val(data['theEntry'][0]['Appropriation_Type_ID']);
                $('#this_appropriation_type_id').append(data['theEntry'][0]['Appropriation_Type']);
    
                $('#this_fund_type_id').empty();
                $('#this_fund_type_id').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_type_id').append(data['theEntry'][0]['Fund_Type']);
    
                $('#this_tax_code_id').empty();
                $('#this_tax_code_id').val(data['theEntry'][0]['Tax_Code_ID']);
                $('#this_tax_code_id').append(data['theEntry'][0]['Description']);

                $('#this_voucher_status_id').empty();
                $('#this_voucher_status_id').val(data['theEntry'][0]['Voucher_Status_ID']);
                $('#this_voucher_status_id').append(data['theEntry'][0]['Voucher_Status']);

                $('#this_card_file_id').empty();
                $('#this_card_file_id').val(data['theEntry'][0]['Card_File_ID']);
                $('#this_card_file_id').append(data['theEntry'][0]['Last_Name']+', '+data['theEntry'][0]['First_Name']+' '+data['theEntry'][0]['Middle_Name']);

                $('#this_brgy_officials_and_staff_id').empty();
                $('#this_brgy_officials_and_staff_id').val(data['theEntry'][0]['Card_File_ID']);
                $('#this_brgy_officials_and_staff_id').append(data['theEntry'][0]['Last_Name']+', '+data['theEntry'][0]['First_Name']+' '+data['theEntry'][0]['Middle_Name']);

                if(data['theEntry'][0]['For_Liquidation']==1){
                    $('#this_purpose').empty();
                    $('#this_purpose').val(1);
                    $('#this_purpose').append('For Liquidation');
                }
                if(data['theEntry'][0]['For_Payroll']==1){
                    $('#this_purpose').empty();
                    $('#this_purpose').val(2);
                    $('#this_purpose').append('For Payroll');
                }
                if(data['theEntry'][0]['For_Cash_Advance']==1){
                    $('#this_purpose').empty();
                    $('#this_purpose').val(3);
                    $('#this_purpose').append('For Cash Advance');
                }
                if(data['theEntry'][0]['Disbursement_Check']==1){
                    $('#this_purpose').empty();
                    $('#this_purpose').val(4);
                    $('#this_purpose').append('Check Disbursement');
                }
                if(data['theEntry'][0]['Disbursement_Cash']==1){
                    $('#this_purpose').empty();
                    $('#this_purpose').val(5);
                    $('#this_purpose').append('Cash Disbursement');
                }
                
                $('#this_particulars').val(data['theEntry'][0]['Particulars']);
                $('#this_remarks').val(data['theEntry'][0]['Remarks']);
    
                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);
    
                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);
    
                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);
    
                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
                
    
            }
        });
    }

    if(ident == 6){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_check_preparation",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Check_Preparation_ID']);

                $('#this_particulars').val(data['theEntry'][0]['Particulars']);
                
                $('#this_brgy_OS').empty();
                $('#this_brgy_OS').val(data['theEntry'][0]['id']);
                $('#this_brgy_OS').append(data['theEntry'][0]['name']);

                $('#this_disbursement_voucher').empty();
                $('#this_disbursement_voucher').val(data['theEntry'][0]['Disbursement_Voucher_ID']);
                $('#this_disbursement_voucher').append(data['theEntry'][0]['Voucher_No']);
                
                $('#this_voucher_status').empty();
                $('#this_voucher_status').val(data['theEntry'][0]['Voucher_Status_ID']);
                $('#this_voucher_status').append(data['theEntry'][0]['Voucher_Status']);

                $('#this_amount').val(data['theEntry'][0]['Amount']);

                $('#this_bank_account').empty();
                $('#this_bank_account').val(data['theEntry'][0]['Bank_Account_ID']);
                $('#this_bank_account').append(data['theEntry'][0]['Bank_Account_Name']+'-('+data['theEntry'][0]['Bank_Account_No']+')');

                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);

                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);

                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);

                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
                

            }
        });
    }
        
    if(ident == 7){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_check_status",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Check_Status_Cleared_ID']);

                $('#this_check_prep').empty();
                $('#this_check_prep').val(data['theEntry'][0]['Check_Preparation_ID']);
                $('#this_check_prep').append(data['theEntry'][0]['Voucher_No']);

                $('#this_cleared_date').val(data['theEntry'][0]['Cleared_Date']);
                $('#this_remarks').val(data['theEntry'][0]['Remarks']);
                
                // alert(data['theEntry'][0]['Check_Status_Cleared_ID']);
            }
        });
    }

    if(ident == 8){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_check_status_released",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Check_Status_Released_ID']);

                $('#this_check_preparation_id').empty();
                $('#this_check_preparation_id').val(data['theEntry'][0]['Check_Preparation_ID']);
                $('#this_check_preparation_id').append(data['theEntry'][0]['Voucher_No']);

                $('#this_released_date').val(data['theEntry'][0]['Released_Date']);
                $('#this_received_by').val(data['theEntry'][0]['Received_by']);
                $('#this_id_presented').val(data['theEntry'][0]['ID_Presented']);
                $('#this_id_number').val(data['theEntry'][0]['ID_Number']);
            }

        });
    }

    if(ident == 9){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_payment_collection",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Payment_Collection_ID']);
                $('#this_payment_collection_number').val(data['theEntry'][0]['Payment_Collection_Number']);

                $('#this_account_name').empty();
                $('#this_account_name').val(data['theEntry'][0]['Accounts_Information_ID']);
                $('#this_account_name').append(data['theEntry'][0]['Account_Name']);

                $('#this_type_of_fee').empty();
                $('#this_type_of_fee').val(data['theEntry'][0]['Type_of_Fee_ID']);
                $('#this_type_of_fee').append(data['theEntry'][0]['Type_of_Fee']);

                $('#this_or_number').val(data['theEntry'][0]['OR_No']);
                $('#this_or_date').val(data['theEntry'][0]['OR_Date']);
                $('#this_cash_tendered').val(data['theEntry'][0]['Cash_Tendered']);
                $('#this_remarks').val(data['theEntry'][0]['Remarks']);
            }

        });
    }
    if(ident == 10){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_budget_appropriation",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Budget_Appropriation_ID']);

                $('#this_appropriation_no').val(data['theEntry'][0]['Appropriation_No']);
                $('#this_appropriation_date').val(data['theEntry'][0]['Appropriation_Date']);
                $('#this_particulars').val(data['theEntry'][0]['Particulars']);

                $('#this_appropriation_status').empty();
                $('#this_appropriation_status').val(data['theEntry'][0]['Budget_Appropriation_Status_ID']);
                $('#this_appropriation_status').append(data['theEntry'][0]['Budget_Appropriation_Status']);

                $('#this_budget_year').empty();
                $('#this_budget_year').val(data['theEntry'][0]['Budget_Year']);
                $('#this_budget_year').append(data['theEntry'][0]['Budget_Year']);

                $('#this_appropriation_type_id').empty();
                $('#this_appropriation_type_id').val(data['theEntry'][0]['Appropriation_Type_ID']);
                $('#this_appropriation_type_id').append(data['theEntry'][0]['Appropriation_Type']);
    
                $('#this_fund_type_id').empty();
                $('#this_fund_type_id').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_type_id').append(data['theEntry'][0]['Fund_Type']);

                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);
    
                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);
    
                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);
    
                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
            }

        });
    }

    if(ident == 11){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_obligation_request",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Obligation_Request_ID']);
    
                $('#this_OR_no').val(data['theEntry'][0]['Obligation_Request_No']);
                $('#this_PO_no').val(data['theEntry'][0]['Purchase_Order_No']);
                $('#this_obr_date').val(data['theEntry'][0]['Obligation_Request_Date']);
    
                $('#this_obr_status').empty();
                $('#this_obr_status').val(data['theEntry'][0]['Obligation_Request_Status_ID']);
                $('#this_obr_status').append(data['theEntry'][0]['Obligation_Request_Status']);
    
                $('#this_fund_type_id').empty();
                $('#this_fund_type_id').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_type_id').append(data['theEntry'][0]['Fund_Type']);
    
                $('#this_ba').empty();
                $('#this_ba').val(data['theEntry'][0]['Budget_Appropriation_ID']);
                $('#this_ba').append(data['theEntry'][0]['Appropriation_No']);

                $('#this_card_file_id').empty();
                $('#this_card_file_id').val(data['theEntry'][0]['Card_File_ID']);
                $('#this_card_file_id').append(data['theEntry'][0]['Last_Name']+', '+data['theEntry'][0]['First_Name']+' '+data['theEntry'][0]['Middle_Name']);

                $('#this_brgy_officials_and_staff_id').empty();
                $('#this_brgy_officials_and_staff_id').val(data['theEntry'][0]['Card_File_ID']);
                $('#this_brgy_officials_and_staff_id').append(data['theEntry'][0]['Last_Name']+', '+data['theEntry'][0]['First_Name']+' '+data['theEntry'][0]['Middle_Name']);

                $('#this_remarks').val(data['theEntry'][0]['Remarks']);
    
                $('#this_region').empty();
                $('#this_region').val(data['theEntry'][0]['Region_ID']);
                $('#this_region').append(data['theEntry'][0]['Region_Name']);
    
                $('#this_province').empty();
                $('#this_province').val(data['theEntry'][0]['Province_ID']);
                $('#this_province').append(data['theEntry'][0]['Province_Name']);
    
                $('#this_city').empty();
                $('#this_city').val(data['theEntry'][0]['City_Municipality_ID']);
                $('#this_city').append(data['theEntry'][0]['City_Municipality_Name']);
    
                $('#this_barangay').empty();
                $('#this_barangay').val(data['theEntry'][0]['Barangay_ID']);
                $('#this_barangay').append(data['theEntry'][0]['Barangay_Name']);
                
    
            }
        });
    }

    if(ident == 12){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_SAAODBA",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['SAAODBA_ID']);
    
                $('#this_obr').empty();
                $('#this_obr').val(data['theEntry'][0]['Obligation_Request_ID']);
                $('#this_obr').append(data['theEntry'][0]['Obligation_Request_No']);
    
                $('#this_fund_type_id').empty();
                $('#this_fund_type_id').val(data['theEntry'][0]['Fund_Type_ID']);
                $('#this_fund_type_id').append(data['theEntry'][0]['Fund_Type']);

                $('#this_asof').val(data['theEntry'][0]['SAAODBA_As_of']);
    
                $('#this_oic').empty();
                $('#this_oic').val(data['theEntry'][0]['Card_File_ID']);
                $('#this_oic').append(data['theEntry'][0]['Last_Name2']+', '+data['theEntry'][0]['First_Name2']+' '+data['theEntry'][0]['Middle_Name2']);

                $('#this_account').empty();
                $('#this_account').val(data['theEntry'][0]['Accounts_Information_ID']);
                $('#this_account').append(data['theEntry'][0]['Account_Name']);
            }
        });
    }

});

$(document).on('change',('#acc_lvl'),function(e) {
    var disVal =$(this).val();

    $.ajax({
        url: "/get_acc_parents",
        type: 'GET',
        data: { id: disVal },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 

            $('#acc_parents').empty();
            $('#acc_parents').append('<option value="0" hidden selected>Select</option> ');

            $.each(data['theEntry'], function(index, value) {
                $('#acc_parents').append('<option value="' + data['theEntry'][index]['Accounts_Information_ID'] + '">' +data['theEntry'][index]['Account_Number']+ ' ' +data['theEntry'][index]['Account_Name']+ '</option>');
            });
        }
    });
});

$(document).on('change',('#acc_lvl2'),function(e) {
    var disVal =$(this).val();

    $.ajax({
        url: "/get_acc_parents",
        type: 'GET',
        data: { id: disVal },
        fail: function(){
            alert('request failed');
        },
        success: function (data) { 

            $('#acc_parents2').empty();
            $('#acc_parents2').append('<option value="0" hidden selected>Select</option> ');

            $.each(data['theEntry'], function(index, value) {
                $('#acc_parents2').append('<option value="' + data['theEntry'][index]['Accounts_Information_ID'] + '">' +data['theEntry'][index]['Account_Number']+ ' ' +data['theEntry'][index]['Account_Name']+ '</option>');
            });
        }
    });
});

$(document).on('click',('.delRec'),function(e) {
    var disVal = $(this).val(); 
    $('#delFile').val(disVal); 
    $('#deleteFile').modal('show');           
});

$(document).on('click',('.delRec2'),function(e) {
    var disVal = $(this).val(); 
    $('#delFile2').val(disVal); 
    $('#deleteFile2').modal('show');           
});

