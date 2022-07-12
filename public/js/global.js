$(document).ready(function(){
    $(".sub_module").hide();
    $(".sb_up").hide();
    $(".sb_right").hide();

});

$('.module').click(function(){

    if ($('.sub_module',this).is(':hidden')) {
        $('.sb_down',this).fadeOut();
        $('.sb_up',this).fadeIn();
        $('.sub_module',this).fadeIn();
    }else{
        $('.sb_down',this).fadeIn();
        $('.sb_up',this).fadeOut();
        $('.sub_module',this).fadeOut();
    }

});

$('.siebar_toggle').click(function(){

    if ($('.sb_left',this).is(':hidden')) {
        $('.sb_right',this).fadeOut(200);
        $('.sb_left',this).fadeIn(1000);
        $("#main").animate({width: '85%'});
        $("#sidebar").animate({width: '15%'}).show();
        
    }else{
        $('.sb_right',this).fadeIn(1000);
        $('.sb_left',this).fadeOut(200);
        $("#main").animate({width: '100%'});
        $("#sidebar").animate({width: '0%'});
        $("#sidebar").fadeOut(1);
       
    }

});