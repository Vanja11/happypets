<?php
if (!defined('IN_PAGE')) {
    die ('Otkud ti ovde?');
}

$_SESSION['loggedIn'] = false;
session_destroy();

include('layout/header.php');

?>

 <div class="container-fluid mt-3">
    <div class="alert alert-success" role="alert">
        Uspešno ste se odjavili
    </div>
</div>