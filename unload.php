<?php

session_start();
$ip=$_SERVER['REMOTE_ADDR'];
$useragent=$_SERVER['HTTP_USER_AGENT'];
$session=$ip.$useragent;
$_SESSION['visited']=array();
session_destroy();
include("./delete.php");
delete($ip,$useragent);
?>