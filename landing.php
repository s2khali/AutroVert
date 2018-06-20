<?php
require("./db.php");
?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta name="description" content="AutroVert"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>AutroVert: The Social Network for Car Enthusiasts</title>
      <link rel="stylesheet" type="text/css" href="https://s3.us-east-2.amazonaws.com/autrovert/style/landing.css"/>
   </head>
   <body>
   <div class="global-wrapper">
      <div class="header">
         <div class="headWrapper">
            <div class="logo"><a href="/"><h1 class="autrovert-logo" id="login">AutroVert</h1></a></div>
            <form class="login-form" action="" method="post">
               <input name="user-login" type="text" id="txt_uname" class="login-text" autocapitalize="off" placeholder="Username or Email">
               <input name="pass-login" type="password" id="txt_pass" class="login-pass" placeholder="Password">
               <input name="submit-login" type="submit" id="btnLogin" value="Sign In">
               <a class="forgot-pass" href="forgot-pass.php">Forgot Password?</a>

               <?php // LOGIN
               if (isset($_POST['submit-login'])) {
                  if ($r = $db->query("SELECT username OR email FROM users WHERE username='" . $db->real_escape_string($_POST['user-login']) . "' OR email='" . $db->real_escape_string($_POST['user-login']) . "';")
                  ) {
                     if (password_verify($_POST['pass-login'], mysqli_fetch_assoc($db->query("SELECT password FROM users WHERE username='" . $db->real_escape_string($_POST['user-login']) . "' OR email='" . $db->real_escape_string($_POST['user-login']) . "';"))['password'])) {
                        if (session_id() == '') session_start();
                        $_SESSION['user'] = mysqli_fetch_assoc($db->query("SELECT id FROM users WHERE username='" . $db->real_escape_string($_POST['user-login']) . "' OR email='" . $db->real_escape_string($_POST['user-login']) . "';"))['id'];
                        $_SESSION['username'] = mysqli_fetch_assoc($db->query("SELECT username FROM users WHERE username='" . $db->real_escape_string($_POST['user-login']) . "' OR email='" . $db->real_escape_string($_POST['user-login']) . "';"))['username'];
                        $_SESSION['img'] = mysqli_fetch_assoc($db->query("SELECT prof_img FROM users WHERE username='" . $db->real_escape_string($_POST['user-login']) . "' OR email='" . $db->real_escape_string($_POST['user-login']) . "';"))['prof_img'];
                        header("Location: /");
                     } else {
                        echo '<a class="login-error">Invalid username or password.</a>';
                     }
                  } else {
                     echo '<a class="login-error">Invalid username or password.</a>';
                  }
               }
               ?>
            </form>
         </div>
      </div>
      <div class="main" data-delayed-url="">
         <form class="registerForm" method="post" action="">
            <h2 id="cms-font" class="headerReg">The Social Network for Car Enthusiasts!</h2>
            <h3 id="cms-font" class="subHeadReg">Sign up for free.</h3>
            <?php //Sign up
            if (isset($_POST['submit-reg'])) {

               $username = $_POST['reg_uname'];
               $email = $_POST['reg_email'];
               $hash_pass = password_hash($_POST['reg_pass'], PASSWORD_BCRYPT);

               if (($db->query("SELECT username FROM users WHERE username='" . $db->real_escape_string($username) . "';"))->num_rows === 0) {
                  if (strlen($username) >= 3 && strlen($username) <= 16) {
                     if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                        if (strlen($_POST['reg_pass']) >= 6 && strlen($_POST['reg_pass']) <= 60) {
                           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                              if (($db->query("SELECT email FROM users WHERE email='" . $db->real_escape_string($email) . "';"))->num_rows === 0) {
                                 if ($_POST['reg_pass'] === $_POST['reg_pass2']) {
                                    $db->query("INSERT INTO users (username, password, email, join_date) VALUES ('" . $db->real_escape_string($username) . "', '" . $db->real_escape_string($hash_pass) . "', '" . $db->real_escape_string($email) . "', DATE_FORMAT(NOW(),\"%y-%m-%d\"))");
                                    if (session_id() == '') session_start();
                                    $_SESSION['user'] = mysqli_fetch_assoc($db->query("SELECT id FROM users WHERE username='" . $db->real_escape_string($username) . "';"))['id'];
                                    $db->query("INSERT INTO followers (user_id, follower_id) VALUES ('" . $_SESSION['user'] . "', '" . $_SESSION['user'] . "')");
                                    $_SESSION['username'] = $username;
                                    $_SESSION['img'] = mysqli_fetch_assoc($db->query("SELECT prof_img FROM users WHERE username='" . $username . "';"))['prof_img'];
                                    header("Location: /");
                                 } else { // Password don't match
                                    echo "<div class='reg-error'>Passwords don't match!</div>";
                                 }
                              } else { // Email in use
                                 echo "<div class='reg-error'>Email is already in use!</div>";
                              }
                           } else { // Email
                              echo "<div class='reg-error'>Email is not valid!</div>";
                           }
                        } else {  // Password Length
                           echo "<div class='reg-error'>Password should be at least 6 characters long!</div>";
                        }
                     } else { // Username Invalid chars
                        echo "<div class='reg-error'>Username has invalid characters!</div>";
                     }
                  } else { // Username length
                     echo "<div class='reg-error'>Username should be 3 - 16 characters!</div>";
                  }
               } else { // Username taken
                  echo "<div class='reg-error'>Username is already taken!</div>";
               }
            }
            ?>
            <label for="reg_uname">Username (max 16 characters)</label>
            <input type="text" id="reg_uname" name="reg_uname" maxlength="16" required>
            <label for="reg_email">Email</label>
            <input type="text" id="reg_email" name="reg_email" required>
            <label for="reg_pass">Password (6 or more characters)</label>
            <input type="password" name="reg_pass" id="reg_pass" required>
            <label for="reg_pass2">Confirm Password</label>
            <input type="password" name="reg_pass2" id="reg_pass2" required>
            <span class="agreement">
                Version 0.1
            </span>
            <input name="submit-reg" type="submit" id="btnSignup" value="Join now">
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

   <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
   </body>
   </html>

<?php


