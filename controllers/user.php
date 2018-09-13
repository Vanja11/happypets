<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}
$me = $_SESSION['user'];

$currentUser = $db->getUser($_GET['user']);

if (!$currentUser) {
    include('pages/404.php');
} else {
    $view = new View('views/pages/user.php');

    $view->currentUser = $currentUser;
    $ads = $db->getAdsByUser($_GET['user']);
    $view->chunks = array_chunk($ads, 3);

    echo $view;
}
