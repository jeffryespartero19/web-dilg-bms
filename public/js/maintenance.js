///// Announcement Status
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

/////// Announcement Type
$(document).on('click','.postThis_Ann_Type',function(e) {
    $('#newBRGY_Ann_Type').submit(); 
});

$(document).on('click',('.edit_news_type'),function(e) {
    
    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_ann_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
         },
        success: function (data) { 
            $('#this_ann_type_idX').val(data['theEntry'][0]['Announcement_Type_ID']);
            $('#this_ann_type_NameX').val(data['theEntry'][0]['Announcement_Type_Name']);
            
            $('#this_ann_type_active').empty();
            $('#this_ann_type_active').val(data['theEntry'][0]['Active']);
            if(data['theEntry'][0]['Active']==1){
                $('#this_ann_type_active').append('Yes');
            }else{
                $('#this_ann_type_active').append('No');
            }

        }
    });

    
 });

$(document).on('click','.updateThis_News_Type',function(e) {
    $('#updateBRGY_News_Type').submit(); 
});

///// News Status
$(document).on('click','.postThis_News_Status',function(e) {
    $('#newBRGY_News_Status').submit(); 
});

$(document).on('click',('.edit_news_status'),function(e) {
    
    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_news_status_maint",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
         },
        success: function (data) { 
            $('#this_news_status_idX').val(data['theEntry'][0]['News_Status_ID']);
            $('#this_news_statusX').val(data['theEntry'][0]['News_Status']);
            
            $('#this_news_status_active').empty();
            $('#this_news_status_active').val(data['theEntry'][0]['Active']);
            if(data['theEntry'][0]['Active']==1){
                $('#this_news_status_active').append('Yes');
            }else{
                $('#this_news_status_active').append('No');
            }

        }
    });

    
 });

$(document).on('click','.updateThis_News_Status',function(e) {
    $('#updateBRGY_News_Status').submit(); 
});


/////// News Type
$(document).on('click','.postThis_News_Type',function(e) {
    $('#newBRGY_News_Type').submit(); 
});

$(document).on('click',('.edit_news_type'),function(e) {
    
    var disID = $(this).val();
    $.ajax({
        url: "/get_bweb_news_type_maint",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
         },
        success: function (data) { 
            $('#this_news_type_idX').val(data['theEntry'][0]['News_Type_ID']);
            $('#this_news_type_NameX').val(data['theEntry'][0]['News_Type_Name']);
            
            $('#this_news_type_active').empty();
            $('#this_news_type_active').val(data['theEntry'][0]['Active']);
            if(data['theEntry'][0]['Active']==1){
                $('#this_news_type_active').append('Yes');
            }else{
                $('#this_news_type_active').append('No');
            }

        }
    });

    
});