</head>
<body>
<header>
<div id='topBarNav'>
<div id="navbar">
<div id='left-navbar'>
<a class="autrovert-logo-small" href="/">AV</a>
<a class='autrovert-logo' href="/">AutroVert</a>
<div role="search" id="search">
<form action="" method="get">
<button value="1" id="searchButton" type="submit">
<img id="searchButtonPic" src="https://s3.us-east-2.amazonaws.com/autrovert/ico/search-icon.png">
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
<a id="profileButton" title="My Profile" href="profile.php?username=<?php echo $_SESSION['username']; ?>">
<img id="profImg" src="<?php echo $_SESSION['img']; ?>">
<span><?php echo $_SESSION['username']; ?></span>
</a>
</div>
<div id="garageNav">
<a id="garageButton" title="My Garage" class="topBarButton" href="garage?username=<?php echo $_SESSION['username']; ?>">
<img id="garageIcon" src="https://s3.us-east-2.amazonaws.com/autrovert/ico/garage-icon.png">
</a>
</div>
</div>
<div id="left-navbar">
<div id="notificationNav">
<a id="notificationButton" title="Notifications" class="topBarButton" href="#">
<img id="notificationIcon" src="https://s3.us-east-2.amazonaws.com/autrovert/ico/notification-icon.png">
</a>
</div>
<div id="topBarLogout">
<a href="admin/logout.php"><img title="Logout" class="topBarButton" id="logoutIcon" src="https://s3.us-east-2.amazonaws.com/autrovert/ico/logout.png"></a>
</div>
</div>
</div>
</div>
</div>
</header>

