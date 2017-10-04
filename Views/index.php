<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AutroVert: Log In or Sign Up</title>
    <link rel="stylesheet" type="text/css" href="//www.autrovert.com/style/front.css"/>
</head>
<body>
<div class="global-wrapper">
    <div class="header">
        <div class="headWrapper">
            <div class="logo"><h1 class="autrovert-logo" id="login">AutroVert</h1></div>
            <form class="login-form" method="post">
                <input type="text" id="txt_uname" class="login-text" autocapitalize="off" placeholder="Username or Email">
                <input type="password" id="txt_pass" class="login-pass" placeholder="Password">
                <input type="submit" id="btnLogin" value="Sign In">
                <a class="forgot-pass" href="forgot-pass">Forgot Password?</a>
            </form>
        </div>
    </div>
    <div class = "main" data-delayed-url="">
        <form class="registerForm" method ="post">
            <h2 id="cms-font" class="headerReg">The social network for enthusiasts!</h2>
            <h3 id="cms-font" class="subHeadReg">Sign up for free.</h3>
            <label for="reg_uname">Username (max 16 characters)</label>
            <input type="text" id="reg_uname" maxlength="16" required>
            <label for="reg_email">Email</label>
            <input type="text" id="reg_email" required>
            <label for="reg_pass">Password (6 or more characters)</label>
            <input type="password" id="reg_pass" required>
            <span class="agreement">
                Version 0.1
            </span>
            <input type="submit" id="btnSignup" value="Join now">
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
<script src="//www.autrovert.com/Controllers/index.js"></script>
</body>
</html>