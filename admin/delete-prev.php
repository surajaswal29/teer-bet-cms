<?php 
include "header-file.php";

$drop="DELETE FROM `prev_result` WHERE `prev_result`.`id` = '{$_GET['p_id']}'";
$drop_qu=mysqli_query($con,$drop);

if($drop_qu){
    redirect('view-prev.php');
}
?>