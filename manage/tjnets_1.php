<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/rank.php");
include("../include/clearing.php");
include("../include/periodscls.php");
;echo '<title>推荐网络图</title>
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
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$rs=$db->get_one($sql);
$timelimit=$rs["begintime"];$timelimit1=$rs["endtime"]+24*60*60;$timelimit2=$rs["endtime"];
$hytjnetznum=1;$hytjnetznum1=0;
function gettjnet_z($hyid){
global $db,$db_prefix,$hytjnetznum;
$sql="select * from {$db_prefix}users where tjrname='".$hyid."'";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$hytjnetznum++;
gettjnet_z($rs["username"]);
}
$db->free_result($result);
}
function gettjnet_z1($hyid){
global $db,$db_prefix,$hytjnetznum1;
$sql="select * from {$db_prefix}users where tjrname='".$hyid."'";
$result=$db->query($sql);
while ($rs=$db->fetch_array($result)){
$hytjnetznum1++;
}
$db->free_result($result);
}
$rs_hy=$db->get_one("select * from {$db_prefix}users where ifnull(tjrname,'')='' and ifnull(prename,'')=''");
$hyid=$rs_hy["username"];
if (!empty($userid)){
$hyid=$userid;
$sql_chk="select * from {$db_prefix}users where username='".$hyid."'";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])){
die("查询会员不存在");
}
}else{
if($from=="timenet"){$hyid=$tuserid;}
}
function rankcolor($rank){
}
;echo '<table width="60%" align="center">  
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
;echo '	  <TD align="center" bgColor="';echo $bgcol;;echo '" width="60"><font color="#FFFFFF">';echo $value;echo '</font></TD>	
	  ';};echo '	  
   </tr>
</table>

	<table width="100%" border="0">
		<form action="" method="get" name="form1" id="form1"><input type="hidden" name="mod" value="s">
		<input type="hidden" name="periods" value="';echo $periods;;echo '">
		<input type="hidden" name="psearch" value="';echo $psearch;;echo '">
		<input type="hidden" name="periods1" value="';echo $periods1;;echo '">
				<tr style=" display:">
					<td height="30" align="center"><span id="Label1">会员编号：</span>					<input name="userid" type="text" id="userid" style="width:100px;">
					<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
				  </td></td>
				</tr>
		</form>
		<tr style=" display:">
		<form action="tjnets_1.php" method="get" name="form1" id="form1">
        <input type="hidden" value="psearch" name="psearch">
		<input name="userid" type="hidden" id="userid" value="';echo $userid;;echo '">
	 <!-- <td height="30" align="center">搜索期数：<input name="periods1" type="text" id="periods" style="width:100px;">
					<input type="submit" name="btnSearch" value="搜索" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
					<br/>(若不添加期数系统默认为第';echo $c_periods;;echo '期，当前查询第';echo $periods;;echo '期)</td> -->
		</form>
		</tr>
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
echo "<div align=\"center\">";
if (!empty($rs11["tjrname"])){
;echo '
<input type="button" name="btnSearch" value="上一层" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?userid=';echo urlencode($rs11["tjrname"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '&periods=';echo $periods;;echo '\';">
<input type="button" name="btnSearch" value="置顶" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'?periods=';echo $periods;;echo '&userid=';echo urlencode($rs_hy["username"]);echo '&psearch=';echo $psearch;;echo '&periods1=';echo $periods1;;echo '\';">

';
}
;echo '</div>
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
            <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px;" href="?userid=';echo urlencode($rs11["username"]);echo '&periods=';echo $periods;;echo '&periods1=';echo $periods1;;echo '&psearch=';echo $psearch;;echo '"><font color="ffffff"><strong>';echo $rs11["username"];echo '</strong></font></a></td>
          </tr>		 
          <tr>
            <td height="20" align="center" bgcolor="';echo $bg1;;echo '" ><font color="ffffff">';echo $rs11["realname"];echo '</font></td>
          </tr>
          <tr>
            <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo getuserrank($hyrank);;echo '</td>
          </tr>
		  ';
if($rs11["director"]==1){
;echo '		   <tr>
            <td height="20" align="center" bgcolor="#E7F2FB">

			<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#517DBF">
			 <tbody>
		  <tr bgcolor="#ffffff">
            <td>&nbsp;</td>
            <td>报单</td>
			<td>消费</td>
          </tr>
          <tr bgcolor="#ffffff">
             <td>新增</td>
              <td>';echo gettjnetnew($rs11["username"],$timelimit,$timelimit2);echo '</td>
			  <td>';echo cgettjnetnew($rs11["username"],$timelimit,$timelimit2);echo '</td>
          </tr>
              </tbody>
            </table>

			</td>
          </tr>
		  ';};echo '          <tr>
            <td height="20" align="center" bgcolor="#E7F2FB" >';echo date("Y-m-d",$rs11["regtime"]);;echo '</td>
          </tr>
          <tr>
            <td height="25" align="center" valign="bottom" background="images/tab_05.gif"><table width="100%" border="0">
              <tr>
                <td>总:';gettjnet_z($rs11["username"]);echo $hytjnetznum;;echo '</td>
                <td>直推:';gettjnet_z1($rs11["username"]);echo $hytjnetznum1;;echo '</td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
   <td>
   ';
$sql1="select count(id) as c from {$db_prefix}users where tjrname='".$rs11["username"]."'";
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
global $db;global $db_prefix,$hytjnetznum,$hytjnetznum1,$timelimit,$timelimit2,$periods,$periods1,$psearch;
if ($dtp1<=$dtp){
;echo '<table align="center" cellpadding="0" cellspacing="0"><tr>
';
$sql="select * from {$db_prefix}users where tjrname='".$tj_username."'";
$result=$db->query($sql);
$c_num=$db->num_rows($result);$i=1;
while ($rs=$db->fetch_array($result)){
$hytjnetznum=1;$hytjnetznum1=0;
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
;echo '	<table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" >
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
              <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><a style="WIDTH: 100px; BACKGROUND-COLOR: ';echo rankcolor($rs11["rank"]);echo '" href="?userid=';echo urlencode($rs["username"]);echo '&periods=';echo $periods;;echo '&periods1=';echo $periods1;;echo '&psearch=';echo $psearch;;echo '"><font color="ffffff"><strong>';echo $rs["username"];echo '</strong></font></a></td>
            </tr>			
            <tr>
              <td height="20" align="center" bgcolor="';echo $bg1;;echo '"><font color="ffffff">';echo $rs["realname"];echo '</font></td>
            </tr>
            <tr>
              <td height="20" align="center" bgcolor="';echo $bg2;;echo '">';echo getuserrank($rs["rank"]);echo '</td>
            </tr>
			 ';
if($rs["director"]==1){
;echo '			 <tr>
            <td height="20" align="center" bgcolor="#E7F2FB">

			<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#517DBF">
			 <tbody>
		  <tr bgcolor="#ffffff">
            <td>&nbsp;</td>
            <td>报单</td>
			<td>消费</td>
          </tr>
          <tr bgcolor="#ffffff">
             <td>新增</td>
              <td>';echo gettjnetnew($rs["username"],$timelimit,$timelimit2);echo '</td>
			  <td>';echo cgettjnetnew($rs["username"],$timelimit,$timelimit2);echo '</td>
          </tr>
              </tbody>
            </table>

			</td>
          </tr>
		  ';
}
;echo '            <tr>
              <td height="20" align="center" bgcolor="#E7F2FB">';echo date("Y-m-d",$rs["regtime"]);echo '</td>
            </tr>
            <tr>
              <td height="25" align="center" valign="bottom" background="images/tab_05.gif"><table width="100%" border="0">
                <tr>
                  <td>总:';gettjnet_z($rs["username"]);echo $hytjnetznum;;echo '</td>
                  <td>直推:';gettjnet_z1($rs["username"]);echo $hytjnetznum1;;echo '</td>
                </tr>
              </table></td>
            </tr>
        </table></td>
      </tr>
    </table>

	';
$sql1="select count(id) as c from {$db_prefix}users where tjrname='".$rs["username"]."'";
$rs1=$db->get_one($sql1);
;echo '	<div style="display:block" id="table_';echo $rs["id"];echo '">
	';
if ($dtp1<$dtp){
;echo '	';
if ($rs1["c"]>0){
;echo '
	<table align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img style="WIDTH: 1px; HEIGHT: 20px" alt="" src="/images/line.gif" border="0" /></td>
	  </tr>
	</table>
	';
}
;echo '	';
if ($rs1["c"]==1){
;echo '
	<table align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center"><img src="/images/line.gif" alt="" width="8" border="0" style="WIDTH: 1px; HEIGHT: 20px" /></td>
	  </tr>
	</table>
	';
}
;echo '	';
}
;echo '
	';
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
tuopu_tree($rs11["username"],3,1);
}
;echo '   </td>
</tr>
</table>

<br>
<center>
  本网络图仅显示4层
</center>
<br><br>

</body>
</html>
';
?>