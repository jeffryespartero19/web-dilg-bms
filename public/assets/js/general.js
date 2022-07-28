$(document).on('mouseover','.hdrItem',function(e) {
    $(this).children('.underline').first().addClass("underColor"); 
});
$(document).on('mouseout','.hdrItem',function(e) {
    $(this).children('.underline').first().removeClass("underColor"); 
});


