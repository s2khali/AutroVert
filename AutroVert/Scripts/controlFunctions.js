function follow() {
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'follow',
        success: function() {
            $('[data-value="follow"]').html('<input type ="button" class="actionButton"value="Following">');
            $('[data-value="follow"]').attr('data-value', 'following');
        }
    })
}

function requestFriend() {
    $.ajax({
        url: $(location).attr('href'),
        method: 'post',
        data: 'requestFriend',
        success: function(data) {
            $('[data-value="addFriend"]').html('<input type ="button" class="actionButton" value="Request Sent">');
            $('[data-value="addFriend"]').attr('data-value', 'friends');
        }
    })
}


