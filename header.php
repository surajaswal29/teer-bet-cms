<?php
 session_start();
 date_default_timezone_set('Asia/Kolkata');
 include "admin/function.inc.php";
 include "admin/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="CMENDIrEW8QVAk3oQOQCawa8GgON4QtHXmkV1sXIntY" />
    
    <meta property="og:url" content="https://www.shillonglocalteernight1.in" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Teer Result | Shillong Local Teer Night1 | Today Results | Shillong Teer Results"/>
    <meta property="og:description" content="Get today's TEER RESULTS, SHILLONG TEER RESULT, SHILLONG NIGHT1 TEER RESULT online here. We update teer results fastest of all."/>
    <meta property="og:image" content="images/logo.png" />
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php
    $query1='SELECT * FROM `seo`';
    $result2=mysqli_query($con,$query1);
    if(mysqli_num_rows($result2)>0){
        $data1=mysqli_fetch_assoc($result2);
    ?>
    <meta name="keyword" content="<?php echo $data1['keyword'] ?>"/>
    <meta name="description" content="<?php echo $data1['description'] ?>">
    <title><?php echo "(".date('d/m/Y').") - ".$data1['title'] ?></title>
    <?php
    }
    ?>
    <!-- bootstrap file -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- style.css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <script src="js/main.js"></script>
</head>
<body>