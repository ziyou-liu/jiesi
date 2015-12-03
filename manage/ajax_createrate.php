<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理奖</title>
</head>
<body>
';
include("../include/conn_1.php");
$sql="select lddai_{$rank} as dai from {$db_prefix}setting where 1";
$rs=$db->get_one($sql);
if($rs['dai']<$num){
for($i=($rs['dai']+1);$i<=$num;$i++){
$db->query("alter table {$db_prefix}setting add `ldrate_{$rank}_{$i}` double(12,2) default 0");
}
}elseif($rs['dai']>$num){
for($i=$rs['dai'];$i>$num;$i--){
$db->query("alter table {$db_prefix}setting drop `ldrate_{$rank}_{$i}`");
}
}
$db->query("update {$db_prefix}setting set lddai_{$rank}='".$num."'");
$sqls="select * from {$db_prefix}setting";
$rss=$db->get_one($sqls);
$picstr="";
for ($i=1;$i<=$num;$i++){
$picstr.="<input name='ldrate_".$rank."_".$i."' type='text' value='".$rss["ldrate_".$rank."_".$i]."' size='7' />%<br>";
}
echo $picstr;
;echo '</body>
</html>
';
?>