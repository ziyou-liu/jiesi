<?php

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_2.xls\"");
include("../include/conn_1.php");include("../include/function.php");
;echo '<html>
<body>
<table
style="WIDTH: 100%"
cellspacing="1" cellpadding="1" border="1" bandno="0">
  <thead>
    <tr>
      <th>编号</th>
      <th>会员编号</th>
      <th>汇款银行</th>
      <th>汇款人</th>
      <th>金额</th>
      <th>汇款日期</th>
      <th>状态</th>
    </tr>
  </thead>
  <input type="hidden" name="chknum" value="0" />
  ';
$sql="select * from {$db_prefix}remits where 1 order by id asc";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while ($rs=$db->fetch_array($result)){
;echo '  <tr style="BACKGROUND-COLOR:#ffffff"  height="22" level="0">
    <td>';echo $rs["id"];echo '</td>
    <td>';echo $rs["username"];echo '</td>
    <td>';echo $rs["bank"];echo '</td>
    <td>';echo $rs["hkname"];echo '</td>
    <td>';echo $rs["price"];echo '</td>
    <td>';echo date("Y-m-d",$rs["hktime"]);echo '</td>
    <td>';echo getremitstate($rs["state"]);echo '</td>
  </tr>
  ';
}
}else{
;echo '  <tr style="BACKGROUND-COLOR:#ffffff"  height="22" level="0">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  ';
}
$db->free_result($result);
;echo '</table>
</body>
</html>';
?>