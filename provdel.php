<?php
$session=$_GET['session'];
$con=mysqli_connect("localhost","root","hereza") or die("error connect");
mysqli_select_db($con,"my");
$query="delete from visited where session='".
$session."'";
mysqli_query($con,$query) or die ("query error");
mysqli_close($con);
?>