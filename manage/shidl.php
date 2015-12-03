<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");include("../include/function.php");include("../include/pageclass.php");include("../include/area.php");include("../include/logcls.php");include("../include/rank.php");include("../include/pv.php");include("../0123456789/1_s.php");include("../include/ecls.php");include("../include/pos.php");
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[会员资料]-[会员列表]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>

            <td width="5%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">编号</span></div></td>
            <td width="8%"  height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
			<td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">区位</span></div></td>
            <td width="8%"  background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">推荐人</span></div></td>
            <td width="8%"  height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">接点人</span></div></td>
			 <td width="4%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">级别</span></div></td>
			 <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">店铺级别</span></div></td>
			 <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">所属店铺</span></div></td>
			 <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">体验店</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">形象店</span></div></td>
			<td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册人</span></div></td>
			 
			<td width="15%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册时间</span></div></td>
           
          </tr>
          ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}users where 1 and isdp=1 and rank1=3";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and username='".trim($username)."'";
if (trim($realname)!="") $filter.=" and realname='".trim($realname)."'";
if (trim($tjrname)!="") $filter.=" and tjrname='".trim($tjrname)."'";
if (trim($prename)!="") $filter.=" and prename='".trim($prename)."'";
if (trim($pos)!="") $filter.=" and pos='".trim($pos)."'";
if (trim($rank)!="") $filter.=" and rank='".trim($rank)."'";
if (trim($rank1)!="") $filter.=" and rank1='".trim($rank1)."'";
if (isset($isdp)&&$isdp!="all") $filter.=" and isdp='$isdp'";
if (trim($zmdname)!="") $filter.=" and zmdname='".trim($zmdname)."'";
if (floatval($price_1)>0) $filter.=" and price>='".floatval($price_1)."'";
if (floatval($price_2)>0) $filter.=" and price<='".floatval($price_2)."'";
if (trim($regtime1)!="") $filter.=" and regtime>='".strtotime($regtime1)."'";
if (trim($regtime2)!="") $filter.=" and regtime<='".(strtotime($regtime2)+3600*24)."'";
if (trim($regusername)!="") $filter.=" and regusername='".trim($regusername)."'";
if (trim($regrealname)!="") $filter.=" and regrealname='".trim($regrealname)."'";
if (floatval($price_s1)>0) $filter.=" and price_s>='".floatval($price_s1)."'";
if (floatval($price_s2)>0) $filter.=" and price_s<='".floatval($price_s2)."'";
if (floatval($price_s11)>0) $filter.=" and price_shop>='".floatval($price_s11)."'";
if (floatval($price_s22)>0) $filter.=" and price_shop<='".floatval($price_s22)."'";
}
if ($action=="query1"){
if (trim($confirmtime1)!="") $filter.=" and confirmtime>='".timestr2unix($confirmtime1)."'";
if (trim($confirmtime2)!="") $filter.=" and confirmtime<='".(timestr2unix($confirmtime2)+3600*24)."'";
if ($emailchk==1) $filter.=" and ifnull(email,'')=''";else $filter.=" and ifnull(email,'')!=''";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}users where 1 and isdp=1 and rank1=3";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$rankname=getuserrank($rs["rank"]);
$sqlt="select count(id) as c from {$db_prefix}users where state=1 and isdp=1 and rank1=1 and store_province='".$rs['store_province']."' and store_city='".$rs['store_city']."'";
$rst=$db->get_one($sqlt);
$sqlx="select count(id) as c from {$db_prefix}users where state=1 and isdp=1 and rank1=2 and store_province='".$rs['store_province']."' and store_city='".$rs['store_city']."'";
$rsx=$db->get_one($sqlx);
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="loginusrdo.php?username=';echo urlencode($rs["username"]);echo '" target="_blank">
			';echo $rs['username'];
if($rs['isbwang']==1){
echo "<br><span style='color:red'>B网</span>";
}
;echo '</a></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["realname"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["pos"];echo '区</span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["tjrname"];echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["prename"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rankname;echo '</span></div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo "<span style='color:red;'>".$rankary1[$rs['rank1']]."</span>";;echo '</span></div></td>
             <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["zmdname"];echo '</span></div></td>
			
			
			
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="users.php?dpname=';echo $rs['username'];;echo '&rank=1">';echo $rst['c'];;echo '</a></span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"><a href="users.php?dpname=';echo $rs['username'];;echo '&rank=2">';echo $rsx["c"];echo '</a></span></div></td>
			
			<td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["regusername"];echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</span></div></td>
			
          
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="13"><div align="center"></div></td>
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
'
?>