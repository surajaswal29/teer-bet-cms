<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "shillong_teer_db";

// Establish connection
$con = mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 (prevents encoding issues)
mysqli_set_charset($con, "utf8mb4");
?>