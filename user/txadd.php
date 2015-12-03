<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/rank.php");include("../include/logcls.php");
include("../include/ecls.php");
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
if ($action=="price"){
$hint="";$modtime=time();
$sql_tx="select id from {$db_prefix}cashes where username='".$_SESSION["glo_username"]."' and state=0";
$rs_tx=$db->get_one($sql_tx);
if($rs_tx['id']){
echo "<script>alert('您已经有未审核的提现记录，请不要重复提交');history.back();</script>";exit();
}
if (empty($bank)) $hint.="请输入银行\\n";
if (empty($zhanghao)) $hint.="请输入账号\\n";
if (empty($huzhu)) $hint.="请输入户主\\n";
if (floatval($price)<=0) $hint.="提现金额不能输入错误";
if ($hint!=''){echo "<script>alert('".$hint."');history.back();</script>";exit();}
if (floatval($price)<$glo_withdraw_low) $hint.="提现金额最少{$glo_withdraw_low}元\\n";
if(ceil($price/100)!=($price/100)) $hint.="提现金额必须是100元的整数倍";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$total=$price;
$sql1="select j_price from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs1=$db->get_one($sql1);
$price1=empty($rs1["j_price"])?0:$rs1["j_price"];
$hint.="您的电子货币余额不足！";
if ($total>$price1){echo "<script>alert('".$hint."');history.back();</script>";exit();}
$sql="insert into {$db_prefix}cashes(username,realname,bank,zhanghao,huzhu,price,addtime,state) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".trim($bank)."','".trim($zhanghao)."','".trim($huzhu)."','".floatval($price)."','".time()."','0')";
$db->query($sql);
$log_adminid=$_SESSION["glo_userid"];$log_admin=$_SESSION["glo_username"];$log_type=100;$log_addtime=time();$log_ip=getip();
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo "<script>alert('提现申请已提交，请等待审核');location.href='moneytx.php';</script>";
}
;echo '</HEAD>
<script>
function frmchk(frm){
	if (frm.bank.value=="")
	{
		alert("请输入汇入银行");
		frm.bank.focus();
		return false;
	}
	if (frm.zhanghao.value=="")
	{
		alert("请输入账号");
		frm.tjrname.focus();
		return false;
	}
	if (frm.price.value=="")
	{
		alert("请输入金额");
		frm.price.focus();
		return false;
	}
	var temp=';echo $glo_withdraw_low;;echo ';
	if (frm.price.value<temp){
		alert("金额不能小于"+temp);
		frm.price.focus();
		return false;
	}
	/*var total=';echo $rs["price"];;echo ';
	alert(total);
	var per=';echo $glo_withdraw_fee;;echo ';
	float now=parseFloat(frm.price.value)+parseFloat(frm.price.value)*parseFloat(per);
	alert(now+parseFloat(total));
	if (now>parseFloat(total)){

		alert("电子货币钱包余额不足！");
		frm.price.focus();
		return false;
	}*/
}

</script>
<body>
<form name="form1" method="post" action="?action=price" onSubmit="return frmchk(this);">
<br>
<TABLE width="550" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="550" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>提现添加</strong>(提现收取手续费：&nbsp;&nbsp;';echo $glo_withdraw_fee;echo "%";;echo ')</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
  <TR>
	  <TD width="30%" align="right" vAlign=middle  bgColor="#FBFDFF">提现须知:</TD>
	  <TD width="70%" height="20" align="left" vAlign=middle  bgColor="#FBFDFF">请仔细核对下表所列的账户资料是否存在误填，漏填现象，<br>
如有请到资料修改栏中修改并完善。<input  onclick="location.href=\'zledit.php\';" class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" value="资料修改" style="width:80px;"></TD>
	</TR>
      <TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >您的电子货币余额为:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["j_price"];;echo '</TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >汇入银行:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="bank" type="text" id="bank" size="35" value="';echo $rs["bank"];echo '" readonly=true style="background-color:#DEB887;"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >账号:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="zhanghao" type="text" id="zhanghao" size="35" value="';echo $rs["zhanghao"];echo '" readonly=true style="background-color:#DEB887;"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >户主:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="huzhu" type="text" id="huzhu" value="';echo $rs["huzhu"];echo '" readonly=true style="background-color:#DEB887;"></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >金额:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="price" type="text" id="price"> 提现金额为100元的整数倍</TD>
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
</body></html>';
?>