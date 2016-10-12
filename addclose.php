<?php
$session=urldecode($_GET['session']);
$text=urldecode($_GET['text']);
$con=mysqli_connect("localhost","root","hereza") or die("connect error");
mysqli_select_db($con,"my");
$insert="insert into close(session,text) values('".$session."','".$text."')";
$query=mysqli_query($con,$insert) or die("query error");
mysqli_close($con);
?>