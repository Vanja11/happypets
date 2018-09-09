<?php

if (strstr($_GET['func'], '/') !== false) {
    die('Sta to radis?');
}

session_start();

include('config.php');
include('lib/db.php');


if (!isset($_GET['func'])) {
    die('Nepotpuni parametri');
}

function deleteAd() {
    $adId = $_GET['ad'];
    $user = $_SESSION['user'];

    if (!isset($adId)) {
        http_response_code(400);
        die(json_encode([
            error => 'ID oglasa je obavezan'
        ]));
    }

    if (!isset($user)) {
        http_response_code(401);
        die(json_encode([
            error => 'Niste prijavljeni'
        ]));
    }

    $db = new DB();
    $ad = $db->getAd($adId);

    if ($user['id'] != $ad['users_id']) {
        http_response_code(401);
        die(json_encode([
            error => 'Pokušavate da obrišete oglas koji nije vaš'
        ]));
    }

    $db->deleteAd($adId);
    echo json_encode([]);
}

function renewAd() {
    $adId = $_GET['ad'];
    $user = $_SESSION['user'];

    if (!isset($adId)) {
        http_response_code(400);
        die(json_encode([
            error => 'ID oglasa je obavezan'
        ]));
    }

    if (!isset($user)) {
        http_response_code(401);
        die(json_encode([
            error => 'Niste prijavljeni'
        ]));
    }

    $db = new DB();
    $ad = $db->getAd($adId);

    if ($user['id'] != $ad['users_id']) {
        http_response_code(401);
        die(json_encode([
            error => 'Pokušavate da obrišete oglas koji nije vaš'
        ]));
    }

    $db->renewAd($adId);
    echo json_encode([]);
}

call_user_func($_GET['func']);

