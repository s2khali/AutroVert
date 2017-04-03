<?php

class Controller
{
    public static function CreateView($viewName) {
    require_once("./Views/$viewName.php");
    }

    public static function getUser()
    {
        $userid = Login::isLoggedIn();
        $username = DB::query('SELECT username FROM users WHERE id=:user_id', array(':user_id' => $userid))[0]['username'];
        echo $username;
    }
}