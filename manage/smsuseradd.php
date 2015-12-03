<?php

header("content-type:text/html; charset=utf-8");
include("../include/conn_1.php");include("../include/rank.php");include("../include/function.php");
echo "<script language='javascript'>";
;echo 'var frm;
frm=parent.document.form1;
var len=frm.mobiles.options.length;
var ext1=0;
';
$sql="select * from {$db_prefix}smsgroupuser where groupid='".$group."'";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$sqlu="select mobile from {$db_prefix}users where id='".$rs['userid']."'";
$rsu=$db->get_one($sqlu);
;echo '	ext1=0;
	for(var i=0;i<len;i++){
		if (frm.mobiles[i].value=="';echo $rsu["mobile"];echo '"){
			ext1=1;break;
		}
	}
	if (ext1==0){
		var option1=parent.document.createElement("option");
		option1.text ="';echo $rs["username"]."(".$rsu["mobile"].")";echo '";
		option1.value ="';echo $rsu["mobile"];echo '";
		parent.document.form1.mobiles.options.add(option1);
	}
	';
}
$db->free_result($result);
echo "</script>";

?>