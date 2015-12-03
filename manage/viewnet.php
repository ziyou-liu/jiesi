<?php
echo '<HTML><HEAD><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/rank.php");
include("../include/clearing.php");
include("../include/periodscls.php");
include("../include/pv.php");
;echo '<title>推荐网络图</title>
</head>

<body>
';
if(!empty($psearch)){
$periods=$periods1;
}else{
$periods=getperiods3();
}
if(empty($periods)) echo "请先添加结算周期，以确保网络图正确！";
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
if($from=="timenet"){$hyid=$tuserid;}
$sql_chk="select * from {$db_prefix}users where username='".$hyid."'";
$rs_chk=$db->get_one($sql_chk);
if (empty($rs_chk["id"])){
die("查询会员不存在");
}
;echo '	
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
if($from=="timenet"){
;echo '<input type="button" name="btnSearch" value="返回" id="btnSearch" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'" onClick="location.href=\'timenet.php?username=';echo $tusername;;echo '&action=';echo $action;echo '&periods=';echo $tperiods;;echo '\';">
';
}
;echo '</div>
<br>


<table align="center" cellpadding="0" cellspacing="0" width="100%"><tr>
<td valign="top">
  <table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center">
    <tr>
      <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td height="20" align="center" bgcolor="#66c2cd"><font color="ffffff"><strong>';echo $rs11["username"];echo '</strong></font></td>
          </tr>		
          <tr>
            <td height="20" align="center" bgcolor="#B0E0E6">';echo getuserrank($hyrank);;echo '</td>
          </tr>		 
          <tr>
            <td height="20" align="center" bgcolor="#E7F2FB" >';echo date("Y-m-d",$rs11["regtime"]);;echo '</td>
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
global $db,$db_prefix,$hytjnetznum,$hytjnetznum1,$timelimit,$timelimit2;
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
;echo '	<table width="100" border="0" cellpadding="0" cellspacing="1" bgcolor="#517DBF" align="center" style="margin:0px 10px;">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td height="20" align="center" bgcolor="#66c2cd"><font color="ffffff"><strong>';echo $rs["username"];echo '</strong></font></td>
            </tr>
			<!--
            <tr>
              <td height="20" align="center" bgcolor="#1956A6"><font color="ffffff">';echo $rs["realname"];echo '</font></td>
            </tr>
			-->
            <tr>
              <td height="20" align="center" bgcolor="#B0E0E6">';echo getuserrank($rs["rank"]);echo '</td>
            </tr>		
            <tr>
              <td height="20" align="center" bgcolor="#E7F2FB">';echo date("Y-m-d",$rs["regtime"]);echo '</td>
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
tuopu_tree($rs11["username"],$glo_rows,1);
}
;echo '   </td>
</tr>
</table>


</body>
</html>
';
?>