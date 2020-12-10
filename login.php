<?php
require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');
require_once('includes/header.php');

ini_set('display_errors', 1);

session_start();
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
<html>

<head></head>
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