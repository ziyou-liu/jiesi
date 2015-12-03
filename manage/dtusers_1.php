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
;echo '<title>安置网体</title>
</head>

<body>
';
if(!empty($psearch)){
$periods=$periods1;
}else{
$periods=getperiods3();
}
if(!empty($psearch)&&empty($periods1)){
$periods=getperiods3();
}
$c_periods=getperiods3();
if(empty($periods)) echo "请先添加结算周期，以确保网络图正确！";
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$rs=$db->get_one($sql);
$timelimit=$rs["begintime"];$timelimit1=$rs["endtime"]+24*60*60;$timelimit2=$rs["endtime"];
$jsfloer1=" and confirmtime>'".$timelimit."' and confirmtime<='".$timelimit1."'";
function getremain($username,$pos){
global $db,$db_prefix,$glo_rank_1,$periods;
$sql="select * from {$db_prefix}jsrec where username='$username' and periods='$periods' ";
$result=$db->get_one($sql);
if($pos==1) return $result["leftsy"];elseif($pos==2) return $result["rightsy"];
}
function getusertimepv($username,$confirmtime){
global $db,$db_prefix,$timelimit,$timelimit1,$timelimit2;
if(!empty($timelimit1)&&!empty($timelimit)){
$sql="select count(id) as c from {$db_prefix}users where  (find_in_set('".$username."',glstr) or prename='$username') and state=1 and confirmtime>'".$timelimit."' and confirmtime<='".$timelimit1."'";
$result=$db->get_one($sql);
if($confirmtime>$timelimit &&$confirmtime<=$timelimit1){
$res=$result["c"]+1;
}else{
$res=$result["c"];
}
return $res;
}else return;
}
function getspanpv($username,$confirmtime){
global $db,$db_prefix,$timelimit1;
if(!empty($timelimit1)){
$sql="select count(id) as c from {$db_prefix}users where (find_in_set('".$username."',glstr) or prename='$username') and state=1 and confirmtime<'".$timelimit1."'";
$result=$db->get_one($sql);
if($confirmtime>0 &&$confirmtime<=$timelimit1){
$res=$result["c"]+1;
}else{
$res=$result["c"];
}
return $res;
}else{
return;
}
}
$sql_d1="select * from {$db_prefix}periods where state>0 order by endtime desc limit 1";
$rs_d1=$db->get_one($sql_d1);
$endtime=$rs_d1["endtime"];
if (empty($endtime)) $begintime=0;else $begintime=$endtime+24*3600;
$monthfrom=date("Y",time())."-".date("m",time())."-"."01";
$monthto=date("Y",time())."-".date("m",time())."-".date("t",time());
$rs_hy=$db->get_one("select * from {$db_prefix}users where ifnull(tjrname,'')='' and ifnull(prename,'')=''");
$hyid=$rs_hy["username"];
if (!empty($userid)){
$hyid=$userid;
$sql_chk="select * from {$db_prefix}users where username='".$hyid."'";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])){
die("查询会员不存在");
}
}
function rankcolor($rank){
}
;echo '<table width="60%" align="center">  
    ';foreach($rankarydt as $key=>$value){
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
;echo '	  <TD align="center" valign="middle" bgColor="';echo $bgcol;;echo '" width="60"><font color="#FFFFFF">';echo $value;echo '</font></TD>	
	  ';};echo '	  
   </tr>
</table>
<table align="center">
<tr><td>
<table width="100%" border="0">
		<tr style=" display:">
		<form action="" method="get" name="form1" id="form1"><input type="hidden" name="mod" value="s">
		<input type="hidden" name="periods" value="';echo $periods;;echo '">
		<input type="hidden" name="psearch" value="';echo $psearch;;echo '">
		<input type="hidden" name="periods1" value="';echo $periods1;;echo '">
			<td height="30" align="center"><span id="Label1">会员编号：</span>
			<input name="userid" type="text" id="userid" style="width:100px;">
			<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
		 </td>
      </form>
		</tr>
		<tr style=" display:">
		<form action="dtusers_1.php" method="get" name="form1" id="form1">
        <input type="hidden" value="psearch" name="psearch">
		<input name="userid" type="hidden" id="userid" value="';echo $userid;;echo '">
	    <td height="30" align="center">搜索期数：<input name="periods1" type="text" id="periods" style="width:100px;">
			<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'"><br>(若不添加期数系统默认为第';echo $c_periods;;echo '期，当前查询第';echo $periods;;echo '期)</td>
		</form>
		</tr>
</table>
<!-- 拓扑图开始 -->
';
if ($hyid!=""){
$sql11="select * from {$db_prefix}users where username='".$hyid."'";
$rs11=$db->get_one($sql11);
$hyrank=$rs11["rank"];
;echo '';
if (!empty($rs11["prename"])){
;echo '<br>
<div align="center">
<input type="button" name="btnSearch" value="上一层" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?periods=';echo $periods;;echo '&userid=';echo urlencode($rs11["prename"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '\';">
<input type="button" name="btnSearch" value="置顶" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?periods=';echo $periods;;echo '&userid=';echo urlencode($rs_hy["username"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '\';">
</div>
<br>
';
}
;echo '</td></tr>
<tr><td>
<table align="center" cellpadding="0" cellspacing="0" width="80%"><tr>
<td valign="top" align="center">
  <table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" width="120px">
    <tr>
      <td align="center" bgcolor="#FFFFFF">
	  <table width="100%" border="0" cellspacing="1" cellpadding="0">
    ';
switch($rs11["rank"]){
case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
case 3:$bg1="#AA3939";$bgcol="#AA3939";$bg2="#AA3939";break;
case 4:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
case 5:$bg1="#ff0000";$bgcol="#ff0000";$bg2="#ff0000";break;
case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
}
if($rs11['state']==0) {$bg1="#CCCCCC";$bgcol="#CCCCCC";$bg2="#CCCCCC";}
;echo '          <tr>
            <td height="15"  align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 80px; BACKGROUND-COLOR:';echo rankcolor($hyrank);echo '" href="?userid=';echo urlencode($rs11["username"]);echo '&periods=';echo $periods;;echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '"><font color="ffffff"><strong>';echo $rs11["username"];echo '</strong></font></a></td>
          </tr>		 
          <tr>
            <td height="15" align="center" bgcolor="';echo $bg1;;echo '"><font color="ffffff">';echo $rs11["realname"];echo '</font></td>
          </tr>
          <tr>
            <td height="15"  align="center" bgcolor="';echo $bg2;;echo '">';$rankname=getuserrank($rs11["rank"]);
echo $rankname;;echo '</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#66c2cd">
			<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#E7F2FB">
              <tbody bgcolor="#c9e8ec">
                 <tr>
                  <td>&nbsp;</td>
                  ';
$posnum=2;
for($j=1;$j<=$posnum;$j++){;echo '				  <td height="15" >';if($j==1) echo "A";if($j==2) echo "B";;echo '</td>
				 ';};echo '                </tr>
				<tr>
				  <td height="15" width="30%">累计</td>
				  ';
$total2="";for($j=1;$j<=$posnum;$j++){;echo '                  <td align="center" height="15" >';
$sql="select * from {$db_prefix}users where prename='".$rs11["username"]."' and pos='$j'";
$ss2=$db->get_one($sql);
$new=0;
if(!empty($ss2)){
$price2=0;
$new=getspanpv($ss2["username"],$ss2["confirmtime"]);
$price2=getusertimepv($ss2["username"],$ss2["confirmtime"]);
$total2[$j]=$price2;
if(!empty($new)) echo $new;else echo "0";
}else{echo "0";}
;echo '</td>
				  ';};echo '                </tr>
                <tr>
                  <td height="15" >
				  	新增</td>
				  ';for($j=1;$j<=$posnum;$j++){;echo '                  <td align="center" height="15"  >
                  ';if(!empty($total2[$j])) echo $total2[$j];else echo "0";;echo '</td>
				  ';};echo '                </tr>
                <tr style="display:">
				  <td height="15" >剩余</td>
				  ';
for($j=1;$j<=$posnum;$j++){$hh=0;
;echo '                  <td align="center" height="15" >
                  ';echo $hh=getremain($rs11["username"],$j);;echo '</td>
				   ';};echo '                </tr>
              </tbody>
            </table></td>
          </tr>
          ';if($rs11['state']==0) {;echo '          <tr>
            <td align="center" background="images/tab_19.gif"><span style=" color:red">未激活</span></td>
          </tr>
          ';};echo '          <tr>
            <td align="center" background="images/tab_19.gif">';echo date("Y-m-d",$rs11["regtime"]);echo '</td>
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
function tuopu_tree($tj_username,$dtp,$dtp1){
global $db;global $db_prefix,$periods,$zyj,$xyj,$syj,$begintime,$monthfrom,$monthto,$jsfloer1,$price,$timelimit1,$timelimit2,$timelimit,$periods,$psearch,$periods1;
if ($dtp>=$dtp1){
;echo '<table align="center" cellpadding="0" cellspacing="0"><tr>
';
$sql="select posnum from {$db_prefix}users where username='$tj_username' ";
$res=$db->get_one($sql);
$i=1;
$posnum=$res["posnum"];
$posnum=2;
for($m=1;$m<=$posnum;$m++){
$sql="select * from {$db_prefix}users where prename='$tj_username' and pos='$m' ";
$rs=$db->get_one($sql);
$c_num=$posnum;
$price=0;
$new=0;
;echo '	<td valign="top">
	';if ($c_num>1){;echo '
	';
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
	';if(!empty($rs)){;echo '	<table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" style="margin:0px auto 0 auto;" width="120px">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        ';
switch($rs["rank"]){
case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
case 3:$bg1="#AA3939";$bgcol="#AA3939";$bg2="#AA3939";break;
case 4:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
case 5:$bg1="#ff0000";$bgcol="#ff0000";$bg2="#ff0000";break;
case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
}
if($rs['state']==0) {$bg1="#CCCCCC";$bgcol="#CCCCCC";$bg2="#CCCCCC";}
;echo '            <tr>
              <td align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 80px; BACKGROUND-COLOR: ';echo rankcolor($rs["rank"]);echo '" href="?userid=';echo urlencode($rs["username"]);echo '&periods=';echo $periods;;echo '&periods=';echo $periods;;echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '"><font color="ffffff"><strong>';echo $rs["username"];echo '</strong></font></a></td>
            </tr>
			<tr>
            <td height="15" align="center" bgcolor="';echo $bg1;;echo '"><font color="ffffff">';echo $rs["realname"];echo '</font></td>
            </tr>
            <tr>
              <td align="center" bgcolor="';echo $bg2;;echo '">
			  ';$rankname=getuserrank($rs["rank"]);echo $rankname;;echo '</td>
            </tr>

            <tr>
              <td align="center" bgcolor="#B0E0E6">
			 <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#E7F2FB">
			  <tbody bgcolor="#c9e8ec">
                 <tr>
                  <td>&nbsp;</td>
                  ';for($j=1;$j<=$posnum;$j++){;echo '				  <td>';if($j==1) echo "A";if($j==2) echo "B";;echo '</td>
				 ';};echo '                </tr>
				<tr>
                  <td width="30%">累计</td>
				  ';$total2="";for($j=1;$j<=$posnum;$j++){;echo '                  <td align="center" >
				  ';
$ss2="";
$sql="select * from {$db_prefix}users where prename='".$rs["username"]."' and pos='$j'";
$ss2=$db->get_one($sql);
$new=0;
if(!empty($ss2)){
$price=0;
$price2=0;
$price=getspanpv($ss2["username"],$ss2["confirmtime"]);
$price2=getusertimepv($ss2["username"],$ss2["confirmtime"]);
$total2[$j]=$price2;
$new=$price;
if(!empty($new)) echo $new;else echo "0";
}else echo "0";
;echo '</td>
				  ';};echo '                </tr>
                <tr>
                  <td>新增</td>
				  ';for($j=1;$j<=$posnum;$j++){;echo '                  <td align="center">
                  ';if(!empty($total2[$j])) echo $total2[$j];else echo "0";;echo '</td>
				  ';};echo '                </tr>
                <tr>
                  <td>剩余</td>
				  ';for($j=1;$j<=$posnum;$j++){$hh=0;;echo '                  <td align="center">
                  ';echo $hh=getremain($rs["username"],$j);;echo '</td>
				   ';};echo '                </tr>
              </tbody>
              </table>
			  </td>
            </tr>
          ';if($rs['state']==0) {;echo '          <tr>
            <td align="center" background="images/tab_19.gif"><span style=" color:red">未激活</span></td>
          </tr>
          ';};echo '          <tr>
              <td align="center" background="images/tab_19.gif">';echo date("Y-m-d",$rs["regtime"]);echo '</td>
          </tr>
        </table></td>
      </tr>
    </table>
	';}else{;echo '    <table border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" style="margin:0px auto 0 auto;">
	     <tr>
              <td align="center" background="images/tab_19.gif" width="70">
			  <a href="userreg.php?prename=';echo $tj_username;;echo '&pos=';echo $i;;echo '&regfrom=net"><font color="#0f743c"><strong>注册</strong></font></a>
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
tuopu_tree($rs["username"],$dtp,$dtp1+1);
}
;echo '	</div>
	</td>
';
$i++;
}
;echo '</tr>
</table>
';}}
tuopu_tree($rs11["username"],3,1);
}
;echo '</td></tr></table>
<br>
<center>
  本网络图仅显示4层
</center>
<br><br>
</body>
</html>
';
?>