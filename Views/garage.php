<!DOCTYPE html>
<html lang="en" id="autrovert">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo Garage::getUsername(); ?>'s Garage</title>
    <link rel="stylesheet" type="text/css" href="//www.autrovert.com/style/front.css"/>
    <link rel="stylesheet" type="text/css" href="//www.autrovert.com/style/garage.css"/>

</head>
<body>
<header>
    <div id='topBarNav'>
        <div id="navbar">
            <div id='left-navbar'>
                <a class="autrovert-logo-small" href="home">AV</a>
                <a class='autrovert-logo' href="home">AutroVert</a>
                <div role="search" id="search">
                    <form action="" method="get">
                        <button value="1" id="searchButton" type="submit">
                            <img id="searchButtonPic" src="//www.autrovert.com/style/icons/search-icon.png">
                        </button>
                        <div id="searchBar">
                            <input type="text" name="searchText" id="searchText" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
            <div id="right-navbar">
                <div id="leftRightNav">
                    <div id="profileNav">
                        <a id="profileButton" title="My Profile" href="profile?username=<?php echo Controller::getUser(); ?>">
                            <img id="profImg" src="http:://wwww.autrovert.com/temp/prof_256x256.jpg">
                            <span><?php echo Controller::getUser(); ?></span>
                        </a>
                    </div>
                    <div id="garageNav">
                        <a id="garageButton" title="My Garage" class="topBarButton" href="garage?username=<?php echo Controller::getUser(); ?>">
                            <img id="garageIcon" src="//wwww.autrovert.com/style/icons/garage-icon.png">
                        </a>
                    </div>
                </div>
                <div id="left-navbar">
                    <div id="notificationNav">
                        <a id="notificationButton" title="Notifications" class="topBarButton" href="#">
                            <img id="notificationIcon" src="//wwww.autrovert.com/style/icons/notification-icon.png">
                        </a>
                    </div>
                    <div id="topBarLogout" >
                        <a href="?logout"><img title="Logout" class="topBarButton" id="logoutIcon" src="//www.autrovert.com/style/icons/logout.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="global-container">
    <div id="content">
        <div id="garageHeader">
            <a id="headerProfileButton" href="profile?username=<?php echo Controller::getUser(); ?>">
                Return to Profile
            </a>
            <div id="garageProfPic">
                <img id="garageProfile" src="http://wwww.autrovert.com/temp/prof_256x256.jpg">
                <h2 id="garageUsername">Welcome to <?php echo Controller::getUser(); ?>'s Garage</h2>
            </div>
        </div>
    </div>
    <div id="mainContainer">
        <div id="center-column">
            <div id="garageFeed"></div>
        </div>
    </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//www.autrovert.com/Scripts/topBar.js"></script>
<script src="//www.autrovert.com/Scripts/react/garage.bundle.js"></script>
</body>
</html>