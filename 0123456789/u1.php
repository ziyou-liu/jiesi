<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/periodscls.php");
$sql="select * from {$db_prefix}periods3 where periods='".$periods."'";
$rs=$db->get_one($sql);
if ($rs["state"]==2) die("奖金已发放过!");
if ($rs["state1"]==1) die("<br><br><br><br><br><center><p style='color:red;'>另一个结算正在进行，请不要重复结算</p></center>");
$timelimit=$rs["endtime"]+24*60*60;
$timelimit1=$rs['begintime'];
$timelimit2=$rs['endtime'];
$jsfloer2=" and datediff(concat(a.year,'-',a.month,'-',a.day),from_unixtime(".$timelimit1."))>=0 and datediff(concat(a.year,'-',a.month,'-',a.day),from_unixtime(".$timelimit2."))<=0";
$sql1="delete from {$db_prefix}jsrec3 where periods='".$periods."'";
$db->query($sql1);
$sql_u="update {$db_prefix}periods3 set state1=1,state2=0 where periods='".$periods."'";
$db->query($sql_u);
$sql2="select username,realname,rank from {$db_prefix}users where state=1 and confirmtime<'$timelimit' and isdp=1";
$result2=$db->query($sql2);
while ($rs2=$db->fetch_array($result2)){
$totalyj=0;
$sqlyj="select sum(a.pv_1) as c from {$db_prefix}tdpv a,{$db_prefix}users b where a.username=b.username and b.zmdname='".$rs2['username']."' and b.state=1 and b.confirmtime<'$timelimit'  and a.pv_1>0".$jsfloer2;
$rsyj=$db->get_one($sqlyj);
if($rsyj['c']>0) $totalyj=$rsyj['c'];
if($totalyj>=$glo_dpyeji){
$sql_1="insert into {$db_prefix}jsrec3 (periods,username,realname,rank,totalyj) values('$periods','".$rs2["username"]."','".$rs2["realname"]."','".$rs2['rank']."','$totalyj')";
$db->query($sql_1);
}
}
$db->free_result($result2);
echo "<script>location.href='u1_do.php?periods={$periods}&maincounter={$main_counter}';</script>";exit();
;echo '
<title>结算</title>
</head>

<body>
	<br><br><br><br><br>
	<center><p style=" color:red;">正在结算，请不要离开此页面。。。</p></center>
</body>
</html>
'
?>