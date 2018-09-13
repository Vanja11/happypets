<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$_SESSION['loggedIn'] = false;
session_destroy();

$view = new View('views/pages/logout.php');
echo $view;