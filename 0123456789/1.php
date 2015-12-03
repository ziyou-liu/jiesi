<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/periodscls.php");
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$rs=$db->get_one($sql);
if ($rs["state"]==2) die("奖金已发放过!");
if ($rs["state1"]==1) die("<br><br><br><br><br><center><p style='color:red;'>另一个结算正在进行，请不要重复结算</p></center>");
$timelimit=$rs["endtime"]+24*60*60;
$sqlla="select id from {$db_prefix}periods where periods<'$periods' and state=0";
$rsla=$db->get_one($sqlla);
if(!empty($rsla['id'])) die("<br><br><br><br><br><center><p style='color:red;'>请先结算上期结算</p></center>");
$sql1="delete from {$db_prefix}jsrec where periods='".$periods."'";
$db->query($sql1);
$sql_u="update {$db_prefix}periods set state1=1,state2=0 where periods='".$periods."'";
$db->query($sql_u);
$sql_1='';
$sql2="select * from {$db_prefix}users where state=1 and confirmtime<='$timelimit' ";
$result2=$db->query($sql2);
while ($rs2=$db->fetch_array($result2)){
if($sql_1!='') $sql_1.=',';
$sql_1.="('$periods','".$rs2["username"]."','".$rs2["realname"]."','".$rs2['rank']."')";
}
$db->free_result($result2);
if($sql_1!=''){
$sql="insert into {$db_prefix}jsrec(periods,username,realname,rank) values".$sql_1;
$db->query($sql);
}
;echo '
<meta http-equiv="refresh" content="1; URL=1_do.php?periods=';echo $periods;echo '&maincounter=';echo $main_counter;;echo '"> 
<title>结算</title>
</head>
<body>
	<br><br><br><br><br>
	<center><p style=" color:red;">正在结算，请不要离开此页面。。。</p></center>
</body>
</html>
'
?>