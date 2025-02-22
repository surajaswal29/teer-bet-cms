<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include "admin/function.inc.php";
include "admin/config.php";

// Get `time_period` from GET request, default to 'day'
$selectedTimePeriod = isset($_GET['time_period']) ? mysqli_real_escape_string($con, $_GET['time_period']) : 'day';

// Fetch SEO data for the selected time period
$query = "SELECT * FROM `seo` WHERE `time_period` = '$selectedTimePeriod' LIMIT 1";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

// Default SEO values if no record is found
$seo_title = $data['title'] ?? "Shillong Teer Results | Shillong Teer";
$seo_description = $data['description'] ?? "Check today's Teer results, Shillong Teer result, and Teer results online. Get the fastest updates!";
$seo_keywords = $data['keyword'] ?? "shillong, teer, result, latest, update";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="CMENDIrEW8QVAk3oQOQCawa8GgON4QtHXmkV1sXIntY" />

    <meta property="og:url" content="https://www.shillongteeresult.in" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_title); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($seo_description); ?>" />
    <meta property="og:image" content="images/logo.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php echo htmlspecialchars($seo_keywords); ?>" />
    <meta name="description" content="<?php echo htmlspecialchars($seo_description); ?>" />

    <title><?php echo "(".date('d/m/Y').") - " . htmlspecialchars($seo_title); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <script src="js/main.js"></script>
</head>

<body>