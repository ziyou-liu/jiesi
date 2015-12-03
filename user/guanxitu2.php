<?php

include("../include/conn_2.php");include("../include/rank.php");
include("../include/function.php");
include("../include/net.php");
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐关系图</title>
<style type="text/css">
body{
	font-size:14px; margin-left:50px; margin-top:10px;
}
</style>
<script language="javascript" src="../include/ajax.js" type="text/javascript"></script>
<script language="javascript" src="../include/js.js" type="text/javascript"></script>
<script language="javascript">
function gxtex(hyid,depth){
	var dobj=document.getElementById("d_"+hyid);
	var imgobj=document.getElementById("img_"+hyid);
	if (dobj.style.display=="block"){
		dobj.style.display="none";
		if (imgobj.src="treeimgs/tree_minus.gif") imgobj.src="treeimgs/tree_plus.gif";else imgobj.src="treeimgs/tree_minus.gif";
	}else{
		dobj.style.display="block";
		if (imgobj.src="treeimgs/tree_minus.gif") imgobj.src="treeimgs/tree_minusl.gif";else imgobj.src="treeimgs/tree_minus.gif";
		dobj.innerHTML="载入中.........";
	}
	////利用ajax动态的读取该用户的推荐下级
	var xmlHttp=getXMLRequester();
	var url="ajax_prenet.php";	
	url=url+"?hyid="+hyid+"&dpth="+depth;
	url=url+"&timeStamp="+new Date().getMilliseconds();
	xmlHttp.onreadystatechange=function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200){ 
			dobj.innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null);
}
</script>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
</head>

<body><br>
	<form action="?action=query" method="post" name="form1">
	&nbsp;&nbsp;&nbsp;会员编号:&nbsp;&nbsp;<input name="username" type="text" /><input name="Search" type="submit" value="查询"  class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'"></form> 
  ';
if ($action=="query"){
if($username!=$_SESSION["glo_username"]){
$preupstr="";
gethypreupstr($username,$preupstr);
$tjupary=explode(",",$preupstr);
if (!in_array($_SESSION["glo_username"],$tjupary)){
die("<center>查询会员不在您的安置网体内</center>");
}
}
if(trim($username)==""){
$sql1="select * from {$db_prefix}users where prename='".$_SESSION["glo_username"]."'";
}else{
$sql1="select * from {$db_prefix}users where username='".trim($username)."'";
}
}else{
$sql1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
}
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])) die("<center>用户不存在</center>");
;echo '  <div style="margin-left:50px;"><img border=0  src="treeimgs/tree_diropen.gif" width="16" height="16" />';echo $rs1["username"];echo '[';echo ($rs1["id"]);echo ']  [';echo getuserrank($rs1["rank"]);echo '] [注册日期:';echo date("Y-m-d",$rs1["regtime"]);echo ']</div>
  ';
$sql="select * from {$db_prefix}users where prename='".$rs1["username"]."'";
$result=$db->query($sql);$rstulnum=$db->num_rows($result);$i=0;
while ($rs=$db->fetch_array($result)){
$i++;
;echo '  <div style="margin-left:50px;">';$chdbit=getchild($rs["username"]);
if ($chdbit){
echo '<a href="#img_'.$rs["id"].'" onclick="gxtex('.$rs["id"].',1);">';
echo ($i==$rstulnum)?'<img border=0 id="img_'.$rs["id"].'"  src="treeimgs/tree_plusl.gif" />':'<img border=0 id="img_'.$rs["id"].'"  src="treeimgs/tree_plus.gif"  />';
echo "</a>";
}else{
echo ($i==$rstulnum)?'<img border=0 id="img_'.$rs["id"].'"  src="treeimgs/tree_blankl.gif" />':'<img border=0 id="img_'.$rs["id"].'"  src="treeimgs/tree_blank.gif"  />';
}
;echo '';echo $rs["username"];echo '[';echo ($rs["id"]);echo '] [第2层] [';echo getuserrank($rs["rank"]);echo '] [注册日期:';echo date("Y-m-d",$rs["regtime"]);echo ']</div>
  <div id="d_';echo $rs["id"];echo '" style="margin-left:50px;display:none"></div>
  ';
}
$db->free_result($result);
;echo '
';
function getchild($hyname){
global $db,$db_prefix;
$sql_chd="select id from {$db_prefix}users where prename='".$hyname."' limit 1";
$rs_chd=$db->get_one($sql_chd);
if (!empty($rs_chd["id"])) return true;else return false;
}
;echo '	
</body>
</html>
';
?>