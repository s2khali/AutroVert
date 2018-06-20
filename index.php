<?php
session_start();

if(empty($_SESSION['user'])) {
include("./landing.php");
} else {
include("./home.php");
}

