<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title></title>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

<style type="text/css">
<!--
.memo{
	color:red;
}
-->
</style>
';
include("../include/conn_2.php");include("../include/function.php");
include("../include/secpwd.php");
include("../include/rank.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");include("../include/pageclass.php");
include("../include/logcls.php");
include("../include/net.php");include("../include/area.php");
$modtime=time();
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$rs=$db->get_one($sql);
if($rs['isdp']) {$isdp=1;}
if ($action=="apply"){
$hint="";
if(trim($storename)=='') {echo "<script>alert(\"请输入您的店名\");history.back();</script>";exit();}
if(trim($storeaddress)=='') {echo "<script>alert(\"请输入您的店铺地址\");history.back();</script>";exit();}
$now=time();
if($rs['price']<$glo_kdmoney){
}
$sql_s="select id from {$db_prefix}applystore where username='".$_SESSION["glo_username"]."' and state=0";
$rs_s=$db->get_one($sql_s);
if($rs_s['id']){
echo "<script>alert(\"您提交的申请暂未审核，请不要重复提交\");history.back();</script>";exit();
}
$sql="insert into {$db_prefix}applystore (username,realname,storename,store_address,applytime,state) values ('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','$storename','$storeaddress','$now','0')";
$db->query($sql);
echo "<script>alert(\"您的申请已提交，请等待管理员审核\");</script>";
}
;echo '</HEAD><body bgcolor="#FFFFFF">
<form name="form1" method="post" action="applycenter.php">
<input type="hidden" name="action" value="apply">
<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt style="margin:0 auto;">
<TBODY>
<TR><TD width="650" colSpan=4 background="images/bg.gif">
';if($isdp!=1){;echo '<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23>&nbsp;<strong>申请店铺</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >申请会员:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $_SESSION["glo_username"];echo '</TD>
	</TR>
	<!--<TR>
	  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >电子货币:</TD>
	  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["price"];echo '</TD>
	</TR>-->
    <TR>
	  <TD width="41%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >店铺名称:</TD>
	  <TD width="59%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" ><input type="text" name="storename" value=\'\' size="35"> <span class="memo">*</span></TD>
	</TR>
     <TR>
	  <TD width="41%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >店铺地址:</TD>
	  <TD width="59%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" ><input type="text" name="storeaddress" value=\'\' size="35"> <span class="memo">*</span></TD>
	</TR>
    <!--<TR>
      <TD align="center" vAlign=middle bgColor="#FBFDFF" class="memo" colspan="2">说明:需花费';echo $glo_kdmoney;;echo '元，成为店铺后可享受服务费 </TD>
    </TR>-->
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="申请" name="but">	  </TD>
	  </TR>
    </table>
	';}else{;echo '	<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
	<TD height=23>&nbsp;<strong>申请店铺</strong></TD>
	</TR></TBODY></TABLE>
	</TD></TR>
	<TR>
	  <TD height="20" align="left" bgColor="#d4e8fa" >
	  <table width="100%" border="0" cellpadding="3" cellspacing="1">
		<TR>
		  <TD width="50%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >您的报单金额为:</TD>
		  <TD width="50%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs['price'];echo '</TD>
		</TR>
	   </table>
	   </td>
	<tr>
	';};echo '	</TD>
  </TR>
</TABLE>
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="3%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="97%" class="STYLE1"><span class="STYLE3">店铺申请记录</span></td>
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
            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
              编号</span>
            </div></td>
            <td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">申请会员</span></div></td>
            <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">店铺名称</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">店铺地址</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">申请时间</div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">处理时间</div></td>
			<td width="6%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center" class="STYLE1">状态</div></td>
          </tr>
         <input type="hidden" name="chknum" value="0">
      ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}applystore where 1 and type=0 and username='".$_SESSION["glo_username"]."'";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($time1)!="") $filter.=" and applytime>='".strtotime($time1)."'";
if (trim($time2)!="") $filter.=" and applytime<='".(strtotime($time2)+3600*24)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}applystore where 1 and type=0 and username='".$_SESSION["glo_username"]."'";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '	 <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["id"];echo '            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["username"];echo '            </div></td>
			<td align="center" bgcolor="#FFFFFF">';echo $rs["realname"];echo '</td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["storename"];echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
             ';echo $rs["store_address"];echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
            ';echo date("Y-m-d H:i:s",$rs["applytime"]);echo '            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center">
            ';if(!empty($rs["edittime"])){echo date("Y-m-d H:i:s",$rs["edittime"]);};echo '            </div></td>
			 <td bgcolor="#FFFFFF"><div align="center">';if ($rs['state']==0) echo '未处理';elseif ($rs['state']==1) echo "已同意";elseif ($rs['state']==2) echo "已拒绝";;echo '</div></td>
          </tr>
          ';
}
}else{
;echo '		  <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="9"><div align="center"></div></td>
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
            <td class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页</td>
            <td>
                     <form name="frmpage" method="get" action="">
            <table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="40"><img src="images/first.gif" width="37" height="15"  onClick="location.href=\'';echo allparam();echo '1\'"/></td>
                  <td width="45"><img src="images/back.gif" width="43" height="15"  onClick="location.href=\'';echo allparam();echo '';echo $pageno-1;echo '\'" /></td>
                  <td width="45"><img src="images/next.gif" width="43" height="15"  onClick="location.href=\'';echo allparam();echo '';echo $pageno+1;echo '\'"/></td>
                  <td width="40"><img src="images/last.gif" width="37" height="15"   onClick="location.href=\'';echo allparam();echo '';echo $pagenum;echo '\'" /></td>
                  <td width="100"><div align="center"><span class="STYLE1">转到第

';
$posts=$_POST;
$gets=$_GET;
$result = array_merge($posts,$gets);
foreach($result as $key=>$value){
;echo '                <input type="hidden" name="';echo $key;echo '" value="';echo $value;echo '" />
                ';
}
;echo '                    <input name="pageno" type="text" size="4" style="height:12px; width:20px; border:1px solid #999999;" />
                    页 </span></div></td>
                  <td width="40"><input  type="image" src="images/go.gif" width="37" height="15" /></td>
                </tr>
            </table>
            </form>
            </td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body></html>'
?>