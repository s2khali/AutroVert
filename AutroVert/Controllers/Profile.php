<?php

class Profile extends Controller
{
    # GET USERNAME -- FOR HTML
    public static function getUsername() {
        if(isset($_GET['username'])) {
            if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {
                $username = DB::query('SELECT username FROM users WHERE username=:username',
                    array(':username'=>$_GET['username']))[0]['username'];
                return $username;
            } else {
                return 'Username not found'; // redirect to error page
            }
        }
    }
}

include('./Classes/DB.php');
include('./Classes/Login.php');

$userid = "";
$viewerid = "";

# CHECK IF LOGGED IN

if(!(Login::isLoggedIn())) {
    Login::redirect('index');
} else {
    $viewerid = Login::isLoggedIn();
}

# LOG OUT FUNCTION
if(isset($_GET['logout'])) {
    if (isset($_COOKIE['SNID'])) {
        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
    }
    setcookie('SNID', '1', time()-3600);
    setcookie('SNID_', '1', time()-3600);

    Login::redirect('index');
}

# FOLLOW
if(isset($_POST['follow'])) {
    $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid', array(':userid'=>$userid))) {
        DB::query('INSERT INTO followers VALUES (:id, :user_id, :follower_id)', array(':id'=>null, ':user_id'=>$userid, ':follower_id'=>$viewerid));
        echo 'followed';
    } else {
    }
}

# FRIEND REQUEST
if(isset($_POST['requestFriend'])) {
    $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
    $user_one = $viewerid;

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(!DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        DB::query('INSERT INTO relationship VALUES (:user_one, :user_two, :status, :actionUserID)',
            array(':user_one' => $user_one, ':user_two' => $user_two, ':status'=>0, ':actionUserID' => $viewerid));
    } else {
        echo json_encode('Status exists');
    }


}

