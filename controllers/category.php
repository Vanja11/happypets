<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$currentCategory = $db->getCategory($_GET['category']);

if (!$currentCategory) {
    include('pages/404.php');
} else {

    $view = new View('views/pages/category.php');
    $view->currentCategory = $currentCategory;
    $ads = $db->getAds($_GET['category']);
    $view->chunks = array_chunk($ads, 3);

    echo $view;
}