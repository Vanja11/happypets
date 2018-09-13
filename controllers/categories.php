<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$view = new View('views/pages/categories.php');
$view->categories = $db->getCategories();

echo $view;