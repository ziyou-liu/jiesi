// JavaScript Document
// JavaScript Document

function _province(str,aid,aid1){
	var xmlHttp=getXMLRequester();
	var url="../include/ajax_area.php"
	url=url+"?pro="+str
	url=url+"&timeStamp="+new Date().getMilliseconds()
	xmlHttp.onreadystatechange=function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200)
		{
			document.getElementById(aid).innerHTML="";
			document.getElementById(aid1).innerHTML="";

			returnstr=xmlHttp.responseText;

			ary=returnstr.split("|");
			city_str="";
			if (returnstr!=""){
				for (var i=0;i<ary.length;i++){
					param=ary[i].split(",");
					if (i==0){
						_city(param[0],aid1);
					}
					var opt=document.createElement("option");
					opt.value=param[0];
					opt.innerText=param[1];
					document.getElementById(aid).appendChild(opt);
				}
			}
		}
	}
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
function _city(str,aid){
	var xmlHttp=getXMLRequester();
	var url="../include/ajax_city.php"

	url=url+"?city="+str
	url=url+"&timeStamp="+new Date().getMilliseconds()


	xmlHttp.onreadystatechange=function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200)
		{
			document.getElementById(aid).innerHTML="";

			returnstr=xmlHttp.responseText;
			ary=returnstr.split("|");
			city_str="";
			if (returnstr!=""){
				for (var i=0;i<ary.length;i++){
					param=ary[i].split(",");
					var opt=document.createElement("option");
					opt.value=param[0];
					opt.innerText=param[1];
					document.getElementById(aid).appendChild(opt);
				}
			}
		}
	}
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
