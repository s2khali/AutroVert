<?php
include("./head.php");
?>
<title>AutroVert</title>
<?php include("./header.php"); ?>

<div class="global-container">
    <div id="content">
        <div id="mainContainer">
            <?php include("./left-col.php")?>
            <div id="centerColumn">
            <div class="contentSelector">
            <ul>
            <li id="active"><a>Feed</a></li>
            <li id=""><a>Vehicles</a></li>
            <li id=""><a>Builds</a></li>
            <li id=""><a>Classifieds</a></li>
            <li id=""><a class="nobord">Meet n Cruise</a></li>
            </ul>
            </div>
            <div class="contentFill contentSkeleton">
            <img class="loadingGif" src="https://s3.us-east-2.amazonaws.com/autrovert/ico/loading.gif" alt="Loading..."/>
            </div>
            </div>
            <?php include("./right-col.php")?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/js/contentComposer.bundle.js"></script>
<script src="https://s3.us-east-2.amazonaws.com/autrovert/scripts/topBar.js"></script>
</body>
</html>