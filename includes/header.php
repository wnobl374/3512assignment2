<?php
ini_set('display_errors', 1);
require_once('session.inc.php');

function printHeader()
{
?>
    <header>
        <a href="index.php" class="headerButton">Home</a>
        <a href="about.php" class="headerButton">About</a>
        <a href="galleries.php" class="headerButton">Galleries</a>
        <a href="browse-paintings.php" class="headerButton">Browse</a>
        <?php
        if (isset($_SESSION['user'])) {
        ?><a href="favorites.php" class="headerButton">Favorites</a>
            <a href="logout.php" class="headerButton">Logout</a>
            <?
    } else {
        ?><a href="login.php" class="headerButton">Login</a>
        <?php
        }
        ?>
    </header>
<?php
}
?>