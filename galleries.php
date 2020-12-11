<?php
require_once('includes/header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galleries</title>
    <link rel="stylesheet" href="includes/reset.css">
    <link rel="stylesheet" href="includes/galleryStyle.css">
</head>

<body>
    <main class="container lessPaint">
        <div id="header" class="box b1">
            <?php printHeader(); ?>
        </div>
        <div id="galleries" class="box b2">
            <h2>Galleries</h2>
            <img id="loader" src="images/loading/animation.gif" width="350px">
            <ul id="galleryList"></ul>
        </div>
        <div id="galleryInfo" class="box b3">
            <div id="infoBox">
                <ul id="informationList"></ul>
            </div>
        </div>
        <div id="googleMap" class="box b4">
            <div id="map"></div>
        </div>
        <div id="paintingList" class="box b5">
            <div class="b5a">
                <div id="arrowBox" class="clickable">
                    <div class="more-less top sticky">←</div>
                    <div class="more-less bottom">←</div>
                </div>
                <div>
                    <table id="paintings" class="lessPaint"></table>
                </div>
            </div>
        </div>
    </main>
    <script src="includes/galleryScript.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACy7NTZo1npL3xyjW0ZrPV52AZjGzXpUo&callback=initMap" async defer></script>
</body>

</html>