<?php
$text=urldecode($_GET['text']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ошибка</title>
</head>

<body onload="unloadb()">

<p><?=$text?></p>
<script>
function unloadb(){
	var request=new XMLHttpRequest();
	var url="unload.php";
	request.open("POST",url,true);
	request.send(null);
}

</script>
</body>
</html>