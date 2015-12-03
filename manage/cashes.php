<?php

include("../include/conn.php");include("../include/function.php");
include("../include/pageclass.php");include("../include/ecls.php");
include("../include/logcls.php");include("../include/smsset.php");
if ($action=="del"){
$sql="select * from {$db_prefix}cashes where id='".$id."'";
$rs=$db->get_one($sql);
if ($rs["state"]==1) die("有效提现申请不能删除!");
$sql_1="delete from {$db_prefix}cashes where id='".$id."'";
$db->query($sql_1);
header("location:cashes.php?pageno={$pageno}");exit();
}
if ($action=="agree"){
$modtime=time();
$sql="select * from {$db_prefix}cashes where id='".$id."'";
$rs=$db->get_one($sql);
if ($rs["state"]!=0) die("提现申请状态错误!");
$price=$rs["price"];$hyusername=$rs["username"];
$price2=$price*$glo_withdraw_fee/100;
$total=$price;
$realprice=$price-$price2;
$sql_chk="select j_price,mobile from {$db_prefix}users where username='".$hyusername."'";
$rs_chk=$db->get_one($sql_chk);
$mobile=$rs_chk['mobile'];
if ($rs_chk["j_price"]<$total) {echo "<script>alert('该会员的奖金币余额不足！');history.back();</script>";exit();}
$sql_2="update {$db_prefix}cashes set state=1,fee='$price2' where id='".$id."'";
$db->query($sql_2);
$sql_1="update {$db_prefix}users set j_price=j_price-'$total' where username='".$hyusername."'";
$db->query($sql_1);
$memo=3;$type=2;$optime=time();$money=$realprice;$memo1="提现编号".$id;
eclsproc($hyusername,$memo,$money,$type,$optime,$memo1,1);
if($price2>0){
$memo=15;$type=2;$optime=time();$money=$price2;$memo1="提现编号".$id;
eclsproc($hyusername,$memo,$money,$type,$optime,$memo1,1);
}
if($glo_post_3_close &&$mobile){
$bianhao=$hyusername;
$bankname=$rs["bank"];
$money=$realprice;
$remitname=$rs["huzhu"];
$num=$rs["zhanghao"];
$gloregsms=$glo_post_3;
eval("\$gloregsms = \"$gloregsms\";");
$content=$gloregsms;
$content1=rawurlencode(trim($content));
$modtime=time();
$sql="insert into {$db_prefix}smsrec(gid,mobile,content,outmsg,sendtime) values('3','".$mobile."','".$content."','0','".$modtime."')";
$db->query($sql);
$gid=$db->insert_id();
$web_duanxin_paw=md5($web_duanxin_paw);
$url ="http://api.52ao.com/?user={$web_duanxin_user}&pass={$web_duanxin_paw}&mobile={$mobile}&content={$content1}&encode=utf-8";
$smsreturn=smsGet($url);
if ($smsreturn==200){
$sqlgx="update {$db_prefix}smsrec set outmsg=1,state=1 where id='$gid'";
$db->query($sqlgx);
}
}
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=10;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}同意会员 {$username}提现 编号{$id}";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
header("location:cashes.php?pageno={$pageno}");exit();
}
if ($action=="refuse"){
$sql="select * from {$db_prefix}cashes where id='".$id."'";
$rs=$db->get_one($sql);
if ($rs["state"]!=0) die("提现申请状态错误!");
$price=$rs["price"];
$price2=$price*$glo_withdraw_fee/100;
$sql_2="update {$db_prefix}cashes set state=2,fee='$price2' where id='".$id."'";
$db->query($sql_2);
header("location:cashes.php?pageno={$pageno}");exit();
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
<head>
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
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
function confirm_agree(){
	if(confirm(\'确定要同意吗？\')){
		document.getElmentById(\'link_agree\').value="提交中..";
		document.getElmentById(\'link_agree\').disabled="disabled";
		return true;
	}else{
		return false;
	}
}
</script>

</head>

<body><br>
<form name="form2" method="post" action="?action=query">
  <TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="650" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD width=213 height=23>&nbsp;<span class="STYLE3">提现查询</span><strong></strong></TD>
                <TD>&nbsp;</TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="9%" align="right" valign="middle" bgColor="#FBFDFF" >时间:</TD>
              <TD width="33%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="time1" type="text" id="time1" size="10" onClick="new WdatePicker()">
                -
              <input name="time2" type="text" id="time2" size="10" onClick="new WdatePicker()"></TD>
              <TD width="33%" align="right" valign="middle" bgColor="#FBFDFF" >会员编号
			    <input name="username" type="text" id="username">
			  </td>
			  <TD width="33%" align="right" valign="middle" bgColor="#FBFDFF" >状态
			  <select name="state">
			    <option value="all">所有</option>
				<option value="0">未审核</option>
			    <option value="1">审核通过</option>
				<option value="2">审核未通过</option>
			  </select>
			  </td>
              <TD width="25%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" background="images/tab_05.gif">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">提现管理</span></td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="14">&nbsp;</td>
                <td width="106"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1"><div align="center"><img src="images/22.gif" width="14" height="14" /></div></td>
                    <td class="STYLE1"><div align="center"><a href="../excel/3.php?state=';echo $state;;echo '&username=';echo $username;;echo '&time1=';echo $time1;;echo '&time2=';echo $time2;;echo '&action=';echo $action;;echo '">导出excel</a></div></td>
                  </tr>
                </table></td>
                <td width="83"></td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">编号</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">收款人姓名</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">提现银行</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">银行账号</span></div></td>
            <td width="8%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">金额</span></div></td>
            <td width="8%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">手续费</span></div></td>
            <td width="8%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">实际金额</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">申请时间</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">状态</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF" ><div align="center"><span class="STYLE1">操作</span></div></td>
          </tr>
     ';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}cashes where 1";
$filter="";
if ($action=="query"){
if (trim($time1)!="") $filter.=" and addtime>='".timestr2unix($time1)."'";
if (trim($time2)!="") $filter.=" and addtime<='".(timestr2unix($time2)+3600*24)."'";
if (trim($username)!="") $filter.=" and username='$username'";
if (trim($state)!="all") $filter.=" and state='$state'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}cashes where 1";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["id"];echo '</div>
            </div></td>
       <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["huzhu"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["bank"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["zhanghao"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["price"];echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if($rs['state']==0) echo $sxf=$rs["price"]*$glo_withdraw_fee/100;else echo $rs['fee'];;echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if($rs['state']==0)echo $rs["price"]-$sxf;else echo $rs['price']-$rs['fee'];;echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d",$rs["addtime"]);;echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo getcashstate($rs["state"]);echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if($rs["state"]==0){;echo '			  <a href="?action=agree&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" id="link_agree" onClick="return confirm_agree();">同意</a>&nbsp;|&nbsp;<a href="?action=refuse&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定拒绝吗?\')">拒绝</a>';}if($rs['state']!=1){;echo '&nbsp;|&nbsp;<a href="?action=del&id=';echo $rs["id"];echo '&pageno=';echo $pageno;echo '" onClick="return confirm(\'确定删除吗?\')">删除</a>';};echo '</div>
            </div></td>
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