<?php

require_once 'ApiDispatcher.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$api = new ApiDispatcher($city, $date);
$api->handleRequest();
