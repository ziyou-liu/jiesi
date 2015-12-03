<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");include("../include/ecls.php");
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="zzadd2.php">
<br>
<TABLE width="450" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="450" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>电子货币转账</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >您目前的现金钱包为:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs22["price"];;echo '</TD>
	</TR>
	<TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >您目前的重消账户为:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs22["price_repeat"];;echo '</TD>
	</TR>
	<TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >转账类型:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
		<select name="zztype">
			<option value="1">现金转出
			<option value="3">重消转出
		</select>
		</TD>
	</TR>
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >转入人会员编号:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="tousername" type="text" id="tousername" value="';echo $tousername;;echo '"> <!--<span class="hint">只限报单中心</span>--></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >转出金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price" type="text" id="price" value="';echo $price;;echo '">元</TD>
	</TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="下一步" name="but"></TD>
	</TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>