

// PROFILE ACTION BUTTON FUNCTIONS
function followIt() {
    var source = $.get('//www.autrovert.com/noRedirect/userControls.html');
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'follow',
        success: function() {
            $('[data-value="follow"]').replaceWith($(source.responseText).filter('[data-value="following"]'));
        }
    })
}

function unfollow() {
    var source = $.get("//www.autrovert.com/noRedirect/userControls.html");
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'unfollow',
        success: function() {
            $('[data-value="following"]').replaceWith($(source.responseText).filter('[data-value="follow"]'));
        }
    })
}

function requestFriend() {
    var source = $.get("//www.autrovert.com/noRedirect/userControls.html");
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'requestFriend',
        success: function() {
            $('[data-value="addFriend"]').replaceWith($(source.responseText).filter('[data-value="requestSent"]'));
        }
    })
}

function acceptFriend() {
    var source = $.get("//www.autrovert.com/noRedirect/userControls.html");
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'acceptFriend',
        success: function() {
            $('[data-value="respond"]').replaceWith($(source.responseText).filter('[data-value="friends"]'));
            $('[data-value="follow"]').replaceWith($(source.responseText).filter('[data-value="following"]'));
        }
    })
}

function cancelRequest() {
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'cancelRequest',
        success: function() {
            $('[data-value="requestSent"]').replaceWith('<input type ="button" class="actionButton" value="Request Canceled" disabled style="cursor:default;color:#aaaaaa">');
        }
    })
}

function deleteRequest() {
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'deleteRequest',
        success: function() {
            $('[data-value="respond"]').html('<input type ="button" class="actionButton" value="Request Deleted" disabled style="cursor:default;color:#aaaaaa">');
        }
    })
}

function removeFriend() {
    var source = $.get('//www.autrovert.com/noRedirect/userControls.html');
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'removeFriend',
        success: function() {
            $('[data-value="following"]').replaceWith($(source.responseText).filter('[data-value="follow"]'));
            $('[data-value="friends"]').html('<input type ="button" class="actionButton" value="Friend Removed" disabled style="cursor:default;color:#aaaaaa">');
        }
    })
}



