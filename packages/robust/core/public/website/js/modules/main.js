$(function() {
    $(".right-icon").click(function () {
        $("#thebar").toggleClass("change fix");
        $('.arrow').html($('.arrow').text() == 'keyboard_arrow_right' ? 'keyboard_arrow_left' : 'keyboard_arrow_right');
        $(".search--main--content").toggleClass("page page-slide");
    });
    $('.inner-list-tabs').tabs();
    $('select').formSelect();
    $('.modal').modal();
    $('.sidenav').sidenav();
    $('.tabs').tabs();
    $('.inner-list-tabs li.tab').on('click',function () {
        console.log('E');
        $(this).siblings('li').removeClass('active');
        $(this).addClass('active');
    })
} );
