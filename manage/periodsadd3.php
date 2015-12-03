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
$sql="select * from {$db_prefix}periods3 where year='$year' and month='$month' ";
$result=$db->get_one($sql);
if(!empty($result)){
$hint="请勿重复添加结算！";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$periods=getperiods4()+1;
$begindate=$year."-".$month."-01";
$begintime=strtotime(trim($begindate));
$day=date("t",$begintime);
$enddate=$year."-".$month."-".$day;
$endtime=strtotime(trim($enddate));
$sql="insert into {$db_prefix}periods3(periods,begintime,endtime,year,month,state,jsname,state1) values('".$periods."','".$begintime."','".$endtime."','".trim($year)."','".trim($month)."','0','','0')";
$db->query($sql);
header("location:salarys3.php");exit();
}
;echo '
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>

<form name="form1" method="post" action="periodsadd3.php?action=addperiods">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>添加分红结算</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	 <TR>
	  <TD width="45%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >期数:</TD>
	  <TD width="55%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo getperiods4()+1;;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >月份:</TD>	  
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  ';
$last=getperiods4();if(!empty($last)){$sql="select * from {$db_prefix}periods3 where periods='$last' ";$nrs=$db->get_one($sql);}
if(!empty($last)){
if($nrs['month']=='12'){
$year=($nrs['year']+1);
$month="01";
}else{
$year=$nrs['year'];
$month=($nrs['month']+1);
}
}else{
$year=date('Y');
$month=date('m');
}
echo $year."年".$month."月";;echo '	  <input type="hidden" name="year" value="';echo $year;;echo '" />
	  <input type="hidden" name="month" value="';echo $month;;echo '" />
		</TD></TR>
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