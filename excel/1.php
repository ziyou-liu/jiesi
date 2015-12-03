<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
';
include("../include/conn_1.php");include("../include/rank.php");
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"excel_1.xls\"");
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<style type="text/css">
<!--
.STYLE1 {font-size: 12px}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="1">
  <tr>
  <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">期数</span></div></td>
            <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">户主</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">帐号</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">开户银行</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">开户行地址</span></div></td>
           ';foreach($salaryprice as $key=>$value){;echo '			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $key;echo '</span></div></td>
			';};echo '			';foreach($salaryfee as $key=>$value){;echo '			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $key;echo '</span></div></td>
			';};echo '            <td width="8%" height="22" align="center" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">实得奖金</div></td>
  </tr>
  ';
$sql="select * from {$db_prefix}jsrec where 1 and periods='".$periods."' and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice)>0 order by id asc";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$total_p=0;
$user_sql="select realname,zhanghao,bankaddress,huzhu,bank from {$db_prefix}users where username='".$rs["username"]."' ";
$temp_res=$db->get_one($user_sql);
$temprank=$rs["rank"];
$userrank=$rankary[$temprank];
foreach($salaryprice as $key=>$value){
$total_p+=$rs[$value];
}
foreach($salaryfee as $key=>$value){
$total_p-=$rs[$value];
}
$total=$total_p;
;echo '  <tr>
    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["periods"];echo '</div>
	</div></td>
	<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
	  <div align="center">';echo $rs["username"];echo '</div>
	</div></td>
	<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
	  <div align="center">';echo $temp_res["huzhu"];echo '</div>
	</div></td>
	 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
	  <div align="center" style="vnd.ms-excel.numberformat:@;">';echo $temp_res["zhanghao"];echo '</div>
	</div></td>
	 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
	  <div align="center">';echo $temp_res["bank"];echo '</div>
	</div></td>
	 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
	  <div align="center">';echo $temp_res["bankaddress"];echo '</div>
	</div></td>
	';foreach($salaryprice as $key=>$value){;echo '	<td width="6%" height="22" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs[$value];echo '</div></td>
	';};echo '	';foreach($salaryfee as $key=>$value){;echo '	<td width="6%" height="22" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs[$value];echo '</div></td>
	';};echo '	<td height="20" align="center" bgcolor="#FFFFFF"><div align="center">
	  <div align="center">';echo $total;;echo '</div>
	</div></td>
  </tr>
  ';}
$db->free_result($result);
;echo '</table>
</body>
</html>';
?>