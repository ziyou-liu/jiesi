<?php

include("../include/conn_2.php");include("../include/function.php");include("../include/ecls.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist3.css" type="text/css">
<script language="javascript" type="text/javascript" src="../jQuery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../jQuery/jquery.alerts.js"></script>
<link rel="stylesheet" href="../jQuery/jquery.alerts.css" type="text/css">
';
$modtime=time();
if ($action=="transfer"){
$sql="select * from {$db_prefix}users where price3>='$glo_tzfhprice' and state=1 and username='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
if ($rs['price3']<$glo_tzfhprice){
echo "<script>$(document).ready( function() {jAlert('您的回购钱包金额不足', '系统提示','transfer1.php');});</script>";exit();
}
$hgnum=floor($rs['price3']/$glo_tzfhprice);
$hgp_sy=$rs['price3']%$glo_tzfhprice;
$hg_bv=$hgnum*$glo_tzfhprice1;
$sqldo="update {$db_prefix}users set price3='$hgp_sy',bv=bv+'$hg_bv',hgnum=hgnum+'$hgnum' where username='".$_SESSION["glo_username"]."'";
$db->query($sqldo);
$curyear=date("Y",$modtime);$curmonth=date("m",$modtime);
$sqlhg="select id from {$db_prefix}huigou where username='".$_SESSION["glo_username"]."' and year='$curyear' and month='$curmonth'";
$rshg=$db->get_one($sqlhg);
if($rshg['id']){
$sqlgx="update {$db_prefix}huigou set hgnum=hgnum+'$hgnum' where username='".$_SESSION["glo_username"]."' and year='$curyear' and month='$curmonth'";
$db->query($sqlgx);
}else{
$sqlgx="insert into {$db_prefix}huigou(username,year,month,hgnum) values('".$_SESSION["glo_username"]."','$curyear','$curmonth','$hgnum')";
$db->query($sqlgx);
}
$memo=100;$type=2;$optime=time();$money=floatval($hg_bv);$memo1="";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,'',4);
$memo=101;$type=2;$optime=time();$money=floatval($hg_bv);$memo1="";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,'',4);
$memo=100;$type=1;$optime=time();$money=floatval($hg_bv);$memo1="";
eclsproc($_SESSION["glo_username"],$memo,$money,$type,$optime,$memo1,'',3);
echo "<script>$(document).ready( function() {jAlert('转帐成功', '系统提示','transfer1.php');});</script>";exit();
}
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs22=$db->get_one($sql);
;echo '<script>function resize(){ parent.document.getElementById(\'I2\').style.height = document.body.scrollHeight>300?document.body.scrollHeight:300+"px";}window.onload=resize;window.onresize = resize;</script><SCRIPT type="text/javascript" language="javascript" src="../include/transfer.js"></SCRIPT>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head><body>
<div id="toubu"><span class="tbbiaoti"><strong>回购转申购</strong></span></div>
<form name="form1" method="post" action="?action=transfer">
<br>
<TABLE width="450" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt1>

<TR>
  <TD ><table width="100%" border="0" cellpadding="2" cellspacing="0">
	 <TR>
	   <TD width="100%" align="center" vAlign=middle  ><p class="STYLE1">您的回购钱包有';echo $rs22["price3"];;echo '元 可以支出<Br>
	     您需要确认支出吗？</p></TD>
	   </TR>
	<TR>
	  <TD align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>

</form>
</body></html>'
?>