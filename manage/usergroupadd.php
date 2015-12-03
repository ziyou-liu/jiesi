<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/function.php");include("../include/pageclass.php");
include("../0123456789/1_s.php");include("../include/rank.php");
if ($action=="usergroupadd"){
$hint="";
if (count($id)==0) $hint.="请选择添加到分组的用户\\n";
if ($hint!=""){
echo "<script>alert('{$hint}');location.href='usergroupadd.php?group=".$group."&pageno=".$pageno."';</script>";exit();
}
$modtime=time();
$sql1="select * from {$db_prefix}smsgroup where id='".$group."'";
$rs1=$db->get_one($sql1);
foreach($id as $v){
$sql0="select * from {$db_prefix}smsgroupuser where groupid='".$group."' and userid='".$v."'";
$rs0=$db->get_one($sql0);
if (empty($rs0["id"])){
$sql2="select username,mobile from {$db_prefix}users where id='".$v."'";
$rs2=$db->get_one($sql2);
$sql="insert into {$db_prefix}smsgroupuser(groupid,groupname,userid,username,mobile,addtime) values('".$rs1["id"]."','".$rs1["groupname"]."','".$v."','".$rs2['username']."','".$rs2["mobile"]."','".$modtime."')";
$db->query($sql);
$sql3="update {$db_prefix}smsgroup set nums=nums+1 where id='".$group."'";
$db->query($sql3);
}
}
echo "<script>alert('所选用户已经添加到短信分组!');location.href='usergroupadd.php?group=".$group."&pageno=".$pageno."';</script>";exit();
}
if ($action=="usergroupaddall"){
$hint="";
$modtime=time();
$sql1="select * from {$db_prefix}smsgroup where id='".$group."'";
$rs1=$db->get_one($sql1);
$sqlhy="select id,username,mobile from {$db_prefix}users where 1";
$resulthy=$db->query($sqlhy);
while($rshy=$db->fetch_array($resulthy)){
$sql0="select * from {$db_prefix}smsgroupuser where groupid='".$group."' and userid='".$rshy['id']."'";
$rs0=$db->get_one($sql0);
if (empty($rs0["id"])){
$sql="insert into {$db_prefix}smsgroupuser(groupid,groupname,userid,username,mobile,addtime) values('".$group."','".$rs1["groupname"]."','".$rshy['id']."','".$rshy['username']."','".$rshy["mobile"]."','".$modtime."')";
$db->query($sql);
$sql3="update {$db_prefix}smsgroup set nums=nums+1 where id='".$group."'";
$db->query($sql3);
}
}
$db->free_result($resulthy);
echo "<script>alert('所选用户已经添加到短信分组!');location.href='usergroupadd.php?group=".$group."&pageno=".$pageno."';</script>";exit();
}
;echo '<style type="text/css">
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
		for(var i=0;i<frm.elements[\'id[]\'].length;i++){
			frm.elements[\'id[]\'][i].checked=true;
		}
	}else{
		for(var i=0;i<frm.elements[\'id[]\'].length;i++){
			frm.elements[\'id[]\'][i].checked=false;
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
            <td width="42%" valign="middle"><table width="95%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1">&nbsp;<b>短信分组用户添加</b></td>
              </tr>
            </table></td>
            <td align="center">
			<table border="0" align="right" cellpadding="0" cellspacing="0" width="100%">
              <tr>               
                <td>';
$sqlg="select * from {$db_prefix}smsgroup where id='".$group."'";
$rsg=$db->get_one($sqlg);
;echo '<INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but_1" value="添加到';echo $rsg["groupname"];echo '" name="but_1" onClick="document.newform.submit();"> 

<INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but_1" value="添加全部会员到';echo $rsg["groupname"];echo '" name="but_1" onClick="document.newform.action=\'?action=usergroupaddall\';document.newform.submit();">
</td>

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
        <td background="images/tab_12.gif">&nbsp;</td>
        <td align="center"><form id="form2" name="form2" method="post" action="?action=query">
         
        会员编号：
        <label>
        <input type="text" name="userid" size="10" />
        </label>
        <label>
        <input type="submit" name="Submit" value="查询" />
        </label><input type="hidden" name="group" value=';echo $group;echo '>
  <input type="hidden" name="pageno" value=';echo $pageno;echo '>
        </form>
        </td>
        <td background="images/tab_15.gif">&nbsp;</td>
      </tr>
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td>
		<form name="newform" id="newform" method="post" action="?action=usergroupadd">
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
		    <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1"></span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">序号</span></div></td>            
			<td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
			<td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">推荐人</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">手机号</div>			  <div align="center"></div></td>
			<td width="18%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">注册时间</span></div></td>
          </tr>
 
  <input type="hidden" name="group" value=';echo $group;echo '>
  <input type="hidden" name="pageno" value=';echo $pageno;echo '>
    ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}users where id not in(select userid from {$db_prefix}smsgroupuser where groupid='$group')";
$filter="";
if ($action=="query"){
if (trim($userid)!='') $filter.=" and username='".trim($userid)."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}users where id not in(select userid from {$db_prefix}smsgroupuser where groupid='$group')";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '          <tr>     
<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1"><input name="id[]" type="checkbox" id="id[]" value="';echo $rs["id"];echo '"></div></div></td>		  
 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["id"];echo '</div></div></td>
 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["username"];echo '</div></div></td>
 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["realname"];echo '</div></div></td>
 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo $rs["tjrname"];echo '</div></div></td>
 <td height="20" bgcolor="#FFFFFF">
   <div align="center" class="STYLE1">';echo $rs["mobile"];echo '</div></div></td>
 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">';echo date("Y-m-d",$rs["regtime"]);echo '</div></div></td>
</TR>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
            <td height="20" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      ';
}
$db->free_result($result);
;echo '  
        </table>
		
        <input type="checkbox" name="selectall" value="1" onClick="selectdo(this);" />
        全选
        <input name="pageno" type="hidden" id="pageno" value="';echo $pageno;echo '" />
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
'
?>