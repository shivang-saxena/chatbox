<?php
include('common.php');
session_start();
//$u=$_REQUEST['user'];
//session_unset($_SESSION['$u']);
//header('location:index.php');
//echo $_SESSION['user']['username'];
session_destroy();
//error('--Successfully! Logged out--');
header('location:index.php');
?>

