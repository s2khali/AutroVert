<?php
require_once ("DB.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    {
        $postId = $_GET['id'];
        $token = $_COOKIE['SNID'];
        $likerId = $db->query("SELECT user_id FROM login_tokens WHERE token=:token", array(':token' => sha1($token)))[0]['user_id'];

        if (!($db->query('SELECT user_id FROM post_likes WHERE post_id=:post_id AND user_id=:user_id', array(':post_id' => $postId, ':user_id' => $likerId)))) {
            $db->query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid' => $postId));
            $db->query('INSERT INTO post_likes (id, post_id, user_id) VALUES (:id, :postid, :userid)', array(':id' => null, ':postid' => $postId, ':userid' => $likerId));
            $numLikes = $db->query('SELECT likes FROM posts WHERE id=:post_id', array(':post_id' => $postId))[0]['likes'];
            $response = '{"liked": "1", "numLikes": "' . $numLikes . '"}';
            echo $response;
        } else {
            $db->query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid' => $postId));
            $db->query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid' => $postId, ':userid' => $likerId));
            $numLikes = $db->query('SELECT likes FROM posts WHERE id=:post_id', array(':post_id' => $postId))[0]['likes'];
            $response = '{"liked": "0", "numLikes": "' . $numLikes . '"}';
            echo $response;
        }
    }
}