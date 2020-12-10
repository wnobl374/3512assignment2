<?php
require_once('includes/header.php');
require_once('includes/session.inc.php');
$msg = "";
// show all session-based favorites (entirely PHP)
if (!isLoggedIn()) {
    header('Location: login.php');
} else if (!isset($_SESSION['favorites'])) {
    $msg = "None yet. Get favoriting!";
} else {
    $msg = "Favorites for " . $_SESSION['user'];
} ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Favorites</title>
</head>
<?php printHeader(); ?>
<section>
    <?php foreach ($_SESSION['favorites'] as $fav) {
    ?><div>
            <a href="single-painting.php?id=<?= $fav['PaintingID'] ?>"><img src="images\paintings\square\<?= $fav['ImageFileName'] ?>.jpg" width="150"></a>
            <a href="single-painting.php?id=<?= $fav['PaintingID'] ?>"><?= $fav['Title'] ?></a>
        </div>
    <?php
    }
    ?>

</section>