<?php
require_once ("DB.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    # SUBMIT POST

        $incomingPost = file_get_contents("php://input");
        $incomingPost = json_decode($incomingPost);

        $userid = $_SESSION['user'];

        $postType = $incomingPost->type;
        $postText = $incomingPost->body;

        if(!$postText==null) {
            if($db->query("INSERT INTO posts (type, body, user_id, date_posted, likes, comments) VALUES ('".$postType."','".$postText."', '".$userid."', NOW(),  0, 0);")){

        $submittedpost = $db->query("SELECT posts.id, posts.type, posts.body, posts.date_posted, posts.likes, posts.comments, users.`username`, users.prof_img FROM users, posts
        WHERE users.id='".$userid."' AND posts.id = (SELECT MAX(id) FROM posts WHERE user_id = '".$userid."')");
        echo json_encode(mysqli_fetch_assoc($submittedpost));
        }} else {
            echo json_encode("bar");
        }
    }
