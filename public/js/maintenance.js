//post buttons
$(document).on('click','.postThis_Ann_Status',function(e) {
    $('#newBRGY_Ann_Status').submit(); 
});

$(document).on('click',('.edit_ann_status'),function(e) {
    
    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_ann_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
         },
        success: function (data) { 
            $('#this_ann_status_idX').val(data['theEntry'][0]['Announcement_Status_ID']);
            $('#this_ann_statusX').val(data['theEntry'][0]['Announcement_Status']);
            
            $('#this_ann_status_active').empty();
            $('#this_ann_status_active').val(data['theEntry'][0]['Active']);
            if(data['theEntry'][0]['Active']==1){
                $('#this_ann_status_active').append('Yes');
            }else{
                $('#this_ann_status_active').append('No');
            }

        }
    });

    
 });

$(document).on('click','.updateThis_Ann_Status',function(e) {
    $('#updateBRGY_Ann_Status').submit(); 
});