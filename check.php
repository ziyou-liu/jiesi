<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>检测</title>
</head>
<body>
';
include("./include/conn_1.php");
$sql="select * from {$db_prefix}users where username='$username' and state=1";
$result=$db->get_one($sql);
if($from=="right"){
$sql="select count(id) from {$db_prefix}users where prename='$username' and state=1 ";
$temp=$db->get_one($sql);
$t_num=$temp["count(id)"];
}
if(!empty($result)){
;echo '   <script language="javascript">
    ';if($from=="left"){;echo '        parent.document.getElementById("thdiv").innerHTML="推荐人验证成功";
   ';}else{
if($t_num>=2) $tip="接点人位置已满!";else $tip="接点人验证成功";
;echo '      parent.document.getElementById("thdiv2").innerHTML=\'';echo $tip;;echo '\';
   ';};echo '
  </script>
   ';
}else{
;echo '   <script language="javascript">
    ';if($from=="left"){;echo '        parent.document.getElementById("thdiv").innerHTML="推荐人验证失败";
   ';}else{;echo '      parent.document.getElementById("thdiv2").innerHTML="接点人验证失败";
   ';};echo '  </script>
   ';
}
;echo '</body>
</html>
'
?>