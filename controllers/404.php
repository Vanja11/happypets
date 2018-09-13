<?php
if (!defined('IN_PAGE')) {
    die('Ovo nije dozvoljeno');
}

$view = new View('views/pages/404.php');

echo $view;