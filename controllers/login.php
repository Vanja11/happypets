<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$error = null;

$view = new View('views/pages/login.php');

if (!empty($_POST)) {
    $view->isPosted = true;
    $view->postData = $_POST;

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'E-Mail je neispravan';
    }

    if (!$_POST['password'] ) {
        $error = 'Unesite lozinku';
    }



    if (!$error) {
        $user = $db->login($_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user'] = $user;
            if (isset($_GET['returnTo'])) {
                header('Location: index.php?page=' . $_GET['returnTo']);
                exit;
            }
        } else {
            $error = 'Uneli ste pogrešan E-Mail ili lozinku';
        }
    }

    $view->error = $error;
} 

echo $view;