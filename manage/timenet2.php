<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");
include("../include/net.php");include("../include/rank.php");
include("../include/clearing.php");
include("../include/periodscls.php");
;echo '<title>一线网</title>
</head>
<body>
';
if(!isset($tjnet) ||empty($tjnet)) $tjnet=1;
if($tjnet==1)$str="timepre";else $str='timepre'.$tjnet;
$sql_chk11="select * from {$db_prefix}users where ifnull(".$str.",'')='' and tjnet>='$tjnet' order by id asc limit 1";
$rs_chk11=$db->get_one($sql_chk11);
$hyid=$gshyid=$rs_chk11['username'];
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
;echo '<table width="70%" align="center">  
  <tr>
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
;echo '	  <TD align="center" valign="middle" bgColor="';echo $bgcol;;echo '" width="60"><font color="#FFFFFF">';echo $value;echo '</font></TD>	
	  ';};echo '	  
   </tr>
</table>
	<table width="100%" border="0">
		<form action="" method="get" name="form1" id="form1">	
		<input type="hidden" name="tjnet" value="';echo $tjnet;;echo '">
				<tr style=" display:">
					<td height="30" align="center"><span id="Label1">会员编号：</span>					<input name="userid" type="text" id="userid" style="width:100px;">
					<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
				  </td></td>
				</tr>
		</form>
		
	</table>
<!-- 拓扑图开始 -->
';
if ($hyid!=""){
$sql11="select * from {$db_prefix}users where username='".$hyid."'";
$rs11=$db->get_one($sql11);
if (empty($rs11["id"])){
die("没有找到相应的会员") ;
}
$hyrank=$rs11["rank"];
echo "<br><div align=\"center\">";
if ($rs11[$str]){
;echo '<input type="button" name="btnSearch" value="上一层" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?userid=';echo urlencode($rs11[$str]);echo '&tjnet=';echo $tjnet;;echo '\';">
<input type="button" name="btnSearch" value="置顶" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?userid=';echo urlencode($rs_hy["username"]);echo '&tjnet=';echo $tjnet;;echo '\';">
';
}
;echo '
</div>
<br>
<table align="center" cellpadding="0" cellspacing="0" width="100%"><tr>
<td valign="top">
  <table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center">
    <tr>
      <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
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
;echo '          <tr>
              <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px; BACKGROUND-COLOR: ';echo rankcolor($rs11["rank"]);echo '" href="?userid=';echo urlencode($rs11["username"]);echo '&tjnet=';echo $tjnet;;echo '"><font color="ffffff"><strong>';echo $rs11["username"];;echo '</strong></font></a></td>
            </tr>
		  <tr>
            <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo $rs11["realname"];echo '</td>
          </tr>
          <tr>
            <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo getuserrank($hyrank);;echo '</td>
          </tr>		       
          <tr>
            <td height="20" align="center" bgcolor="#E7F2FB">';if($tjnet==1)echo date("Y-m-d  H:i:s",$rs11["confirmtime"]);else echo date("Y-m-d H:i:s",$rs11["confirmtime".$tjnet]);;echo '</td>
          </tr>
          
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
   <td>
   ';
$sql1="select count(id) as c from {$db_prefix}users where timepre='".$rs11["username"]."'";
$rs_c=$db->get_one($sql1);
if ($rs_c["c"]>0){
;echo '<table border="0" align="center" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
	  </tr>
</table>
';
}
function tuopu_tree($tj_username,$dtp,$dtp1){
global $db;global $db_prefix,$tjnet;
if ($dtp1<=$dtp){
;echo '<table align="center" cellpadding="0" cellspacing="0"><tr>
';
if($tjnet==1) $str='timepre';else $str='timepre'.$tjnet;
$sql="select * from {$db_prefix}users where ".$str."='".$tj_username."'";
$result=$db->query($sql);
$c_num=$db->num_rows($result);$i=1;
while ($rs=$db->fetch_array($result)){
;echo '	<td valign="top">

	';
if ($c_num>1){
;echo '
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
;echo '	<table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" style="margin:0px 10px;">
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
;echo '            <tr>
              <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px; BACKGROUND-COLOR: ';echo rankcolor($rs["rank"]);echo '" href="?userid=';echo urlencode($rs["username"]);echo '&tjnet=';echo $tjnet;;echo '"><font color="ffffff"><strong>';echo $rs["username"];;echo '</strong></font></a></td>
            </tr>
            <tr>
              <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo $rs["realname"];echo '</td>
            </tr>
            <tr>
              <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo getuserrank($rs["rank"]);echo '</td>
            </tr>			
            <tr>
              <td height="20" align="center" bgcolor="#E7F2FB">';if($tjnet==1) echo date("Y-m-d H:i:s",$rs["confirmtime"]);else echo date("Y-m-d H:i:s",$rs["confirmtime".$tjnet]);;echo '</td>
            </tr>
        </table></td>
      </tr>
    </table>
	';
$sql1="select count(id) as c from {$db_prefix}users where timepre='".$rs["username"]."'";
$rs1=$db->get_one($sql1);
;echo '	<div style="display:block" id="table_';echo $rs["id"];echo '">
	';
if ($dtp1<$dtp){
;echo '	';
if ($rs1["c"]>0){
;echo '	<table align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
	  </tr>
	</table>
	';
}
;echo '	';
if ($rs1["c"]==1){
;echo '	<table align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img src="/images/line.gif" alt="" width="8" border="0" style="WIDTH: 1px; HEIGHT: 20px" /></td>
	  </tr>
	</table>
	';
}
;echo '	';
}
;echo '	';
tuopu_tree($rs["username"],$dtp,$dtp1+1);
;echo '	</div>
	</td>
';
$i++;
}
$db->free_result($result);
;echo '</tr>
</table>
';
}
}
tuopu_tree($rs11["username"],20,1);
}
;echo '   </td>
</tr>
</table>

<br>
<center>
  本网络图仅显示20层
</center>
<br><br>

</body>
</html>
';
?>