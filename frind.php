<?php
session_start();
require_once('config.php');
if(isset($_GET['p'])){
    $p = mysql_real_escape_string($_GET['p']);
    $insert = mysql_query("INSERT INTO friendship VALUES('', '{$_SESSION['userid']}','{$p}',0)");
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\')
    header("Location: http://$host$uri/profile.php?={$p}");
    exit; 
}
else{
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: http://$host$uri/home.php");
    exit;
}
?>