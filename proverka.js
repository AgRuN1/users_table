onmessage=loadb;
function loadb(){
	var request=new XMLHttpRequest();
	var url="getclose.php";
	request.open("POST",url,false);
	request.onreadystatechange=function(request){
		if(request.readyState==4 && request.status==200){
			var text=request.responseText;
			if(text=="close"){
				postMessage("close");
			}
		}
		loadb();
	}
	request.send(null);
}
