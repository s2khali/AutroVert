<!DOCTYPE html>
<html lang="en" id="autrovert">
<head>
    <meta charset = "utf-8"/>
    <meta name="description" content="AutroVert"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo Profile::getUsername(); ?>'s Profile</title>
    <link rel="stylesheet" type="text/css" href="/AutroVert/style/front.css"/>
    <link rel="stylesheet" type="text/css" href="/AutroVert/style/profile.css"/>
    <script src="/AutroVert/Scripts/controlFunctions.js"></script>

</head>
<body>
<header>
    <div id='topBarNav'>
        <div id="navbar">
            <div id='left-navbar'>
                <a class='autrovert-logo' href="home">Autro<span class='vert'>Vert</span></a>
                <div role="search" id="search">
                    <form action="" method="get">
                        <button value="1" id="searchButton" type="submit">
                            <img id="searchButtonPic" src="/AutroVert/style/icons/search-icon.png">
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
                            <img id="profImg" src="/AutroVert/temp/prof_256x256.jpg">
                            <span><?php echo Controller::getUser(); ?></span>
                        </a>
                    </div>
                    <div id="garageNav">
                        <a id="garageButton" title="My Garage" class="topBarButton" href="#">
                            <img id="garageIcon" src="/AutroVert/style/icons/garage-icon.png">
                        </a>
                    </div>
                </div>
                <div id="left-navbar">
                    <div id="notificationNav">
                        <a id="notificationButton" title="Notifications" class="topBarButton" href="#">
                            <img id="notificationIcon" src="/AutroVert/style/icons/notification-icon.png">
                        </a>
                    </div>
                    <div id="topBarLogout" >
                        <a href="?logout"><img title="Logout" class="topBarButton" id="logoutIcon" src="/AutroVert/style/icons/logout.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="global-container">
    <div id="content">
        <div id="mainContainer">
            <div id="profile-top-section">
                <div id="mainPhotoWrapper">
                    <div id="main-photo">
                        <a href="#">
                            <img src="/AutroVert/temp/main_1000x562.jpg">
                        </a>
                    </div>
                </div>
                <div id="profile-nav-bar">
                    <div class="profileActions">
                    </div>
                </div>
            </div>
            <div id="left-column">
                <div id="profile-pic-wrapper">
                    <a href="#"><img id="profile-picture" src="/AutroVert/temp/prof_256x256.jpg"></a>
                </div>
            </div>
            <div id="center-column">
                <div id="status-wrapper"> <!-- Post, Image, Build, Poll -->
                    <div id="post-type">
                        <span class="spanPost"><a id="postTypeButton" class="postType"  data-content="postPostType" role="tab" aria-selected="true" href="#">Post</a></span>
                        <span class="spanPost"><a id="photoTypeButton" class="postType" data-content="photoPostType" role="tab" aria-selected="false" href="#">Photo/Album</a></span>
                        <span class="spanPost"><a id="buildTypeButton" class="postType" data-content="buildPostType" role="tab" aria-selected="false" href="#">Build Update</a></span>
                        <span class="spanPost"><a id="pollTypeButton" class="postType" data-content="pollPostType" role="tab" aria-selected="false" href="#">Poll</a></span>
                    </div>
                    <div id="postArea">
                        <div id="postPostType">
                             <div id="postText">
                                <textarea id="postTextArea" rows="2" placeholder="What's New?"></textarea>
                            </div>
                            <div id="submitButtonWrapper">
                                <input type="submit" name="postSubmit" id="postSubmit" value="Post">
                            </div>
                        </div>
                        <div id="photoPostType">
                            <form action="upload.php" class="dropzone"></form>
                        </div>
                        <div id="buildPostType" >
                            <div id="buildNewOrSearch">
                                <span class="spanBuild"><a id="newBuildButton" class="buildSelection" data-content="newBuild" role="tab" aria-selected="true" href="#">New Build</a></span>
                                <span class="spanBuild" id="searchBuilds"><input type="text" name="build" placeholder="Search your builds" class="auto"></span>
                            </div>
                            <div id="buildText">
                                <textarea id="buildTextArea" rows="2" placeholder="What's New?"></textarea>
                            </div>
                            <div id="submitButtonWrapper">
                                <input type="submit" name="buildSubmit" id="postSubmit" value="Post">
                            </div>
                        </div>
                        <div id="pollPostType">
                            <div id="pollCreator">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/AutroVert/Scripts/profileControls.js"></script>
<script src="/AutroVert/Scripts/postBox.js"></script>
<script src="/AutroVert/Scripts/dropzone.js"></script>
<script src="/AutroVert/Scripts/topBar.js"></script>
</body>
</html>
