// LOADS THE SPECIFIC PROFILE ACTIONS DEPENDING ON VIEWER
// HTML code needs to be moved and called by functions or references-- temporary


$(function() {
    var source = $.get("//www.autrovert.com/noRedirect/userControls.html");
    var myProfURLS = ['//www.autrovert.com/Scripts/myProfControls.js'];
    var otherProfURLS = ['//www.autrovert.com/Scripts/otherProfControls.js'];

    //Load Profile User Controls
    $.ajax({
        url: "//www.autrovert.com/noRedirect/userControls.php?request=checkUser",
        cache: false,
        // Check if user is on their own page: 'true'=yes, 'false'=no
        success: function (response) {
            if (response == 'true') {
                $('#mainPhotoWrapper').append($(source.responseText).filter("#updateMainPic"));
                $('#profile-pic-wrapper').append($(source.responseText).filter("#updateProfPic"));
                $('.profileActions').append($(source.responseText).filter('[data-referer="updateInfo"]'));
                $.each(myProfURLS, function (i, u) {
                    $('head').append('<script src=' + u + '><\/script>');
                })
            } else if (response == 'false') {
                $.ajax({
                    url: "//www.autrovert.com/noRedirect/userControls.php?request=checkFriend",
                    //Check if there is an active relationship: '3'=Friends, '0'=Not friends/No active requests, '2'=User has requested to Visitor, '1'=Visitor is requesting to User
                    success: function (friend) {
                        if (friend == 3) {
                            $('.profileActions').append($(source.responseText).filter('[data-value="friends"]'));
                        } else if (friend == 0) {
                            $('.profileActions').append($(source.responseText).filter('[data-value="addFriend"]'));
                        } else if (friend == 2) {
                            $('.profileActions').append($(source.responseText).filter('[data-value="respond"]'));
                        } else if (friend == 1) {
                            $('.profileActions').append($(source.responseText).filter('[data-value="requestSent"]'));
                        }
                    },
                    async: false,
                })
                $.ajax({
                    url: "//www.autrovert.com/noRedirect/userControls.php?request=checkFollower",
                    // Check if visitor is following user: 'true'=following, 'false'=not following
                    success: function (following) {
                        if (following == 'true') {
                            $('.profileActions').append($(source.responseText).filter('[data-value="following"]'));
                        } else if (following == 'false') {
                            $('.profileActions').append($(source.responseText).filter('[data-value="follow"]'));
                        }
                    },
                    async: false,
                })
                $.each(otherProfURLS, function (i, u) {
                    $('head').append('<script src=' + u + '><\/script>');
                })
            }
        }
    })
});


