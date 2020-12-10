<?php
require_once('includes/header.php');
require_once('includes/session.inc.php');
$msg = "";
$favorites = [];
// show all session-based favorites (entirely PHP)
if (!isLoggedIn()) {
    header('Location: login.php');
} else if (!isset($_SESSION['favorites'])) {
    $msg = "None yet. Get favoriting!";
    $_SESSION['favorites'] = $favorites;
} else {
    $msg = "Favorites for " . $_SESSION['user'];
    $favorites = $_SESSION['favorites'];
} ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Favorites</title>
</head>
<?php printHeader(); ?>
<section>
    <p><?= $msg ?></p>
    <table>
        <tr>
            <th></th>
        </tr>
        <?php foreach ($favorites as $fav) {
        ?><tr>
                <td> <a href="single-painting.php?id=<?= $fav['PaintingID'] ?>"><img src="images\paintings\square\<?= $fav['ImageFileName'] ?>.jpg" width="150"></a>
                <td> <a href="single-painting.php?id=<?= $fav['PaintingID'] ?>"><?= $fav['Title'] ?></a>
            </tr>
        <?php
        }
        ?>

    </table>
</section>