var pathname = window.location.pathname.substr(1);
var params = window.location.search.substr(1);


$(function() {
    $.ajax({
        type: "GET",
        url: "api/feeder.php?page=" + pathname + "&" + params,
        processData: false,
        contentType: "application/json",
        data: '',
        success: function (r) {
            if (r != "") {
                var posts = JSON.parse(r)
                $.each(posts, function (index) {
                    $('#feed').html(
                        $('#feed').html() + '<div class="postWrapper"><div class="postHeader"><div class="posterProfile"><a class="posterProfileA" href="profile?username=' + posts[index].PostedBy + '"><img class="posterPic" src="//www.autrovert.com/temp/prof_256x256.jpg"><span>' + posts[index].PostedBy + '</span></a><label class="postTime">' + posts[index].PostDate + '</label></div></div><div class="postBody">' + posts[index].PostBody + '</div><div class="postFooter">' +
                        '<div class="postLikes"><a class="footerButton" data-id="' + posts[index].PostId + '"></a></div>' +
                        '<div class="postComments"><a class="footerButton"><span>Comment</span></a></div></div></div>'
                    )
                    if (posts[index].ViewerLiked == 1) {
                        $("[data-id = '" + posts[index].PostId + "']").html('<img class="likeIcon" src="//www.autrovert.com/style/icons/thumb_up_red.png"><span id="likeRed">Like</span>')
                    } else {
                        $("[data-id = '" + posts[index].PostId + "']").html('<img class="likeIcon" src="//www.autrovert.com/style/icons/thumb_up_grey.png"><span id="likeGrey">Like</span>')
                    }

                    $('[data-id]').click(function (e) {
                        var buttonid = $(this).attr('data-id');
                        $.ajax({
                            type: "post",
                            url: "api/like.php?id=" + $(this).attr('data-id'),
                            processData: false,
                            contentType: "application/json",
                            data: '',
                            success: function (r) {
                                console.log(r);
                                if (r == 1) {
                                    $("[data-id='" + buttonid + "']").html('<img class="likeIcon" src="//www.autrovert.com/style/icons/thumb_up_red.png"><span id="likeRed">Like</span>')
                                } else {
                                    $("[data-id='" + buttonid + "']").html('<img class="likeIcon" src="//www.autrovert.com/style/icons/thumb_up_grey.png"><span id="likeGrey">Like</span>')
                                }
                            }
                        })
                        e.preventDefault();
                    })
                })
            } else {
                $('#feed').html("<h3>No Feed</h3>");
            }
        }
    })
})
