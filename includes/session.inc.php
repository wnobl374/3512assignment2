<?php

session_start();

require_once('includes/stock-config.inc.php');
require_once('includes/service-utilities.inc.php');
require_once('lib/db-classes.class.php');
require_once('lib/DatabaseHelper.class.php');

/*function logIn($username, $password, $connection)
{
    $customerGate = new CustomerDB($connection);
if (isset($_POST['id'])) {
    $customer = $customerGate->findCustomer($username);
} else {
    $customer = NULL;
}
    if ($username != null && $password != null)
    {
        if $digest = password_hash( $_POST['pass'], PASSWORD_BCRYPT, ['cost' => 12] );
        if ($digest == $password_field_from_database_table && emails also match) {
        $_SESSION['User'] = $found
        }
    }
}*/

function isLoggedIn()
{
    if (isset($_SESSION['user']) && ($_SESSION['user'] != null)) {
        return true;
    } else {
        return false;
    }
}

function logOut()
{
    if (isset($_SESSION['user'])) {
        session_destroy();
        return true;
        header('Location: index.php');
    } else {
        return false;
    }
}
