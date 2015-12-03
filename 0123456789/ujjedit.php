<?php
echo '<HTML><head><script language="javascript" type="text/javascript" src="js/resize.js"></script><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");
include("../include/logcls.php");
include("../include/rank.php");
include("../include/setting.php");
$sql="select * from {$db_prefix}jsrec3 where 1 and id='".$id."'";
$rs=$db->get_one($sql);
$sqlp="select state from {$db_prefix}periods3 where periods='$periods'";
$rsp=$db->get_one($sqlp);
if($rsp['state']==2) die("奖金已经发放，不能修改");
if ($action=='jjedit'){
$sql="update {$db_prefix}jsrec3 set fenhong1='$fenhong1',fax='$fax' where id='$id'";
$db->query($sql);
echo "<script>alert('奖金已修改成功！');location.href='u2.php?periods=".$rs['periods']."&pageno=$pageno';</script>";exit();
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
      <TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><p >分红：</p>	    </TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><label>
	    <input name="fenhong1" type="text" id="fenhong1" value="';echo $rs['fenhong1'];echo '">
	  </label></TD>
	  </tr>
      <!--<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >重复消费：</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><label>
	    <input name="cfxf" type="text" id="cfxf" value="';echo $rs['cfxf'];echo '">
	  </label></TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >税：</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><label>
	    <input name="fax" type="text" id="fax" value="';echo $rs['fax'];echo '">
	  </label></TD>
	  </TR>-->
  
  
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
</body></html>';
?>