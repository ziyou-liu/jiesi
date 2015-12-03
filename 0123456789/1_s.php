<?php

function insertintopv_1($year,$month,$day,$username,$pv_1,$num){
global $db,$db_prefix;
$sql="insert into {$db_prefix}tdpv(username,pv_1,pv1,t_pv1,num_1,num_2,year,month,day) values('$username','$pv_1','$pv_1','$pv_1','$num','$num','$year','$month','$day')";
$db->query($sql);
return true;
}
function editpv($year,$month,$day,$username,$pv_1,$bdnum){
global $db,$db_prefix;
$sql1="select id from {$db_prefix}tdpv where username='".$username."' and year='".$year."' and month='".$month."' and day='".$day."' limit 1";
$rs1=$db->get_one($sql1);
if ($rs1["id"]){
$sql="update {$db_prefix}tdpv set pv_1=pv_1+'$pv_1',pv1=pv1+'$pv_1',t_pv1=t_pv1+'$pv_1',num_1=num_1+'$bdnum',num_2=num_2+'$bdnum' where id='".$rs1['id']."'  limit 1";
}else{
$sql="insert into {$db_prefix}tdpv(username,pv_1,pv1,t_pv1,num_1,num_2,year,month,day) values('$username','$pv_1','$pv_1','$pv_1','$bdnum','$bdnum','$year','$month','$day')";
}
$db->query($sql);
return true;
}
function updateglnettdpv($year,$month,$day,$username,$pv1,$num,$hytype=2){
global $db,$db_prefix;
$sql1="select id from {$db_prefix}tdpv where username='$username' and year='$year' and month='$month' and day='$day' limit 1";
$rs1=$db->get_one($sql1);
if ($rs1["id"]){
$sql="update {$db_prefix}tdpv set pv1=pv1+'$pv1',num_2=num_2+'$num' where id='".$rs1['id']."'  limit 1";
}else{
$sql="insert into {$db_prefix}tdpv(username,pv1,num_2,year,month,day) values('$username','$pv1','$num','$year','$month','$day')";
}
$db->query($sql);
return true;
}
function updatetjnettdpv($year,$month,$day,$username,$pv1){
global $db,$db_prefix;
$sql1="select id from {$db_prefix}tdpv where username='".$username."' and year='".$year."' and month='".$month."' and day='".$day."' limit 1";
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])){
$sql="insert into {$db_prefix}tdpv(username,t_pv1,year,month,day) values('$username','$pv1','$year','$month','$day')";
}else{
$sql="update {$db_prefix}tdpv set t_pv1=t_pv1+'$pv1' where id='".$rs1['id']."'  limit 1";
}
$db->query($sql);
return true;
}
function updateglnetusertdpv2($username,$pv2,$num){
global $db,$db_prefix;
$sql="update {$db_prefix}users set pv_team_reg=pv_team_reg+'$pv2',bdnum_team=bdnum_team+'$num' where username='".$username."'  limit 1";
$db->query($sql);
return true;
}
function updatetjnetusertdpv2($username,$pv4){
global $db,$db_prefix;
$sql="update {$db_prefix}users set pv_team_regp=pv_team_regp+'$pv4' where username='$username' limit 1";
$db->query($sql);
return true;
}
function updateusernetconsume($username,$pv5){
global $db,$db_prefix;
$sql="update {$db_prefix}users set pv_team_conp=pv_team_conp+'$pv5' where username='".$username."' limit 1";
$db->query($sql);
return true;
}
function updateglconsume($year,$month,$day,$username,$pv,$price){
global $db,$db_prefix;
$sql1="select id from {$db_prefix}tdpv where username='".$username."' and year='".$year."' and month='".$month."' and day='".$day."' limit 1";
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])){
$sql="insert into {$db_prefix}tdpv(username,pv2,price2,year,month,day) values('$username','$pv','$price','$year','$month','$day')";
}else{
$sql="update {$db_prefix}tdpv set pv2=pv2+'$pv',price2=price2+'$price' where id='".$rs1['id']."'  limit 1";
}
$db->query($sql);
return true;
}
function getglnetupstr($username){
global $db,$db_prefix,$glnetupstr;
$sql="select id,username,prename from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if($rs['id']){
if ($glnetupstr!="") $glnetupstr.=",";
$glnetupstr.=$rs["username"];
if (!empty($rs["prename"])) getglnetupstr($rs["prename"]);
}
}
function gettjnetupstr($username){
global $db,$db_prefix,$tjnetupstr;
$sql="select id,username,tjrname from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if ($rs['id']){
if ($tjnetupstr!="") $tjnetupstr.=",";
$tjnetupstr.=$rs["username"];
if (!empty($rs["tjrname"])) gettjnetupstr($rs["tjrname"]);
}
}
function gettjnetupstrs($username){
global $db,$db_prefix,$tjnetupstrs;
$sql="select id,username,tjrname from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if ($rs['id']){
if ($tjnetupstrs!="") $tjnetupstrs.=",";
$tjnetupstrs.=$rs["username"];
if (!empty($rs["tjrname"])) gettjnetupstrs($rs["tjrname"]);
}
}
function gettjnetupstrdai($username,$dai,$dai1){
global $db,$db_prefix,$tjnetupstrdai;
if ($dai1>=$dai){
$sql="select id,username,tjrname from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if ($rs['id']){
if ($tjnetupstrdai!="") $tjnetupstrdai.=",";
$tjnetupstrdai.=$rs["username"];
if (!empty($rs["tjrname"])) gettjnetupstrdai($rs["tjrname"],$dai+1,$dai1);
}
}
}
function getglnetupstrceng($username,$ceng,$ceng1){
global $db,$db_prefix,$glnetupstrceng;
if ($ceng1>=$ceng){
$sql="select id,username,prename from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if($rs['id']){
if ($glnetupstrceng!="") $glnetupstrceng.=",";
$glnetupstrceng.=$rs["username"];
if (!empty($rs["prename"])) getglnetupstrceng($rs["prename"],$ceng+1,$ceng1);
}
}
}
function getglnetupstrl($username){
global $db,$db_prefix,$glnetupstrl;
$sql="select username from {$db_prefix}users where prename='".$username."' and pos=1  limit 1";
$rs=$db->get_one($sql);
if(!empty($rs["username"])){
if ($glnetupstrl!="") $glnetupstrl.=",";
$glnetupstrl.=$rs["username"];
}
if (!empty($rs["username"])) getglnetupstrl($rs["username"]);
}
function getglnetupstrr($username){
global $db,$db_prefix,$glnetupstrr;
$sql="select username from {$db_prefix}users where prename='".$username."' and pos=2 ";
if($jsfloer1!=''){
$sql.=$jsfloer1;
}
$sql.=" limit 1";
$rs=$db->get_one($sql);
if(!empty($rs["username"])){
if ($glnetupstrr!="") $glnetupstrr.=",";
$glnetupstrr.=$rs["username"];
}
if (!empty($rs["username"])) getglnetupstrr($rs["username"]);
}
function gettimepreupstr($username,$ceng,$ceng1){
global $db,$db_prefix,$timepreupstr;
if ($ceng1>=$ceng){
$sql="select id,username,timepre from {$db_prefix}users where username='".$username."' limit 1";
$rs=$db->get_one($sql);
if($rs['id']){
if ($timepreupstr!="") $timepreupstr.=",";
$timepreupstr.=$rs["username"];
if (!empty($rs["timepre"])) gettimepreupstr($rs["timepre"],$ceng+1,$ceng1);
}
}
}
function getgppreupstr($username,$ceng,$ceng1){
global $db,$db_prefix,$gppreupstr;
if ($ceng1>=$ceng){
$sql="select id,username,preid from {$db_prefix}bwnet where id='".$username."' and state=1 limit 1";
$rs=$db->get_one($sql);
if($rs['id']){
if ($gppreupstr!="") $gppreupstr.=",";
$gppreupstr.=$rs["username"];
if (!empty($rs["preid"])) getgppreupstr($rs["preid"],$ceng+1,$ceng1);
}
}
}
function gethystr($username) {
global $db,$db_prefix,$c_str;
$curcengstr='';
$sql1 = "select username from {$db_prefix}users where find_in_set(prename,'".$username."')>0  and state=1 order by id asc";
$result1=$db->query($sql1);
while($rs1=$db->fetch_array($result1)) {
if($curcengstr!='') $curcengstr.=',';
$curcengstr.=$rs1['username'];
}
$db->free_result($result1);
$sql2="select id,username from {$db_prefix}users where find_in_set(prename,'".$curcengstr."')>0 and state=1 order by id asc";
$result2=$db->query($sql2);
while($rs2=$db->fetch_array($result2)) {
if($c_str!='') $c_str.=',';
$c_str.=$rs2['username'];
}
$db->free_result($result2);
if ($curcengstr!=''){
gethystr($curcengstr);
}
}

?>