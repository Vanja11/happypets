<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$view = new View('views/pages/create.php');
$view->categories = $db->getCategories();

$error = null;

if (!empty($_POST)) {
    $view->posted = true;
    $view->postData = $_POST;

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

    $view->error = $error;

    if (!$error) {
        $view->adId = $db->create($_POST['category'], $_POST['title'], $_POST['description'], $_POST['phone'], $_FILES['photos']);
    }
} 

echo $view;