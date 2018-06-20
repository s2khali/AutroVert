$(function () {
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

})
