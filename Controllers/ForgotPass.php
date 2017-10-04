<?php

/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 3/19/2017
 * Time: 3:42 AM
 */
class ForgotPass extends Controller
{

}

include('./Classes/DB.php');
include('./Classes/Login.php');

const WEEK = 60 * 60 * 24 * 7;
const THREE_DAY = 60 * 60 * 24 * 3;

if(Login::isLoggedIn())
{
    Login::redirect('home');
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

            Login::redirect('home');

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