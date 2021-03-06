<?php
require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');
require_once('includes/header.php');

ini_set('display_errors', 1);

if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$msg = '';
if (isLoginDataPresent()) {
    try {
        $customerGate = new CustomerDB($connection);
        $found = $customerGate->findCustomer($_POST['uname']);
        $connection = null;
        if (isset($found["Pass"])) {
            $extendedPassword = $_POST['upass'] . $found['Salt'];
            $calculatedDigest = hash("sha256", $extendedPassword);
            $digestInDatabase = $found['Password_sha256'];
            if ($calculatedDigest == $digestInDatabase) {
                $_SESSION['user'] = $found['CustomerID'];
                unset($_SESSION['favorites']);
                $_SESSION['favorites'] = [];
                header('Location: index.php');
                exit();
            } else {
                $msg = "Incorrect Password";
            }
        } else {
            $msg = "Email not found";
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function isLoginDataPresent()
{
    if (isset($_POST['uname']) && isset($_POST['upass']))
        return true;
    else
        return false;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
</head>
<?php printHeader(); ?>

<body>
    <form action="login.php" method="POST">
        UserName <input type="text" name="uname"><br>
        Pass <input type="password" name="upass"><br>
        <input type="submit">
    </form>
    <div class=error><?= $msg ?></div>


</body>

</html>