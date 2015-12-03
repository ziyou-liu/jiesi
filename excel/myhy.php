<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
';
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"myhy.xls\"");
include("../include/conn_1.php");
include("../include/function.php");
include("../include/rank.php");include("../include/pos.php");
include("../include/pageclass.php");
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table
style="WIDTH: 100%"
cellspacing="1" cellpadding="1" border="1" bandno="0">
  <thead>
    <tr>
       <!--<th width="6%" >编号</th>-->
            <th width="10%">会员编号</th>
			<th width="10%" >姓名</th>
			<th width="8%" >级别</th>
            <th width="10%" >推荐人</th>
            <th width="10%" >接点人</th>
			<th width="8%" >区位</th>		
			<th width="16%">注册时间</th>
			<!--<th width="16%">确认时间</th>-->
    </tr>
  </thead>
  <input type="hidden" name="chknum" value="0" />
  ';
$sql="select * from {$db_prefix}users where state=1 and regusername='".$_SESSION["glo_username"]."'";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '  <tr style="BACKGROUND-COLOR:#ffffff"  height="22" level="0">
    <!--<td ><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];echo '</div>
            </div></td>-->
            <td align="center">';echo $rs["username"];echo '</td>
			<td  align="center">';echo $rs["realname"];echo '</td>
			<td  align="center">';echo $rankary[$rs['rank']];;echo '</td>
            <td  align="center">';echo $rs["tjrname"];echo '</td>
            <td  align="center">';echo $rs["prename"];echo '</td>
			<td  align="center">';echo $posary[$rs['pos']];;echo '区</td>			
			<td  align="center">';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</td>
			<!--<td  align="center">';echo date("Y-m-d H:i:s",$rs["confirmtime"]);echo '</td>-->
  </tr>
  ';
}
}
$db->free_result($result);
;echo '</table>
</body>
</html>
';
?>