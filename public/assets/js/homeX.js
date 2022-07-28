$(document).ready(function(){
    $(".firstln").removeClass("txtHide");
    $(".secondln").removeClass("txtHide");
    $(".thirdln").removeClass("txtHide");

    $(".firstln").addClass("ln1"); 
    $(".secondln").addClass("ln2"); 
    $(".thirdln").addClass("ln3"); 
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

//post buttons
$(document).on('click','.postThis',function(e) {
    $('#userPost').submit(); 
});
$(document).on('click','.postThis2',function(e) {
    $('#EditMV').submit(); 
});