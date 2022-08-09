$(document).ready(function(){
    $(".firstln").removeClass("txtHide");
    $(".secondln").removeClass("txtHide");
    $(".thirdln").removeClass("txtHide");

    $(".firstln").addClass("ln1"); 
    $(".secondln").addClass("ln2"); 
    $(".thirdln").addClass("ln3"); 
}); 

$(document).on('click','#FUpload',function(e) {
    $('#up1_only').val('file'); 
});
$(document).on('click','#imgUpload',function(e) {
    $('#up1_only').val('image'); 
});
$(document).on('click','#vidUpload',function(e) {
    $('#up1_only').val('video');
});
$(document).on('click','#gifUpload',function(e) {
    $('#up1_only').val('gif');
});

$(document).on('click','#FUpload2',function(e) {
    $('#up1_only2').val('file'); 
});
$(document).on('click','#imgUpload2',function(e) {
    $('#up1_only2').val('image'); 
});
$(document).on('click','#vidUpload2',function(e) {
    $('#up1_only2').val('video');
});
$(document).on('click','#gifUpload2',function(e) {
    $('#up1_only2').val('gif');
});

//////////////////


$(document).on('click','#FUpload_edit',function(e) {
    $('#up1_only_edit').val('file'); 
});
$(document).on('click','#imgUpload_edit',function(e) {
    $('#up1_only_edit').val('image'); 
});
$(document).on('click','#vidUpload_edit',function(e) {
    $('#up1_only_edit').val('video');
});
$(document).on('click','#gifUpload_edit',function(e) {
    $('#up1_only_edit').val('gif');
});

$(document).on('click','#FUpload_edit2',function(e) {
    $('#up1_only_edit2').val('file'); 
});
$(document).on('click','#imgUpload_edit2',function(e) {
    $('#up1_only_edit2').val('image'); 
});
$(document).on('click','#vidUpload_edit2',function(e) {
    $('#up1_only_edit2').val('video');
});
$(document).on('click','#gifUpload_edit2',function(e) {
    $('#up1_only_edit2').val('gif');
});


////////////////


//post buttons
$(document).on('click','.postThis',function(e) {
    $('#userPost').submit(); 
});
$(document).on('click','.postThis2',function(e) {
    $('#EditMV').submit(); 
});

$(document).on('click','.postThisAnn',function(e) {
    $('#annPost').submit(); 
});

$(document).on('click',('.editZ'),function(e) {
    
    var disID = $(this).val();
    $.ajax({
        url: "/get_thisPost",
        type: 'GET',
        data: { id: disID },
        fail: function(){
            alert('request failed');
         },
        success: function (data) { 
            
            $('#this_postType').val(data['Announcement_Type'][0]['News_Type_ID']);
            $('#this_postStatus').val(data['Announcement_Type'][0]['News_Status_ID']);

            $('#posterName_edit').empty();
            $('#posterName_edit').append(data['the_Post_User'][0]['name']);

            $('#this_postID').val(data['thePost'][0]['News_ID']);
            $('#this_postTitle').val(data['thePost'][0]['News_Title']);
            $('#this_postActual').val(data['thePost'][0]['News_Description']);

            $('#attached_items').empty();
            $.each(data['attachements'], function(index, value) {
                $('#attached_items').append(
                    '<tr>'
                        +'<td style="width:65%;">'+ data['attachements'][index]['File_Name'] + '</td>'
                        +'<td style="text-align:center;"> <button class="change_att">Change</button> <button class="remove_att" value="'+data['thePost'][0]['News_ID']+'">Remove</button> </td>'
                    +'</tr>'
                 );
            });

            if ($('#attached_items').is(':empty')){
                $('.edit_hidden').removeAttr('hidden');
                $('.edit_hidden').show();
                $('.att_table').hide();
            }else{
                $('.att_table').show();
                $('.edit_hidden').hide();
            }

        }
    });
 
 });

 $(document).on('click',('.editZ2'),function(e) {
    if ($.trim($("#attached_items").html())==''){
        $('.edit_hidden').removeAttr('hidden');
        $('.edit_hidden').show();
        $('.att_table').hide();
    }else{
        $('.att_table').show();
        $('.edit_hidden').hide();
    }
});

$(document).on('click','.change_att',function(e) {
    $('#editPost_form').on('submit', function(e){
        e.preventDefault();
        $(this).unbind(e);
    });
    $('#editAnn_form').on('submit', function(e){
        e.preventDefault();
        $(this).unbind(e);
    });
    $('.edit_hidden').removeAttr('hidden');
    $('.edit_hidden').show();
    $('.att_table').hide();
});

$(document).on('click','.postThis_edit',function(e) {
    $('#editPost_form').submit(); 
});

$(document).on('click','.updateThisAnn',function(e) {
    $('#editAnn_form').submit(); 
});

$('#editPost').on('hidden.bs.modal', function () {
    $('.att_table').show();
    $('.edit_hidden').hide();
});









