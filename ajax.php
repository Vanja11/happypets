<?php

session_start();

include('config.php');
include('lib/db.php');


if (!isset($_GET['func'])) {
    die(json_encode([
        error => 'Mora biti odabrana funkcija'
    ]));
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
if (function_exists($_GET['func'])) {
    call_user_func($_GET['func']);
} else {
    die(json_encode([
        error => 'Funkcija ne postoji'
    ]));
}

