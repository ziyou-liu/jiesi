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
$sql="select * from {$db_prefix}periods where periods='$periods'";
$rs=$db->get_one($sql);
if ($rs["state"]==0) die("奖金还没有结算");
if ($rs["state"]==2) die("<center>奖金已发放过!</center>");
$timelimit1=$rs["endtime"]+24*60*60;
$sqlla="select id from {$db_prefix}periods where periods<'$periods' and state<2";
$rsla=$db->get_one($sqlla);
if(!empty($rsla['id'])) die("<br><br><br><br><br><center><p style='color:red;'>请先发放上期奖金</p></center>");
if($modtime<$timelimit1) {
die("当前发放时间不能小于该期的截止时间。");
}else {
if($rs['jstime']<$timelimit1) {
die("发放之前，请重新结算一遍。");
}
}
$sql="select * from {$db_prefix}jsrec where periods='$periods' and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+tgprice+tcprice+fdprice)>0 order by id asc ";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$cxprice=$rs['cxprice'];
$total_p=0;$real=0;
foreach ($salaryprice as $key=>$val){
$total_p+=$rs[$val];
}
foreach ($salaryfee as $key=>$val){
$total_p-=$rs[$val];
}
$real=$total_p;
if($real >0){
$sql1="update {$db_prefix}jsrec set fee='$fee',total='$real' where id='".$rs["id"]."'";
$db->query($sql1);
$sql1="update {$db_prefix}users set j_price=j_price+'$real',price_s=price_s+'$real',flprice=flprice+'".$rs['flprice']."' where username='".$rs["username"]."' ";
$db->query($sql1);
$memo=4;$type=1;$optime=$modtime;$money=$real;$memo1="第".$periods."期奖金";$type1=4;
eclsproc($rs["username"],$memo,$money,$type,$optime,$memo1,$type1);
}
if($cxprice>0){
$sql1="update {$db_prefix}users set price_repeat=price_repeat+'".$rs['cxprice']."' where username='".$rs["username"]."' ";
$db->query($sql1);
$memo=4;$type=1;$optime=$modtime;$money=$rs['cxprice'];$type1=3;$memo1="第".$periods."期奖金";
eclsproc($rs["username"],$memo,$money,$type,$optime,$memo1,$type1);
}
$sqlu="select flprice,bdmoney from {$db_prefix}users where username='".$rs["username"]."'";
$rsu=$db->get_one($sqlu);
if($rsu['flprice']>=$rsu['bdmoney']){
$db->query("update {$db_prefix}users set isout=1 where username='".$rs["username"]."'");
}
}
$db->free_result($result);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=7;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}结算发放第{$periods}期奖金";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
$sql_u="update {$db_prefix}periods set state=2,fftime='$modtime' where periods='".$periods."'";
$db->query($sql_u);
echo "<script>alert('恭喜!本期奖金已经发放');location.href='../manage/salarys.php';</script>";exit();

?>