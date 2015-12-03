<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
$u_sql="select isdp,rank from {$db_prefix}users where id='".$_SESSION["glo_userid"]."'";
$u_res=$db->get_one($u_sql);
$zktemp="glo_zhekou_".$u_res['rank'];
$zhekou=$$zktemp;
if ($action=="order"){
include("../include/goodcartcls.php");
$sql1="select * from {$db_prefix}product where id='".$id."'";
$rs1=$db->get_one($sql1);
if($num>$rs1['num']){
echo "<script>alert('此商品仅有库存".$rs1['num']."');history.back();</script>";exit();
}
setgoodscart($rs1["id"],$rs1["productname"],$num,$rs1["price"],$rs1["pv"],$shopname,$rs1['type']);
echo "<script>alert('订购成功');location.href='mygoodscart.php?ordertype={$ordertype}';</script>";exit();
}
$sql="select * from {$db_prefix}product where id='".$id."'";
$rs=$db->get_one($sql);
;echo '
<script language="javascript">
function buypro(){
	var type=';echo $rs['type'];echo ';
	var price=';echo $rs["price"];;echo ';
	var num=document.getElementsByName(\'num\')[0].value;
	if(type==0){
		var zhekou=';echo $zhekou;;echo ';
	}else{
		var zhekou=10;
	}
	var zprice=price*num*zhekou/10;
	if(zprice>0){
		document.getElementById(\'zprice\').innerHTML=zprice;
	}
}
</script>
</HEAD><body>
<form name="form1" method="post" action="?action=order">
<input type="hidden" value="';echo $ordertype;;echo '" name="ordertype">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/tab_05.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>商品定购</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >商品编号:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["id"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >商品名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["productname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >单价:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["price"];echo '元</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >折扣:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($rs['type']==0) echo $zhekou;else echo "10";;echo '折</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >库存:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["num"];echo '</TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" ><input name="id" type="hidden" id="id" value="';echo $id;echo '">
	    订购数:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="num" type="text" id="num" value="1" size="10" onkeyup="buypro()" onkeydown="buypro()">
	    </TD>
	</TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >总支付:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><span id="zprice">';if($rs['type']==0) echo ($rs["price"]*$zhekou/10);else echo $rs["price"];;echo '</span>元</TD>
	</TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="定购" name="but">
      </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>