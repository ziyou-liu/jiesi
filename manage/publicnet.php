<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");
include("../include/periodscls.php");
include("../include/function.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/clearing.php");
include("../include/setting.php");
;echo '<title>公排网</title>
</head>

<body>
';
$monthfrom=date("Y",time())."-".date("m",time())."-"."01";
$monthto=date("Y",time())."-".date("m",time())."-".date("t",time());
$rs_hy=$db->get_one("select * from {$db_prefix}bwnet where ifnull(prename,'')='' and ifnull(preid,'')=''");
$hyid=$rs_hy["id"];
if (!empty($_GET['userid'])){
$sqlhy="select * from {$db_prefix}bwnet where username='".$_GET['userid']."' and state=1 order by id asc limit 1";
$rshy=$db->get_one($sqlhy);$hyid=$rshy['id'];
if(!empty($_GET['type'])){
$type=trim($_GET['type']);
}
$sql_chk="select * from {$db_prefix}bwnet where id='".$hyid."'";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])){
die("查询会员不存在");
}
}
if (!empty($_GET['pubid'])){
$hyid=$_GET['pubid'];
$sql_chk="select * from {$db_prefix}bwnet where id='".$hyid."'";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])){
die("查询会员不存在");
}
}
function rankcolor($rank){
}
;echo '<table width="600px" align="center">  
    ';foreach($rankary as $key=>$value){
switch($key){
case 0:$bg1="#CCCCCC";$bgcol="#CCCCCC";$bg2="#CCCCCC";break;
case 1:$bg1="#CCff09";$bgcol="#009999";$bg2="#EAC3C3";break;
case 2:$bg1="#CC0099";$bgcol="#8891ed";$bg2="#F2B6E3";break;
case 3:$bg1="#AA3939";$bgcol="#AA3939";$bg2="#EAC3C3";break;
case 4:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
case 5:$bg1="#ff0000";$bgcol="#ff0000";$bg2="#ff0000";break;
case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
}
;echo '	<TD align="center" bgColor="';echo $bgcol;;echo '" width="120"><font color="#FFFFFF">';echo $value;echo '</font></TD>	
	';};echo '    <TD align="center" bgColor="#666666" width="120"><font color="#FFFFFF">未确认会员</font></TD>
   </tr>
</table>
<form action="" method="get" name="form1" id="form1">
<table width="100%" border="0">
		<tr style=" display:">
			<input type="hidden" name="mod" value="s">
			<input type="hidden" name="periods" value="';echo $type;;echo '">
			<td height="30" align="center"><span id="Label1">会员编号：</span>
				<input name="userid" type="text" id="userid" style="width:100px;">
				<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
			</td>
		</tr>
</table>
</form>
<!-- 拓扑图开始 -->
';
if ($hyid!=""){
$sql11="select * from {$db_prefix}bwnet where id='".$hyid."'";
$rs11=$db->get_one($sql11);
if(!empty($rs11['id'])){
$sql12="select * from {$db_prefix}users where username='".$rs11['username']."'";
$rs12=$db->get_one($sql12);
$hyrank=$rs12["rank"];
;echo '';
if (!empty($rs11["preid"])){
$sql12="select * from {$db_prefix}users where username='".$rs11['username']."'";
$rs12=$db->get_one($sql12);
;echo '<br>
<div align="center">
	<input type="button" name="btnSearch" value="上一层" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?pubid=';echo urlencode($rs11["preid"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods;;echo '\';">
	<input type="button" name="btnSearch" value="置顶" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?pubid=';echo urlencode($rs_hy["id"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods;;echo '\';">
</div>
<br>
';
}
;echo '</td></tr>
<tr><td>
<table align="center" cellpadding="0" cellspacing="0" width="100%"><tr>
<td valign="top" align="center">
  <table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" width="80">
    <tr>
      <td align="center" bgcolor="#FFFFFF">
	  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    ';
switch($rs12["rank"]){
case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
case 3:$bg1="#AA3939";$bgcol="#AA3939";$bg2="#AA3939";break;
case 4:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
case 5:$bg1="#ff0000";$bgcol="#ff0000";$bg2="#ff0000";break;
case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
}
if($rs12['state']==0){$bg1="#666666";$bgcol="#666666";$bg2="#666666";}
$s1=$rs11["fullsalary1"];
$s0=$rs11["fullsalary"];
$maxpos=0;
if($s0==1){
$sql="select * from {$db_prefix}jsrec where username='".$rs11["username"]."' and areatag2=1 ";
$p_rs=$db->get_one($sql);
if($p_rs["periods"]<$periods){
$pos="all";
}
}
if($s1==1){
$sql="select * from {$db_prefix}jsrec where username='".$rs11["username"]."' and areatag1=1 ";
$p_rs=$db->get_one($sql);
if($p_rs["periods"]<$periods){
$maxpos=$rs11["limitpos"];
}
}
;echo '          <tr>
            <td align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px; BACKGROUND-COLOR:';echo rankcolor($hyrank);echo '" href="?userid=';echo urlencode($rs11["username"]);echo '&type=';echo $type;;echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods;;echo '"><font color="ffffff"><strong>';echo $rs11["username"];echo '</strong></font></a></td>
          </tr>		 
          <tr>
            <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><font color="ffffff">';echo $rs12["realname"];echo '</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="';echo $bg2;;echo '">';$rankname=getuserrank($rs12["rank"]);
echo $rankname;;echo '</td>
          </tr>
           ';if($rs12['state']==0) {;echo '          <tr>
            <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo "未确认";;echo '</td>
          </tr>
          ';};echo '          <tr>
            <td align="center" background="images/tab_19.gif">';echo date("Y-m-d",$rs11["addtime"]);echo '</td>
          </tr>
          <tr>            </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
</table>
<table border="0" align="center" cellspacing="0" cellpadding="0">
  <tr>
	<td align="center"><img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
  </tr>
</table>
';
function tuopu_tree($tj_username,$dtp,$dtp1,$glo_gui){
global $db,$db_prefix,$periods,$begintime,$monthfrom,$monthto,$jsfloer1,$timelimit1,$timelimit2,$timelimit,$psearch,$periods1;$glo_gui;
if ($dtp>=$dtp1){
;echo '<table align="center" cellpadding="0" cellspacing="0"><tr>
	';
$i=1;
for($m=1;$m<=$glo_gui;$m++){
$sql13="select * from {$db_prefix}bwnet where preid='$tj_username' and pos='$m'";
$rs=$db->get_one($sql13);
$c_num=$glo_gui;
;echo '	<td valign="top">
	';if ($c_num>1){;echo '	';
if (($i==1) &&($c_num>$i)){
;echo '	<table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" height="1" ></td>
            <td width="50%" height="1" bgcolor="#003399"></td>
          </tr>
        </table>
              <img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
      </tr>
    </table>
	';
}else if(($i>1) &&($c_num==$i)){
;echo '	<table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" height="1" bgcolor="#003399"></td>
            <td width="50%" height="1" ></td>
          </tr>
        </table>
              <img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
      </tr>
    </table>
	';
}else{
;echo '	<table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" height="1" bgcolor="#003399"></td>
            <td width="50%" height="1" bgcolor="#003399"></td>
          </tr>
        </table>
              <img src="/images/line.gif" alt="" width="27" border="0" style="WIDTH: 1px; HEIGHT: 20px" /></td>
      </tr>
    </table>
	';
}
}
;echo '	<!---->
	';if(!empty($rs['id'])){
$sqls="select * from {$db_prefix}users where username='".$rs['username']."'";
$rss=$db->get_one($sqls);
;echo '	<table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" width="80" style="margin:0px auto;">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        ';
switch($rss["rank"]){
case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
case 3:$bg1="#AA3939";$bgcol="#AA3939";$bg2="#AA3939";break;
case 4:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
case 5:$bg1="#ff0000";$bgcol="#ff0000";$bg2="#ff0000";break;
case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
}
if($rss['state']==0){$bg1="#666666";$bgcol="#666666";$bg2="#666666";}
;echo '            <tr>
              <td align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px; BACKGROUND-COLOR: ';echo rankcolor($rss["rank"]);echo '" href="?userid=';echo urlencode($rs["username"]);echo '&type=';echo $type;;echo '&periods=';echo $periods;;echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods;;echo '"><font color="ffffff"><strong>';echo $rs["username"];echo '</strong></font></a></td>
            </tr>
			<tr>
            <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><font color="ffffff">';echo $rss["realname"];echo '</font></td>
          </tr>
          <tr>
            <td align="center" bgcolor="';echo $bg2;;echo '">';$rankname=getuserrank($rss["rank"]);
echo $rankname;;echo '</td>
          </tr>
 		';if($rss['state']==0) {;echo '          <tr>
            <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo "未确认";;echo '</td>
          </tr>
          ';};echo '            <tr>
              <td align="center" background="images/tab_19.gif">';echo date("Y-m-d",$rs["addtime"]);echo '</td>
            </tr>
        </table></td>
      </tr>
    </table>
	';}else{;echo '    <table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" style="margin:0px auto;">
	     <tr>
              <td align="center" background="images/tab_19.gif" width="70">
			 <font color="#0f743c"><strong>无</strong></font> 
			  </td>
         </tr>
	</table>
  ';};echo '    ';
$sql1="select *  from {$db_prefix}users where username='".$rs["username"]."' ";
$rs1=$db->get_one($sql1);
;echo '	<div style="display:" id="table_';echo $rs["id"];echo '">
	';if (!empty($rs1)&&$dtp1<$dtp){;echo '
	<table align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
	  </tr>
	</table>
    ';
tuopu_tree($rs["id"],$dtp,$dtp1+1,$glo_gui);
}
;echo '	</div>
	</td>
';
$i++;
}
;echo '</tr>
</table>
';}}
tuopu_tree($rs11["id"],3,1,$glo_gui);
}}
;echo '</td></tr></table>
<br>
<center>
本网络图仅显示4层
</center>
<br><br>
</body>
</html>
';
?>