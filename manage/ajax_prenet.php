<?php

include("../include/conn_1.php");include("../include/function.php");include("../include/rank.php");
header("Content-Type: text/html; charset=utf-8");
$sql="select * from {$db_prefix}users where id='".$hyid."'";
$rs=$db->get_one($sql);
$hyname=$rs["username"];
$sql="select * from {$db_prefix}users where prename='".$hyname."'";
$result=$db->query($sql);$rstulnum=$db->num_rows($result);$i=0;
while ($rs=$db->fetch_array($result)){
$i++;
;echo '  <div>
  ';
echo str_repeat('<img border=0  src="treeimgs/tree_line.gif" />',$dpth);
$chdbit=getchild($rs["username"]);
if ($chdbit){
echo '<a href="#img_'.$rs["id"].'" onclick="gxtex('.$rs["id"].','.($dpth+1).');">';
echo ($i==$rstulnum)?'<img border=0 id="img_'.$rs["id"].'" src="treeimgs/tree_plusl.gif" />':'<img border=0 id="img_'.$rs["id"].'" src="treeimgs/tree_plus.gif" />';
echo "</a>";
}else{
echo ($i==$rstulnum)?'<img border=0 id="img_'.$rs["id"].'" src="treeimgs/tree_blankl.gif" />':'<img border=0 id="img_'.$rs["id"].'" src="treeimgs/tree_blank.gif" />';
}
;echo '';echo $rs["username"];echo ' [第';echo $dpth+2;echo '层] [';echo getuserrank($rs["rank"]);echo ']  [注册日期:';echo date("Y-m-d",$rs["regtime"]);echo ']</div>
  <div id="d_';echo $rs["id"];echo '" style="display:none"></div>
  ';
}
$db->free_result($result);
;echo '  
';
function getchild($hyname){
global $db,$db_prefix;
$sql_chd="select id from {$db_prefix}users where prename='".$hyname."' limit 1";
$rs_chd=$db->get_one($sql_chd);
if (!empty($rs_chd["id"])) return true;else return false;
}

?>