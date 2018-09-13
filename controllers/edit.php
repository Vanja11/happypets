<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$editView = new View('views/pages/edit.php');

$ad = $db->getAd($_GET['ad']);
$categories = $db->getCategories();
$editView->ad = $ad;
$editView->categories = $categories;
$editView->photos = $db->getPhotos($_GET['ad']);

$error = null;

if (!empty($_POST)) {
    $editView->posted = true;
    $editView->postData = $_POST;

    if (!$_POST['category'] || $_POST['category'] === '') {
        $error = 'Odaberite kategoriju';
    } else if (!$_POST['title'] ) {
        $error = 'Unesite naslov oglasa';
    } else if (!$_POST['description'] ) {
        $error = 'Unesite tekst oglasa';
    } else if ($_POST['phone'] && strlen($_POST['phone']) < 9) {
        $error = 'Telefon mora sadržati najmanje 9 cifara';
    } else if ($_POST['phone'] && !is_numeric($_POST['phone'])) {
        $error = 'Telefon je neispravan';
    }

    $editView->error = $error;


    if (!$error) {
        $db->updateAd($ad['id'], $_POST['category'], $_POST['title'], $_POST['description'], $_POST['phone'], $_FILES['photos']);
    }
} 

echo $editView;