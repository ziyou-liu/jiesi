<?php

set_time_limit(1000);
include("../include/conn.php");
include("../include/rank.php");
include("../include/logcls.php");
include("../include/function.php");
$sqlp="select begintime,endtime from {$db_prefix}periods where periods='$periods'";
$rsp=$db->get_one($sqlp);
$sqlj="select sum(lsprice+dianbuj+ywzzj+glprice-jfprice) as c from {$db_prefix}jsrec where periods='".$periods."'";
$rsj=$db->get_one($sqlj);
$c2=$rsj['c'];
$timelimit=$rsp['begintime'];$timelimit2=$rsp['endtime'];
$sqlf="select username from {$db_prefix}users where 1 order by id asc limit 1";
$rsf=$db->get_one($sqlf);
$sqlt="select sum(pv1) as  c from {$db_prefix}tdpv where username='".$rsf['username']."'  and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$rst=$db->get_one($sqlt);
$c1=$rst['c'];
if($c1>0) {
$c3=($c2/$c1)*100;
if($c3>$glo_krate) {
$more=$c2-$glo_krate*$c1/100;
if($more>0) {
$sql="select * from {$db_prefix}jsrec where (lsprice+dianbuj+ywzzj+glprice-jfprice)>0 and periods='".$periods."'";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$kzhi=0;
$total=$rs['gdprice']+$rs['lsprice']+$rs["dianbuj"]+$rs["glprice"]+$rs['ywzzj']+$rs['bzprice']+$rs['cxprice']-$rs['jfprice']-$rs["cfxf"]-$rs['fax'];
$bili=$total/$c2;
$kzhi=$bili*$more;
if($kzhi>0) {
$sqluu="update {$db_prefix}jsrec set kzhi='".$kzhi."' where username='".$rs['username']."' and periods='$periods'";
$db->query($sqluu);
}
}
$db->free_result($result);
}
}
}
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=12;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}平衡第{$periods}期奖金";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo("<script>location.href='2.php?periods={$periods}';</script>");
exit();
?>