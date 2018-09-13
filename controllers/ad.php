<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$view = new View('views/pages/ad.php');

$view->ad = $db->getAd($_GET['ad']);
$view->photos = $db->getPhotos($_GET['ad']);

echo $view;