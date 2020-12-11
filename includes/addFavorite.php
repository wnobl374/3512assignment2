<?php
/*if (isset ($_SESSION['favorites'])){
    if ($_SESSION)
} else {
    $_SESSION['favorites'] = 
}*/
if (isset($_GET['id']) && $_SESSION['user'] && (($_GET['id']))) {
    $paintingGate = new PaintingDB($connection);
    $painting = $paintingGate->getPainting($_GET["id"]);
    if (!in_array($painting, $_SESSION['favorites'])) {
        array_push($_SESSION['favorites'], $painting);
    } else { //if already in array, removes from array
        unset($$_SESSION['favorites'][$painting['PaintingID']]);
    }
} else {
    header('Location: ../favorites.php');
}
