<?php

include("../include/conn.php");include("../include/function.php");
include("../include/rate.php");include("../include/ecls.php");
include("../include/pageclass.php");
if(!empty($action1)){
$totime=strtotime($sstime2);
$sql="select * from {$db_prefix}periods where '".strtotime($sstime2)."'>=begintime and '$totime'<=endtime and state>=1";
$top_res=$db->get_one($sql);
if(empty($top_res)||empty($sstime2)){
$hint="您所查询的日期没有结算，或是记录不存在！";
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'pvsalaryquery.php?action=';echo $action;;echo '&stime1=';echo $stime1;;echo '&stime2=';echo $stime2;;echo '\';</script>
	 ';exit();
}
}
if(!empty($action)){
$totime=strtotime($stime2);
$sql="select * from {$db_prefix}periods where '".strtotime($stime2)."'>=begintime and '$totime'<=endtime and state>=1";
$top_res=$db->get_one($sql);
if(empty($top_res)||empty($stime2)){
$hint="您所查询的日期没有结算，或是记录不存在！";
;echo '	<script>alert(\'';echo $hint;;echo '\');location.href=\'pvsalaryquery.php?action1=';echo $action1;;echo '&sstime2=';echo $sstime2;;echo '\';</script>
	 ';exit();
}
}
function getusertimepv($username,$timelimit,$timelimit2){
global $db,$db_prefix;
if(!empty($timelimit2)&&!empty($timelimit)){
$sql="select sum(pv1+pv2) as c from {$db_prefix}tdpv where username='".$username."' and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$result=$db->get_one($sql);
return $result["c"];
}else return;
}
function netfee($type,$timelimit1,$timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)&&!empty($timelimit1)){
$sql="select sum(money) as c from {$db_prefix}e where memo='$type' and addtime>='$timelimit1' and addtime<='$timelimit2' and type=2 ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
}
function netfee3($type,$timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)){
$sql="select sum(money) as c from {$db_prefix}e where memo='$type' and addtime<='$timelimit2' and type=2 ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
}
function getnotblank($timelimit2) {
global $db,$db_prefix,$glo_regprice;
if(!empty($timelimit2)){
$sql="select count(id) as c from {$db_prefix}users where confirmtime<='$timelimit2' and isblank=0";
$res=$db->get_one($sql);
return $res["c"]*$glo_regprice;
}else{
return;
}
}
function getspannotblank($timelimit1,$timelimit2) {
global $db,$db_prefix,$glo_regprice;
if(!empty($timelimit2)){
$sql="select count(id) as c from {$db_prefix}users where confirmtime<='$timelimit2' and confirmtime>='$timelimit1' and isblank=0";
$res=$db->get_one($sql);
return $res["c"]*$glo_regprice;
}else{
return;
}
}
function repeatfee($type,$timelimit1,$timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)&&!empty($timelimit1)){
$sql="select sum(price) as c from {$db_prefix}orders where type='$type' and zftime>='$timelimit1' and zftime<='$timelimit2' ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
}
function repeatfee3($type,$timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)){
$sql="select sum(price) as c from {$db_prefix}orders where type='$type' and zftime<='$timelimit2' ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
}
function netfee2($timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)){
$sql="select sum(money) as c from {$db_prefix}e where (memo='17' or memo='18') and addtime<='$timelimit2' and type=2 ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
}
function repeatfee2($timelimit2) {
global $db,$db_prefix;
if(!empty($timelimit2)){
$sql="select sum(price) as c from {$db_prefix}orders where (type='5' or type='6') and zftime<='$timelimit2' ";
$res=$db->get_one($sql);
return $res["c"];
}else{
return;
}
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

<body><br>
<form name="form2" method="post" action="pvsalaryquery.php?action1=query">
 <input type="hidden" name="action" value="';echo $action;;echo '">
 <input type="hidden" name="stime1" value="';echo $stime1;;echo '">
 <input type="hidden" name="stime2" value="';echo $stime2;;echo '">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>非积分营业额总额查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="19%" align="right" valign="middle" bgColor="#FBFDFF" >请选择日期:
              <input name="sstime2" type="text" id="sstime2" size="10" onClick="new WdatePicker()"></TD>
              <TD width="33%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>

  <TABLE width="100%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="100%" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>初始化至查询日总额统计';if(!empty($sstime2)) echo "(至".$sstime2.")";;echo '</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">网络管理费总额</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">会员重复消费总额</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">体验装订购总额</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">3%的提现费率总额</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">各项非积分营业总额</TD>
            </TR>
			';
$temp=strtotime($sstime2)+24*60*60;
$t_time2=strtotime($sstime2);
$sql="select * from {$db_prefix}periods where 1 and '".$t_time2."'>=begintime order by id desc ";
$t_rs=$db->get_one($sql);
if(!empty($t_rs["periods"])){
$sql="select sum(repeat_price) as c from {$db_prefix}jsrec where periods<='".$t_rs["periods"]."'";
$r_res=$db->get_one($sql);
}
;echo '			<TR>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa1=getnotblank($temp);};echo '</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa2=$r_res["c"];};echo '</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa3=repeatfee3('5',$temp);};echo '</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa4=netfee3('18',$temp);};echo '</TD>
			  <TD align="right" valign="middle" bgColor="#FBFDFF">';if(!empty($action1)){echo $aa1+$aa2+$aa3+$aa4;};echo '			  ';
;echo '			  </TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>

<!--
<form name="form2" method="post" action="?action=query">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>奖金拨出及拨出率</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="15%" align="right" valign="middle" bgColor="#FBFDFF" >起:</TD>
              <TD width="14%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="time1" type="text" id="time1" size="10" onClick="new WdatePicker()"></TD>
              <TD width="6%" align="right" valign="middle" bgColor="#FBFDFF" >止:</TD>
              <TD width="16%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="time2" type="text" id="time2" size="10" onClick="new WdatePicker()"></TD><TD width="49%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
            </TR>
        </table></TD>
      </TR>
  </TABLE>
</form>
-->
<form name="form2" method="post" action="pvsalaryquery.php?action=query">
<input type="hidden" name="action1" value="';echo $action1;;echo '">
  <input type="hidden" name="sstime2" value="';echo $sstime2;;echo '">
  <TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="600" colSpan=4  background="images/bg.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD>&nbsp;<strong>非积分营业额查询</strong></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
			  <TD width="19%" align="right" valign="middle" bgColor="#FBFDFF" >起:
		      <input name="stime1" type="text" id="time1" size="10" onClick="new WdatePicker()"></TD>
              <TD width="19%" align="right" valign="middle" bgColor="#FBFDFF" >止:
              <input name="stime2" type="text" id="time2" size="10" onClick="new WdatePicker()"></TD>
              <TD width="33%" height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
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
                <td width="95%" class="STYLE1"><span class="STYLE3">查询结果</span>
				';
if(!empty($action)){echo "(".$stime1."---".$stime2.")";}
;echo '				</td>
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
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onMouseOut="changeback()">
          <tr>
		    <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">期数</span> </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">起</span></div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">止</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">网络管理费</span> </div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">会员重复消费额</span></div></td>
            <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">体验装订购额</span></div></td>
            <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">3%的提现费率</span></div></td>
            <td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center">
			<span class="STYLE1">当期总额</span></div></td>
          </tr>
		    ';
if(!empty($action)){
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$sqlc="select count(id) as c from {$db_prefix}periods where 1";
$filter="";
if ($action=="query"){
if (trim($stime1)!="") $filter.=" and endtime>='".strtotime($stime1)."'";
if (trim($stime2)!="") $filter.=" and begintime<='".(strtotime($stime2))."'";
}
if ($filter!='') $sqlc.=$filter;
$rs=$db->get_one($sqlc);
$recnum=$rs['c'];
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
$sql="select * from {$db_prefix}periods where 1";
if ($filter!='') $sql.=$filter;
$sql.=" order by id asc limit ".$bgpos.",".$pagesize;
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
$time1="";$time2="";
$n1=0;$n2=0;$a1=0;$a2=0;$a3=0;$a4=0;$total=0;
$sql="select * from {$db_prefix}periods where periods='".$rs["periods"]."' ";
$rs2=$db->get_one($sql);
if(!empty($rs2)){
$time1=$rs2["begintime"];$time2=$rs2["endtime"]+24*60*60;
$periods=$rs2["begintime"];
}
;echo '          <tr>
		    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo $rs["periods"];};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo date("Y-m-d",$time1);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo date("Y-m-d",$time2-24*60*60);};echo '</div>
            </div></td>
		    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo $a1=getspannotblank($time1,$time2);};echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){
$sql="select sum(repeat_price) as c from {$db_prefix}jsrec where periods='".$rs["periods"]."'";
$r_res=$db->get_one($sql);
echo $a2=$r_res["c"];
};echo '</div>
            </div></td>
            <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo $a3=repeatfee('5',$time1,$time2);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($action)){echo $a4=netfee('18',$time1,$time2);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $a1+$a2+$a3+$a4;;echo '</div>
            </div></td>
          </tr>
		   ';}}};echo '        </table></td>
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
                ';};echo '                    <input name="pageno" type="text" size="4" style="height:12px; width:20px; border:1px solid #999999;" />
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