<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/secpwd.php");
include("../include/rank.php");
include("../include/pv.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/net.php");
$modtime=time();
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$rs=$db->get_one($sql);
if ($action=="applystore"){
if (!$torank) {
echo "<script>alert('请选择升级的会员类型');history.back();</script>";exit();
}
$bucha=1;
$glo_rname="glo_member_".$torank;
$bdmoney=$$glo_rname;
$glo_rname="glo_num_".$torank;
$bdnum=$$glo_rname;
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$urs=$db->get_one($sql);
$tjrname=$urs["tjrname"];
$prename=$urs["prename"];
$glo_rname_o="glo_member_".$urs["rank"];
$o_bdmoney=$$glo_rname_o;
$glo_rname_o="glo_num_".$urs["rank"];
$o_bdnum=$$glo_rname_o;
$span_bdmoney=$bdmoney-$o_bdmoney;
$span_bdmoney1=$bdmoney-$o_bdmoney;
$span_bdnum=$bdnum-$o_bdnum;
$totalmoney=$span_bdmoney;
if($bucha==1){
if($urs["price"]<$totalmoney){
$hint.="您没有足够的电子金额！请充值足额后在升级！此操作需要花费{$span_bdmoney}$！";
}
}
if ($hint!=''){
echo "<script>alert('{$hint}');history.back();</script>";exit();
}
if($bucha==1){
if($urs["price"]>=$span_bdmoney){
$sql111="insert into {$db_prefix}editrankrecord (username,oldrank,rank,applytime,state,isapproved,edittime) values ('".$_SESSION["glo_username"]."','".$urs["rank"]."','$torank','$modtime','0','1','')";
$db->query($sql111);
}
}
echo "<script>alert('会员已升级');location.href='applystore.php';</script>";exit();
}
;echo '<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
</HEAD><body bgcolor="#FFFFFF">
<form name="form1" method="post" action="applystore.php">
<input type="hidden" name="rank" value="';echo $rs["rank"];;echo '">
<input type="hidden" name="action" value="applystore">
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt style="margin:auto;">
<TBODY>
<TR><TD width="650" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23>&nbsp;<strong>升级申请</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  ';if($rs["rank"]<5){;echo '  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >申请会员:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $_SESSION["glo_username"];echo '</TD>
	</TR>
    <TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >现会员类型为:</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rankary[$rs["rank"]];;echo '</TD>
	</TR>
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >申请会员类型: </TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
      <select name="torank">
        ';
foreach($rankary as $key=>$val){
if($key>$rs["rank"]){
echo "<option value=\"$key\">$val</option>";
}
}
;echo '      </select>      </TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>
    </table>
	';};echo '	</TD>
  </TR>
</TABLE>
</form>
<br>
<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="30" background="images/tab_05.gif">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">升级申请记录</span></td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="14">&nbsp;</td>
                <td width="106">&nbsp;</td>
                <td width="83"></td>
                <td width="29"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1">&nbsp;</td>
                    <td class="STYLE1">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
		    <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             原会员类型</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             申请会员类型</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             升级时间</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             状态</span>
            </div></td>
          </tr>
         ';
$sql="select * from {$db_prefix}editrankrecord where 1 and type=0 and username='".$_SESSION["glo_username"]."'";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '          <tr>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rankary[$rs["oldrank"]];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rankary[$rs["rank"]];echo '</div>
            </div></td>
		    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d H:i:s",$rs["applytime"]);echo '</div>
            </div></td>
			 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';
switch($rs["state"]){
case 0: echo "未处理";break;
case 1:echo "成功";break;
case 2:echo "失败";break;
}
;echo '</div>
            </div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="5"><div align="center"></div></td>
          </tr>
      ';
}
$db->free_result($result);
;echo '        </table></td>
        <td width="8" background="images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;</td>
            <td>
            </td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body></html>';
?>