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
    else if ($_GET['sort'] = "year")
        $paintings = $paintingGate->getAllByYear();
    else if ($_GET['sort'] = "title")
        $paintings = $paintingGate->getAllByTitle();
} else {
    $paintings = $paintingGate->getAll();
}
?>

<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse</title>
</head>

<body>
    <div>
        <a href="browse-paintings.php?<?= $_GET['sort'] ?>">Filter</a>
        <?php foreach ($paintings as $painting) {
            echo $painting['FirstName'] . $painting['LastName'];
        }
        ?>
    </div>
    <form action="browse-paintings.php?<?= $_GET['sort'] ?>" method="GET">
        Title <input type="text" name="title"><br>
        Artist <br>
        Gallery <br>


        <input type="submit">
    </form>
</body>

</html>