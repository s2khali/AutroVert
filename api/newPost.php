<?php
require_once ("DB.php");
$db = new DB("localhost", "autrovert", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    # SUBMIT POST

        $postBody = file_get_contents("php://input");
        $postBody = json_decode($postBody);

        $token = $_COOKIE['SNID'];
        $user_id = $db->query("SELECT user_id FROM login_tokens WHERE token=:token", array(':token'=>sha1($token)))[0]['user_id'];

        $postText = $postBody->body;

        if(!$postText==null) {
            $db->query('INSERT INTO posts VALUES (:id, :body, :user_id, NOW(),  0, 0)', array(':id' => null, ':body' => $postText, ':user_id' => $user_id));
            json_encode("foo");
        } else {
            json_encode("bar");
        }
    }
