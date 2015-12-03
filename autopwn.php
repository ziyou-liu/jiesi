<?php

$prename='';$pos=0;
$tjrname=trim($tjrname);
$allstrsjd=$tjrname;
$sql="select username from {$db_prefix}users where prename='".$tjrname."' order by id asc";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if($allstrsjd!='') $allstrsjd.=',';
$allstrsjd.=$rs['username'];
}
$db->free_result($result);
$c_str='';
gethystr($tjrname);
if($c_str!='') {
if($allstrsjd!='') $allstrsjd.=",";
$allstrsjd.=$c_str;
}
if($allstrsjd!='') {
$allarys=explode(',',$allstrsjd);
$isbrealk=0;
foreach($allarys as $kpp=>$vpp) {
$sql1="select posnum from {$db_prefix}users where username='".$vpp."'";
$rs1=$db->get_one($sql1);
for($i=1;$i<=$rs1['posnum'];$i++) {
$sql2="select id from {$db_prefix}users where prename='".$vpp."' and pos='".$i."'";
$rs2=$db->get_one($sql2);
if(empty($rs2['id'])) {
$prename=$vpp;
$pos=$i;
$isbrealk=1;
break;
}
}
if($isbrealk==1) {
break;
}
}
unset($allarys);
}else {
$prename=$tjrname;
$pos=1;
}
if (trim($prename)=='') $hint.="无空位\\n";

?>