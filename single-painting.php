<?php
$paintingGate = new PaintingDB($pdo);
if (isset($_GET['id'])) {
    $painting = $paintingGate->getPainting($_GET["id"]);
} else {
    $painting = NULL;
}
?>
<!DOCTYPE html>