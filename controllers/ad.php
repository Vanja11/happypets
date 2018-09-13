<?php
if (!defined('IN_PAGE')) {
    die('Ovo nije dozvoljeno');
}

$view = new View('views/pages/ad.php');

$view->ad = $db->getAd($_GET['ad']);
$view->photos = $db->getPhotos($_GET['ad']);

echo $view;