<?php
$ip=$_SERVER['REMOTE_ADDR'];
$user_agent=$_SERVER['HTTP_USER_AGENT'];
?>
<!DOCTYPE html>
<html>
<head>
<style>
#self{
	color:#0F0;
}
td,th{
	border:thin solid #03C;
}
.session{
	display:none;
}
.textd{
	color:red;
}
.textd:hover{
	background-color:blue;
	color:red;
}
.actf{
	color:green;
}
.actb{
	color:red;
}
</style>
<meta charset="utf-8" />
<title>Форма</title>
<script src="query-min.js"></script>
</head>
<body>
 <table>
 <caption>
 Пользователи
 </caption>
 <thead><tr><th>ip адрес</th><th>user agent</th><th>Удалить пользователя</th><th>Активность</th></tr>
 <tr><td><?=$ip?></td><td><?=$user_agent?></td>
 <td id="self">Нельзя удалить себя</td><td class="actf">Активен</td></tr></thead>
 
 <tbody>
 </tbody>
 </table>
 
<script>
window.onload=loadb;
var request;
function loadb(){
	request = new XMLHttpRequest();
	var url="load.php";
	request.open("post",url);
	request.onreadystatechange=response;
	request.send(null);
}
function response(){
	if(request.readyState==4 && request.status==200){
	var xml = request.responseXML;
	var table=document.getElementsByTagName("tbody")[0];
	var tbody=document.createElement("tbody");
	
	var ip=xml.getElementsByTagName("ip");
	var agent=xml.getElementsByTagName("agent");
	var sessions=xml.getElementsByTagName("session");
	var action=xml.getElementsByTagName("action");
	
	for(var i=0;i<ip.length;i++){
		
	var tr=document.createElement("tr");
	var ipt=document.createElement("td");
	var agentt=document.createElement("td");
	var deletet=document.createElement("td");
	var session=document.createElement("p");
	var act=document.createElement("td");
	
	session.setAttribute("class","session");
	session.appendChild(
	document.createTextNode(
	sessions[i].firstChild.nodeValue));
	
	var actp=document.createElement("p");
	if(action[i].firstChild.nodeValue=="1"){
	actp.appendChild(document.createTextNode(
	"Активен"));
	actp.setAttribute("class","actf");
	}else {
	actp.appendChild(document.createTextNode(
	"Не активен"));
	actp.setAttribute("class","actb");
	}
	act.appendChild(actp);
	
	var textdelete=document.createElement("p");
	textdelete.setAttribute("class","textd");
	textdelete.addEventListener('click',sendt,false);
	textdelete.appendChild(document.createTextNode("Удалить"));
	
	deletet.appendChild(session);
	deletet.appendChild(textdelete);
	
	
    ipt.appendChild(
	document.createTextNode(
	ip[i].firstChild.nodeValue));
	
	agentt.appendChild(
	document.createTextNode(
	agent[i].firstChild.nodeValue));
	
	tr.appendChild(ipt);
	tr.appendChild(agentt);
	tr.appendChild(deletet);
	tr.appendChild(act);
	tbody.appendChild(tr);
	}
	document.getElementsByTagName("table")[0].
	replaceChild(tbody,table);
	
}
}
setInterval(loadb,3000);
function sendt(){
	var elem=$(this).prev();
	elem.parents("tr").css("opacity","0");
	sessionis(elem);
}
function sessionis(obj){
	var ses=obj.text();
	var del=document.getElementsByTagName("body")[0];
	var user=new XMLHttpRequest();
	var urlclose="addclose.php?session="+escape(ses)+
	"&text="+escape("HELLO");
	user.open("GET",urlclose);
	user.send(null);
	var usertwo=new XMLHttpRequest();
	usertwo.open("GET","provdel.php?session="+escape(ses));
	usertwo.send(null);
}

</script>
</body>
</html>
