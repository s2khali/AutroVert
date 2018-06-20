<?php
include("./db.php");

$r = $db->query("SELECT password FROM users WHERE username='s2khali' OR email='s2khali';");
print_r(mysqli_fetch_assoc($r)['password']);
echo "<br>";
print(password_hash('illaaj', PASSWORD_DEFAULT, array("cost" => 11)));
echo "<br>";

if(password_verify('illaaj', password_hash('illaaj', PASSWORD_DEFAULT, array("cost" => 11)))){
print("foo");
} else {
print("bar");
}