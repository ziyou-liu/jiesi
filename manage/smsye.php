<?php

include("../include/conn.php");include("../include/function.php");include("../include/smsset.php");
if ($action!='getye'){
$f_zhuangtai='';
$web_duanxin_paw=md5($web_duanxin_paw);
$url ="http://api.52ao.com/m/?user={$web_duanxin_user}&pass={$web_duanxin_paw}";
$smsreturn=smsGet($url);
$smsary=explode(',',$smsreturn);
if ($smsary[0]==200){
$f_zhuangtai="获取成功";
}else{
$f_zhuangtai="获取失败";
}
}else{
$f_zhuangtai='';
$web_duanxin_paw=md5($web_duanxin_paw);
$url ="http://api.52ao.com/m/?user={$web_duanxin_user}&pass={$web_duanxin_paw}";
$smsreturn=smsGet($url);
$smsary=explode(',',$smsreturn);
if ($smsary[0]==200){
$f_zhuangtai="获取成功";
}else{
$f_zhuangtai="获取失败";
}
}
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
</HEAD><body>
<form action="?action=getye" method="post">
<TABLE width="96%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="100%" colSpan=4 background="images/tab_05.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>短信余额';echo $f_zhuangtai;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%" align="right" valign="middle" bgColor="#FBFDFF" ><p>余额:</p>	    </TD>
	  <TD width="50%" height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $smsary[1];echo '条</TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="获取短信余额" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>