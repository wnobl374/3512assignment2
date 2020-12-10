<?php

require_once('includes/session.inc.php');

if (logOut()) {
    header('Location: index.php');
} else {
    header('Location: ' . $_SERVER["HTTP_REFERER"]);
}
