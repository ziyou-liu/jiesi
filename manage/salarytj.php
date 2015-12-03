<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/rank.php");
$allprice=0;
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<div style=" width:auto; height:38px;background:url(images/hygl.jpg) left center no-repeat; text-indent:35px;font-size:14px; display:block; line-height:38px; margin-left:10px; border-bottom:1px solid #CCCCCC; margin-bottom:10px;">您当前位置：查询系统 >> 总奖金拨出</div>

<TABLE width="80%" border=0 align="center" cellPadding=4 cellSpacing=1 bgcolor="#CCCCCC" >
<TBODY>
<TR>
  <TD width="421" colSpan=4 bgcolor="#EEEEEE" >&nbsp;<strong>奖金统计</strong></TD>
</TR>
    ';foreach($salaryprice as $k=>$v){;echo '	<TR>
	  <TD width="50%" align="right" valign="middle" bgColor="#EEEEEE" >';echo $k;echo '总额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >';
$sqlper="select periods from {$db_prefix}periods where state>1 order by id desc limit 1";
$rsper=$db->get_one($sqlper);
if($rsper['periods']){
$periods=$rsper['periods'];
}else{
$periods=0;
}
$sqljj="select sum(".$v.") as c from {$db_prefix}jsrec where periods<=".$periods."";
$rsjj=$db->get_one($sqljj);
echo $rsjj['c']?$rsjj['c']:0;
$allprice+=$rsjj['c'];
;echo '</TD>
	</TR>	
	';}foreach($salaryfee as $k=>$v){;echo '	<TR>
	  <TD width="50%" align="right" valign="middle" bgColor="#EEEEEE" >';echo $k;echo '总额(扣除):</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >';
$sqljj="select sum(".$v.") as c from {$db_prefix}jsrec where periods<=".$periods."";
$rsjj=$db->get_one($sqljj);
echo $rsjj['c']?$rsjj['c']:0;
$allprice-=$rsjj['c'];
;echo '</TD>
	  </TR>
	';};echo '	 <TR>
	  <TD align="right" valign="middle" bgColor="#EEEEEE" >奖金发放总额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >';
echo $allprice;
;echo '</TD>
	  </TR>
	  <TR>
	    <TD align="right" valign="middle" bgColor="#EEEEEE" >沉淀总金额(手续费):</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >
		';
$sql="select sum(money) as c from {$db_prefix}e where memo in(15)";
$rssxf=$db->get_one($sql);
echo $rssxf['c']?$rssxf['c']:0;
;echo '		</TD>
      </TR>
	  <TR>
	    <TD align="right" valign="middle" bgColor="#EEEEEE" >消费总金额:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >
		';
$sql="select sum(price*zhekou) as c from {$db_prefix}orders where state>=1";
$rssxf=$db->get_one($sql);
echo $rssxf['c']?$rssxf['c']:0;
;echo '		</TD>
      </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#EEEEEE" >报单额累计:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >';
$sqlsr="select sum(bdmoney) as c from {$db_prefix}users where state=1";
$rssr=$db->get_one($sqlsr);
$srprice=$rssr['c'];
echo $srprice;
;echo '</TD>
	  </TR>
	  <TR>
	    <TD align="right" valign="middle" bgColor="#EEEEEE" >奖金总拨出率:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FFFFFF" >
		';
if ($srprice==0){
echo 0;
}else{
echo number_format(($allprice/$srprice)*100,2,'.','');
}
;echo '%
		</TD>
      </TR>
	 
	  
  </table>
</TD>
<br>
</body></html>';
?>