<?php
session_start();
if(!$_SESSION['visited']){
$user_agent=htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
$ip=$_SERVER['REMOTE_ADDR'];
$_SESSION['visited']=$ip.$user_agent;
$con=mysqli_connect('localhost','root','hereza') or 
die("connect error");
mysqli_select_db($con,"my");
$insert="insert into visited(ip,useragent,session,action) values('".$ip.
"','".$user_agent."','".$_SESSION['visited']."','1')";
$query=mysqli_query($con,$insert) or die("query error");
mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<script src="query-min.js"></script>
<script src="jquery.tipTip.js"></script>

<title>Главная</title>
<link href="jquery-ui.css" rel="stylesheet">
<link href="tipTip.css" rel="stylesheet" type="text/css">

</head>
<body>
<button onclick="unloadb()">1</button>
<button onclick="loadb()">2</button>
<form>
<input id="text" type="text" placeholder="Ваш текст">
<input  class="add" type="button" onclick="clickn()" value="add">
<input class="clear" type="button" onclick="clearn()" value="clear">
</form>
<p id="see">
<?php 

?>
</p>
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
var get;
window.onbeforeunload=unloadb;
window.onload=loadn;
function unloadb(){
	var request=new XMLHttpRequest();
	var url="unload.php";
	request.open("POST",url,true);
	request.send(null);
}
function loadb(){
	window.location="error";
}
function loadn(){
	var see=document.getElementById("see");
	for(var i=0; i<localStorage.length;i++){
		var text=localStorage[i];
		see.appendChild(document.createTextNode(text));
		see.appendChild(document.createElement("br"));
	}
}
function clickn(){
	var text=document.getElementById("text").value;
	localStorage.setItem(localStorage.length,text);
	document.getElementById("text").value = '';
	var see=document.getElementById("see");
	see.appendChild(document.createTextNode(text));
	see.appendChild(document.createElement("br"));
}
function clearn(){
	localStorage.clear();
	var see=document.getElementById("see");
	see.innerHTML='';
}
$(".clear,.add, button").button();
/*
var worker=new Worker("proverka.js");
worker.onmessage=function(e){
	if(e.data=="close"){
		loadb();
	}
}
worker.postMessage("start");
console.log("start");
*/
function clos(){
	get=new XMLHttpRequest();
	var url="getclose.php";
	get.open("post",url);
	get.onreadystatechange=req;
	get.send(null);
}
function req(){
	var text=get.responseText;
	if(text!=""){
		window.location="error.php?text="+escape(text);
	}
}
function alteraction(status){
	var request=new XMLHttpRequest();
	request.open("get","action.php?action="+status);
	request.send(null);
}
setInterval(clos,5000);
window.onfocus=function(){
	alteraction(1);
}
window.onblur=function(){
	alteraction(0);
}
</script>
</body>
</html>