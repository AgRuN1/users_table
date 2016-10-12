<?php
$con=mysqli_connect("localhost","root","hereza")
or die("connect error");
mysqli_select_db($con,"my");
$select="select * ";
$from="from visited";
$query=mysqli_query($con,$select.$from)
or die("query error");
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
echo "<visited>";
while($row=mysqli_fetch_array($query)){;
	echo "<ip>".$row['ip']."</ip>";
	echo "<agent>".$row['useragent']."</agent>";
	echo "<session>".$row['session']."</session>";
	echo "<action>".$row['action']."</action>";
} 
echo "</visited>";
mysqli_close($con);
?>


