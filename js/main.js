$(document).ready(function(){
    $('#menu-click').on('click',function(){
        $('#mobile-nav').toggle(300);
    });

    $('#logout').on('click',function(){
        $('#a_log').toggle();
    });

    $('#logout_btn').on('click',function(){
        $('#logout_drop').toggle();
    });
});