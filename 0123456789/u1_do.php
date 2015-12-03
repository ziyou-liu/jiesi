<?php

set_time_limit(1000);
include("../include/conn.php");
include("../include/rank.php");
include("../include/periodscls.php");
include("../include/logcls.php");
include("../include/function.php");
$sql="select * from {$db_prefix}periods3 where periods='".$periods."'";
$periods_rs=$db->get_one($sql);
if($periods_rs['state2']==1) die("<br><br><br><br><br><center><p style='color:red;'>暂不支持后退操作，如需重复结算，请从结算列表里重新点击‘结算’</p></center>");
$timelimit=$periods_rs["begintime"];$timelimit1=$periods_rs["endtime"]+24*60*60;
$timelimit2=$periods_rs["endtime"];
$jsfloer2=" and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$modtime=time();
$sql="select count(id) as c from {$db_prefix}jsrec3 where 1";
$rs=$db->get_one($sql);
if($rs['c']>0){
$sql="select username from {$db_prefix}users where state=1 order by id asc limit 1";
$rsf=$db->get_one($sql);
$sql="select sum(pv1) as c from {$db_prefix}tdpv where username='".$rsf['username']."'".$jsfloer2;
$rsy=$db->get_one($sql);
if($rsy['c']>0){
$totalprice=$rsy['c']*$glo_fhrate/100;
if($totalprice>0){
$per=floatval($totalprice/$rs['c']);
$sqlj="update {$db_prefix}jsrec3 set fenhong1=fenhong1+'$per' where  periods='$periods'";
$rsj=$db->query($sqlj);
}
}
}
$sql_upt="update {$db_prefix}periods3 set state1=0,state=1,state2=1,jsname='".$_SESSION["glo_adminname"]."',jstime='$modtime' where periods='$periods'";
$db->query($sql_upt);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=6;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}结算第{$periods}期分红奖";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo("<script>location.href='u2.php?periods={$periods}';</script>");
exit();
?>