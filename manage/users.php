<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");include("../include/function.php");include("../include/pageclass.php");include("../include/area.php");include("../include/logcls.php");include("../include/rank.php");include("../include/pv.php");include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/pos.php");
if ($action=="del"){
$modtime=time();
$sqlu="select id from {$db_prefix}users where id>'".$id."' limit 1";
$rsu=$db->get_one($sqlu);
if(!empty($rsu['id'])) {
die("<center>只能删除最后一个会员</center>");
}
$sql="select * from {$db_prefix}users where id='".$id."'";
$rs=$db->get_one($sql);
$bytype=$rs["regtype"];
$byname=$rs["regusername"];
$tjrname=$rs["tjrname"];
$username=$rs["username"];
$prename=$rs["prename"];
$bdnum=$rs["bdnum"];
$sql14="select * from {$db_prefix}users where prename='".trim($username)."'";
$rs4=$db->get_one($sql14);
if (!empty($rs4["id"])) die("<center>该会员已是接点人，不可删除</center>");
$sql14="select * from {$db_prefix}users where tjrname='".trim($username)."'";
$rs4=$db->get_one($sql14);
if (!empty($rs4["id"])) die("<center>该会员已是推荐人，不可删除</center>");
$sql14="select * from {$db_prefix}users where timepre='".trim($username)."'";
$rs4=$db->get_one($sql14);
if (!empty($rs4["id"])) die("<center>该会员的一条线下已有会员，不可删除</center>");
$sql14="select * from {$db_prefix}users where regusername='".trim($username)."'";
$rs4=$db->get_one($sql14);
if (!empty($rs4["id"])) die("<center>该店铺下已有会员存在，不可删除</center>");
$sql1="select * from {$db_prefix}jsrec where username='".$username."' and periods in (select periods from {$db_prefix}periods where state>=1)";
$rs1=$db->get_one($sql1);
if (!empty($rs1["id"])) die("<center>参与过结算的会员不允许删除 </center>");
$sqlyj="select pv_1,num_1,year,month,day from {$db_prefix}tdpv where username='$username' and pv_1>0 and type=0";
$result=$db->query($sqlyj);
if($db->num_rows($result)>0){
while($rsyj=$db->fetch_array($result)){
$year=$rsyj['year'];$month=$rsyj['month'];$day=$rsyj['day'];
$glnetupstr="";
getglnetupstr(trim($prename));
$glnetary=explode(",",$glnetupstr);
foreach($glnetary as $u=>$u1){
updateglnetusertdpv2($u1,-$rsyj['pv_1'],-$rsyj['num_1']);
updateglnettdpv($year,$month,$day,$u1,-$rsyj['pv_1'],-$rsyj['num_1']);
}
$tjnetupstr="";
gettjnetupstr(trim($tjrname));
$tjnetary=explode(",",$tjnetupstr);
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,-$rsyj['pv_1']);
updatetjnettdpv($year,$month,$day,$u1,-$rsyj['pv_1']);
}
}
}
$db->query("update {$db_prefix}users set tjnum=tjnum-1,tjbdnum=tjbdnum-'".$bdnum."' where username='".trim($tjrname)."'");
$sql_1="delete from {$db_prefix}users where id='".$id."'";
$db->query($sql_1);
$db->query("update {$db_prefix}users set timeok=0 where state=1 order by id desc limit 1");
$sql_2="delete from {$db_prefix}tdpv where username='$username'";
$db->query($sql_2);
$sql_3="delete from {$db_prefix}orders where username='".$username."'";
$db->query($sql_3);
$sql_4="delete from {$db_prefix}orders1 where username='".$username."'";
$db->query($sql_4);
$sql_4="delete from {$db_prefix}delta where username='".$username."'";
$db->query($sql_4);
$sql_3="delete from {$db_prefix}e where username='".$username."'";
$db->query($sql_3);
$sql_3="delete from {$db_prefix}remits where username='".$username."'";
$db->query($sql_3);
$sql_3="delete from {$db_prefix}editrankrecord where username='".$username."'";
$db->query($sql_3);
$sql_3="delete from {$db_prefix}applystore where username='".$username."'";
$db->query($sql_3);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=5;$log_addtime=time();$log_ip=getip();$log_memo="删除会员{$username},推荐人{$tjrname},接点人{$prename},注册人{$byname}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:users.php?pageno={$pageno}");exit();
}
if (isset($action) &&$action=="bdzx"){
$sqlu="select username,rank from {$db_prefix}users where id='$id'";
$rsu=$db->get_one($sqlu);
if ($setok==1){
$log_type=15;
$sql="update {$db_prefix}users set isdp=1,rank1=1 where id='".$id."'";
$db->query($sql);
}else{
$log_type=16;
$sqlb="select count(id) as c from {$db_prefix}users where zmdname='".$rsu['username']."'";
$rsb=$db->get_one($sqlb);
if($rsb['c']>0) {
echo "<script>alert('该店铺下已有会员存在');history.back();</script>";exit();
}
$sql="update {$db_prefix}users set isdp=0,rank1=0 where id='".$id."'";
$db->query($sql);
}
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_addtime=time();$log_ip=getip();
$log_memo="会员".$rsu['username'];
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:users.php?pageno={$pageno}");exit();
}
if (isset($action) &&$action=="jjsuoding"){
if ($setok==1){
$sql="update {$db_prefix}users set jjsuoding=0 where id='".$id."'";
$db->query($sql);
}else{
$sql="update {$db_prefix}users set jjsuoding=1 where id='".$id."'";
$db->query($sql);
}
header("location:users.php?pageno={$pageno}");exit();
}
if ($action=="suoding"){
if($sel==0){
foreach($adid as $key1=>$value1){
$sql_1="update {$db_prefix}users set jjsuoding=1 where id='".$value1."'";
$db->query($sql_1);
}
}else{
$sql_1="update {$db_prefix}users set jjsuoding=1 ";
$db->query($sql_1);
}
header("location:?pageno={$pageno}");exit();
}
if ($action=="jiesuo"){
if($sel==0){
foreach($adid as $key1=>$value1){
$sql_1="update {$db_prefix}users set jjsuoding=0 where id='".$value1."'";
$db->query($sql_1);
}
}else{
$sql_1="update {$db_prefix}users set jjsuoding=0 ";
$db->query($sql_1);
}
header("location:?pageno={$pageno}");exit();
}
if(empty($orderbyname)){
$orderbyname="desc";
}else{
if($orderbyname=="asc"){$orderbyname="desc";}else{$orderbyname="asc";}
}
;echo '<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {font-size: 12px}
.STYLE3 {font-size: 12px; font-weight: bold; }
.STYLE4 {
	color: #03515d;
	font-size: 12px;
}
-->
</style>

<script>
var  highlightcolor=\'#c1ebff\';
//此处clickcolor只能用win系统颜色代码才能成功,如果用#xxxxxx的代码就不行,还没搞清楚为什么:(
var  clickcolor=\'#51b2f6\';
function  changeto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=highlightcolor&&source.id!="nc"&&cs[1].style.backgroundColor!=clickcolor)
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=highlightcolor;
}
}

function  changeback(){
if  (event.fromElement.contains(event.toElement)||source.contains(event.toElement)||source.id=="nc")
return
if  (event.toElement!=source&&cs[1].style.backgroundColor!=clickcolor)
//source.style.backgroundColor=originalcolor
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}

function  clickto(){
source=event.srcElement;
if  (source.tagName=="TR"||source.tagName=="TABLE")
return;
while(source.tagName!="TD")
source=source.parentElement;
source=source.parentElement;
cs  =  source.children;
//alert(cs.length);
if  (cs[1].style.backgroundColor!=clickcolor&&source.id!="nc")
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor=clickcolor;
}
else
for(i=0;i<cs.length;i++){
	cs[i].style.backgroundColor="";
}
}
function selectdo(t){ 
	var frm=document.newform;
	if (t.checked){
		for(var i=0;i<frm.elements[\'adid[]\'].length;i++){
			frm.elements[\'adid[]\'][i].checked=true;
		}
	}else{
		for(var i=0;i<frm.elements[\'adid[]\'].length;i++){
			frm.elements[\'adid[]\'][i].checked=false;
		}
	}

}

function button1do(){
	var frm=document.newform;
	var sel=0;
	if(document.getElementById(\'selectall\').checked) sel=1;
	frm.action="?action=suoding&sel="+sel;
	frm.submit();
}
function button2do(){
	var frm=document.newform;
	if(document.getElementById(\'selectall\').checked) sel=1;
	frm.action="?action=jiesuo&sel="+sel;
	frm.submit();
}
</script>

</head>

<body>
<form name="form2" method="post" action="?action=query">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD width=213 height=23>&nbsp;<strong><span class="STYLE3">查询</span></strong></TD>
                <TD>&nbsp;</TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD align="right" valign="middle" bgColor="#FBFDFF" >
			  会员编号
			    <input name="username" type="text" id="username" size="15">
			  推荐人
			    <input name="tjrname" type="text" id="tjrname" size="15">
				接点人
			    <input name="prename" type="text" id="prename" size="15">
			  </td>
              <TD width="15%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
            </TR>

        </table></TD>
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
            <td width="56%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[会员资料]-[会员列表]<span class=\'hint\'>(点击会员编号进入会员前台)</span></td>
              </tr>
            </table></td>
            <td width="44%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="106">&nbsp;</td>
                <td width="106"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="userreg.php">新增会员</a></div></td>
                  </tr>
                </table></td>
                <td width="83"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/33.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="../excel/5.php">导出Excel</a></div></td>
                  </tr>
                </table></td>
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
        <td> 
		<form action="?action=" name="newform" id="newform" method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">

		  <tr>

            <td width="3%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="users.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo '';reset($_GET);if (count($_GET)){while (list($key,$val) = each($_GET)) {if(!is_array($_GET[$key])){echo $key."=".urlencode($_GET[$key])."&";}}};echo 'orderbyname=';echo $orderbyname;;echo '">编号</a></span></div></td>
            <td  height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td> 
            <td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">级别</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">销售级别</span></div></td>
            <td  background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">推荐人</span></div></td>
            <td  height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">接点人</span></div></td>
			<td  height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">报单中心</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">现金钱包</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">奖金钱包</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">奖金累计</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">重消购物账户</span></div></td>
			<td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">报单购物账户</span></div></td>
            <td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册人</span></div></td>
			<td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册时间</span></div></td>
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">确认时间</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
          </tr>
          ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}users where state=1";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($realname)!="") $filter.=" and realname='".trim($realname)."'";
if (trim($tjrname)!="") $filter.=" and tjrname='".trim($tjrname)."'";
if (trim($prename)!="") $filter.=" and prename='".trim($prename)."'";
if (trim($isblank)!="") $filter.=" and isblank='".trim($isblank)."'";
if (trim($pos)!="") $filter.=" and pos='".trim($pos)."'";
if (trim($rank)!="") $filter.=" and rank='".trim($rank)."'";
if (trim($storerank)!="") $filter.=" and storerank='".trim($storerank)."'";
if (isset($gudong)&&$gudong!="all") $filter.=" and gudong='$gudong'";
if (isset($isdp)&&$isdp!="all") $filter.=" and isdp='$isdp'";
if (trim($zmdname)!="") $filter.=" and zmdname='".trim($zmdname)."'";
if (floatval($price_1)>0) $filter.=" and price>='".floatval($price_1)."'";
if (floatval($price_2)>0) $filter.=" and price<='".floatval($price_2)."'";
if (trim($regtime1)!="") $filter.=" and regtime>='".strtotime($regtime1)."'";
if (trim($regtime2)!="") $filter.=" and regtime<='".(strtotime($regtime2)+3600*24)."'";
if (trim($confirmtime1)!="") $filter.=" and confirmtime>='".strtotime($confirmtime1)."'";
if (trim($confirmtime2)!="") $filter.=" and confirmtime<='".(strtotime($confirmtime2)+3600*24)."'";
if (trim($regusername)!="") $filter.=" and regusername='".trim($regusername)."'";
if (trim($regrealname)!="") $filter.=" and regrealname='".trim($regrealname)."'";
if (floatval($price_s1)>0) $filter.=" and price_s>='".floatval($price_s1)."'";
if (floatval($price_s2)>0) $filter.=" and price_s<='".floatval($price_s2)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}users where state=1";
if ($filter!='') $sql.=$filter;
$sql.=" order by id $orderbyname limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$delbool=false;
$sqlu="select id from {$db_prefix}users where id>'".$rs['id']."' limit 1";
$rsu=$db->get_one($sqlu);
if(empty($rsu['id'])) $delbool=true;
$rankname=getuserrank($rs["rank"]);
$rankname1=$rank1ary[$rs["rank1"]];
$noprice=0;
$sqln="select sum(money) as c from {$db_prefix}e1 where username='".$rs['username']."' and state=0";
$rsn=$db->get_one($sqln);
if($rsn['c']>0) $noprice=$rsn['c'];
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">
			  ';echo $rs["id"];if($rs['isblank']) echo "<br><span style='color:red'>空点</span>";;echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="loginusrdo.php?username=';echo urlencode($rs["username"]);echo '" class="letu';echo $rs['rank'];;echo '" target="_blank">
			';echo $rs['username'];if($rs['isdp']) echo "<br><span style='color:red'>店铺</span>";;echo '</a></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["realname"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rankname;echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rankname1;echo '</span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["tjrname"];echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';if($rs['prename']) echo $rs["prename"]."<br>".$posary[$rs['pos']]."区";;echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["zmdname"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="package.php?id=';echo $rs['id'];;echo '&type=1">';echo $rs["price"];echo '</a></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="package.php?id=';echo $rs['id'];;echo '&type=4">';echo $rs["j_price"];echo '</a></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["price_s"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="package.php?id=';echo $rs['id'];;echo '&type=3">';echo $rs["price_repeat"];echo '</a></span></div></td>
           <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="package.php?id=';echo $rs['id'];;echo '&type=2">';echo $rs["price_repeat1"];echo '</a></span></div></td>
			 <!--<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="package.php?id=';echo $rs['id'];;echo '&type=3">';echo $rs["price_shop"];echo '</a></span></div></td>-->
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["regusername"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="';if($rs['confirmtime']!=$rs['regtime']) echo "hint";else echo "STYLE1";;echo '">';echo date("Y-m-d H:i:s",$rs["confirmtime"]);echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE4"><a href="userview.php?id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">查看</a>&nbsp;|&nbsp;<a href="useredit.php?id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">修改</a>';if($delbool){;echo '&nbsp;|&nbsp;<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除?\');">删除</a>
            ';};echo '			';if ($rs['isdp']==1){
;echo '			|&nbsp;<a href="?action=bdzx&setok=2&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" style="color:#ff0000;">取消服务中心</a>&nbsp;
			';
}else{
;echo '			|&nbsp;<a href="?action=bdzx&setok=1&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">设为服务中心</a>';};echo '            </span></div></td>
          </tr>
          ';
}
}
$db->free_result($result);
;echo '	
        </table>
		</form>
		</td>
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
            <td width="43%" class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页			</td>
			';if($dpname!=''){;echo '			<td width="8%" align="center"> <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" onclick="javascript:history.back();" name="but"></td>
			';};echo '            <td width="49%">
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
</body>
</html>
'
?>