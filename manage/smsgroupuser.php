<?php

include("../include/conn.php");
include("../include/pageclass.php");
if ($action=="del"){
$sql_1="delete from {$db_prefix}smsgroupuser where id='".$id."'";
$db->query($sql_1);
$sql_2="update {$db_prefix}smsgroup set nums=nums-1 where id='".$group."'";
$db->query($sql_2);
header("location:smsgroupuser.php?group=".$group."&pageno={$pageno}");exit();
}
if ($action=="delall"){
foreach($uid as $id){
$sqldo="delete from {$db_prefix}smsgroupuser where id='".$id."'";
$db->query($sqldo);
$sql_2="update {$db_prefix}smsgroup set nums=nums-1 where id='".$group."'";
$db->query($sql_2);
}
header("location:smsgroupuser.php?group=".$group."&pageno={$pageno}");exit();
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<title>无标题文档</title>
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
		for(var i=0;i<frm.elements[\'uid[]\'].length;i++){
			frm.elements[\'uid[]\'][i].checked=true;
		}
	}else{
		for(var i=0;i<frm.elements[\'uid[]\'].length;i++){
			frm.elements[\'uid[]\'][i].checked=false;
		}
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
                <td width="95%" class="STYLE1">&nbsp;<b>分组用户列表</b></td>
              </tr>
            </table></td>
            <td width="54%">&nbsp;</td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="images/tab_12.gif">&nbsp;</td>
        <td align="center"><form id="form1" name="form1" method="post" action="?action=query">
          会员编号：
          <label>
          <input name="username" type="text" id="username" size="10" />
          </label>
                <input type="submit" name="Submit" value="查询" />
        </form>
        </td>
        <td background="images/tab_15.gif">&nbsp;</td>
      </tr>
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><form id="newform" name="newform" method="post" action="?action=delall">
          <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
            <tr>
              <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">序号</span></div></td>
              <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">分组</span></div></td>
              <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">用户名</span></div></td>
              <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">手机</span></div></td>
              <td width="18%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">添加时间</span></div></td>
              <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">操作</span></div></td>
            </tr>
            ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}smsgroupuser where 1 and groupid='".$group."'";
$filter="";
if($action=='query'){
if (trim($username)!='') $filter.=" and username='".trim($username)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}smsgroupuser where 1 and groupid='".$group."'";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '            <tr>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
                  <input type="checkbox" name="uid[]" value="';echo $rs['id'];echo '" />
                  ';echo $rs["id"];echo '</div>
                  </div></td>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["groupname"];echo '</div>
                  </div></td>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["username"];echo '</div>
                  </div></td>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["mobile"];echo '</div>
                  </div></td>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo date("Y-m-d",$rs["addtime"]);echo '</div>
                  </div></td>
              <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1"><a href="?action=del&amp;group=';echo $group;echo '&amp;id=';echo $rs["id"];echo '&amp;pageno=';echo $pageno;echo '" onclick="return confirm(\'确定删除?\');">删除</a></div>
                  </div></td>
            </tr>
            ';
}
}else{
;echo '            <tr>
              <td height="20" bgcolor="#FFFFFF" colspan="6"><div align="center"></div></td>
            </tr>
            ';
}
$db->free_result($result);
;echo '          </table>
              
          <input type="submit" name="Submit2" value="删除" />
          <input type="checkbox" name="selectall" value="1" onClick="selectdo(this);" />
        全选
        <input name="pageno" type="hidden" id="pageno" value="';echo $pageno;echo '" />
		  <input type="hidden" name="group" value="';echo $group;echo '" />
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
</body>
</html>
';
?>