<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/secpwd.php");include("../include/rank.php");
die("<center>文件无效</center>");
if ($action=="upgrade"){
$sql="select (pv2+pv3) as mpv,rank from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
$oldrank=$rs["rank"];$curmpv=$rs["mpv"];
if ($rank<=$oldrank) die("<center>级别选择错误</center>");
$isdp=0;
switch($rank){
case 1:$pv_limit1=$glo_price_r1_1;$pv_limit2=$glo_price_r1_2;break;
case 2:$pv_limit1=$glo_price_r2_1;$pv_limit2=$glo_price_r2_2;break;
case 3:$pv_limit1=$glo_price_r3_1;$pv_limit2=$glo_price_r3_2;break;
case 4:$pv_limit1=$glo_price_r4_1;$pv_limit2=$glo_price_r4_2;break;
case 5:$pv_limit1=$glo_price_r5_1;$pv_limit2=$glo_price_r5_2;break;
case 6:$pv_limit1=$glo_price_r6_1;$pv_limit2=$glo_price_r6_2;break;
case 7:$pv_limit1=$glo_price_r7_1;$pv_limit2=$glo_price_r7_2;$isdp=1;break;
case 8:$pv_limit1=$glo_price_r8_1;$pv_limit2=$glo_price_r8_2;$isdp=1;break;
case 9:$pv_limit1=$glo_price_r9_1;$pv_limit2=$glo_price_r9_2;$isdp=1;break;
case 10:$pv_limit1=$glo_price_r10_1;$pv_limit2=$glo_price_r10_2;$isdp=1;break;
case 11:$pv_limit1=$glo_price_r11_1;$pv_limit2=$glo_price_r11_2;$isdp=1;break;
case 12:$pv_limit1=$glo_price_r12_1;$pv_limit2=$glo_price_r12_2;$isdp=1;break;
}
if ($curmpv<$pv_limit1) die("<center>当前累积积分不足</center>");
$sql2="update {$db_prefix}users set rank='".$rank."',isdp='".$isdp."' where username='".$_SESSION["glo_username"]."'";
$db->query($sql2);
$sql="insert into {$db_prefix}upgrade(username,ranktime,oldrank,newrank,curpv) values('".$_SESSION["glo_username"]."','".time()."','".$oldrank."','".$rank."','".$curmpv."')";
$db->query($sql);
echo "<script>alert('升级成功');location.href='upgrades.php';</script>";exit();
}
$sql="select (pv2+pv3) as mpv,rank from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=upgrade">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>我要升级</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >当前累计消费:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["mpv"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >现在级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getuserrank($rs["rank"]);echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="rank" id="rank">
	  ';
foreach($rank4ary as $key=>$value){
echo "<option value='{$key}'>{$value}</option>";
}
;echo '	    </select></TD>
	  </TR>
	<TR>
	  <TD height="38" colspan="2" align="center" valign="middle">

	    <INPUT class=button_text onmousedown="this.className=\'button_onmousedown\'" onmouseover="this.className=\'button_onmouseover\'" onmouseout="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>