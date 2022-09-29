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
            url: "/get_bfas_type_of_fee_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Type_of_Fee_ID']);

                // $('#this_acc_info').empty();
                // $('#this_acc_info').val(data['Account_InfoX'][0]['Accounts_Information_ID']);
                // $('#this_acc_info').append(data['Account_InfoX'][0]['Accounts_Information_ID']+'-'+data['Account_Name'][0]['Account_Number']);

                $('#this_type_fee').val(data['theEntry'][0]['Type_of_Fee']);
                $('#this_amount').val(data['theEntry'][0]['Amount']);
                
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
            url: "/get_bfas_card_type_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Card_Type_ID']);

                $('#this_card_type').val(data['theEntry'][0]['Card_Type']);
                
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
            url: "/get_bfas_account_type_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Account_Type_ID']);

                $('#this_account_type').val(data['theEntry'][0]['Account_Type']);
                
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
            url: "/get_bfas_fund_type_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Fund_Type_ID']);

                $('#this_fund_type').val(data['theEntry'][0]['Fund_Type']);
                
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
            url: "/get_bfas_bank_account_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Bank_Account_ID']);

                $('#this_bcode').val(data['theEntry'][0]['Bank_Account_Code']);
                $('#this_bno').val(data['theEntry'][0]['Bank_Account_No']);
                $('#this_bname').val(data['theEntry'][0]['Bank_Account_Name']);

                $('#this_cn_from').val(data['theEntry'][0]['Check_Number_From']);
                $('#this_cn_to').val(data['theEntry'][0]['Check_Number_To']);

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
            url: "/get_bfas_voucher_status_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Voucher_Status_ID']);

                $('#this_voucher_status').val(data['theEntry'][0]['Voucher_Status']);
                
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
    
    if(ident == 7){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_tax_code_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Tax_Code_ID']);

                $('#this_description').val(data['theEntry'][0]['Description']);
                $('#this_payment').val(data['theEntry'][0]['Payment_Type']);
                $('#this_bir_no').val(data['theEntry'][0]['BIR_Form_No']);
                $('#this_rate').val(data['theEntry'][0]['Rate']);
                
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

    if(ident == 8){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_tax_type_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Tax_Type_ID']);

                $('#this_tax_type').val(data['theEntry'][0]['Tax_Type']);
                
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

    
    if(ident == 9){
        var disID = $(this).val();
        $.ajax({
            url: "/get_bfas_journal_type_maint",
            type: 'GET',
            data: { id: disID },
            fail: function(){
                alert('request failed');
            },
            success: function (data) { 
                $('#this_idX').val(data['theEntry'][0]['Journal_Type_ID']);

                $('#this_journal_type').val(data['theEntry'][0]['Journal_Type']);
                
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
});