<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$view = new View('views/pages/404.php');

echo $view;