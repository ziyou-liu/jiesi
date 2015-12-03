<?php

header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_5.xls\"");
include("../include/conn_1.php");include("../include/function.php");include("../include/rank.php");include("../include/pageclass.php");include("../include/area.php");
include("../0123456789/1_s.php");include("../include/logcls.php");include("../include/ecls.php");include("../include/pos.php");
;echo '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<TABLE
style="WIDTH: 100%"
cellSpacing=1 cellPadding=1 border=1 bandNo="0">
  <THEAD>
    <TR>
      <TH>编号</TH>
      <TH>会员编号</TH>
      <TH>姓名</TH>
	  <TH>级别</TH>
      <TH>推荐人</TH>
      <TH>接点人</TH> 
	 <!-- <TH>所属店铺</TH>-->
      <TH>现金钱包</TH>
	  <TH>奖金钱包</TH>
	  <TH>奖金累计</TH>	
	  <TH>购物账户</TH>	
      <TH>注册人</TH>
      <TH>注册时间</TH>
	  <TH>确认时间</TH>
    </TR>
  </THEAD>
  <input type="hidden" name="chknum" value="0">
  ';
$sql="select * from {$db_prefix}users where 1";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$rankname=getuserrank($rs["rank"]);
;echo '  <TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
   <td height="20" ><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];if($rs['isblank']) echo "<br><span style='color:red'>空点</span>";;echo '</div>
            </div></td>
            <td height="20" ><div align="center">
			';echo $rs['username'];
;echo '</div></td>
			<td ><div align="center">';echo $rs["realname"];echo '</div></td>
			<td ><div align="center">';echo $rankname;echo '</div></td>
            <td ><div align="center">';echo $rs["tjrname"];echo '</div></td>
            <td height="20" ><div align="center">';if($rs['prename']) echo $rs["prename"]."<br>".$posary[$rs['pos']]."区";;echo '</div></td>
			<td ><div align="center">';echo $rs["price"];echo '</div></td>
			<td ><div align="center">';echo $rs["j_price"];echo '</div></td>
			<td ><div align="center">';echo $rs["price_s"];echo '</div></td>
			<td ><div align="center">';echo $rs["price_repeat"];echo '</div></td>
            <td height="20" ><div align="center">';echo $rs["regusername"];echo '</div></td> 
			<td ><div align="center">';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</div></td>
			<td ><div align="center">';echo date("Y-m-d H:i:s",$rs["confirmtime"]);echo '</div></td>
  </TR>
  ';
}
}
$db->free_result($result);
;echo '</TABLE>
</body>
</html>
';
?>