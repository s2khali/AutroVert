<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AutroVert: Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="//www.autrovert.com/style/front.css"/>
</head>
<body>
<div class="global-wrapper forPass">
    <div class="header">
        <div class="headWrapper">
            <div class="logo"><a href="index"><h1 class="autrovert-logo" id="login">AutroVert</h1></a></div>
            <form class="login-form" action="" method="post">
                <input type ="text" name="txt_uname" class="login-text" autocapitalize="off" tabindex="1" placeholder="Username or Email">
                <input type ="password" name="txt_pass" class="login-pass" tabindex="1" placeholder="Password">
                <input type ="submit" name="btn-login" value="Sign In" tabindex="1">
                <a class="forgot-pass" tabindex="1" href="forgot-pass">Forgot Password?</a>
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