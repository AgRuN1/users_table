<?php  
session_start();
if(isset($_SESSION['visited'])){
	$session=$_SESSION['visited'];
	$con=mysqli_connect("localhost","root","hereza") or die("error connect");
	mysqli_select_db($con,"my");
	$select="select * ";
	$from="from close ";
	$where="where session='".$session."'";
	$query=mysqli_query($con,$select.$from.$where) or die("query errror");
	if(mysqli_num_rows($query)!=0){
		$row=mysqli_fetch_array($query);
		echo $row['text'];
		$query="delete from close where session='".
		$session."'";
		mysqli_query($con,$query);
	}
}else{
	header("Location:mar");
}

?>