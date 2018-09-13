<?php
if (!defined('IN_PAGE')) {
    die('Ovo nije dozvoljeno');
}

$view = new View('views/pages/categories.php');
$view->categories = $db->getCategories();

echo $view;