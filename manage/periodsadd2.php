<?php
echo '<HTML><HEAD><title></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE3 {font-size: 12px; font-weight: bold; }
.STYLE4 {
	color: #03515d;
	font-size: 12px;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");
include("../include/periodscls.php");include("../include/datecls.php");
if ($action=="addperiods"){
$sql="select * from {$db_prefix}periods2 where year='$year' and month='$month' ";
$result=$db->get_one($sql);
if(!empty($result)){
$hint="请勿重复添加结算！";
}
if(strlen($month)!=2) $hint="请输入正确的时间格式";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$periods=getperiods2()+1;
$begindate=$year."-".$month."-01";
$begintime=strtotime(trim($begindate));
$day=date("t",$begintime);
$enddate=$year."-".$month."-".$day;
$endtime=strtotime(trim($enddate));
$sql="insert into {$db_prefix}periods2(periods,begintime,endtime,year,month,state,jsname,state1) values('".$periods."','".$begintime."','".$endtime."','".trim($year)."','".trim($month)."','0','','0')";
$db->query($sql);
header("location:salarys2.php");exit();
}
;echo '
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>

<form name="form1" method="post" action="periodsadd2.php?action=addperiods">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>添加月结算</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="45%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >期数:</TD>
	  <TD width="55%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo getperiods2()+1;;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >月份:</TD>
	  ';$last=getperiods2();if(!empty($last)){$sql="select * from {$db_prefix}periods2 where periods='$last' ";$nrs=$db->get_one($sql);};echo '	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <input name="year" type="text" id="year" size="6">
	    年
	    <input name="month" type="text" id="month" size="3">
	    月
	  <!--
	  <input name="year" type="text" id="year" size="8" value="';echo date("Y");;echo '">
	    年
	    <input name="month" type="text" id="month" size="8" value="';echo date("m");;echo '">
	    月
		-->
        <br>';echo "格式：".date("Y年m月");;echo '		</TD></TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but"></TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>'
?>