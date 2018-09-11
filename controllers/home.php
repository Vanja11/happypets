<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}
include('layout/header.php');

$categories = $db->getCategories();
$view = new View('views/pages/home.php');
$view->categories = $categories;
$view->loggedIn = $_SESSION['loggedIn'];

echo $view;