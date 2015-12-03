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
$hint="";
if (trim($begindate)=="") $hint.="请选择开始日期\\n";
if (trim($enddate)=="") $hint.="请选择结束日期\\n";
$periods=getperiods1()+1;
$begintime=strtotime(trim($begindate));$endtime=strtotime(trim($enddate));
$c=datediff($begindate,$enddate);
$sql="select * from {$db_prefix}periods1 where begintime='$begintime' and endtime='$endtime' ";
$rs=$db->get_one($sql);
if(!empty($rs)) $hint="请勿重复添加结算!";
$sql="select * from {$db_prefix}periods1 where ('$begintime'>=begintime and '$begintime'<=endtime) or ('$endtime'>=begintime and '$endtime'<=endtime)";
$rs=$db->get_one($sql);
if(!empty($rs)) $hint="结算日期重复！请重新添加。";
if(!empty($year)){
if(strlen($month)!=2) $hint="请输入正确的月格式";
}
if(!empty($month)){
if(strlen($year)!=4) $hint="请输入正确的年格式";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql="insert into {$db_prefix}periods1 (periods,begintime,endtime,year,month,state,jsname,state1) values('".$periods."','".$begintime."','".$endtime."','".trim($year)."','".trim($month)."','0','','0')";
$db->query($sql);
header("location:salarys1.php");exit();
}
;echo '
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>

<form name="form1" method="post" action="?action=addperiods">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>添加分红</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="28%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >期数:</TD>
	  <TD width="72%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo getperiods1()+1;;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开始日期:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="begindate" type="text" id="begindate" onClick="new WdatePicker()"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >结算日期:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="enddate" type="text" id="enddate" onClick="new WdatePicker()"></TD>
	  </TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >包含月份:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="year" type="text" id="year" size="8">
	    年<input name="month" type="text" id="month" size="8">月';echo "(格式：".date("Y年m月").")";;echo '</TD>
	</TR>
	<TR style="display:none">
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >备注:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >若添加了包含月份，则会执行月结项目</TD>
	</TR>
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