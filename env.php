<?php

$current_page = basename($_SERVER['PHP_SELF']);

$env_page = 'env.php';

$APP_URL = 'http://mobiblitz.com/shipcar/';
$DB_NAME = "boligprosjekter";
$DB_HOST = "localhost";
$Password = "";
$DB_USER = "root";

// Check if the current page is env.php
if ($current_page === $env_page) {
    // Get the previous page URL
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $APP_URL;

    // Redirect to the previous page or fallback to APP_URL if HTTP_REFERER is not set
    header('Location: ' . $previous_page);
    exit();
}



