<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/clearing.php");
$sql_p="select max(periods+0) as c1 from {$db_prefix}periods where state>=1 and ifnull(year,'')!='' and ifnull(month,'')!=''";
$rs_p=$db->get_one($sql_p);
$recentperiods=empty($rs_p["c1"])?0:$rs_p["c1"];
$modtime=time();
$year=date("Y",$modtime);$month=date("m",$modtime);
if ($action=="query"){
if ((trim($username)=="") &&(trim($realname)=="")){
die("请输入查询内容");
}
$sql_q="select * from {$db_prefix}users where 1";
if (trim($username)!=""){
$sql_q.=" and username='".trim($username)."'";
}
if (trim($realname)!=""){
$sql_q.=" and realname='".trim($realname)."'";
}
$rs_q=$db->get_one($sql_q);
if (empty($rs_q["id"])){
die("没有找到会员");
}
$usernamequery=$rs_q["username"];
}
if (empty($usernamequery)){
$sql="select * from {$db_prefix}users where ifnull(prename,'')='' and ifnull(tjrname,'')=''";
$rs=$db->get_one($sql);
$usernamequery=$rs["username"];
}
$sql_1="select * from {$db_prefix}users where username='".$usernamequery."'";
$rs_1=$db->get_one($sql_1);
if (empty($rs_1["id"])) die("查询用户不存在");
$sql_1_a="select * from {$db_prefix}users where prename='".$usernamequery."' and pos='a'";
$rs_1_a=$db->get_one($sql_1_a);
$sql_1_b="select * from {$db_prefix}users where prename='".$usernamequery."' and pos='b'";
$rs_1_b=$db->get_one($sql_1_b);
$sql_1_c="select * from {$db_prefix}users where prename='".$usernamequery."' and pos='c'";
$rs_1_c=$db->get_one($sql_1_c);
$sql_1_a_a="select * from {$db_prefix}users where prename='".$rs_1_a["username"]."' and pos='a'";
$rs_1_a_a=$db->get_one($sql_1_a_a);
$sql_1_a_b="select * from {$db_prefix}users where prename='".$rs_1_a["username"]."' and pos='b'";
$rs_1_a_b=$db->get_one($sql_1_a_b);
$sql_1_a_c="select * from {$db_prefix}users where prename='".$rs_1_a["username"]."' and pos='c'";
$rs_1_a_c=$db->get_one($sql_1_a_c);
$sql_1_b_a="select * from {$db_prefix}users where prename='".$rs_1_b["username"]."' and pos='a'";
$rs_1_b_a=$db->get_one($sql_1_b_a);
$sql_1_b_b="select * from {$db_prefix}users where prename='".$rs_1_b["username"]."' and pos='b'";
$rs_1_b_b=$db->get_one($sql_1_b_b);
$sql_1_b_c="select * from {$db_prefix}users where prename='".$rs_1_b["username"]."' and pos='c'";
$rs_1_b_c=$db->get_one($sql_1_b_c);
$sql_1_c_a="select * from {$db_prefix}users where prename='".$rs_1_c["username"]."' and pos='a'";
$rs_1_c_a=$db->get_one($sql_1_c_a);
$sql_1_c_b="select * from {$db_prefix}users where prename='".$rs_1_c["username"]."' and pos='b'";
$rs_1_c_b=$db->get_one($sql_1_c_b);
$sql_1_c_c="select * from {$db_prefix}users where prename='".$rs_1_c["username"]."' and pos='c'";
$rs_1_c_c=$db->get_one($sql_1_c_c);
$sql_1_a_a_a="select * from {$db_prefix}users where prename='".$rs_1_a_a["username"]."' and pos='a'";
$rs_1_a_a_a=$db->get_one($sql_1_a_a_a);
$sql_1_a_a_b="select * from {$db_prefix}users where prename='".$rs_1_a_a["username"]."' and pos='b'";
$rs_1_a_a_b=$db->get_one($sql_1_a_a_b);
$sql_1_a_a_c="select * from {$db_prefix}users where prename='".$rs_1_a_a["username"]."' and pos='c'";
$rs_1_a_a_c=$db->get_one($sql_1_a_a_c);
$sql_1_a_b_a="select * from {$db_prefix}users where prename='".$rs_1_a_b["username"]."' and pos='a'";
$rs_1_a_b_a=$db->get_one($sql_1_a_b_a);
$sql_1_a_b_b="select * from {$db_prefix}users where prename='".$rs_1_a_b["username"]."' and pos='b'";
$rs_1_a_b_b=$db->get_one($sql_1_a_b_b);
$sql_1_a_b_c="select * from {$db_prefix}users where prename='".$rs_1_a_b["username"]."' and pos='c'";
$rs_1_a_b_c=$db->get_one($sql_1_a_b_c);
$sql_1_a_c_a="select * from {$db_prefix}users where prename='".$rs_1_a_c["username"]."' and pos='a'";
$rs_1_a_c_a=$db->get_one($sql_1_a_c_a);
$sql_1_a_c_b="select * from {$db_prefix}users where prename='".$rs_1_a_c["username"]."' and pos='b'";
$rs_1_a_c_b=$db->get_one($sql_1_a_c_b);
$sql_1_a_c_c="select * from {$db_prefix}users where prename='".$rs_1_a_c["username"]."' and pos='c'";
$rs_1_a_c_c=$db->get_one($sql_1_a_c_c);
$sql_1_b_a_a="select * from {$db_prefix}users where prename='".$rs_1_b_a["username"]."' and pos='a'";
$rs_1_b_a_a=$db->get_one($sql_1_b_a_a);
$sql_1_b_a_b="select * from {$db_prefix}users where prename='".$rs_1_b_a["username"]."' and pos='b'";
$rs_1_b_a_b=$db->get_one($sql_1_b_a_b);
$sql_1_b_a_c="select * from {$db_prefix}users where prename='".$rs_1_b_a["username"]."' and pos='c'";
$rs_1_b_a_c=$db->get_one($sql_1_b_a_c);
$sql_1_b_b_a="select * from {$db_prefix}users where prename='".$rs_1_b_b["username"]."' and pos='a'";
$rs_1_b_b_a=$db->get_one($sql_1_b_b_a);
$sql_1_b_b_b="select * from {$db_prefix}users where prename='".$rs_1_b_b["username"]."' and pos='b'";
$rs_1_b_b_b=$db->get_one($sql_1_b_b_b);
$sql_1_b_b_c="select * from {$db_prefix}users where prename='".$rs_1_b_b["username"]."' and pos='c'";
$rs_1_b_b_c=$db->get_one($sql_1_b_b_c);
$sql_1_b_c_a="select * from {$db_prefix}users where prename='".$rs_1_b_c["username"]."' and pos='a'";
$rs_1_b_c_a=$db->get_one($sql_1_b_c_a);
$sql_1_b_c_b="select * from {$db_prefix}users where prename='".$rs_1_b_c["username"]."' and pos='b'";
$rs_1_b_c_b=$db->get_one($sql_1_b_c_b);
$sql_1_b_c_c="select * from {$db_prefix}users where prename='".$rs_1_b_c["username"]."' and pos='c'";
$rs_1_b_c_c=$db->get_one($sql_1_b_c_c);
$sql_1_c_a_a="select * from {$db_prefix}users where prename='".$rs_1_c_a["username"]."' and pos='a'";
$rs_1_c_a_a=$db->get_one($sql_1_c_a_a);
$sql_1_c_a_b="select * from {$db_prefix}users where prename='".$rs_1_c_a["username"]."' and pos='b'";
$rs_1_c_a_b=$db->get_one($sql_1_c_a_b);
$sql_1_c_a_c="select * from {$db_prefix}users where prename='".$rs_1_c_a["username"]."' and pos='c'";
$rs_1_c_a_c=$db->get_one($sql_1_c_a_c);
$sql_1_c_b_a="select * from {$db_prefix}users where prename='".$rs_1_c_b["username"]."' and pos='a'";
$rs_1_c_b_a=$db->get_one($sql_1_c_b_a);
$sql_1_c_b_b="select * from {$db_prefix}users where prename='".$rs_1_c_b["username"]."' and pos='b'";
$rs_1_c_b_b=$db->get_one($sql_1_c_b_b);
$sql_1_c_b_c="select * from {$db_prefix}users where prename='".$rs_1_c_b["username"]."' and pos='c'";
$rs_1_c_b_c=$db->get_one($sql_1_c_b_c);
$sql_1_c_c_a="select * from {$db_prefix}users where prename='".$rs_1_c_c["username"]."' and pos='a'";
$rs_1_c_c_a=$db->get_one($sql_1_c_c_a);
$sql_1_c_c_b="select * from {$db_prefix}users where prename='".$rs_1_c_c["username"]."' and pos='b'";
$rs_1_c_c_b=$db->get_one($sql_1_c_c_b);
$sql_1_c_c_c="select * from {$db_prefix}users where prename='".$rs_1_c_c["username"]."' and pos='c'";
$rs_1_c_c_c=$db->get_one($sql_1_c_c_c);
function getcurmonthnew($username){
global $db,$db_prefix,$year,$month;
$sql="select (pv-pv_1) as pv from {$db_prefix}tdpv where year='".$year."' and month='".$month."' and username='".$username."'";
$rs=$db->get_one($sql);
return str_replace(",",'',number_format(empty($rs["pv"])?0.00:$rs["pv"],0));
}
$sql_c1="select * from {$db_prefix}periods where state>0 order by endtime desc limit 1";
$rs_c1=$db->get_one($sql_c1);
$maxtimec1=$rs_c1["endtime"];
function getnewpvnet($username){
global $db,$db_prefix,$maxtimec1,$glo_price;
$sql="select count(id) as c from {$db_prefix}users where confirmtime>'".$maxtimec1."'";
$rs=$db->get_one($sql);
$mc=0;
$mc=empty($rs["c"])?0:$rs["c"];
$mc1=$glo_price*$mc;
return $mc1;
}
;echo '</HEAD><body>

<div align="center" style="margin:5px,0px;">
<form action="?action=query" method="post" name="queryfrm">
    会员编号:<input name="username" type="text"> 姓名:<input name="realname" type="text"> <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but1" value="查询" name="but1">
</form>
</div>
<form name="form1" method="post" action="">
';
if ($usernamequery!=$_SESSION["glo_username"]){
;echo '<div align="center" style="margin:5px,0px;">
    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="上一层" name="but" onClick="location.href=\'?usernamequery=';echo urlencode($rs_1["prename"]);echo '\'">
</div>
';
}
;echo '<TABLE width="900" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="900" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>团队成员</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="24%" height="20" align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1["username"]);echo '">';echo $rs_1["username"];echo '</a><br>
	    ';echo $rs_1["realname"];echo '<br>';echo $rs_1["rank1"];echo '<br>';echo date("Y-m-d",$rs_1["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>

		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1["username"],3);;echo '</td>
		    </tr>
			  <tr>
		    <td align="center">&nbsp;</td>
		    <td align="center">';echo $c0=getnewpvnet($rs_1["username"]);echo '</td>
		    <td align="center">';echo $c1;echo '</td>
		    <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
		    </tr>
		  </tbody>
		</table>

	  ';
}else{
if (!empty($rs_1["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '</TD>
	  <TD width="25%" align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a["username"]);echo '">';echo $rs_1_a["username"];echo '</a><br>
	    ';echo $rs_1_a["realname"];echo '<br>';echo $rs_1_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD width="24%" align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_a["username"]);echo '">';echo $rs_1_a_a["username"];echo '</a><br>
	    ';echo $rs_1_a_a["realname"];echo '<br>';echo $rs_1_a_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a["username"])){
;echo '	 <a href=\'userreg.php?prename=';echo urlencode($rs_1_a["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD width="27%" align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_a_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_a_a["username"]);echo '">';echo $rs_1_a_a_a["username"];echo '</a><br>
	    ';echo $rs_1_a_a_a["realname"];echo '<br>';echo $rs_1_a_a_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_a_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_a_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_a_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_a["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_a_a["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_a["username"]);echo '&pos=a\'>注册</a><br>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_a_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_a_b["username"]);echo '">';echo $rs_1_a_a_b["username"];echo '</a><br>';echo $rs_1_a_a_b["realname"];echo '<br>';echo $rs_1_a_a_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_a_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_a_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_a_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_a_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_a["username"])){
;echo '		<a href=\'userreg.php?prename=';echo urlencode($rs_1_a_a["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_a_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_a_c["username"]);echo '">';echo $rs_1_a_a_c["username"];echo '</a><br>';echo $rs_1_a_a_c["realname"];echo '<br>';echo $rs_1_a_a_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_a_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_a_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_a_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_a_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_a_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_a["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_b["username"]);echo '">';echo $rs_1_a_b["username"];echo '</a><br>';echo $rs_1_a_b["realname"];echo '<br>';echo $rs_1_a_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_b["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a["username"])){
;echo '	 <a href=\'userreg.php?prename=';echo urlencode($rs_1_a["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_b_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_b_a["username"]);echo '">';echo $rs_1_a_b_a["username"];echo '</a><br>';echo $rs_1_a_b_a["realname"];echo '<br>';echo $rs_1_a_b_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_b_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_b_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_b_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_b_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_b["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="80" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_b_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_b_b["username"]);echo '">';echo $rs_1_a_b_b["username"];echo '</a><br>';echo $rs_1_a_b_b["realname"];echo '<br>';echo $rs_1_a_b_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_b_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_b_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_b_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_b_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_b["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_b_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_b_c["username"]);echo '">';echo $rs_1_a_b_c["username"];echo '</a><br>';echo $rs_1_a_b_c["realname"];echo '<br>';echo $rs_1_a_b_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_b_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_b_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_b_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_b_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_b_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_b["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_c["username"]);echo '">';echo $rs_1_a_c["username"];echo '</a><br>';echo $rs_1_a_c["realname"];echo '<br>';echo $rs_1_a_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_c_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_c_a["username"]);echo '">';echo $rs_1_a_c_a["username"];echo '</a><br>';echo $rs_1_a_c_a["realname"];echo '<br>';echo $rs_1_a_c_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_c_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_c_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_c_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_a["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_c_a["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_c["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_c_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_c_b["username"]);echo '">';echo $rs_1_a_c_b["username"];echo '</a><br>';echo $rs_1_a_c_b["realname"];echo '<br>';echo $rs_1_a_c_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_c_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_c_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_c_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_b["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_a_c_b["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_c["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_a_c_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_a_c_c["username"]);echo '">';echo $rs_1_a_c_c["username"];echo '</a><br>';echo $rs_1_a_c_c["realname"];echo '<br>';echo $rs_1_a_c_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_a_c_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_a_c_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_a_c_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_a_c_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_a_c_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_a_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_a_c["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b["username"]);echo '">';echo $rs_1_b["username"];echo '</a><br>';echo $rs_1_b["realname"];echo '<br>';echo $rs_1_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_a["username"]);echo '">';echo $rs_1_b_a["username"];echo '</a><br>';echo $rs_1_b_a["realname"];echo '<br>';echo $rs_1_b_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_a["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_a_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_a_a["username"]);echo '">';echo $rs_1_b_a_a["username"];echo '</a><br>';echo $rs_1_b_a_a["realname"];echo '<br>';echo $rs_1_b_a_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_a_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_a_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_a_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_a["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_a_a["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_a["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_a_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_a_b["username"]);echo '">';echo $rs_1_b_a_b["username"];echo '</a><br>';echo $rs_1_b_a_b["realname"];echo '<br>';echo $rs_1_b_a_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_a_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_a_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_a_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_b["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_a_b["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_a["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_a_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_a_c["username"]);echo '">';echo $rs_1_b_a_c["username"];echo '</a><br>';echo $rs_1_b_a_c["realname"];echo '<br>';echo $rs_1_b_a_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_a_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_a_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_a_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_a_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_a_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_a["username"])){
;echo '	   <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_a["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_b["username"]);echo '">';echo $rs_1_b_b["username"];echo '</a><br>';echo $rs_1_b_b["realname"];echo '<br>';echo $rs_1_b_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_b_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_b_a["username"]);echo '">';echo $rs_1_b_b_a["username"];echo '</a><br>';echo $rs_1_b_b_a["realname"];echo '<br>';echo $rs_1_b_b_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_b_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_b_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_b_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_b_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_b["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_b_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_b_b["username"]);echo '">';echo $rs_1_b_b_b["username"];echo '</a><br>';echo $rs_1_b_b_b["realname"];echo '<br>';echo $rs_1_b_b_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_b_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_b_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_b_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_b_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_b["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_b_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_b_c["username"]);echo '">';echo $rs_1_b_b_c["username"];echo '</a><br>';echo $rs_1_b_b_c["realname"];echo '<br>';echo $rs_1_b_b_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_b_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_b_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_b_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_b_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_b_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_b["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_c["username"]);echo '">';echo $rs_1_b_c["username"];echo '</a><br>';echo $rs_1_b_c["realname"];echo '<br>';echo $rs_1_b_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_c_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_c_a["username"]);echo '">';echo $rs_1_b_c_a["username"];echo '</a><br>';echo $rs_1_b_c_a["realname"];echo '<br>';echo $rs_1_b_c_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_c_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_c_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_c_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_c_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_c["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_c_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_c_b["username"]);echo '">';echo $rs_1_b_c_b["username"];echo '</a><br>';echo $rs_1_b_c_b["realname"];echo '<br>';echo $rs_1_b_c_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_c_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_c_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_c_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_b_c_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_c["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_b_c_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_b_c_c["username"]);echo '">';echo $rs_1_b_c_c["username"];echo '</a><br>';echo $rs_1_b_c_c["realname"];echo '<br>';echo $rs_1_b_c_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_b_c_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_b_c_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_b_c_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_b_c_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_b_c_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_b_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_b_c["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c["username"]);echo '">';echo $rs_1_c["username"];echo '</a><br>';echo $rs_1_c["realname"];echo '<br>';echo $rs_1_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_a["username"]);echo '">';echo $rs_1_c_a["username"];echo '</a><br>';echo $rs_1_c_a["realname"];echo '<br>';echo $rs_1_c_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_a_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_a_a["username"]);echo '">';echo $rs_1_c_a_a["username"];echo '</a><br>';echo $rs_1_c_a_a["realname"];echo '<br>';echo $rs_1_c_a_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_a_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_a_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_a_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_a_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_a["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_a_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_a_b["username"]);echo '">';echo $rs_1_c_a_b["username"];echo '</a><br>';echo $rs_1_c_a_b["realname"];echo '<br>';echo $rs_1_c_a_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_a_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_a_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_a_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_b["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_c_a_b["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_a["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_a_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_a_c["username"]);echo '">';echo $rs_1_c_a_c["username"];echo '</a><br>';echo $rs_1_c_a_c["realname"];echo '<br>';echo $rs_1_c_a_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_a_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_a_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_a_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_a_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_a_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_a["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_a["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_b["username"]);echo '">';echo $rs_1_c_b["username"];echo '</a><br>';echo $rs_1_c_b["realname"];echo '<br>';echo $rs_1_c_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_b_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_b_a["username"]);echo '">';echo $rs_1_c_b_a["username"];echo '</a><br>';echo $rs_1_c_b_a["realname"];echo '<br>';echo $rs_1_c_b_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_b_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_b_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_b_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_a["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_c_b_a["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_b["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_b_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_b_b["username"]);echo '">';echo $rs_1_c_b_b["username"];echo '</a><br>';echo $rs_1_c_b_b["realname"];echo '<br>';echo $rs_1_c_b_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_b_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_b_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_b_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_b_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_b["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_b_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_b_c["username"]);echo '">';echo $rs_1_c_b_c["username"];echo '</a><br>';echo $rs_1_c_b_c["realname"];echo '<br>';echo $rs_1_c_b_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_b_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_b_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_b_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_b_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_b_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_b["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_b["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_c["username"]);echo '">';echo $rs_1_c_c["username"];echo '</a><br>';echo $rs_1_c_c["realname"];echo '<br>';echo $rs_1_c_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c["username"],3);;echo '</td>
		    </tr>
			 <tr>
               <td align="center">&nbsp;</td>
               <td align="center">';echo $c0=getnewpvnet($rs_1_c_c["username"]);echo '</td>
               <td align="center">';echo $c1;echo '</td>
               <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			   </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_c_a["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_c_a["username"]);echo '">';echo $rs_1_c_c_a["username"];echo '</a><br>';echo $rs_1_c_c_a["realname"];echo '<br>';echo $rs_1_c_c_a["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_c_a["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_a["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_c_a["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_c_a["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_a["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_c_a["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_c["username"]);echo '&pos=a\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_c_b["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_c_b["username"]);echo '">';echo $rs_1_c_c_b["username"];echo '</a><br>';echo $rs_1_c_c_b["realname"];echo '<br>';echo $rs_1_c_c_b["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_c_b["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_b["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_c_b["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_c_b["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_b["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_c_b["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_c["username"]);echo '&pos=b\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>
	<TR>
	  <TD height="20" align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" ></TD>
	  <TD align="center" valign="middle" bgColor="#FBFDFF" >';if (!empty($rs_1_c_c_c["id"])) {;echo '<a href="?usernamequery=';echo urlencode($rs_1_c_c_c["username"]);echo '">';echo $rs_1_c_c_c["username"];echo '</a><br>';echo $rs_1_c_c_c["realname"];echo '<br>';echo $rs_1_c_c_c["rank1"];echo '<br>';echo date("Y-m-d",$rs_1_c_c_c["confirmtime"]);echo '<br>
		<table width="100%" border="0" cellspacing="1" bgcolor="#d4e8fa">
		<tbody bgcolor="#FFFFFF">
		  <tr>
		    <td align="center">新增</td>
		    <td align="center">当月新增</td>
		    <td align="center">结余</td>
		    <td align="center">累计</td>
		    </tr>
		  <tr>
		    <td width="70" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_c["username"],1);;echo '</td>
		    <td width="68" align="center">';echo getcurmonthnew($rs_1_c_c_c["username"]);;echo '</td>
		    <td width="68" align="center">';echo $c1=get_clear_param($recentperiods,$rs_1_c_c_c["username"],2);;echo '</td>
		    <td width="60" align="center">';echo get_clear_param($recentperiods,$rs_1_c_c_c["username"],3);;echo '</td>
		    </tr>
			<tr>
              <td align="center">&nbsp;</td>
              <td align="center">';echo $c0=getnewpvnet($rs_1_c_c_c["username"]);echo '</td>
              <td align="center">';echo $c1;echo '</td>
              <td align="center">';echo floatval($c0)+floatval($c1);echo '</td>
			  </tr>
		  </tbody>
		</table>
	  ';
}else{
if (!empty($rs_1_c_c["username"])){
;echo '	  <a href=\'userreg.php?prename=';echo urlencode($rs_1_c_c["username"]);echo '&pos=c\'>注册</a>
	  ';
}
}
;echo '	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>