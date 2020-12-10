<?php
require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');

ini_set('display_errors', 1);

$paintingGate = new PaintingDB($connection);
if (isset($_GET['sort'])) {
    echo "Sorting by" . $_GET['sort'];
    if ($_GET['sort'] = "artist")
        $paintings = $paintingGate->getAllByArtist();
    else if ($_GET['sort'] = "year") {
        echo "Should be sorting by Year";
        $paintings = $paintingGate->getAllByYear();
    } else if ($_GET['sort'] = "title")
        $paintings = $paintingGate->getAllByTitle();
} else if (isset($_GET['title'])) {
    $paintings = $paintingGate->getAllForTitle($_GET['title']);
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
        <table style="width:100%">
            <tr>
                <th></th>
                <th><a href='browse-paintings.php?sort=artist'>Artist</a></th>
                <th> <a href='browse-paintings.php?sort=title'>Title</a></th>
                <th> <a href='browse-paintings.php?sort=year'>YearOfWork</th>
            </tr>
            <?php foreach ($paintings as $painting) {
                echo "<tr>";
            ?> <td><a href='single-painting.php?id=<?= $painting['PaintingID'] ?>'><img src='images\paintings\square\<?= $painting['ImageFileName'] ?>.jpg' width=150></td>
            <?php
                echo "<td>" . $painting['FirstName'] . " " . $painting['LastName'] . "</td>";
                echo "<td>" . $painting['Title'] . "</td>";
                echo "<td>" . $painting['YearOfWork'] . "</td>";
                echo "</tr>";
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