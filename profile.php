<?php
require("./db.php");
session_start();
include("./head.php");

if ($_SESSION['username'] === $_GET['username']) { // If the viewer is looking at their own profile
$myprof = true;
$username = $_SESSION['username'];
} else {
$username = $_GET['username'];
}
$profile = mysqli_fetch_assoc($db->query("SELECT * FROM users WHERE username='" . $username . "'"));
$privacy = mysqli_fetch_assoc($db->query("SELECT * FROM privacy WHERE userid='" . $profile['id'] . "'"));

?>
<title>AutroVert | <?php echo $profile['username']; ?>'s Profile</title>
<link rel="stylesheet" href="/style/profile.css"/>
<?php include("./header.php"); ?>

<div class="global-container">
<div id="content">
<div id="mainContainer">
<div id="profileTopSection">
<div id="mainPhotoWrapper">
<div id="mainPhoto">
<a href="#">
<img src="<?php echo $profile['cover_img']; ?>" title="View Original Image"/>
</a>
</div>
</div>
</div>

<div class="leftColumn">
<div class="profileInfo">
<h1 class="profileHeader"><?php echo $username; ?></h1>
<div class="profilePicWrapper">
<a href="#"><img src="<?php echo $profile['prof_img']; ?>" title="<?php echo $username;?>"/></a>
</div>
<div id="profileInfo">
<ul class="userInformation">
<h4><?php echo $username;?>'s Info</h4>
<?php
echo ($privacy['name'] == '1' && (!empty($profile['realname']))) ? "<li class='realName'>{$profile['realname']}</li>" : "";
echo ($privacy['location'] == '1' && (!empty($profile['location']))) ? "<li class='location'>{$profile['location']}</li>" : "";
echo ($privacy['instagram'] == '1' && (!empty($profile['instagram']))) ? "<li class='instagram'><a href='https://www.instagram.com/{$profile['instagram']}/'>@{$profile['instagram']}</a></li>" : "";
?>
</ul>
<ul class="userVehicles">
<h4><?php echo $username;?>'s Rides</h4>
<?php

?>
</ul>
</div>
</div>
</div>

<div id="center-column">
<div id="feedComposer">
<div id="postComposer"></div>
<div id="feed"></div>
</div>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://s3.us-east-2.amazonaws.com/autrovert/scripts/topBar.js"></script>
<script>if($('ul.userInformation li').length < 1){$('ul.userInformation').append("<li>Nothing to show...</li>")}</script>
</body>
</html>
