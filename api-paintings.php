<?php
ini_set('display_errors', 1);
require_once 'includes/stock-config.inc.php';
require_once 'lib/db-classes.class.php';
require_once 'lib/DatabaseHelper.class.php';

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');
// indicate whether other domains can use this API
header("Access-Control-Allow-Origin: *");

try {
    $conn = DatabaseHelper::createConnectionInfo(array(
        DBCONNECTION,
        DBUSER, DBPASS
    ));
    $gateway = new PaintingDB($conn);

    if (isCorrectQueryStringInfo("gallery"))
        $paintings = $gateway->getAllForGallery($_GET["gallery"]);
    else
        $paintings = NULL;
    echo json_encode($paintings, JSON_NUMERIC_CHECK);
    $conn = NULL;
} catch (Exception $e) {
    die($e->getMessage());
}

function isCorrectQueryStringInfo($param)
{
    if (isset($_GET[$param]) && !empty($_GET[$param])) {
        return true;
    } else {
        return false;
    }
}
