<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/pageclass.php");
if ($action=="del"){
$sql="select departmentid from {$db_prefix}admin where id='$id'";
$rs=$db->get_one($sql);
if($rs['departmentid']==7) die("超级管理员无法删除");
$sql_1="delete from {$db_prefix}admin where id='".$id."'";
$db->query($sql_1);
header("location:managers.php?pageno={$pageno}");exit();
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[系统管理]-[管理员设置]</td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="20"><table width="95%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1">&nbsp;</td>
                    <td class="STYLE1">&nbsp;</td>
                  </tr>
                </table></td>
                <td width="100"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="manageradd.php">添加管理员</a></div></td>
                  </tr>
                </table></td>
                <td width="86"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/33.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="departments.php">部门列表</a></div></td>
                  </tr>
                </table></td>
                <td width="26"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"></div></td>
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
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">管理员</span></div></td>
            <td width="29%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">管理员名</span></div></td>
            <td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">所属部门</span></div></td>
          
             <td width="13%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">创建时间</span></div></td>    <td width="13%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">手机</span></div></td> 
            <td width="21%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" class="STYLE1"><div align="center">操作</div></td>
          </tr>
         <input type="hidden" name="chknum" value="0">
';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}admin where 1";
$filter="";
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}admin where 1";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '
          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["realname"];echo '</span></div></td>
            
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["department"];echo '</span></div></td> 
             <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo date("Y-m-d",$rs["addtime"]);echo '</span></div></td> 
              <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $rs["mobile"];echo '</span></div></td>  
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE4"><a href="manageradd.php?action=edit&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '">修改</a>';if($rs['departmentid']!=7 ||($rs['departmentid']==7) &&$rs['id']!=11){;echo '|<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除?\');">删除</a>';};echo '</span></div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
      
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>   
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