<?php

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_product.xls\"");
include("../include/conn_1.php");
;echo '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<TABLE
style="WIDTH: 100%"
cellSpacing=1 cellPadding=1 border=1 bandNo="0">
  <THEAD>
    <TR>
      <TH>编号</TH>
	  <TH>图片</TH>
      <TH>产品分类</TH>
      <TH>产品名称</TH>
      <TH>零售价</TH>
      <TH>会员价</TH>
      <!--<TH>PV</TH>-->
      <TH>库存</TH>
      <TH>添加时间</TH>
    </TR>
  </THEAD>
  <input type="hidden" name="chknum" value="0">
  ';
$sql="select * from {$db_prefix}product where 1";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '  <TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
    <TD>';echo $rs["id"];echo '</TD>
	<TD>';echo $rs["category"];echo '</TD>
    <TD>';echo $rs["category"];echo '</TD>
    <TD>';echo $rs["productname"];echo '</TD>
    <TD>';echo $rs["scprice"];echo '</TD>
    <TD>';echo $rs["price"];echo '</TD>
    <!--<TD>';echo $rs["pv"];echo '</TD>-->
    <TD>';echo $rs["num"];echo '</TD>
    <TD>';echo date("y-m-d",$rs["addtime"]);echo '</TD>
  </TR>
  ';
}
}else{
;echo '  <TR style="BACKGROUND-COLOR:#FFFFFF"  height=22 level="0">
    <TD  id=UltraWebGrid1rc_0_0  level="0_0" colspan="8"></TD>
  </TR>
  ';
}
$db->free_result($result);
;echo '</TABLE>
</body>
</html>
';
?>