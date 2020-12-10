<?php
ini_set('display_errors', 1);

require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');



$paintingGate = new PaintingDB($connection);
if (isset($_GET['id'])) {
    $painting = $paintingGate->getPainting($_GET["id"]);
} else {
    $painting = NULL;
}
?>

<!DOCTYPE html>
<html lang=en>

<head>
    <title>Painting Details</title>
    <meta charset=utf-8>
</head>

<body>
    <div>
        <img src="images\paintings\square\<?= $painting['ImageFileName'] ?>.jpg">
    </div>
    <!-- approach taken from w3schools https://www.w3schools.com/howto/howto_js_tabs.asp-->
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Description')">Description</button>
        <button class="tablinks" onclick="openCity(event, 'Details')">Details</button>
        <button class="tablinks" onclick="openCity(event, 'Colors')">Colors</button>
    </div>

    <div id="Description" class="tabcontent">
        <h3>Description</h3>
        <p><?= $painting['Description'] ?></p>
    </div>

    <div id="Details" class="tabcontent">
        <h3>Details</h3>
        <p>Medium: <?= $painting['Medium'] ?></p>
        <p>Width: <?= $painting['Width'] ?></p>
        <p>Height: <?= $painting['Height'] ?></p>
        <p>Copyright Text: <?= $painting['CopyrightText'] ?></p>
        <a href="<?= $painting['WikiLink'] ?>">Wiki Link</a>
        <a href="<?= $painting['MuseumLink'] ?>">Museum Link</a>
    </div>

    <div id="Colors" class="tabcontent">
        <h3>Colors</h3>
        <p><?php//unsure how to parse this properly for now
            $Annotations = json_decode($painting['JsonAnnotations']);
            foreach ($Annotations as $colors) {
                echo $colors;
            }; ?></p>
    </div>
</body>

</html>