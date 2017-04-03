<?php

include('Classes/DB.php');
include('Classes/Login.php');

$username = "";
$userid = "";

# CHECK IF LOGGED IN

if(!(Login::isLoggedIn())) {
    Login::redirect('signup.php');
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

    Login::redirect('signup.php');
}

# MY PROFILE FUNCTION
if(isset($_GET['self'])) {
    $username = DB::query('SELECT username FROM users WHERE id=:user_id', array(':user_id'=>$userid))[0]['username'];
    Login::redirect("profile.php?username=$username");
}

# check if profile exists
if(isset($_GET['username'])) {
    if(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {
        $username = DB::query('SELECT username FROM users WHERE username=:username',
            array(':username'=>$_GET['username']))[0]['username'];
    } else {
        echo 'Username not found';
    }
}

?>

<!DOCTYPE html>
<html lang="en" id="autrovert">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $username; ?></title>
    <link rel="stylesheet" type="text/css" href="../style/front.css"/>
    <link rel="stylesheet" type="text/css" href="../style/profile.css"/>
</head>
<body>
<div class='av-container-nav'>
    <div class="navbar">
        <div class="av-topbar-search">

        </div>
        <div class='center-navbar'>
            <ul id='av-topnavbar'>
                <li><a class="topnavbar-text" href="#">Garages</a></li>
                <li><a class="topnavbar-text" href="?self">My Profile</a></li>
                <li><a class='autrovert-logo' href="../index.php">Autro<span class='vert'>Vert</span></a></li>
                <li><a class="topnavbar-text" href="#">Classifieds</a></li>
                <li><a class="topnavbar-text" href="#">Meets</a></li>
            </ul>
        </div>
        <div class="av-topbar-logout" >
            <a class="logout-button" href="?logout"><img title="Logout" src="../style/icons/logout2.png" width='37px' height='37px' ></a>
        </div>
    </div>
</div>

<div class="global-container">
    <div class="content">
        <div class="main-container">
            <div class="contentColumn">
                <div class="content">
                    <div class="profile-top-section">
                        <div class="main-photo">

                        </div>
                        <div class="profile-nav-bar">

                        </div>
                    </div>
                </div>
                <div class="rightColumn">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
