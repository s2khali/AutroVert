<?php
require_once ("DB.php");
$db = new DB("localhost", "autrovert", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $page = $_GET['page'];
    $token = $_COOKIE['SNID'];
    $user_id = $db->query("SELECT user_id FROM login_tokens WHERE token=:token", array(':token' => sha1($token)))[0]['user_id'];

    if ($page == 'home') {
        $followingposts = $db->query('SELECT posts.id, posts.body, posts.date_posted, posts.likes, posts.comments, users.`username` FROM users, posts, followers
        WHERE posts.user_id = followers.user_id
        AND users.id = posts.user_id
        AND follower_id = :userid
        ORDER BY posts.date_posted DESC LIMIT 20;', array(':userid' => $user_id));
        if ($followingposts != null) {
            $response = "[";
            foreach ($followingposts as $post) {
                $formattedDate = date_create($post['date_posted']);
                $formattedDate = date_format($formattedDate, 'M j, Y g:i A');

                if ($db->query('SELECT user_id FROM post_likes WHERE post_id=:post_id AND user_id=:user_id', array(':post_id' => $post['id'], ':user_id' => $user_id))) {
                    $liked = 1;
                } else {
                    $liked = 0;
                }

                $response .= "{";
                $response .= '"PostId": "' . $post['id'] . '",';
                $response .= '"PostBody": "' . $post['body'] . '",';
                $response .= '"PostedBy": "' . $post['username'] . '",';
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
        $user_id = $db->query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];

        $followingposts = $db->query('SELECT posts.id, posts.body, posts.date_posted, posts.likes, posts.comments, users.`username` FROM users, posts
        WHERE posts.user_id = :userid AND users.id = :userid
        ORDER BY posts.date_posted DESC LIMIT 10;', array(':userid' => $user_id));
        if ($followingposts != null) {
            $response = "[";
            foreach ($followingposts as $post) {
                $formattedDate = date_create($post['date_posted']);
                $formattedDate = date_format($formattedDate, 'M j, Y g:i A');

                if ($db->query('SELECT user_id FROM post_likes WHERE post_id=:post_id AND user_id=:user_id', array(':post_id' => $post['id'], ':user_id' => $user_id))) {
                    $liked = 1;
                } else {
                    $liked = 0;
                }

                $response .= "{";
                $response .= '"PostId": "' . $post['id'] . '",';
                $response .= '"PostBody": "' . $post['body'] . '",';
                $response .= '"PostedBy": "' . $post['username'] . '",';
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