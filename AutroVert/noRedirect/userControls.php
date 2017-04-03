<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/AutroVert/Classes/DB.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/AutroVert/Classes/Login.php');

# GET THE REQUEST PASSED BY AJAX
$request = $_GET["request"];

# GET THE USERNAME FROM THE PROFILE PAGE
$referer = $_SERVER['HTTP_REFERER'];
$query = parse_url($referer, PHP_URL_QUERY);
parse_str($query, $params);
$username = $params['username'];

# CHECK IF THE VISITOR IS VISITING THEIR OWN PAGE
if($request == "checkUser") {
    $viewerid = Login::isLoggedIn();
    $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username' => $username))[0]['id'];

    if ($userid == $viewerid) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}

# CHECK FRIEND RELATIONSHIP
/**
 *  0 - no active status
 *  1 - request sent
 *  2 - active request with user
 *  3 - friends
 */
if($request == "checkFriend") {
    $viewerid = Login::isLoggedIn();
    $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
    $user_one = $viewerid;


    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(!DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        echo json_encode(0);
    } else {
        $status = DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
            array(':user_one'=>$user_one, ':user_two'=>$user_two))[0]['status'];
        $actionUser = DB::query('SELECT actionUserID FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
            array(':user_one'=>$user_one, ':user_two'=>$user_two))[0]['actionUserID'];
        if ($status == 0 && $viewerid == $actionUser) {
            echo json_encode(1);
        } else if ($status == 0 && $viewerid != $actionUser) {
            echo json_encode(2);
        } else if ($status == 1) {
            echo json_encode(3);
        }
    }
}

# CHECK IF THE VIEWER IS FOLLOWING
if($request == 'checkFollower') {
    $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username' => $username))[0]['id'];

    if(DB::query('SELECT follower_id FROM followers WHERE user_id=:userid', array(':userid'=>$userid))) {
        echo json_encode(false);
    } else {
        echo json_encode(false);
    }
}



