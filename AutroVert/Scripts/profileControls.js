// LOADS THE SPECIFIC PROFILE ACTIONS DEPENDING ON VIEWER
// HTML code needs to be moved and called by functions or references-- temporary

$(function() {
    //Load Profile User Controls
    $.ajax("/AutroVert/noRedirect/userControls.php?request=checkUser")
    // Check if user is on their own page: 'true'=yes, 'false'=no
        .done(function (response) {
            if (response == 'true') {
                $('#mainPhotoWrapper').append('<div id="updateMainPic"><a id="updateMainButton" href="#main" aria-haspopup="true" aria-expanded="false" rel="toggle" role="button"><img id="updateMainIcon" title="updateMain" src="/AutroVert/style/icons/camera-icon.png"><span id="updateMainText">Update Main Picture</span></a></div>');
                $('#profile-pic-wrapper').append('<div id="updateProfPic"><a id="updateProfPicButton" href="#prof"><img id="updateProfIcon" title="updateProf" src="/AutroVert/style/icons/camera-icon.png"><span id="updateProfText">Update Profile Picture</span></a></div>');
                $('.profileActions').append('<div class="navButton" data-referer="updateInfo"><a href="#"><input type="button" class="actionButton" value="Update Info"></a></div>');
            } else if (response == 'false') {
                $.ajax("/AutroVert/noRedirect/userControls.php?request=checkFriend")
                //Check if there is an active relationship: '3'=Friends, '0'=Not friends/No active requests, '2'=User has requested to Visitor, '1'=Visitor is requesting to User
                    .done(function(friend) {
                        if (friend == 3) {
                            $('.profileActions').append('<div class="navButton" data-value="friends"><input type="button" class="actionButton" value="Friends"></div>');
                        } else if (friend == 0) {
                            $('.profileActions').append('<div class="navButton" data-value="addFriend"><input type="button" class="actionButton" value="Add Friend" onclick="requestFriend()"></div>');
                        } else if (friend == 2) {
                            $('.profileActions').append('<div class="navButton" data-value="respond"><input type="button" class="actionButton" value="Respond to Friend Request"></div>');
                        } else if (friend == 1) {
                            $('.profileActions').append('<div class="navButton" data-value="requestSent"><input type="button" class="actionButton" value="Request Sent"></div>');
                        }
                        $.ajax("/AutroVert/noRedirect/userControls.php?request=checkFollower")
                        // Check if visitor is following user: 'true'=following, 'false'=not following
                            .done(function (following) {
                                if (following == 'true') {
                                    $('.profileActions').append('<div class="navButton" data-value="following"><input type ="button" class="actionButton"value="Following"></div>')
                                } else if (following == 'false') {
                                    $('.profileActions').append('<div class="navButton" data-value="follow"><input type ="button" class="actionButton" value="Follow" onclick="follow()"></div>')
                                }
                            })
                    });
            }
        });
})