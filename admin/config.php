<?php
    $hostname="localhost";
    $u_name="root";
    $pass="";
    $db_name="teer";

    $con=mysqli_connect($hostname,$u_name,$pass,$db_name) or die("Connection failed!");
?>