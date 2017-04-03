<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AutroVert: Log In or Sign Up</title>
    <link rel="stylesheet" type="text/css" href="/AutroVert/style/front.css"/>
</head>
<body>
<div class="global-wrapper">
    <div class="header">
        <div class="headWrapper">
            <div class="logo"><h1 class="autrovert-logo" id="login">AutroVert</h1></div>
            <form class="login-form" action="" method="post">
                <input type ="text" name="txt_uname" class="login-text" autocapitalize="off" tabindex="1" placeholder="Username or Email">
                <input type ="password" name="txt_pass" class="login-pass" tabindex="1" placeholder="Password">
                <input type ="submit" name="btn-login" value="Sign In" tabindex="1">
                <a class="forgot-pass" tabindex="1" href="forgot-pass">Forgot Password?</a>
            </form>
        </div>
    </div>
    <div class = "main" data-delayed-url="">
        <form class="registerForm" action="" method ="post">
            <h2 id="cms-font" class="headerReg">The social network for enthusiasts!</h2>
            <h3 id="cms-font" class="subHeadReg">Sign up for free.</h3>
            <label for="reg_uname">Username (max 16 characters)</label>
            <input type="text" name="reg_uname" tabindex="1" maxlength="16" required>
            <label for="reg_email">Email</label>
            <input type="text" name="reg_email" tabindex="1" required>
            <label for="reg_pass">Password (6 or more characters)</label>
            <input type="password" name="reg_pass" tabindex="1" required>
            <span class="agreement">
                By clicking Join now, you agree to the nonexistent AutroVert User Agreement and Privacy Policy. *Coming Soon*
            </span>
            <input type="submit" name="btnSignup" tabindex="1" value="Join now">
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