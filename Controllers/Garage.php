<?php

class Garage extends Controller
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