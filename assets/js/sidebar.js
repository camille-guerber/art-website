$('#open').click(function (e) {
    e.preventDefault();
    $(".sidenav").css({
        'width': '100%',
        'opacity': '0.9',
    });
    $(".main").css('margin-left', '0');
});

$('#close').click(function (e) {
    e.preventDefault();
    $(".sidenav").css('width', '0');
    $(".main").css('margin-left', '0');
});