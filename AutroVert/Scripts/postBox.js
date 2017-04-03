
$('#postArea').children().hide();
$('#' + $('#post-type').find('.postType[aria-selected=true]').data('content')).show();


$(function() {

    // Selecting Post Type
    $('.postType').click(function (evt) {
        if ($(this).attr('aria-selected') != 'true') {
            if ($('#post-type').find('.postType[aria-selected=true]')) {
                $('#post-type').find('.postType[aria-selected=true]').attr('aria-selected', 'false');
            }
            $('#postArea').children().hide();
            $('#' + $(this).data('content')).show();
            $(this).attr('aria-selected', 'true');
        }
        evt.preventDefault();
    });

    // Auto Height textbox
    $('#postTextArea, #buildTextArea').on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });



    $('#mainPhotoWrapper').hover(function () {
        $('#updateMainPic').fadeTo( 200, 0.7);
        $('#updateMainText').fadeTo( 100, 1);
    }, function () {
        $('#updateMainPic').css('opacity', '0.25');
        $('#updateMainText').hide();
    });

    $('#profile-pic-wrapper').hover(function () {
        $('#updateProfPic').fadeTo(200, 0.8);
    }, function () {
        $('#updateProfPic').hide();
    });

});

