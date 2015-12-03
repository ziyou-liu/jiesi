<?php

include("../include/conn.php");
include("../include/function.php");
include("../include/rank.php");
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员统计</title>
<script language="javascript" src="../include/ajax.js" type="text/javascript"></script>
<script language="javascript" src="../include/js.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td,.STYLE1 {font-size: 12px}
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

<body style="margin:0px;">
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[查询系统]-[会员统计]</td>
              </tr>
            </table></td>
             <td width="54%" align="center">&nbsp;</td>
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
        <td align="center"><form id="form1" name="form1" method="post" action="hytjquery.php?action=query">
          注册时间
          <input name="regtime1" type="text" id="regtime1" size="10" onClick="new WdatePicker()">
	    -
	    <input name="regtime2" type="text" id="regtime2" size="10"onClick="new WdatePicker()">
          <label>
              <input type="submit" name="Submit" value="查询" class="button_text"/>
              </label>
        </form>
        </td>
        <td background="images/tab_15.gif">&nbsp;</td>
      </tr>
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>      
          			';foreach($rankary as $v){;echo '          			 <Td width="8%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" align="center">
                      <NOBR>';echo $v;;echo '</NOBR></Td>
                   	';};echo '                    <Td width="12%" height="22" background="images/bg.gif" bgcolor="#FFFFFF" align="center">会员总数</Td>
                   
                  </TR>
                
			';
$filter="";
if($action=='query'){
if(trim($regtime1)!='') $filter.=" and regtime>='".strtotime(trim($regtime1))."'";
if(trim($regtime1)!='') $filter.=" and regtime<='".strtotime(trim($regtime1))."'";
}
$sql="select count(id) as c from {$db_prefix}users where 1";
if($filter!='')$sql.=$filter;
$rs=$db->get_one($sql);
;echo '                  <TR>
                  ';foreach($rankary as $k=>$v){
$sqlu="select count(id) as c from {$db_prefix}users where rank='".$k."'";
if($filter!='') $sqlu.=$filter;
$rsu=$db->get_one($sqlu);
;echo '                  <TD align="center"bgcolor="#FFFFFF" ><NOBR>';echo $rsu["c"];echo '</NOBR></TD>
                  ';};echo '	
                    <TD align="center" class="reg_css01" bgcolor="#FFFFFF" ><NOBR>';echo $rs["c"];echo '</NOBR></TD>
                    
                  </TR>
				
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
            <td class="STYLE4"></td>
            <td>
            <table border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
              	<td>';
$modtime=time();
$starttime=strtotime(date("Y-m-d",$modtime));
$month=date("m",$modtime);$year=date("Y",$modtime);
$firstday=mktime(0,0,0,$month,1,$year);
$upmonthf=mktime(0,0,0,$month-1,1,$year);
$totalt=0;$totalm=0;$totalu=0;
$sql="select count(id) as c from {$db_prefix}users where regtime>='$starttime' and regtime<='$modtime'";
$rs=$db->get_one($sql);
if($rs['c']) $totalt=$rs['c'];
$sql="select count(id) as c from {$db_prefix}users where regtime>='$firstday' and regtime<='$modtime'";
$rs=$db->get_one($sql);
if($rs['c']) $totalm=$rs['c'];
$sql="select count(id) as c from {$db_prefix}users where regtime>='$upmonthf' and regtime<='$firstday'";
$rs=$db->get_one($sql);
if($rs['c']) $totalu=$rs['c'];
;echo '				<strong><span class="beizhucolor">今日会员总数:';echo $totalt;;echo '&nbsp;&nbsp;&nbsp;&nbsp;本月会员总数:';echo $totalm;;echo '&nbsp;&nbsp;&nbsp;&nbsp;上月会员总数:';echo $totalu;;echo '</span></strong></td>
                </tr>
            </table>
            </td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
</body>
</html>
';
?>