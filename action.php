<?php 
$action=$_GET['action'];
$useragent=$_SERVER['HTTP_USER_AGENT'];
$ip=$_SERVER['REMOTE_ADDR'];
	$con=mysqli_connect("localhost","root","hereza") or die("connect error");
	mysqli_select_db($con,"my");
	mysqli_query($con,"update visited set action='".$action."' where ip='".
	$ip."' and useragent='".$useragent."'") or die("query error");
	mysqli_close($con);
?>