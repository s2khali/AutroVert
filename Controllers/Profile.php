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

    echo json_encode("foo");

    if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:viewerid', array(':userid'=>$userid, ':viewerid'=>$viewerid))) {
        DB::query('INSERT INTO followers VALUES (:id, :user_id, :follower_id)', array(':id'=>null, ':user_id'=>$userid, ':follower_id'=>$viewerid));
    } else {
        echo json_encode('Already following');
    }
}

# UNFOLLOW
if(isset($_POST['unfollow'])) {
    $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if(DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:viewerid', array(':userid'=>$userid, ':viewerid'=>$viewerid))) {
        DB::query('DELETE FROM followers WHERE user_id=:user_id AND follower_id=:follower_id', array(':user_id'=>$userid, ':follower_id'=>$viewerid));
    } else {
        echo json_encode('Not following');
    }
}

# SEND FRIEND REQUEST
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

#ACCEPT FRIEND REQUEST
if(isset($_POST['acceptFriend'])){
   $user_one = $viewerid;
   $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        DB::query('UPDATE relationship SET status="1" WHERE user_one=:user_one AND user_two=:user_two', array(':user_one'=>$user_one, ':user_two'=>$user_two));
        if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:viewerid', array(':userid'=>$user_one, ':viewerid'=>$user_two))){
            DB::query('INSERT INTO followers VALUES (:id, :user_id, :follower_id)', array(':id'=>null, ':user_id'=>$user_one, ':follower_id'=>$user_two));
        }
        if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:viewerid', array(':userid'=>$user_two, ':viewerid'=>$user_one))){
            DB::query('INSERT INTO followers VALUES (:id, :user_id, :follower_id)', array(':id'=>null, ':user_id'=>$user_two, ':follower_id'=>$user_one));
        }
    }
}

# CANCEL FRIEND REQUEST
if(isset($_POST['cancelRequest'])){
    $user_one = $viewerid;
    $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        DB::query('DELETE FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
            array(':user_one'=>$user_one, ':user_two'=>$user_two));
    }
}

# DELETE FRIEND REQUEST
if(isset($_POST['deleteRequest'])) {
    $user_one = $viewerid;
    $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        DB::query('DELETE FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
            array(':user_one'=>$user_one, ':user_two'=>$user_two));
    }
}

# REMOVE FRIEND
if(isset($_POST['removeFriend'])) {
    $user_one = $viewerid;
    $user_two = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];

    if ($user_one > $user_two) {
        $temp = $user_one;
        $user_one = $user_two;
        $user_two = $temp;
    }

    if(DB::query('SELECT status FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
        array(':user_one'=>$user_one, ':user_two'=>$user_two))) {
        DB::query('DELETE FROM relationship WHERE user_one=:user_one AND user_two=:user_two',
            array(':user_one'=>$user_one, ':user_two'=>$user_two));
        if(DB::query('SELECT follower_id FROM followers WHERE user_id=:user_id AND follower_id=:viewerid', array(':user_id'=>$user_one, ':viewerid'=>$user_two))) {
            DB::query('DELETE FROM followers WHERE user_id=:user_id AND follower_id=:follower_id', array(':user_id' => $user_one, ':follower_id' => $user_two));
        }
        if(DB::query('SELECT follower_id FROM followers WHERE user_id=:user_id AND follower_id=:viewerid', array(':user_id'=>$user_two, ':viewerid'=>$user_one))) {
            DB::query('DELETE FROM followers WHERE user_id=:user_id AND follower_id=:follower_id', array(':user_id' => $user_two, ':follower_id' => $user_one));
        }
    }
}

# SUBMIT POST
if(isset($_POST['postBody'])) {
    $user_id = $viewerid;
    $postbody = $_POST['postBody'];

    if(!$postbody==null) {
        DB::query('INSERT INTO posts VALUES (:id, :body, :user_id, NOW(),  0, 0)', array(':id' => null, ':body' => $postbody, ':user_id' => $user_id));
    }
}

