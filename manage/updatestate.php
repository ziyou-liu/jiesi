<?php

include("../include/conn.php");include("../include/function.php");
die("文件无效");
if (empty($periods)) die("缺少参数");
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$rs=$db->get_one($sql);
if ($rs["state"]==0) die("奖金还没有结算");
if ($rs["state"]==2) die("奖金已发放过!");
$posary=array("主任","经理","区域总监","总监");
$sql_lst="select * from {$db_prefix}jsrec where periods='".$periods."' and ifnull(price_3_pos,'')<>''";
$result_lst=$db->query($sql_lst);
while($rs_lst=$db->fetch_array($result_lst)){
$lst_price_3_pos=$rs_lst["price_3_pos"];
$sql_pre="select * from {$db_prefix}users where username='".$rs_lst["username"]."'";
$rs_pre=$db->get_one($sql_pre);
if (!empty($rs_pre["prename"])) $prename=$rs_pre["prename"];else $prename="";
if ($prename!=""){
$sql_pos_lst="select count(a.id) as c from {$db_prefix}jsrec a,{$db_prefix}users b where a.username=b.username and b.prename='".$prename."' and a.periods='".$periods."' and ifnull(a.price_3_pos,'')='".$lst_price_3_pos."'";
$rs_pos_lst=$db->get_one($sql_pos_lst);
if ($rs_pos_lst["c"]==3){
$lst_price_4_b=1;
}else{
$lst_price_4_b=0;
}
$sql_u_lst="update {$db_prefix}jsrec set price_4_b='".$lst_price_4_b."' where username='".$rs_lst["username"]."' and periods='".$periods."'";
$db->query($sql_u_lst);
}
if ($lst_price_4_b==0){
if (in_array($lst_price_3_pos,$posary)){
$a_p="";$b_p="";$c_p="";
$a_b=0;$b_b=0;$c_b=0;
$sql_a="select * from {$db_prefix}users where pos='a' and prename='".$rs_lst["username"]."'";
$rs_a=$db->get_one($sql_a);
if (!empty($rs_a["username"])) $a_p=$rs_a["username"];else $a_p="";
if ($rs_a["price_3_pos"]=="业务员") $a_b=1;else $a_b=0;
$sql_b="select * from {$db_prefix}users where pos='b' and prename='".$rs_lst["username"]."'";
$rs_b=$db->get_one($sql_b);
if (!empty($rs_b["username"])) $b_p=$rs_b["username"];else $b_p="";
if ($rs_b["price_3_pos"]=="业务员") $b_b=1;else $b_b=0;
$sql_c="select * from {$db_prefix}users where pos='c' and prename='".$rs_lst["username"]."'";
$rs_c=$db->get_one($sql_c);
if (!empty($rs_c["username"])) $c_p=$rs_c["username"];else $c_p="";
if ($rs_c["price_3_pos"]=="业务员") $c_b=1;else $c_b=0;
if ($a_b==0){
if ($a_p!=""){
getglnetpos($a_p,1,"业务员");
}
}
if ($b_b==0){
if ($b_p!=""){
getglnetpos($b_p,2,"业务员");
}
}
if ($c_b==0){
if ($c_p!=""){
getglnetpos($c_p,3,"业务员");
}
}
if (($a_b==1) &&($b_b==1) &&($c_b==1)){
$lst_price_4_b=1;
}
if ($lst_price_4_b==1){
$sql_u_lst="update {$db_prefix}jsrec set price_4_b='".$lst_price_4_b."' where username='".$rs_lst["username"]."' and periods='".$periods."'";
$db->query($sql_u_lst);
}
}
}
}
$db->free_result($result_lst);
$sql_state="update {$db_prefix}periods set state2=1 where periods='".$periods."'";
$db->query($sql_state);
echo "<script>alert('更新奖金成功');location.href='salarys.php?pageno={$pageno}';</script>";exit();
function getglnetpos($username,$pos,$pos1){
global $db,$db_prefix,$a_b,$b_b,$c_b;
$sql1="select * from {$db_prefix}users where prename='".$username."'";
$result1=$db->query($sql1);
while ($rs1=$db->fetch_array($result1)){
if ($rs1["price_3_pos"]==$pos1){
switch($pos){
case 1:$a_b=1;break;
case 2:$b_b=1;break;
case 3:$c_b=1;break;
}
break;
}
}
$db->free_result($result1);
}

?>