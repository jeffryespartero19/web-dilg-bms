$(document).on('click','.postThis_XYZ',function(e) {
    $('#newEntryXYZ').submit(); 
});

$(document).on('click','.updateThis_XYZ',function(e) {
    $('#updateEntryXYZ').submit(); 
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

});