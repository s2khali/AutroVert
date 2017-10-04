<?php

class Index extends Controller {

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

    if(DB::query('SELECT username OR email FROM users WHERE username=:username OR email=:email LIMIT 1',
        array(':username'=>$lusername, ':email'=>$lemail))) {

        if(password_verify($_POST['txt_pass'] ,DB::query('SELECT password FROM users WHERE username=:username OR email=:email',
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
        // USER DOESN'T EXIST -- Still use user or pass incorrect
        echo 'no user';
    }

}

# SIGN UP
if(isset($_POST['btnSignup']))
{
    $username = $_POST['reg_uname'];
    $email = $_POST['reg_email'];

    $hash_pass = password_hash($_POST['reg_pass'], PASSWORD_DEFAULT, array("cost" => 11));

    if(!(DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username)))) {
        if(strlen($username) >= 3 && strlen($username) <= 16) {
            if(preg_match('/[a-zA-Z0-9_]+/', $username)) {
                if (strlen($_POST['reg_pass']) >= 6 && strlen($password) <= 60) {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if(!(DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email)))) {
                            DB::query('INSERT INTO users VALUES (:id, :username, :password, :email, DATE_FORMAT(NOW(),"%y-%m-%d"))',
                                array(':id' => null, ':username' => $username, ':password' => $hash_pass,
                                    ':email' => $email));
                            $id = DB::query('SELECT id FROM users WHERE username=:username OR email=:email LIMIT 1',
                                array(':username'=>$username, ':email'=>$email))[0]['id'];
                            DB::query('INSERT INTO followers VALUES (:id, :userid, :userid)', array(':id'=> null, ':userid'=>$id));

                            $cstrong = true;
                            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

                            $user_id = DB::query('SELECT id FROM users WHERE username=:username OR email=:email LIMIT 1',
                                array(':username'=>$username, ':email'=>$email))[0]['id'];
                            DB::query('INSERT INTO login_tokens VALUES (:id, :token, :user_id)',
                                array(':id'=>null, ':token'=>sha1($token), ':user_id'=>$user_id));

                            setcookie("SNID", $token, time() + WEEK, '/', NULL, NULL, TRUE);
                            setcookie("SNID_", '1', time() + THREE_DAY, '/', NULL, NULL, TRUE);

                            Login::redirect('home');
                        } else {
                            //EMAIL ALREADY IN USE
                        }
                    }
                    else{
                        //INVALID EMAIL
                    }
                } else {
                    //INVALID PASS
                }
            } else {
                //INVALID USERNAME
            }
        } else {
            //INVALID USERNAME
        }
    } else {
        //USERNAME ALREADY IN USE
        echo 'USERNAME IN USE';
    }

}
