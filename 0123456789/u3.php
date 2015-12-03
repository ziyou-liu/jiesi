<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
set_time_limit(1000);
include("../include/conn.php");
include("../include/rank.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/function.php");
$modtime=time();
$sql="select * from {$db_prefix}periods3 where periods='$periods'";
$rs=$db->get_one($sql);
if ($rs["state"]==0) die("奖金还没有结算");
if ($rs["state"]==2) die("<center>奖金已发放过!</center>");
$timelimit1=$rs['endtime']+24*3600;
$sqlla="select id from {$db_prefix}periods3 where periods<'$periods' and state<2";
$rsla=$db->get_one($sqlla);
if(!empty($rsla['id'])) die("<br><br><br><br><br><center><p style='color:red;'>请先发放上期奖金</p></center>");
if($modtime<$timelimit1) {
die("当前发放时间不能小于该期的截止时间。");
}else {
if($rs['jstime']<$timelimit1) {
die("发放之前，请重新结算一遍。");
}
}
$sql="select * from {$db_prefix}jsrec3 where periods='$periods' and fenhong1>0 order by id desc ";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$total_p=$rs["fenhong1"]-$rs['fax'];
$real=$total_p-$fee;
$sql="update {$db_prefix}jsrec3 set fee='$fee',total='$real' where id='".$rs["id"]."' ";
$db->query($sql);
$sql="update {$db_prefix}users set price=price+'$real',price_s=price_s+'$real' where username='".$rs["username"]."' ";
$db->query($sql);
$memo=7;$type=1;$optime=$modtime;$money=$real;$memo1="第{$periods}期分红";
eclsproc($rs["username"],$memo,$money,$type,$optime,$memo1);
}
$db->free_result($result);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=7;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}结算发放第{$periods}期分红奖";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
$sql_u="update {$db_prefix}periods3 set state=2,fftime='$modtime' where periods='".$periods."'";
$db->query($sql_u);
echo "<script>alert('恭喜!本期分红已经发放');location.href='../manage/salarys3.php';</script>";exit();

?>