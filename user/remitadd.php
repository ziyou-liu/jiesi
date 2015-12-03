<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");include("../include/logcls.php");
if ($action=="remit"){
$hint="";
if (empty($bankid)) $hint.="请选择汇款银行\\n";
if (empty($hkname)) $hint.="请输入汇款人\\n";
if (floatval($price)<$glo_remits_low) $hint.="汇款金额最低{$glo_remits_low}积分\\n";
if (trim($hktime)=="") $hint.="请输入汇款时间\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$bank="";
$sql_bank="select * from {$db_prefix}bank where id='".$bankid."'";
$rs_bank=$db->get_one($sql_bank);
$bank=$rs_bank["bank"]."<br>".$rs_bank["zhanghao"]."<br>".$rs_bank["huzhu"];
$sql="insert into {$db_prefix}remits(username,realname,bankid,bank,hkname,price,memo,state,hktime,addtime) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".$bankid."','".$bank."','".trim($hkname)."','".floatval($price)."','".$memo."','0','".timestr2unix($hktime)."','".time()."')";
$db->query($sql);
$log_adminid=$_SESSION["glo_userid"];$log_admin=$_SESSION["glo_username"];$log_type=101;$log_addtime=time();$log_ip=getip();
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:myremits.php");exit();
}
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="?action=remit">

<br>
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="650" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>添加汇款通知</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="21%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >选择汇款账号:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <ol>
	  ';
$sql_bank="select * from {$db_prefix}bank where 1 order by id asc";
$result_bank=$db->query($sql_bank);
while ($rs_bank=$db->fetch_array($result_bank)){
;echo '		<li><input name="bankid" type="radio" value="';echo $rs_bank["id"];echo '"> ';echo $rs_bank["bank"]." ";;echo '';echo $rs_bank["zhanghao"]." ";;echo '';echo $rs_bank["huzhu"];echo '</li>
		';
}
$db->free_result($result_bank);
;echo '	  </ol>
	  </TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >汇款人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="hkname" type="text" id="hkname" value="';echo $_SESSION["glo_realname"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price" type="text" id="price">
	  最低';echo $glo_remits_low;;echo '元</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >汇款时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="hktime" type="text" id="hktime" onClick="new WdatePicker()"></TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >备注:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><textarea name="memo" id="memo" cols=40 rows=8></textarea> </TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>