<?php
if(empty($_SESSION['user'])) {
header("location: /");
}

?>
<!DOCTYPE html>
<html lang="en" id="autrovert">
<head>
<meta charset = "utf-8"/>
<meta name="description" content="AutroVert"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" href="/style/front.css"/>