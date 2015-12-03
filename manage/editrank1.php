<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/function.php");
include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/rank.php");include("../include/sys.php");
include("../include/pv.php");
include("../include/logcls.php");
include("../include/net.php");include("../include/area.php");
if(!empty($edit)){
$modtime=time();
$sql="select * from {$db_prefix}users where id='$id' ";
$rr=$db->get_one($sql);
if($newrank==$oldrank){
echo "<script>alert('升级操作有误！');history.back();</script>";exit();
}
if($newrank==3){
$sqlds="select * from {$db_prefix}users where store_city='".$city."' and isdp=1 and rank1=3 and username!='".$rr['username']."'";
$rsds=$db->get_one($sqlds);
if($rsds['id']) $hint.="您所选择的市已经存在市代理\\n";
}
if ($hint!=''){
echo "<script>alert('{$hint}');history.back();</script>";exit();
}
if($rr['isdp']) {
$sqlhy="update {$db_prefix}users set rank1='".$newrank."' where username='".$rr['username']."'";
}else{
$sqlhy="update {$db_prefix}users set rank1='".$newrank."',isdp=1 where username='".$rr['username']."'";
}
$db->query($sqlhy);
$sql="insert into {$db_prefix}applystore (username,oldrank,applyrank,edittime,operator,type,applytime) values ('".$rr["username"]."','".$oldrank."','".$newrank."','$modtime','".$_SESSION["glo_adminname"]."','1','$modtime')";
$db->query($sql);
$sqldl="update {$db_prefix}users set store_province='".$province."',store_city='".$city."',store_area='".$area."' where username='".$rr['username']."'";
$db->query($sqldl);
$username=$rr["username"];
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=12;$log_addtime=time();$log_ip=getip();$log_memo="{$log_admin}修改{$username}级别";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:editrecord1.php");exit();
}
$sql="select * from {$db_prefix}users where id='$id' ";
$rs=$db->get_one($sql);
;echo '<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="editrank1.php">
<input type="hidden" name="id" value="';echo $id;;echo '">
<input type="hidden" name="oldrank" value="';echo $rs["rank1"];;echo '">
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="650" colSpan=4  background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>店铺级别修改</strong></TD>
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
      <TD align="right" valign="middle" bgColor="#FBFDFF" >店铺级别:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  ';
if ($rs['isdp']) echo $rankary1[$rs['rank1']];else echo "不是店铺";
;echo '	  </TD>
    </TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >选择级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
	  <select name="newrank" id="newrank">
		';
foreach($rankary1 as $key_1=>$value_1){
echo "<option value='{$key_1}' >{$value_1}</option>";
}
;echo '	    </select>  	    </TD>
	  </TR>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >省份、城市、地区:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
      
	  <select name="province" id="province" onChange="_province(this.value,\'city\',\'area\')">
	  <option value="">请选择</option>
	   ';
$sql_pro="select * from {$db_prefix}province where 1 order by id asc";
$result_pro=$db->query($sql_pro);
while ($rs_pro=$db->fetch_array($result_pro)){
echo "<option value='".$rs_pro["provinceID"]."'";
if ($rs["province"]==$rs_pro["provinceID"]) echo " selected";
echo ">".$rs_pro["province"]."</option>";
}
$db->free_result($result_pro);
;echo '	    </select>
	    <select name="city" id="city" onChange="_city(this.value,\'area\')">
		';
$sql_city="select * from {$db_prefix}city where 1 and father='".$rs["province"]."' order by id asc";
$result_city=$db->query($sql_city);
while ($rs_city=$db->fetch_array($result_city)){
echo "<option value='".$rs_city["cityID"]."'";
if ($rs["city"]==$rs_city["cityID"]) echo " selected";
echo ">".$rs_city["city"]."</option>";
}
$db->free_result($result_city);
;echo '	      </select>
	  <select name="area" id="area">
	  ';
$sql_area="select * from {$db_prefix}area where 1 and father='".$rs["city"]."' order by id asc";
$result_area=$db->query($sql_area);
while ($rs_area=$db->fetch_array($result_area)){
echo "<option value='".$rs_area["areaID"]."'";
if ($rs["area"]==$rs_area["areaID"]) echo " selected";
echo ">".$rs_area["area"]."</option>";
}
$db->free_result($result_area);
;echo '	      </select>
          
          </TD>
	  </TR>
  
	<TR>
	  <TD colspan="2" align="center" valign="middle"  background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="edit" ';
;echo '>	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>