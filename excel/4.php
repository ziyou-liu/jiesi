<?php

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_4.xls\"");
include("../include/conn_1.php");include("../include/function.php");include("../include/pageclass.php");include("../include/area.php");
include("../0123456789/1_s.php");include("../include/logcls.php");include("../include/ecls.php");
;echo '<html>
<body>
<TABLE
style="WIDTH: 100%"
cellSpacing=1 cellPadding=1 border=1>
  <THEAD>
    <TR>
      <TH>会员编号</TH>
      <TH>姓名</TH>
      <TH>地区</TH>
      <TH>地址</TH>
      <TH>注册人</TH>
      <TH>注册人姓名</TH>
      <TH>手机号</TH>
      <TH>会员卡号</TH>
    </TR>
  </THEAD>
  <input type="hidden" name="chknum" value="0">
  ';
$sql="select * from {$db_prefix}users where 1";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while ($rs=$db->fetch_array($result)){
;echo '  <TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
    <TD>';echo $rs["username"];echo '</TD>
    <TD>';echo $rs["realname"];echo '</TD>
    <TD>';echo getprovince($rs["province"])."-".getcity($rs["city"])."-".getarea($rs["area"]);echo '</TD>
    <TD>';echo $rs["address"];echo '</TD>
    <TD>';echo $rs["regusername"]."[".(empty($rs["regtype"])?"管理员":"会员")."]";echo '</TD>
    <TD>';echo $rs["regrealname"];echo '</TD>
    <TD>';echo $rs["mobile"];echo '</TD>
    <TD>
     ';echo $rs["email"];echo '    </TD>
  </TR>
  ';
}
}else{
;echo '  <TR style="BACKGROUND-COLOR:#FFFFFF"  height=22 level="0">
    <TD colspan="8"></TD>
  </TR>
  ';
}
$db->free_result($result);
;echo '</TABLE>
</body>
</html>
';
?>