<?php

function getincome($time1,$time2){
global $db,$db_prefix;
$return=0;
if(!empty($time1)&&!empty($time2)){
$sql1="select sum(a.pv1) as c from {$db_prefix}tdpv a,{$db_prefix}users b where a.username=b.username and ifnull(b.tjrname,'')='' and ifnull(b.prename,'')='' and datediff(concat(a.year,'-',a.month,'-',a.day),from_unixtime(".$time1."))>=0 and datediff(concat(a.year,'-',a.month,'-',a.day),from_unixtime(".$time2."))<=0";
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else return ;
}
function getincome2($time2){
global $db,$db_prefix;
$return=0;
if(!empty($time2)){
$sql1="select sum(a.num_2) as c from {$db_prefix}tdpv a,{$db_prefix}users b where a.username=b.username and datediff(concat(a.year,'-',a.month,'-',a.day),from_unixtime(".$time2."))<=0 and ifnull(b.tjrname,'')='' and ifnull(b.prename,'')='' ";
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else return ;
}
function getoutcome($periods){
global $db,$db_prefix;
$return=0;
$sql1="select sum(lsprice+dianbuj+ywzzj+glprice-cfxf-fax) as c from {$db_prefix}jsrec where periods='$periods'";
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}
function gettotalincome($time1,$time2){
global $db,$db_prefix;
$sql2="select bdmoney from {$db_prefix}users where confirmtime>='$time1' and confirmtime<='$time2'";
$res=$db->query($sql2);
if($db->num_rows($res)>0){
$total=0;
while($rs=$db->fetch_array($res)){
$total=$total+$rs["bdmoney"];
}
}
$allc=$total;
return $allc;
}
function gettotalincome2($time2){
global $db,$db_prefix;
$sql2="select * from {$db_prefix}users where regtime<='$time2'";
$res=$db->query($sql2);
if($db->num_rows($res)>0){
$total=0;
while($rs=$db->fetch_array($res)){
$total=$total+$rs["bdmoney"];
}
}
$allc=$total;
return $allc;
}
function getoutcomespan($periods,$type){
global $db,$db_prefix;
if(!empty($periods)){
if ($type=="all"){
$sql1="select sum(flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice-cxprice-wlwhf) as c from {$db_prefix}jsrec where periods='$periods'";
}else{
$sql1="select sum(".$type.") as c from {$db_prefix}jsrec where periods='$periods'";
}
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else{
return;
}
}
function getoutcomespan2($timelimit2,$type){
global $db,$db_prefix;
if(!empty($timelimit2)){
if ($type=="all"){
$sql1="select sum(lsprice+dianbuj+ywzzj+glprice-cfxf-fax) as c from {$db_prefix}jsrec where periods in (select periods from {$db_prefix}periods where endtime<='$timelimit2')";
}else{
$sql1="select sum({$type}) as c from {$db_prefix}jsrec where periods in (select periods from {$db_prefix}periods where endtime<='$timelimit2')";
}
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else{
return;
}
}
function getoutcomespan3($timelimit2,$type,$username){
global $db,$db_prefix;
if(!empty($timelimit2)){
if ($type=="all"){
$sql1="select sum(lsprice+dianbuj+ywzzj+glprice-cfxf-fax) as c from {$db_prefix}jsrec where periods in (select periods from {$db_prefix}periods where endtime<='$timelimit2') and username='$username'";
}else{
$sql1="select sum({$type}) as c from {$db_prefix}jsrec where periods in (select periods from {$db_prefix}periods where endtime<='$timelimit2' and state>0) and username='$username'";
}
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else{
return;
}
}
function getallout($timelimit2){
global $db,$db_prefix;
$sql1="select sum(lsprice+dianbuj+ywzzj+glprice-cfxf-fax) as c from {$db_prefix}jsrec where periods in (select periods from {$db_prefix}periods where endtime<='$timelimit2')";
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}
function getallincome($timelimit2){
global $db,$db_prefix;
if(!empty($timelimit2)){
$sql1="select sum(pv1+pv2-pv_1) as c from {$db_prefix}tdpv where id=1 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$rs1=$db->get_one($sql1);
$allc=empty($rs1["c"])?0:$rs1["c"];
return $allc;
}else{
return ;
}
}

?>