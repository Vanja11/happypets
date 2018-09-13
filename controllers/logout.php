<?php
if (!defined('IN_PAGE')) {
    die ('Ovo nije dozvoljeno');
}

$_SESSION['loggedIn'] = false;
session_destroy();

$view = new View('views/pages/logout.php');
echo $view;