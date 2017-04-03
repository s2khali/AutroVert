<?php

class Login
{
    public static function isLoggedIn() {

        if(isset($_COOKIE['SNID'])) {
            if(DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
                $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];

                if (isset($_COOKIE['SNID_'])) {
                    return $userid;
                } else {
                    $cstrong = true;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    DB::query('INSERT INTO login_tokens VALUES (:id, :token, :user_id)',
                        array(':id'=>null, ':token'=>sha1($token), ':user_id'=>$userid));
                    DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));

                    setcookie("SNID", $token, time() + WEEK, '/', NULL, NULL, TRUE);
                    setcookie("SNID_", '1', time() + THREE_DAY, '/', NULL, NULL, TRUE);

                    return $userid;

                }
            }
        }

        return false;
    }

    public static function redirect($url) {
        header("Location: $url");
    }
}