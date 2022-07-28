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