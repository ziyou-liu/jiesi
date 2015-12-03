<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/rank.php");include("../include/logcls.php");
include("../include/ecls.php");include("../include/secpwd.php");
if ($action=="transfer"){
$hint="";
if (floatval($price)<=0) $hint.="请输入金额\\n";
if ($hint!=""){
echo "<script>$(document).ready( function() {jAlert('".$hint."', '系统提示','transfer.php');});</script>";exit();
}
$sql_chk1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if($pricetype==1){
$money=$rs_chk1["j_price"];
$pricename="j_price";
$toname="price";
$types1=4;$types2=1;
}else if($pricetype==2){
$money=$rs_chk1["j_price"];
$pricename="j_price";
$toname="price_repeat";
$types1=4;$types2=3;
}else if($pricetype==3){
$money=$rs_chk1["price"];
$pricename="price";
$toname="price_repeat";
$types1=1;$types2=3;
}else{
$money=$rs_chk1["price_repeat"];
$pricename="price_repeat";
$toname="price";
$types1=3;$types2=1;
}
if ($money<floatval($price)){
echo "<script>alert('您没有足够的金额');history.back();</script>";exit();
}
$sql_1="update {$db_prefix}users set ".$pricename."=".$pricename."-".floatval($price).",".$toname."=".$toname."+".floatval($price)." where username='".$_SESSION["glo_username"]."' and state=1";
$db->query($sql_1);
$memo=19;$type=1;$optime=time();$money=floatval($price);$memo1="由".$priceary[$types1]."转入";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,$types2,'');
$memo=19;$type=2;$optime=time();$money=floatval($price);$memo1="转入".$priceary[$types2];
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,$types1,'');
echo "<script>alert('转帐成功');location.href='e_government.php?type=".$types2."'</script>";exit();
}
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '<script language="javascript">
function checktype(){
	var t1=document.getElementById(\'pricetype\').length;
	for(var i=0;i<t1;i++){
		var checked=document.getElementById(\'pricetype\').options[i].selected;
		if(checked){
			var type=document.getElementById(\'pricetype\').options[i].value;
			if(type<=2){
				var huobi="';echo $rs22['j_price'];;echo '元";
			}else if(type==3){
				var huobi="';echo $rs22['price'];;echo '元";
			}else if(type==4){
				var huobi="';echo $rs22['price_repeat'];;echo '元";
			}
			if(huobi){
				document.getElementById(\'price\').innerHTML=huobi;
			}
		}
	}
}
</script>
</HEAD>
<body>
<form name="form1" method="post" action="?action=transfer">
<br>
<TABLE width="550" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="550" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>内部转账</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
		<TD align="right" vAlign=middle bgColor="#FBFDFF" >您目前的电子币为:</TD>
		<TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" id="price">';echo $rs22["j_price"];;echo '元</TD>
	</TR>
	<TR>
		<TD align="right" vAlign=middle bgColor="#FBFDFF" >转账方式:</TD>
		<TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
		<select name="pricetype" id="pricetype" onchange="checktype()">
			<option value="1">奖金币转电子币</option>
			<option value="2">奖金币转购物账户</option>
			<option value="3">电子币转购物账户</option>
			<option value="4">购物账户转电子币</option>
		</select></TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >转出金额:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="price" type="text" id="price" value="';echo $price;;echo '" >
	    元</TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
</form>
</body></html>';
?>