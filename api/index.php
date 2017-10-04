<?php
require_once ("DB.php");
$db = new DB("localhost", "autrovert", "root", "");

const WEEK = 60 * 60 * 24 * 7;
const THREE_DAY = 60 * 60 * 24 * 3;

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if($_GET['url'] == "auth") {
        $clientToken = $_COOKIE["SNID"];

        if ($db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token' => sha1($clientToken)))) {
            $userid = $db->query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token' => sha1($clientToken)))[0]['user_id'];

            if ($clientToken != null) {
                echo '{ "Auth": true }';
            } else {
                $cstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                $db->query('INSERT INTO login_tokens VALUES (:id, :token, :user_id)',
                    array(':id' => null, ':token' => sha1($token), ':user_id' => $userid));
                $db->query('DELETE FROM login_tokens WHERE token=:token', array(':token' => sha1($clientToken)));

                setcookie("SNID", $token, time() + WEEK, '/', NULL, NULL, TRUE);
                setcookie("SNID_", '1', time() + THREE_DAY, '/', NULL, NULL, TRUE);

                echo '{ "Auth": true }';

            }
        }
    } else {
        echo json_encode(0);
    }

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

    # SIGN UP
    if($_GET['url'] == "users") {
        $postBody = file_get_contents("php://input");
        $postBody = json_decode($postBody);

        $username = $postBody->username;
        $email = $postBody->email;
        $hash_pass = password_hash($postBody->password, PASSWORD_BCRYPT);

        if(!($db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username)))) {

            if(strlen($username) >= 3 && strlen($username) <= 16) {

                if(preg_match('/[a-zA-Z0-9_]+/', $username)) {

                    if (strlen($postBody->password) >= 6 && strlen($postBody->password) <= 60) {

                        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            if(!($db->query('SELECT email FROM users WHERE email=:email', array(':email'=>$email)))) {
                                //Success
                                $db->query('INSERT INTO users VALUES (:id, :username, :password, :email, DATE_FORMAT(NOW(),"%y-%m-%d"))',
                                    array(':id' => null, ':username' => $username, ':password' => $hash_pass,
                                        ':email' => $email));
                                $id = $db->query('SELECT id FROM users WHERE username=:username OR email=:email LIMIT 1',
                                    array(':username'=>$username, ':email'=>$email))[0]['id'];
                                $db->query('INSERT INTO followers VALUES (:id, :userid, :userid)', array(':id'=> null, ':userid'=>$id));

                                echo '{ "Success": "User Created!" }';
                                http_response_code(200);
                            } else {
                                echo 'Email in use';
                                http_response_code(409);
                            }
                        }
                        else{
                            echo 'Invalid email';
                            http_response_code(409);
                        }
                    } else {
                        echo 'Invalid password';
                        http_response_code(409);
                    }
                } else {
                    echo 'Invalid username';
                    http_response_code(409);
                }
            } else {
                echo 'Invalid username';
                http_response_code(409);
            }
        } else {
            echo 'Username exists';
            http_response_code(409);
        }
    }

    if($_GET['url'] == "auth") {

        $postBody = file_get_contents("php://input");
        $postBody = json_decode($postBody);

        $username = $postBody->username;
        $password = $postBody->password;

        if ($db->query('SELECT username OR email FROM users WHERE username=:username OR email=:email LIMIT 1',
            array(':username' => $username, ':email' => $username))
        ) {

            if (password_verify($password, $db->query('SELECT password FROM users WHERE username=:username OR email=:email',
                array(':username' => $username, ':email' => $username))[0]['password'])) {

                $cstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

                $user_id = $db->query('SELECT id FROM users WHERE username=:username OR email=:email LIMIT 1',
                    array(':username' => $username, ':email' => $username))[0]['id'];
                $db->query('INSERT INTO login_tokens VALUES (:id, :token, :user_id)',
                    array(':id' => null, ':token' => sha1($token), ':user_id' => $user_id));


                setcookie("SNID", $token, time() + WEEK, '/', NULL, NULL, TRUE);
                setcookie("SNID_", '1', time() + THREE_DAY, '/', NULL, NULL, TRUE);

                echo '{  "Auth": true, "Token": "' . $token . '" }';
            } else {
                echo '{ "Error": "Invalid Username or Password!" }';
                http_response_code(401);
            }
        } else {
            echo '{ "Error": "Invalid Username or Password!" }';
            http_response_code(401);
        }
    } else if($_GET['url'] == 'like') {
        $postId = $_GET['id'];
        $token = $_COOKIE['SNID'];
        $likerId = $db->query("SELECT user_id FROM login_tokens WHERE token=:token", array(':token'=>sha1($token)))[0]['user_id'];

        if(!($db->query('SELECT user_id FROM post_likes WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$postId, ':user_id'=>$likerId)))) {
            $db->query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
            $db->query('INSERT INTO post_likes VALUES (:postid, :id, :userid)', array(':id'=>null, ':postid'=>$postId, ':userid'=>$likerId));
            echo json_encode(1);
        } else {
            $db->query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
            $db->query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
            echo json_encode(0 );
        }
    }
}