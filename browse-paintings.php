<?php
require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');

ini_set('display_errors', 1);

$paintingGate = new PaintingDB($connection);
if (isset($_GET['sort'])) {
    echo $_GET['sort'];
    if ($_GET['sort'] = "artist")
        $paintings = $paintingGate->getAllByArtist();
} else {
    $paintings = $paintingGate->getAll();
}
?>

<!DOCTYPE html>
<html lang=en>

<a href="browse-paintings.php?<?php echo $_GET['sort']; ?>>Filter</a>