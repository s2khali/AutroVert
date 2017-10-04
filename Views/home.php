<!DOCTYPE html>
<html lang="en" id="autrovert">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>AutroVert</title>
    <link rel="stylesheet" href="//www.autrovert.com/style/front.css"/>
    <link rel="stylesheet" href="//www.autrovert.com/style/home.css"/>
    <link rel="stylesheet" href="//www.autrovert.com/style/feed.css"/>
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
                            <img id="profImg" src="//wwww.autrovert.com/temp/prof_256x256.jpg">
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
        <div id="mainContainer">
            <div class="leftColumn">
                <div id="quickLinks">
                    <ul class="leftNavUL">
                        <div class="buttonWrapper">
                            <a href="profile?username=<?php echo Controller::getUser(); ?>" class="quickButton" id="quickMyProf">
                                <span class="quickFont">My Profile</span>
                            </a>
                        </div>
                        <div class="buttonWrapper">
                            <a href="garage?username=<?php echo Controller::getUser(); ?>" class="quickButton" id="quickMyGarage">
                                <span class="quickFont">My Garage</span>
                            </a>
                        </div>
                    </ul>
                    <ul class="leftNavUL">
                        <h5 class="leftNavHeader">Explore</h5>
                        <div class="buttonWrapper">
                            <a href="#" class="quickButton" id="quickBrowseGarage">
                                <span class="quickFont">Browse Cars</span>
                            </a>
                        </div>
                        <h5 class="leftNavHeader">Coming Soon</h5>
                        <div class="buttonWrapper">
                            <a class="quickButton" id="quickGroups">
                                <span class="quickFont">Groups</span>
                            </a>
                        </div>
                        <div class="buttonWrapper">
                            <a  class="quickButton" id="quickClassifeds">
                                <span class="quickFont">Classifieds</span>
                            </a>
                        </div>
                        <div class="buttonWrapper">
                            <a  class="quickButton" id="quickMeets">
                                <span class="quickFont">Meets</span>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="centerColumn">
                <div id="feedComposer">
                    <div id="postComposer"></div>
                    <div id="feed"></div>
                </div>
            </div>
            <div class="rightColumn">
                <h1>Automotive Ads Only! :D</h1>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//www.autrovert.com/Scripts/react/PostComposer.bundle.js"></script>
<script src="//www.autrovert.com/Scripts/react/feed.bundle.js"></script>
<script src="//www.autrovert.com/Scripts/topBar.js"></script>
</body>
</html>