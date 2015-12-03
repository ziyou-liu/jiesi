<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");include("../include/ecls.php");include("../include/rank.php");
if ($action=="transfer"){
$hint="";
if($zztype==1){
$pricename="price";
}else{
$pricename="price_repeat";
}
if (trim($tousername)=="") $hint.="请输入转入人\\n";
if (floatval($price)<=0) $hint.="请输入金额\\n";
if(ceil($price/100)!=($price/100) &&$zztype==1)$hint.="转账金额必须是100元的整数倍\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk="select * from {$db_prefix}users where username='".trim($tousername)."' and state=1 and isdp=1";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])) die("转入报单中心验证失败");
$torealname=$rs_chk["realname"];
if (strtolower($rs_chk["username"])==strtolower($_SESSION["glo_username"])) die("不能转入给自己!");
$sql_chk1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
$pricereal=$price;
if ($rs_chk1[$pricename]<floatval($pricereal)) die("您没有足够的金额!");
$transfer_rate=$glo_transfer_rate/100;
if($zztype==1){
$shouxu=$pricereal*$transfer_rate;
}else{
$shouxu=0;
}
$realmoney=$pricereal-$shouxu;
$sql_1="update {$db_prefix}users set ".$pricename."=".$pricename."-".floatval($pricereal)." where username='".$_SESSION["glo_username"]."' and state=1";
$db->query($sql_1);
$sql_2="update {$db_prefix}users set ".$pricename."=".$pricename."+".floatval($realmoney)." where username='".trim($tousername)."' and state=1";
$db->query($sql_2);
$sql_3="insert into {$db_prefix}tranfer(username,realname,tousername,torealname,price,fee,addtime,state,type) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".trim($tousername)."','".$torealname."','".floatval($price)."','".$shouxu."','".time()."','1',".$zztype.")";
$db->query($sql_3);
$ssss='';
if($zztype==1){
$ssss="，手续费{$shouxu}";
}
$memo=2;$type=2;$optime=time();$money=floatval($price);$memo1="{$priceary[$zztype]}转给{$tousername}".$ssss;
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,$zztype);
$memo=10;$type=1;$optime=time();$money=floatval($price);$memo1=$_SESSION["glo_username"]."转入{$priceary[$zztype]}".$ssss;
eclsproc(trim($tousername),$memo,$money,$type,$optime,$memo1,$zztype);
echo "<script>alert('转账成功!');location.href='moneyzz.php';</script>";exit();
}
if($zztype==1){
$pricename="price";
}else{
$pricename="price_repeat";
}
$hint="";
if (trim($tousername)=="") $hint.="请输入转入人\\n";
if (floatval($price)<=0) $hint.="请输入金额\\n";
if(ceil($price/100)!=($price/100))$hint.="转账金额必须是100元的整数倍\\n";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_chk="select * from {$db_prefix}users where username='".trim($tousername)."' and state=1 and isdp=1";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])) $hint.="转入报单中心验证失败";
$torealname=$rs_chk["realname"];
if (strtolower($rs_chk["username"])==strtolower($_SESSION["glo_username"])) $hint.="不能转入给自己!";
$sql_chk1="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' and state=1";
$rs_chk1=$db->get_one($sql_chk1);
if ($rs_chk1[$pricename]<floatval($price))$hint.="您没有足够的金额!";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="zzadd2.php?action=transfer">
<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/bg.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>电子货币转账---确认</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="42%" align="right" vAlign=middle bgColor="#FBFDFF" >您目前的现金钱包为:</TD>
	  <TD width="58%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs22["price"];;echo '</TD>
	</TR>
	<TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >您目前的重消账户为:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs22["price_repeat"];;echo '</TD>
	</TR>
	<TR>
	  <TD width="39%" align="right" vAlign=middle bgColor="#FBFDFF" >转账类型:</TD>
	  <TD width="61%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
		';if($zztype==1) echo "现金转出";else echo "重消转出";;echo '		<input name="zztype" value="';echo $zztype;echo '" type="hidden"/>
		</TD>
	</TR>
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF">您要转入的会员编号为:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $tousername;;echo '<input name="tousername" type="hidden" id="tousername" value="';echo $tousername;;echo '"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >转出金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $price;;echo '	      <input name="price" type="hidden" id="price" value="';echo $price;;echo '">
	    元</TD>
	  </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="上一步" name="but" onClick="javascript:location.href=\'zzadd.php?';reset($_POST);if (count($_POST)) {while (list($key,$val) = each($_POST)) {echo $key."=".urlencode($_POST[$key])."&";}};echo 'kk=kk\'">&nbsp;&nbsp;&nbsp;
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="下一步" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>