<?php

if (strstr($_GET['page'], '/') !== false) {
    die('Sta to radis?');
}

define('IN_PAGE', true);

include('views/view.php');

session_start();

include('config.php');
include('lib/db.php');

$db = new DB();

$page = $_GET['page'] ? $_GET['page'] : 'home';

if (file_exists('pages/' . $page . '.php')) {
    include('pages/' . $page . '.php');
} else {
    include('pages/404.php');
}

include('layout/footer.php');