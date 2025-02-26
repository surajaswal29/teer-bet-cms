<?php
$env = require __DIR__ . '/env.php';

// Determine if it's local or live
$isLocal = $env->ENVIRONMENT === 'local';

// Select the appropriate database credentials
$hostname = $isLocal ? $env->DB_HOST_LOCAL : $env->DB_HOST_LIVE;
$username = $isLocal ? $env->DB_USER_LOCAL : $env->DB_USER_LIVE;
$password = $isLocal ? $env->DB_PASS_LOCAL : $env->DB_PASS_LIVE;
$dbname   = $isLocal ? $env->DB_NAME_LOCAL : $env->DB_NAME_LIVE;

// Establish database connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 (prevents encoding issues)
mysqli_set_charset($con, "utf8mb4");

// Get the current URL
$currentUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Check if the URL contains "night" or "morning"
if (strpos($currentUrl, 'night') !== false) {
    $timePeriod = 'night';
} elseif (strpos($currentUrl, 'morning') !== false) {
    $timePeriod = 'morning';
} else {
    $timePeriod = 'day';
}