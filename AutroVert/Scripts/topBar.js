$(function() {

    $('.topBarButton').hover(function () {
        $(this).fadeTo(200, 0.8);
    }, function () {
        $(this).fadeTo(0, 0.4);
    });

    $('#profileButton').hover(function() {
        $(this).fadeTo(200, 1);
    }, function () {
        $(this).fadeTo(0, 0.85);
    });

    // Auto Height textbox
    $('#postTextArea').on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Left Nav Column

    $('.buttonWrapper').hover(function () {
        $(this).find('.quickFont').css('color', '#000000');
    }, function() {
        $(this).find('.quickFont').css('color', '#666666');
    })
});


