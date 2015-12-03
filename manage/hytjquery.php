<?php

include("../include/conn.php");
include("../include/function.php");
include("../include/pageclass.php");
include("../include/rank.php");
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员统计查询</title>
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
                <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[查询系统]-[会员统计]-[会员查询]</td>
              </tr>
            </table></td>
             <td width="54%" align="center"><table width="60%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    
                    
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
        <td align="center">	';
if($action=="query"){
$str="";$total=0;$fitler='';
if($regtime1!="")  {$str.=$regtime1;$filter.=" and regtime>='".strtotime(trim($regtime1))."'";}
if($regtime2!="") {$str.="到".$regtime2;$filter.=" and  regtime<='".(strtotime(trim($regtime2))+24*3600)."'";}else $str.="以后";
$sqlp="select count(id) as c from {$db_prefix}users where 1";
if($filter!='') $sqlp.=$filter;
$rsp=$db->get_one($sqlp);
$total=$rsp['c'];
}
;echo '<span class="beizhucolor" style="font-size:14px;">';echo $str.",会员共计: ".$total;;echo '</span>
        <td background="images/tab_15.gif">&nbsp;</td>
      </tr>
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>      
          			<td width="10%" align="center"  background="images/bg.gif" bgcolor="#FFFFFF">日期</td>
                   ';foreach($rankary as $k=>$v){;echo '                    <Td width="10%" align="center"  background="images/bg.gif" bgcolor="#FFFFFF">';echo $v;;echo '</Td>
                    ';};echo '                    <td width="10%"  align="center" background="images/bg.gif" bgcolor="#FFFFFF">会员总数</td>
                   
                  </TR>
                
			';
$pagesize=20;$pageno=getparam("pageno");
if($pageno<1) $pageno=1;
$ftime=strtotime($regtime1);
$etime=strtotime($regtime2);
$entime=strtotime($regtime2)+24*3600;
$totalday=($entime-$ftime)/(24*3600);
$dayary=array();
$t=$ftime;
while($t<=$etime){
$dayary[]=$t;
$t+=24*3600;
}
$recnum=$totalday;
$pagenum=ceil($recnum/$pagesize);
if($pageno>$pagenum) $pageno=intval($pagenum);
if($pageno<1) $pageno=1;
$bgpos=$pagesize*($pageno-1);
foreach($dayary as $k=>$v){
if(($k)>=$bgpos &&($k/$pageno)<$pagesize){
$totalt=0;
;echo '                  <TR>
                  <TD align="center"bgcolor="#FFFFFF" ><NOBR>';echo date("Y-m-d",$dayary[$k]);echo '</NOBR></TD>
                  ';foreach($rankary as $k1=>$v1) {;echo '                  	<TD align="center"bgcolor="#FFFFFF" >';
$sql="select count(id) as c from {$db_prefix}users where regtime>='".$dayary[$k]."' and regtime<='".($dayary[$k]+24*3600)."' and rank='".$k1."'";
$rsa=$db->get_one($sql);
$totalt+=$rsa['c'];
if($rsa['c']) echo "<span style='color:red;font-weight:bold;'>".$rsa["c"]."</span>";else echo '0';echo '</TD>
                    ';};echo '                    <TD align="center" class="reg_css01" bgcolor="#FFFFFF">';if($totalt==0) echo $totalt;else echo "<span style='color:red;font-weight:bold;'>".$totalt."</span>";;echo '</TD>
                    
                  </TR>
				';
}}
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
            <td width="46%" class="STYLE4">&nbsp;&nbsp;共<span id="lbRecordSum" style="font-family:Microsoft Sans Serif;">';echo $recnum;echo '</span>&nbsp;条记录&nbsp;&nbsp; 第<span id="lbPCurrent" style="font-family:Microsoft Sans Serif;">';echo $pageno;echo '</span>&nbsp;页 / 共<span id="lbPSum" style="font-family:Microsoft Sans Serif;">';echo $pagenum;echo '</span>&nbsp;页</td>
            <td width="4%"> <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" onClick="history.back();" value="返回" name="but"></td>
            <td width="50%">
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