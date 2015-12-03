<?php

include("../include/conn.php");include("../include/function.php");
include("../include/pageclass.php");include("../include/ecls.php");
include("../include/rank.php");
function getusernum($rank,$timelimit,$timelimit1){
global $db,$db_prefix;
$c=0;
if($rank!="11"){
$sql="select count(id) from {$db_prefix}users where regtime>='$timelimit' and regtime<='$timelimit1' and rank='$rank' ";
}else{
$sql="select count(id) from {$db_prefix}users where regtime>='$timelimit' and regtime<='$timelimit1' ";
}
$rs=$db->get_one($sql);
$c=$rs["count(id)"];
return $c;
}
function getusernum2($rank,$timelimit1){
global $db,$db_prefix;
$c=0;
if($rank!="11"){
$sql="select count(id) from {$db_prefix}users where regtime<='$timelimit1' and rank='$rank' ";
}else{
$sql="select count(id) from {$db_prefix}users where regtime<='$timelimit1' ";
}
$rs=$db->get_one($sql);
$c=$rs["count(id)"];
return $c;
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
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
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</head>

<body>
<br>
 <form name="form2" method="post" action="tjnetquery.php?action=query">
  <TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="650" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>会员推荐网体业绩查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
			   <TD width="18%" align="right" valign="middle" bgColor="#FBFDFF" >起:
		      <input name="stime1" type="text" id="stime1" size="10" onClick="new WdatePicker()"></TD>
              <TD width="22%" align="right" valign="middle" bgColor="#FBFDFF" >止:
              <input name="stime2" type="text" id="stime2" size="10" onClick="new WdatePicker()"></TD>
			  <TD width="30%" align="right" valign="middle" bgColor="#FBFDFF" >
			  会员编号:
			    <input type="text" name="username" size="20">
			  </TD>
			  <TD width="30%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">
		      </TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>
<table width="650" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td height="30" background="images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">查询结果</span>
				';
if(!empty($action)){echo "(".$stime1."---".$stime2.")";}
;echo '				</td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onMouseOut="changeback()">
         <tr>

            <td width="21%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">起</span></div></td>
            <td width="23%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">止</span></div></td>
            <td width="30%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">会员编号</span></div></td>
			<td width="26%" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">报单</span></div></td>
          </tr>
		  ';
if(!empty($stime1)&&!empty($stime2)){
$totime=strtotime($stime2);
$sql="select sum(t_pv1+t_pv2-pv_1) as c from {$db_prefix}tdpv where username='".$username."' and datediff(concat(year,'-',month,'-',day),from_unixtime(".strtotime($stime1)."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$totime."))<=0";
$result=$db->get_one($sql);
}
;echo '          <tr>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $stime1;;echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $stime2;;echo '</span></div></td>
            <td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';echo $username;;echo '</span></div></td>
			<td bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">';if(!empty($result)){if(!empty($result["c"])) echo $result["c"];else echo "0.00";};echo '</span></div></td>
          </tr>
	
        </table></td>
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
            <td class="STYLE4">&nbsp;&nbsp;</td>
            <td></td>
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