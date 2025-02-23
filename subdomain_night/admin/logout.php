<?php
include "function.inc.php";
session_start(); 

session_destroy();

session_unset();

redirect("index.php");
?>