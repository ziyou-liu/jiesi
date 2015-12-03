<?php

include("../include/conn.php");include("../include/function.php");
include("../include/pageclass.php");include("../include/rank.php");
if ($action=="del"){
$sql="select * from {$db_prefix}orders where id='".$id."'";
$rs=$db->get_one($sql);
if($rs["state"]>=1) die("<center>有效单不能删除</center>");
$sql1="delete from {$db_prefix}orders where id='".$id."'";
$sql2="delete from {$db_prefix}orders1 where orderid='".$id."'";
$db->query($sql1);$db->query($sql2);
header("location:orders.php?pageno={$pageno}");exit();
}
if($action=='setzt'){
$modtime=time();
$sql="select state from {$db_prefix}orders where id='".$id."'";
$rs=$db->get_one($sql);
if($rs["state"]!=1) die("订单状态错误");
$sql="update {$db_prefix}orders set state=3,shouhuotime='$modtime',ziti=1,fahuotime='$modtime' where id='$id' ";
$db->query($sql);
header("location:orders.php?pageno={$pageno}");exit();
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
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
<form name="form2" method="post" action="?action=query">
  <TABLE width="820" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="820" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>订单查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
            <td width="114" bgColor="#FBFDFF" align="right" >
			<select name="ordertype">
			<option value=\'all\'>所有订单</option>
			<option value="1">注册订单</option>
			<option value="2">升级订单</option>
			<option value="0">重消订单</option>
			<option value="3">自提订单</option>
			</select></td>
              <TD align="right" valign="middle" bgColor="#FBFDFF" >起&nbsp;<input name="time1" type="text" id="time1" size="10" onClick="new WdatePicker()">止&nbsp;
			  <input name="time2" type="text" id="time2" size="10" onClick="new WdatePicker()">
			  </td>
			  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员编号
			  <input name="username" type="text" id="username" size="10">
			  </td>
			  <TD align="right" valign="middle" bgColor="#FBFDFF" >订单编号
			  <input name="orderid" type="text" id="orderid" size="10">
			  </td>
			  <TD valign="middle" bgColor="#FBFDFF" >
			  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">              </TD>
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
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><b>订单查询</b></td>
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
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">订单编号</span></div></td>
            <td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
            <td width="7%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">姓名</span></div></td>
            <td width="8%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">总价格</span></div></td>
           <!--<td width="7%" background="images/bg.gif" bgcolor="#FFFFFF" align="center">pv</td>-->
            <td width="7%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">折扣</span></div></td> 
			<td width="10%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">实际支付</span></div></td>
			<td width="7%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">状态</span></div></td>
            <!--<td width="7%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">类型</span></div></td>-->
			<td width="15%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">时间</span></div></td>
			<td width="16%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">操作</span></div></td>
          </tr>
      ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(a.id) as c from {$db_prefix}orders a,{$db_prefix}users b where a.username=b.username  ";
$filter="";
if ($action=="query"){
if (trim($username)!="") $filter.=" and a.username='".trim($username)."'";
if (trim($time1)!="") $filter.=" and a.addtime>='".strtotime($time1)."'";
if (trim($time2)!="") $filter.=" and a.addtime<='".(strtotime($time2)+3600*24)."'";
if (trim($orderid)!="") $filter.=" and a.id='$orderid'";
if(trim($ordertype)!="all"){
if($ordertype<3){
$filter.=" and a.type1='$ordertype'";
}else{
$filter.=" and a.ziti=1";
}
}
}
if ($action=="sjquery"){
if (trim($orderid)!="") $filter.=" and a.id='$orderid'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select a.* from {$db_prefix}orders a,{$db_prefix}users b where a.username=b.username ";
if ($filter!='') $sql.=$filter;
$sql.=" order by a.id desc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$sqldp="select isdp,rank1 from {$db_prefix}users where username='".$rs['username']."'";
$rsdp=$db->get_one($sqldp);
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];if($rs['type1']==1) echo "<font color='red'>注册</font>";elseif($rs['type1']==2) echo "<font color='red'>升级</font>";if($rs['ziti']) echo "<font color='blue'><br>自提</font>";;echo '</div>
            </div></td>
           <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["realname"];echo '</div>
            </div></td>
           
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["price"];echo '</div>
            </div></td>
			<!--<td bgcolor="#FFFFFF" align="center">';echo $rs["pv"];echo '</td>-->
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo ($rs["zhekou"]*10)."折";echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["price"]*$rs['zhekou'];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo getorderstate($rs["state"]);;echo '</div>
            </div></td>
             <!--<td  bgcolor="#FFFFFF"><div align="center"  bgcolor="#FFFFFF">
              <div align="center">';if($rs['type']==1) echo "普通订单";else echo "<font color='red'>重消订单</font>";;echo '</div>
            </div></td>-->
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d H:i:s",$rs["addtime"]);echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1"><a href="orderview.php?id=';echo $rs["id"];echo '">查看</a>
            ';if($rs["state"]==1){;echo '  | 
			<a href="orders.php?action=setzt&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定此订单为会员自提吗?\');" > <span class="hint">自提</span> </a>   | 
			<a href="sendgoods.php?id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" > 发货 </a>  
			';}if($rs['state']==0){;echo '           | <a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除吗?\');"> 删除</a>';};echo '</div>
            </div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="9"><div align="center"></div></td>
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
            <td width="8%" align="center"> <!--<INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" onclick="javascript:history.back();" name="but">--></td>
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