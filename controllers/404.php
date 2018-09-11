<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}
include('layout/header.php');

$view = new View('views/pages/404.php');

echo $view;