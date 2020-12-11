<?php
require_once('includes/header.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');

$paintingGate = new PaintingDB($connection);
if (isset($_GET['galleryID'])) {
    $painting = $paintingGate->getAllForGallery($_GET["galleryID"]);
} else {
    $painting = NULL;
}

$galleryGate = new GalleryDB($connection);
$galleries = $galleryGate->getAll();


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
            <img id="loader" src="images/loading/animation.gif" width="100%">
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
        <div id="bigImage">
            <div class="img-nav box">
                <div class="loaderImg i1"><img src="img/loader.gif" height="750px"></div>
                <div class="imageBox i2"></div>
                <div class="navigate">
                    <button title="Previous painting" type="button" id="previousImg" class="clickable nav">←</button>
                    <button title="View galleries" type="button" id="home" class="clickable nav">⌂</button>
                    <button title="Next painting" type="button" id="nextImg" class="clickable nav">→</button>
                </div>
            </div>
            <div class="header box">
                <h1></h1>
                <h2></h2>
                <h3></h3>
            </div>
            <div class="details box">
                <div>
                    <ul id="details-gallery"></ul>
                </div>
                <div>
                    <ul id="details-painting"></ul>
                </div>
                <div class="colors"></div>
            </div>
            <div class="description box">
                <p></p>
            </div>

        </div>
        <div class="modal"></div>
    </main>
    <script src="js/script.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACy7NTZo1npL3xyjW0ZrPV52AZjGzXpUo&callback=initMap" async defer></script>
</body>

</html>