<?php
$hostname = "localhost";
$username = "u138263012_root";
$password = "slngtrRslt123*";
$dbname = "u138263012_shillong_teer";

// Establish connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 (prevents encoding issues)
mysqli_set_charset($con, "utf8mb4");
?>