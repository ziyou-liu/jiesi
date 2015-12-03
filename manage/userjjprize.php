<?php

set_time_limit('10000');
$udtime=mktime(12,0,0,6,10,2013);
if ($bdmoney>0 &&$timepre){
function tjloop($username,$timepre,$tjnet){
global $db,$db_prefix,$tcnumary,$glo_tax,$ysmemo,$tcnameary,$modtime,$udtime;
global $glo_gxrate_1_1,$glo_gxrate_1_2,$glo_gxrate_1_3,$glo_gxrate_2_2,$glo_gxrate_2_3,$glo_gxrate_3_2,$glo_gxrate_3_3,$glo_gxrate_4_2,$glo_gxrate_4_3,$glo_gxrate_5_2,$glo_gxrate_5_3,$glo_gxrate_6_2,$glo_gxrate_6_3,$glo_gxrate_7_2,$glo_gxrate_7_3;
global $glo_gxmax_1,$glo_gxmax_2,$glo_gxmax_3,$glo_gxmax_4,$glo_gxmax_5,$glo_gxmax_6,$glo_gxmax_7;
global $glo_ljmax_1,$glo_ljmax_2,$glo_ljmax_3,$glo_ljmax_4,$glo_ljmax_5,$glo_ljmax_6,$glo_ljmax_7;
global $glo_gxrate_1_4,$glo_gxrate_2_4,$glo_gxrate_3_4,$glo_gxrate_4_4,$glo_gxrate_5_4,$glo_gxrate_6_4,$glo_gxrate_7_4;
global $glo_bftjrate2,$glo_bftjrate3;
$sqlr="select rank,tjrname from {$db_prefix}users where username='$username'";
$rsr=$db->get_one($sqlr);
$jjtemp="glo_gxrate_".$tjnet."_".$rsr['rank'];
$jjprice=$$jjtemp;
$fdtemp="glo_gxmax_".$tjnet;
$fdprice=$$fdtemp;
$nexttjnet=$tjnet+1;
$tjnum=$tcnumary[$nexttjnet];
if($tjnet>=4){
$ljtemp="glo_ljmax_".$tjnet;
$ljprice=$$ljtemp;
}
$memo1=$ysmemo.",".$username."进入".$tcnameary[$tjnet];
$sqlu="select count(id) as c from {$db_prefix}users where state=1 and username!='$username' and tjnet='$tjnet' and storerank=0";
$rsu=$db->get_one($sqlu);
$xunhuan=floor($rsu['c']/500);
$yu=$rsu['c']%500;
$fduserary=array();
$tjnumary=array();
if($xunhuan>0){
for($j=0;$j<$xunhuan;$j++){
$preary=array();
if($timepre){
$preary=gettimeprestr($timepre,$tjnet,1,500);
}
if(count($preary)>0){
foreach($preary as $k=>$v){
$realtjnum=0;
$lsprice=0;
$havprice=0;$tax=0;$gxprice=0;
$gxprice=$jjprice;
$sqltj="select count(id) as c from {$db_prefix}users where tjrname='".$v."' and state=1 and rank>1";
$rstj=$db->get_one($sqltj);
if($rstj['c']>0) $realtjnum=$rstj['c'];
$sqle="select sum(money) as c from {$db_prefix}e where username='$v' and memo=30 and tjnet='$tjnet'";
$rse=$db->get_one($sqle);
if($rse['c']>0) $havprice=$rse['c'];
if($tjnet>=4){
$sqlwj="select sum(money) as c from {$db_prefix}e1 where username='$v' and memo=30 and tjnet='$tjnet' and state=0";
$rswj=$db->get_one($sqlwj);
if($rswj['c']>0) {
$lsprice=$rswj['c'];
$havprice+=$lsprice;
}
}
$cha=$fdprice-$havprice;
$sqlp="select id,rank,tjnum,jjsuoding from {$db_prefix}users where username='$v'";
$rsp=$db->get_one($sqlp);
if($rsp['rank']==2 &&$tjnet==1){
if($realtjnum>=$tjnum){
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}else{
if($cha>0){
$fdbool=false;
if($gxprice>=$cha){
$gxprice=$cha;$fdbool=true;
}
$realjjprice=$gxprice;
$ljbool=false;
if($tjnet>=4){
if(($gxprice+$lsprice)>=$ljprice ||$fdbool){
$realjjprice=$gxprice+$lsprice;
$ljbool=true;
}
}
if($realjjprice>0 &&$rsp['jjsuoding']==0){
if($ljbool ||$tjnet<4){
if($tjnet>=4){
$db->query("update {$db_prefix}e1 set state=1 where username='$v' and state=0 and tjnet='$tjnet'");
}
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$sqljj="update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$v'";
$db->query($sqljj);
$memo1=$ysmemo.",".$username."进入".$tcnameary[$tjnet];
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".($gxprice+$lsprice)."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','36','".$tax."','2','".$modtime."','','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}else{
$sql_e="insert into {$db_prefix}e1 (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".$realjjprice."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}
if($fdbool &&$rsp['rank']>1 &&$realtjnum>=$tjnum &&(($tjnet==2 &&$rsp['rank']==2) ||$rsp['rank']>2)) {
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}else{
if($lsprice>0 &&$rsp['jjsuoding']==0){
$db->query("update {$db_prefix}e1 set state=1 where username='$v' and state=0 and tjnet='$tjnet'");
$realjjprice=$lsprice;
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$sqljj="update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$v'";
$db->query($sqljj);
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".$lsprice."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','36','".$tax."','2','".$modtime."','','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}
if($rsp['rank']>1 &&$realtjnum>=$tjnum  &&(($tjnet==2 &&$rsp['rank']==2) ||$rsp['rank']>2)){
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}
}
}
if($k==499){
if($tjnet==1) $timepre_temp='timepre';else $timepre_temp='timepre'.$tjnet;
$rs499=$db->get_one("select ".$timepre_temp." from {$db_prefix}users where username='".$v."'");
$timepre=$rs499[$timepre_temp];
}
unset($preary);
}
}
}
if($yu>0){
$preary=array();
$preary=gettimeprestr($timepre,$tjnet,1,$yu);
if(count($preary)>0){
foreach($preary as $k=>$v){
$realtjnum=0;
$lsprice=0;
$havprice=0;$tax=0;$gxprice=0;
$gxprice=$jjprice;
$sqltj="select count(id) as c from {$db_prefix}users where tjrname='".$v."' and state=1 and rank>1";
$rstj=$db->get_one($sqltj);
if($rstj['c']>0) $realtjnum=$rstj['c'];
$sqle="select sum(money) as c from {$db_prefix}e where username='$v' and memo=30 and tjnet='$tjnet'";
$rse=$db->get_one($sqle);
if($rse['c']>0) $havprice=$rse['c'];
if($tjnet>=4){
$sqlwj="select sum(money) as c from {$db_prefix}e1 where username='$v' and memo=30 and tjnet='$tjnet' and state=0";
$rswj=$db->get_one($sqlwj);
if($rswj['c']>0) {
$lsprice=$rswj['c'];
$havprice+=$lsprice;
}
}
$cha=$fdprice-$havprice;
$sqlp="select id,rank,tjnum,jjsuoding from {$db_prefix}users where username='$v'";
$rsp=$db->get_one($sqlp);
if($rsp['rank']==2 &&$tjnet==1){
if($realtjnum>=$tjnum){
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}else{
if($cha>0){
$fdbool=false;
if($gxprice>=$cha){
$gxprice=$cha;$fdbool=true;
}
$realjjprice=$gxprice;
$ljbool=false;
if($tjnet>=4){
if(($gxprice+$lsprice)>=$ljprice ||$fdbool){
$realjjprice=$gxprice+$lsprice;
$ljbool=true;
}
}
if($realjjprice>0 &&$rsp['jjsuoding']==0){
if($ljbool ||$tjnet<4){
if($tjnet>=4){
$db->query("update {$db_prefix}e1 set state=1 where username='$v' and state=0 and tjnet='$tjnet'");
}
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$sqljj="update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$v'";
$db->query($sqljj);
$memo1=$ysmemo.",".$username."进入".$tcnameary[$tjnet];
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".($gxprice+$lsprice)."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','36','".$tax."','2','".$modtime."','','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}else{
$sql_e="insert into {$db_prefix}e1 (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".$realjjprice."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}
if($fdbool &&$rsp['rank']>1 &&$realtjnum>=$tjnum   &&(($tjnet==2 &&$rsp['rank']==2) ||$rsp['rank']>2)) {
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}else{
if($lsprice>0 &&$rsp['jjsuoding']==0){
$db->query("update {$db_prefix}e1 set state=1 where username='$v' and state=0 and tjnet='$tjnet'");
$realjjprice=$lsprice;
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$sqljj="update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$v'";
$db->query($sqljj);
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','30','".$lsprice."','1','".$modtime."','".$memo1."','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$v."','36','".$tax."','2','".$modtime."','','1','".$rsp['rank']."','$tjnet')";
$db->query($sql_e);
}
}
if($rsp['rank']>1 &&$realtjnum>=$tjnum  &&(($tjnet==2 &&$rsp['rank']==2) ||$rsp['rank']>2)){
$fduserary[]=$v;
$tjnumary[]=$realtjnum;
}
}
}
}
unset($preary);
}
}
if($tjnet>1 &&$tjnet<4 &&$rsr['tjrname'] &&$rsr['rank']!=1 &&$rsr['rank']!=3){
$bftemp="glo_bftjrate".$tjnet;
$bfprice=$$bftemp;
if($bfprice>0){
$realbfprice=$bfprice;$bftax=0;
$sql2t="select confirmtime,tjnet,confirmtime4,rank from {$db_prefix}users where username='".$rsr['tjrname']."'";
$rs2t=$db->get_one($sql2t);
$bfbool=false;
if($rs2t['confirmtime']<$udtime &&$rs2t['rank']>2){
if($rs2t['tjnet']>=4 &&$rs2t['confirmtime4']<$udtime){
if($rsr['rank']==2){
$sql2n="select count(id) as c from {$db_prefix}e where username='".$rsr['tjrname']."' and memo='34' and rank=2 and tjnet='$tjnet'";
$rs2n=$db->get_one($sql2n);
if($rs2n['c']<10){
$bfbool=true;
}
}
}elseif($rs2t['tjnet']>=$tjnet){
$sql2n="select count(id) as c from {$db_prefix}e where username='".$rsr['tjrname']."' and memo='34' and rank='".$rsr['rank']."' and tjnet='$tjnet'";
$rs2n=$db->get_one($sql2n);
if($rs2n['c']<10){
$sqle="select id from {$db_prefix}e where username='".$rsr['tjrname']."' and memo=30 and addtime='$modtime' and tjnet='$tjnet'";
$rse=$db->get_one($sqle);
if(empty($rse['id'])){
$sqle="select id from {$db_prefix}e1 where username='".$rsr['tjrname']."' and memo=30 and addtime='$modtime' and tjnet='$tjnet'";
$rse=$db->get_one($sqle);
if(empty($rse['id'])){
$bfbool=true;
}
}
}
}
}
if($bfbool){
if($glo_tax>0){
$bftax=$bfprice*$glo_tax/100;
$realbfprice-=$bftax;
}
$sqljj="update {$db_prefix}users set price=price+'$realbfprice',price_s=price_s+'$realbfprice' where username='".$rsr['tjrname']."'";
$db->query($sqljj);
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$rsr['tjrname']."','34','".$bfprice."','1','".$modtime."','".$memo1."','1','".$rsr['rank']."','$tjnet')";
$db->query($sql_e);
if($bftax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1,rank,tjnet) values('".$rsr['tjrname']."','36','".$bftax."','2','".$modtime."','','1','".$rsr['rank']."','$tjnet')";
$db->query($sql_e);
}
}
}
}
if(count($fduserary)>0 &&$nexttjnet<8){
krsort($fduserary);
krsort($tjnumary);
foreach($fduserary as $k=>$v){
$uptimepre='';
$xh=0;
$sqlup="select username,xh from {$db_prefix}users where tjnet='$nexttjnet' order by xh desc limit 1";
$rsup=$db->get_one($sqlup);
if(!empty($rsup['username'])){
$uptimepre=$rsup['username'];
$xh=$rsup['xh']+1;
}
$sql="update {$db_prefix}users set confirmtime".$nexttjnet."='".time()."',tjnet='$nexttjnet',timepre".$nexttjnet."='$uptimepre',xh='$xh' where username='$v'";
$db->query($sql);
$sql_in="insert into {$db_prefix}tjpan (username,tjnet,newtjnet,addtime,tjnum,memo) values('".$v."','$tjnet','$nexttjnet','".time()."','".$tjnumary[$k]."','$ysmemo')";
$db->query($sql_in);
if($uptimepre!='') tjloop($v,$uptimepre,$nexttjnet);
}
}
unset($fduserary);unset($tjnumary);
}
$tjnet=1;
tjloop($username,$timepre,$tjnet);
}
function gettimeprestr($username,$tjnet,$ceng,$ceng1,$preary=array()){
global $db,$db_prefix;
if($ceng1>=$ceng){
if($tjnet==1) $temp="timepre";else $temp="timepre".$tjnet;
$sql="select id,".$temp.",tjnet,storerank from {$db_prefix}users where username='".$username."'";
$rs=$db->get_one($sql);
if($rs['tjnet']==$tjnet &&$rs['storerank']==0) $preary[]=$username;
if(!empty($rs[$temp])){
if($rs['tjnet']==$tjnet &&$rs['storerank']==0){
return gettimeprestr($rs[$temp],$tjnet,$ceng+1,$ceng1,$preary);
}else{
return gettimeprestr($rs[$temp],$tjnet,$ceng,$ceng1,$preary);
}
}else{
return $preary;
}
}else{
return $preary;
}
}
if($dprank>0 &&$tjrname){
$dptemp="glo_tdrate_".$dprank;
$tdprice=$rankneedpv*$$dptemp/100;
if($tdprice>0){
$realjjprice=$tdprice;
$tax=0;
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$db->query("update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$tjrname'");
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$tjrname."','31','".$tdprice."','1','".$modtime."','$ysmemo','1')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$tjrname."','36','".$tax."','2','".$modtime."','','1')";
$db->query($sql_e);
}
}
$tjnetupstrdai='';
gettjnetupstrdai($tjrname,1,$glo_jddai);
$jdtemp="glo_jdrate_".$dprank;
$jdprice=$rankneedpv*$$jdtemp/100;
$realjjprice=$jdprice;
$tax=0;
if($glo_tax>0){
$tax=$realjjprice*$glo_tax/100;
$realjjprice-=$tax;
}
$tjnetary=explode(',',$tjnetupstrdai);
foreach($tjnetary as $kt=>$vt){
$memo1=$ysmemo.'第'.($kt+1)."代";
$db->query("update {$db_prefix}users set price=price+'$realjjprice',price_s=price_s+'$realjjprice' where username='$vt'");
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$vt."','32','".$jdprice."','1','".$modtime."','$memo1','1')";
$db->query($sql_e);
if($tax>0){
$sql_e="insert into {$db_prefix}e (username,memo,money,type,addtime,memo1,type1) values('".$vt."','36','".$tax."','2','".$modtime."','','1')";
$db->query($sql_e);
}
}
}

?>