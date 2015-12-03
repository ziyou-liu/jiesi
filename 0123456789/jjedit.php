<?php
echo '<HTML><head><script language="javascript" type="text/javascript" src="js/resize.js"></script><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");
include("../include/function.php");
$sql="select * from {$db_prefix}jsrec where 1 and id='".$id."'";
$rs=$db->get_one($sql);
$periods=$rs['periods'];
$sqlp="select * from {$db_prefix}periods where periods='$periods'";
$rsp=$db->get_one($sqlp);
if($rsp['state']==2) die('已发放奖金禁止修改');
if ($action=='jjedit'){
$jjprice=0;
foreach($salaryprice as $k=>$v){
$jjprice+=$$v;
}
foreach($salaryfee as $k=>$v){
$jjprice-=$$v;
}
if($jjprice<0){
echo "<script>alert('支出不能大于收入！');location.href='2.php?periods=".$rs['periods']."&pageno=$pageno';</script>";exit();
}
$sql="update {$db_prefix}jsrec set fee=0 ";
foreach($salaryprice as $k=>$v){
$sql.=", ".$v."='".$$v."' ";
}
foreach($salaryfee as $k=>$v){
$sql.=", ".$v."='".$$v."' ";
}
$sql.=" where id='".$id."'";
$db->query($sql);
echo "<script>alert('奖金已修改成功！');location.href='2.php?periods=".$rs['periods']."&pageno=$pageno';</script>";exit();
}
;echo '
<style type="text/css">
<!--
.style1 {color: #FF0000}
.STYLE2 {font-size: 12px}
-->
</style>
<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
</HEAD>
<body>
<form name="form1" method="post" action="?action=jjedit">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>奖金修改</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="40%" align="right" vAlign=middle bgColor="#FBFDFF" >期数：</TD>
  <TD width="60%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs['periods'];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >会员编号：</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs['username'];echo '</TD>
	  </TR>
	';foreach($salaryprice as $k=>$v){;echo '
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><p >';echo $k;echo '：</p>	    </TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><label>
	    <input name="';echo $v;;echo '" type="text" id="';echo $v;;echo '" value="';echo $rs[$v];echo '">
	  </label></TD>
	  </TR>
	';};echo '
	';foreach($salaryfee as $k=>$v){;echo '
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><p >';echo $k;echo '：</p>	    </TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><label>
	    <input name="';echo $v;;echo '" type="text" id="';echo $v;;echo '" value="';echo $rs[$v];echo '">
	  </label></TD>
	  </TR>
	';};echo '
	  <TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <input name="id" type="hidden" id="id" value="';echo $id;echo '">
	    <input name="pageno" type="hidden" id="pageno" value="';echo $pageno;echo '">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="修改" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>