<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$error = null;
$view = new View('views/pages/register.php');

if (!empty($_POST)) {
    $view->isPosted = true;
    $view->postData = $_POST;

    if (!$_POST['name'] || strlen($_POST['name']) < 2) {
        $error = 'Ime mora sadržati najmanje 2 karaktera';
    } else if (!$_POST['phone'] || strlen($_POST['phone']) < 9) {
        $error = 'Telefon mora sadržati najmanje 9 cifara';
    } else if (!is_numeric($_POST['phone'])) {
        $error = 'Telefon je neispravan';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'E-Mail je neispravan';
    } else if (!$_POST['password'] || strlen($_POST['password']) < 6) {
        $error = 'Lozinka mora sadržati najmanje 6 karaktera';
    }

    $view->error = $error;

    if (!$error) {
        $db->register($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['password']);
    }
} 

echo $view;