<?php
require_once ("DB.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $page = $_GET['page'];
    $user_id = $_SESSION['user'];

    if ($page === '') {
        $followingposts = $db->query("SELECT posts.id, posts.type, posts.body, posts.date_posted, posts.likes, posts.comments, users.`username`, users.prof_img FROM users, posts, followers
        WHERE posts.user_id = followers.user_id
        AND users.id = posts.user_id
        AND follower_id = '".$user_id."'
        ORDER BY posts.date_posted DESC LIMIT 20;");
        if ($followingposts != null) {
            $response = "[";
            foreach ($followingposts as $post) {
                $formattedDate = date_create($post['date_posted']);
                $formattedDate = date_format($formattedDate, 'M j, Y g:i A');

                if ($db->query($db->query("SELECT user_id FROM post_likes WHERE post_id='".$post['id']."' AND user_id='".$user_id."'"))) {
                    $liked = 1;
                } else {
                    $liked = 0;
                }

                $response .= "{";
                $response .= '"PostId": "' . $post['id'] . '",';
                $response .= '"PostType": "'. $post['type']. '",';
                $response .= '"PostBody": "' . $post['body'] . '",';
                $response .= '"PostedBy": "' . $post['username'] . '",';
                $response .= '"PosterImg": "' .$post['prof_img'] . '",';
                $response .= '"PostDate": "' . $formattedDate . '",';
                $response .= '"PostLikes": "' . $post['likes'] . '",';
                $response .= '"PostComments": "' . $post['comments'] . '",';
                $response .= '"ViewerLiked": "' . $liked . '"';
                $response .= "},";
            }
            $response = substr($response, 0, strlen($response) - 1);
            $response .= "]";
        } else {
            $response = null;
        }

        http_response_code(200);
        echo $response;
    }
    elseif($page == 'profile') {
        $username = $_GET['username'];
    $user_id = mysqli_fetch_assoc($db->query("SELECT id FROM users WHERE username='".$username."'"))['id'];

        $followingposts = $db->query("SELECT posts.id, posts.type posts.body, posts.date_posted, posts.likes, posts.comments, users.`username`, users.prof_img FROM users, posts
        WHERE posts.user_id = '".$user_id."' AND users.id = '".$user_id."'
        ORDER BY posts.date_posted DESC LIMIT 10;");
        if ($followingposts != null) {
            $response = "[";
            foreach ($followingposts as $post) {
                $formattedDate = date_create($post['date_posted']);
                $formattedDate = date_format($formattedDate, 'M j, Y g:i A');

                if ($db->query("SELECT user_id FROM post_likes WHERE post_id='".$post['id']."' AND user_id='".$_SESSION['user']."'")) {
                    $liked = 1;
                } else {
                    $liked = 0;
                }

                $response .= "{";
                $response .= '"PostId": "' . $post['id'] . '",';
                $response .= '"PostType": "'. $post['type'] .'",';
                $response .= '"PostBody": "' . $post['body'] . '",';
                $response .= '"PostedBy": "' . $post['username'] . '",';
                $response .= '"PosterImg": "' .$post['prof_img'] . '",';
                $response .= '"PostDate": "' . $formattedDate . '",';
                $response .= '"PostLikes": "' . $post['likes'] . '",';
                $response .= '"PostComments": "' . $post['comments'] . '",';
                $response .= '"ViewerLiked": "' . $liked . '"';
                $response .= "},";
            }
            $response = substr($response, 0, strlen($response) - 1);
            $response .= "]";
        } else {
            $response = null;
        }

        http_response_code(200);
        echo $response;
    }
}