$(document).on('click','.postThis_XYZ',function(e) {
    $('#newEntryXYZ').submit(); 
});

$(document).on('click','.updateThis_XYZ',function(e) {
    $('#updateEntryXYZ').submit(); 
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

                $('#this_acc_type').empty();
                $('#this_acc_type').val(data['theEntry'][0]['Account_Type_ID']);
                $('#this_acc_type').append(data['theEntry'][0]['Account_Type']);

                $('#this_acc_code').empty();
                $('#this_acc_code').val(data['theEntry'][0]['Account_Code_ID']);
                $('#this_acc_code').append(data['theEntry'][0]['Account_Code']);

                $('#this_acc_name').val(data['theEntry'][0]['Account_Name']);
                $('#this_acc_no').val(data['theEntry'][0]['Account_Number']);
                
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

    if(ident == 6){
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
                $('#this_check_preparation_id').append(data['theEntry'][0]['Check_Preparation_ID']);

                $('#this_released_date').val(data['theEntry'][0]['Released_Date']);
                $('#this_received_by').val(data['theEntry'][0]['Received_by']);
                $('#this_id_presented').val(data['theEntry'][0]['ID_Presented']);
                $('#this_id_number').val(data['theEntry'][0]['ID_Number']);
            }

        });
    }

    if(ident == 7){
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

});