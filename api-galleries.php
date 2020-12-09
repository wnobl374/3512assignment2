<?php
require_once 'stock-config.inc.php';
require_once 'db-classes.inc.php';

// Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');
// indicate whether other domains can use this API
header("Access-Control-Allow-Origin: *");

try {
    $conn = DatabaseHelper::createConnectionInfo(array(
        DBCONNECTION,
        DBUSER, DBPASS
    ));
    $gateway = new GalleryDB($conn);

    if (isCorrectQueryStringInfo("id"))
        $paintings = $gateway->getGallery($_GET["id"]);
    else
        $paintings = $gateway->getAll();

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
