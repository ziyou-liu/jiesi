<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

';
include("../include/conn_2.php");include("../include/function.php");include("../include/ecls.php");
if ($action=="transfer"){
$hint="";
if (floatval($price)<=0) $hint.="请输入金额\\n";
if(ceil($price/100)!=($price/100))$hint.="转账金额必须是100元的整数倍\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if ($rs_chk1["cash"]<floatval($price)) {echo "<script>alert('您没有足够的现金金额！');history.back();</script>";exit();}
$sql_1="update {$db_prefix}users set cash=cash-".floatval($price)." where username='".$_SESSION["glo_username"]."' and state=1";
$db->query($sql_1);
$sql_2="update {$db_prefix}users set price=price+".floatval($price)." where username='".$_SESSION["glo_username"]."' and state=1";
$db->query($sql_2);
$memo=19;$type=2;$optime=time();$money=floatval($price);$memo1="转入电子钱包";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,2);
$memo=19;$type=1;$optime=time();$money=floatval($price);$memo1="现金钱包转入";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1);
echo "<script>alert('转账成功!');location.href='cash_government.php';</script>";exit();
}
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="cashzz.php?action=transfer">
<br>
<TABLE width="450" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="450" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>现金转入电子钱包</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >您目前的现金余额为:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs22["cash"];;echo '</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >转出金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price" type="text" id="price" value="';echo $price;;echo '">
	    元</TD>
	  </TR>
      <TR>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" style="color:red;" colspan="2">说明:转账金额必须是100元的整数倍</TD>
	  </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
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