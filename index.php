<?php
require_once('includes/session.inc.php');
require_once('includes/header.php');
ini_set('display_errors', 1);
$welcome = "";
if (isLoggedIn()) {
  $welcome = "Welcome back " . $_SESSION['user'];
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
  <link rel="stylesheet" href="includes/styles.css">
  <!--needs troubleshooting, css isn't working yet-->
</head>
<?php printHeader(); ?>

<body>
  <section class="section">
    <div class="hero">
      <div class="hero-text">
        <p class="subtitle">
          <a href="https://youtu.be/dQw4w9WgXcQ">JOIN</a>
        </p>
        <p class="subtitle">
          <a href="single-painting.php?id=7">LOGIN</a>
        </p>

        <p><?= $welcome ?>?></p>

      </div>
    </div>


  </section>
  <footer id="imgcredit"> Image credit - @saketh_upadhya</footer>
</body>

</html>