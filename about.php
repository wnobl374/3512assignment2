<?php
require_once('includes/header.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
</head>
<?php printHeader(); ?>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">
                <?php echo "About"; ?>
            </h1>
            <hr>
            <p>Made for Randy Connolly's COMP 3512 class (Fall 2020) at Mount Royal University. Made with JS + PHP + mySQL (hosted with Google App Engine).</p>
            <p>Wade Noble - <a href="https://github.com/wnobl374">github</a>.
                <!--Dominic Silvestre - <a href="https://github.com/silvestred">github</a>. I'm sorry.-->
                Steven Soklofske - <a href="https://github.com/ssokl601">github</a>.</p>
            <p><a href="https://github.com/wnobl374/3512assignment2">Source code repository</a>.</p>
            <p>Much of the code is repurposed from the course material, but any otherwise outsourced code will be mentioned here.</p>
            <p>Currently uses Bulma, but this may change before the final release</p>
        </div>
    </section>
</body>

</html>