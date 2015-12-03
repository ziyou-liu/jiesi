<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/ecls.php");
include("../include/function.php");
include("../include/logcls.php");
if ($action=="delta"){
$hint="";
if (trim($username)=="") $hint.="请输入会员编号\\n";
if (floatval($money)==0) $hint.="请输入充值金额\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql1="select * from {$db_prefix}users where username='".trim($username)."' and state=1";
$rs1=$db->get_one($sql1);
if (empty($rs1["id"])){
die("会员编号不存在或者没有被确认");
}
if($type1==1){
$pricename='price';
}else if($type1==2){
$pricename='price_repeat1';
}else if($type1==3){
$pricename='price_repeat';
}
$realname=$rs1["realname"];
$sql2="update {$db_prefix}users set ".$pricename."=".$pricename."+".floatval($money)." where username='".trim($username)."'";
$db->query($sql2);
$sql3="insert into {$db_prefix}delta(username,realname,money,state,addtime,adminname,type) values('".trim($username)."','".$realname."','".floatval($money)."','1','".time()."','".$_SESSION["glo_adminname"]."','$type1')";
$db->query($sql3);
$memo=1;$optime=time();$type=1;$money=floatval($money);$memo1="后台充{$priceary[$type1]}";
eclsproc(trim($username),$memo,$money,$type,$optime,$memo1,$type1);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=8;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}给会员{$username}充{$priceary[$type]}{$money}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo "<script>alert('已经充值成功');location.href='deltalst.php';</script>";exit();
}
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=delta">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>充值货币</strong>(<span class="hint">负数为扣款</span>)</TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="45%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="55%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >充值金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="money" type="text" id="money" size="10">
	    元</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >货币类型:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<select name="type1">
			<option value=\'1\'>现金钱包
			<option value=\'2\'>报单购物账户
			<option value=\'3\'>重消购物账户
		</select>
	   </TD>
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
</body></html>';
?>