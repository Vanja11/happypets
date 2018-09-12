<?php

// if (strstr($_GET['page'], '/') !== false) {
//     die('Ovo nije dozvoljeno');
// }

define('IN_PAGE', true);

include('config.php');
include('lib/db.php');
include('lib/view.php');

session_start();

$db = new DB();

$page = $_GET['page'] ? $_GET['page'] : 'home';

if (file_exists('controllers/' . $page . '.php')) {
    include('controllers/' . $page . '.php');
} else {
    include('controllers/404.php');
}

include('layout/footer.php');