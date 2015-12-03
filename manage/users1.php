<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");include("../include/function.php");include("../include/pageclass.php");include("../include/area.php");include("../include/logcls.php");include("../include/rank.php");include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/pos.php");
if ($action=="del"){
$modtime=time();
$sql="select * from {$db_prefix}users where id='".$id."'";
$rs=$db->get_one($sql);
if($rs['state']!=0) die("会员状态错误");
$username=$rs["username"];
$bytype=$rs["regtype"];
$byname=$rs["zmdname"];
$tjrname=$rs["tjrname"];
$regtime=$rs["regtime"];
$prename=$rs["prename"];
$sql_1="delete from {$db_prefix}users where id='".$id."'";
$db->query($sql_1);
$sql_3="delete from {$db_prefix}orders where username='".$username."'";
$db->query($sql_3);
$sql_4="delete from {$db_prefix}orders1 where username='".$username."'";
$db->query($sql_4);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=5;$log_addtime=time();$log_ip=getip();$log_memo="删除未确认会员{$username},推荐人{$tjrname},接点人{$prename},注册人{$byname}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:users1.php?pageno={$pageno}");exit();
}
if ($action=="confirm"){
$modtime=time();
$sql="select * from {$db_prefix}users where id='".$id."'";
$rs=$db->get_one($sql);
if ($rs["state"]!=0) die("<center>会员状态错误</center>");
$prename=$rs["prename"];$username=$rs["username"];$rank=$rs['rank'];
$bytype=$rs["regtype"];$byname=$rs["zmdname"];
$zmdname=$rs["zmdname"];
$tjrname=$rs["tjrname"];$bdmoney=$rs['bdmoney'];$bdnum=$rs['bdnum'];
$rank=$rs["rank"];
$glo_rname="glo_shopmon_".$rank;
$price_repeat1=$$glo_rname;
$sqlreg="select * from {$db_prefix}users where username='".$byname."'";
$rsreg=$db->get_one($sqlreg);
if ($rsreg['price']<$bdmoney){
echo "<script>alert('注册人{$byname}的电子货币不足{$bdmoney}元');history.back();</script>";exit();
}
$timeok=0;$tjnet=1;
$sql="select id,username from {$db_prefix}users where state=1  and timeok=0 order by confirmtime desc limit 0,1";
$p_rs=$db->get_one($sql);
if(empty($p_rs['id'])) $hint="对不起，当前时间有注册会员操作，请稍后在注册！";
if($hint==''){
$timepre=$p_rs['username'];
$db->query("update {$db_prefix}users set timeok=1 where username='".$timepre."'");
$updatenum=mysql_affected_rows();
if($updatenum<1) $hint="对不起，当前时间有注册会员操作，请稍后在注册！";
}
$sql_state="update {$db_prefix}users set state=1,timeok='$timeok',confirmtime='".$modtime."',price_repeat1='".$price_repeat1."',timepre='".$timepre."',tjnet='$tjnet' where id='".$id."'";
$db->query($sql_state);
$rank1=0;
$rstj=$db->get_one("select tjnum from {$db_prefix}users where username='".trim($tjrname)."' limit 1");
for($i=1;$i<=6;$i++){
$glotjnum="glo_xstjnum_".$i;
$tjnums=$$glotjnum-1;
if($rstj['tjnum']>=$tjnums){
$rank1=$i;
}
}
$db->query("update {$db_prefix}users set tjnum=tjnum+1,tjbdnum=tjbdnum+'".$bdnum."',rank1='$rank1' where username='".trim($tjrname)."'");
$sqlt="select rank,isdp from {$db_prefix}users where username='".trim($tjrname)."' limit 1";
$rst=$db->get_one($sqlt);
if($rst['rank']>=5 &&$rst['isdp']==1){
$db->query("update {$db_prefix}users set bdtjnum=bdtjnum+1 where username='".trim($tjrname)."' limit 1");
}
$db->query("update {$db_prefix}orders set state=1,zftime='$modtime' where id='".$rs['orderid']."'");
$db->query("update {$db_prefix}orders1 set state=1,zftime='$modtime' where orderid='".$rs['orderid']."'");
$sql_state="update {$db_prefix}users set price=price-".floatval($bdmoney)." where username='".$byname."'";
$db->query($sql_state);
$memo=11;$type=2;$optime=$modtime;$memo1="后台确认会员".$username;
eclsproc($byname,$memo,$bdmoney,$type,$optime,$memo1);
if($bdmoney>0){
$year=date("Y",$modtime);$month=date("m",$modtime);$day=date("d",$modtime);
insertintopv_1($year,$month,$day,$username,$bdmoney,$bdnum);
$glnetupstr="";
getglnetupstr(trim($prename));
$glnetary=explode(",",$glnetupstr);
foreach($glnetary as $u=>$u1){
updateglnetusertdpv2($u1,$bdmoney,$bdnum);
updateglnettdpv($year,$month,$day,$u1,$bdmoney,$bdnum);
}
$tjnetupstr="";
gettjnetupstr(trim($tjrname));
$tjnetary=explode(",",$tjnetupstr);
foreach($tjnetary as $u=>$u1){
updatetjnetusertdpv2($u1,$bdmoney);
updatetjnettdpv($year,$month,$day,$u1,$bdmoney);
}
}
require("../autopw.php");
header("location:users1.php?pageno={$pageno}");exit();
}
if(empty($orderbyname)){
$orderbyname="asc";
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
</script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[会员资料]-[未确认会员列表]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="106">&nbsp;</td>
                <td width="106"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"></div></td>
                  </tr>
                </table></td>
                <td width="83">&nbsp;</td>
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
	 <tr><td colspan=""></td></tr>
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
		  <tr>
			  <td colspan="10" align="center">
			  <form name="qfrm" method="post" action="users1.php?action=query">
			  会员编号
			  <input type="text" name=\'username\' value=\'\' size="15">
			  推荐人
			  <input type="text" name=\'tjrname\' value=\'\' size="15">
			  接点人
			  <input type="text" name=\'prename\' value=\'\' size="15">
			  <input type="submit" name="qbut" class="button_text" value="查询">
			  </form>
			  </td>
		  </tr>
          <tr>

            <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="users1.php?';reset($_POST);if (count($_POST)){while (list($key,$val) = each($_POST)) {if(!is_array($_POST[$key])){echo $key."=".urlencode($_POST[$key])."&";}}};echo '';reset($_GET);if (count($_GET)){while (list($key,$val) = each($_GET)) {if(!is_array($_GET[$key])){echo $key."=".urlencode($_GET[$key])."&";}}};echo 'orderbyname=';echo $orderbyname;;echo '">编号</a></span></div></td>
            <td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
			<td width="6%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">级别</span></div></td>
            <td width="9%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">推荐人</span></div></td>
            <td width="9%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">接点人</span></div></td>
			
			<!--<td width="7%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">是否商务中心</td>-->
			<td width="11%" align="center" background="images/bg.gif" bgcolor="#FFFFFF">所属报单中心</td>
			
			<td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">区位</span></div></td>
			
			<!--<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">口袋金额</span></div></td>-->
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册人</span></div></td>
			<td width="16%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册时间</span></div></td>
            <td width="16%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
          </tr>
          ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}users where 1 and state=0";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($tjrname)!="") $filter.=" and tjrname='".trim($tjrname)."'";
if (trim($prename)!="") $filter.=" and prename='".trim($prename)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}users where 1 and state=0";
if ($filter!='') $sql.=$filter;
$sql.=" order by id $orderbyname limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$rankname=getuserrank($rs["rank"]);
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><span class="letu';echo $rs['rank'];;echo '">';echo $rs["username"];echo '</span></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["realname"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rankname;echo '</span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["tjrname"];echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["prename"];echo '</span></div></td>
			<!--<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">';echo ($rs["isdp"]==1)?"是店铺":"否";;echo '</span></td>-->
			<td align="center" bgcolor="#FFFFFF"><span class="STYLE1">';echo $rs["zmdname"];echo '</span></td>
			
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $posary[$rs["pos"]];echo '区</span></div></td>
			
			<!--<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["price"];echo '</span></div></td>-->
			<td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["regusername"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE4"><a href="userview.php?id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">查看</a>&nbsp;|<a href="?action=confirm&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定确认会员吗?\')">确认</a>|&nbsp;<a href="useredit.php?id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">修改</a>&nbsp;|&nbsp;<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除?\');">删除</a></span></div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="11"><div align="center"></div></td>
  
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
            <td class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页			</td>
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
</body>
</html>
';
?>