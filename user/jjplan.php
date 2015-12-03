<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

';
include("../include/conn_2.php");include("../include/function.php");
$sql="select * from {$db_prefix}jjplan where 1";
$rs=$db->get_one($sql);
;echo '<link rel="stylesheet" href="/images/datalist.css" type="text/css"><script language="javascript" src="js/resize.js"></script></head>
<body>
<form name="form1" method="post" action="">
<br>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif" class="webtitle">&nbsp;<strong>奖励制度</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="';echo $style_color;;echo '" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	
	<TR>	 
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo "<br>".$rs["content"];echo '</TD>
	</TR>
	<TR>
	  <TD align="center" valign="middle" background="images/tab_19.gif" >
	  	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>