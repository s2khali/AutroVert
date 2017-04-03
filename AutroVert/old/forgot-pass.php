<?php
include('Classes/DB.php');
include('Classes/Login.php');

const WEEK = 60 * 60 * 24 * 7;
const THREE_DAY = 60 * 60 * 24 * 3;

if(Login::isLoggedIn())
{
    Login::redirect('home.php');
}


# LOG IN
if(isset($_POST['btn-login']))
{
    $lusername = $_POST['txt_uname'];
    $lemail = $_POST['txt_uname'];
    $lpassword = $_POST['txt_pass'];

    if(DB::query('SELECT username OR email FROM users WHERE username=:username OR email=:email LIMIT 1',
        array(':username'=>$lusername, ':email'=>$lemail))) {

        if(password_verify($lpassword ,DB::query('SELECT password FROM users WHERE username=:username OR email=:email',
            array(':username'=>$lusername, ':email'=>$lemail))[0]['password'])) {

            $cstrong = true;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

            $user_id = DB::query('SELECT id FROM users WHERE username=:username OR email=:email LIMIT 1',
                array(':username'=>$lusername, ':email'=>$lemail))[0]['id'];
            DB::query('INSERT INTO login_tokens VALUES (:id, :token, :user_id)',
                array(':id'=>null, ':token'=>sha1($token), ':user_id'=>$user_id));

            setcookie("SNID", $token, time() + WEEK, '/', NULL, NULL, TRUE);
            setcookie("SNID_", '1', time() + THREE_DAY, '/', NULL, NULL, TRUE);

            Login::redirect('home.php');

        } else {
            // USER OR PASSWORD IS INCORRECT
            echo 'pass issue';
        }

    } else {
        // USER DOESN'T EXIST
        echo 'no user';
    }

}

# FORGOT PASSWORD

if(isset($_POST['btnForPass']))
{
    $cstrong = True;
    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

    $email = $_POST['for_email'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email' => $email))[0]['id'];
        DB::query('INSERT INTO password_tokens VALUES (:id, :token, :user_id)',
            array(':id' => null, ':token' => sha1($token), ':user_id' => $user_id));

        echo 'email sent';
    } else {
        // INVALID EMAIL
        echo 'invalid email';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AutroVert: Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="../style/front.css"/>
</head>
<body>
<div class="global-wrapper forPass">
    <div class="header">
        <div class="headWrapper">
            <div class="logo"><h1 class="autrovert-logo" id="login">AutroVert</h1></div>
            <form class="login-form" action="" method="post">
                <input type ="text" name="txt_uname" class="login-text" autocapitalize="off" tabindex="1" placeholder="Username or Email">
                <input type ="password" name="txt_pass" class="login-pass" tabindex="1" placeholder="Password">
                <input type ="submit" name="btn-login" value="Sign In" tabindex="1">
                <a class="forgot-pass" tabindex="1" href="forgot-pass.php">Forgot Password?</a>
            </form>
        </div>
    </div>
    <div class="main">
        <form class="forPassForm" action="" method="post">
            <h2 id="cms-font" class="headForPass">Please enter your email</h2>
            <label for="for_email">Email</label>
            <input type="text" name="for_email" required>
            <div class="forPassForm-actions"><input class="btnSubmit" type="submit" name="btnForPass" value="Reset Password"></div>
        </form>
    </div>
    <div class="footer-wrapper">
        <div id="footer">
            <div class="copyright">
                <span> AutroVert © 2017</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
