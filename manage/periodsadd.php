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
$periods=getperiods()+1;
$begintime=strtotime(trim($begindate));$endtime=strtotime(trim($enddate));
if($endtime<$begintime) $hint.="结束日期不能小于开始日期";
$sql="select * from {$db_prefix}periods where begintime='$begintime' and endtime='$endtime' ";
$rs=$db->get_one($sql);
if(!empty($rs)) $hint="请勿重复添加结算!";
$sql="select * from {$db_prefix}periods where ('$begintime'>=begintime and '$begintime'<=endtime) or ('$endtime'>=begintime and '$endtime'<=endtime)";
$rs=$db->get_one($sql);
if(!empty($rs)) $hint="结算日期重复！请重新添加。";
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql="insert into {$db_prefix}periods(periods,begintime,endtime,state,jsname,state1) values('".$periods."','".$begintime."','".$endtime."','0','','0')";
$db->query($sql);
header("location:salarys.php");exit();
}
$periods1=getperiods()+1;
if($periods1==1){
$sqlf="select id,confirmtime from {$db_prefix}users where state=1 order by id asc limit 1";
$rsf=$db->get_one($sqlf);
if(empty($rsf['id'])) die("系统暂未运行");
else $time=strtotime(date("Y-m-d",$rsf['confirmtime']));
}else{
$sqlp="select endtime from {$db_prefix}periods where 1 order by id desc limit 1 ";
$rsp=$db->get_one($sqlp);
$time=$rsp['endtime']+24*3600;
}
;echo '
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>

<form name="form1" method="post" action="?action=addperiods">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD height=23>&nbsp;<strong>添加结算</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="28%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >期数:</TD>
	  <TD width="72%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo getperiods()+1;;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开始日期:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="begindate" type="text" id="begindate" value="';echo date('Y-m-d',$time);;echo '" readonly=\'readonly\' style="background-color:#DEB887"> 系统默认</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >结束日期:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="enddate" type="text" id="enddate" onClick="new WdatePicker()"></TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" ><span class="hint">说明:</span></TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >1.结算当天的，开始和结束日期请选择相同的日期<br>2.结算日期不能重复添加</TD>
	  </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but"></TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>