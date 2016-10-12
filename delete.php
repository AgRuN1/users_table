<?php
function delete($ip,$useragent){
$con=mysqli_connect("localhost","root","hereza") or die("connect error");
mysqli_select_db($con,"my");
$query="delete from visited where ip='".$ip."' and useragent='".$useragent."'";
mysqli_query($con,$query) or die("query error");
mysqli_close($con);
}
?>