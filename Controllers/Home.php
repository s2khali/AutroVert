<?php

class Home extends Controller
{

}

include('./Classes/DB.php');
include('./Classes/Login.php');

$userid = "";

# CHECK IF LOGGED IN
if(!(Login::isLoggedIn())) {
    Login::redirect('/');
} else {
    $userid = Login::isLoggedIn();
}

# LOG OUT FUNCTION
if(isset($_GET['logout'])) {
    if (isset($_COOKIE['SNID'])) {
        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
    }
    setcookie('SNID', '1', time()-3600);
    setcookie('SNID_', '1', time()-3600);

    Login::redirect('/');
}