<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");
include("../include/area.php");
if(!empty($edit)){
$modtime=time();
$sql="select * from {$db_prefix}users where id='$id' ";
$rr=$db->get_one($sql);
if($newrank==$oldrank){
echo "<script>alert('升级操作有误！');history.back();</script>";exit();
}
$sqlhy="update {$db_prefix}users set storerank='".$newrank."' where username='".$rr['username']."'";
$db->query($sqlhy);
$sql="insert into {$db_prefix}editrankrecord2 (username,oldrank,rank,edittime,operator,type,applytime,state) values ('".$rr["username"]."','$oldrank','$newrank','$modtime','".$_SESSION["glo_adminname"]."','1','$modtime','1')";
$db->query($sql);
header("location:editrecord2.php");exit();
}
$sql="select * from {$db_prefix}users where id='$id' ";
$rs=$db->get_one($sql);
;echo '<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="editrank2.php">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="oldrank" value="';echo $rs["storerank"];;echo '">
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="650" colSpan=4  background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>开店级别修改</strong></TD>
<TD>&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="35%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="65%" height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["username"];;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rankary[$rs["rank"]];;echo '</TD>
	  </TR>
    <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >开店级别:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  ';
if ($rs['storerank']) echo $dprankary[$rs['storerank']];else echo "无";
;echo '	  </TD>
    </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >选择级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="newrank" id="newrank">
		';
foreach($dprankary as $key_1=>$value_1){
echo "<option value='{$key_1}' >{$value_1}</option>";
}
;echo '	    </select>  	    </TD>
	  </TR>
	
	<TR>
	  <TD colspan="2" align="center" valign="middle"  background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="edit" >	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>