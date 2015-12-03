<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
$sql="select * from {$db_prefix}product where id='".$id."'";
$rs=$db->get_one($sql);
;echo '<body>
<form action="" method="post" enctype="multipart/form-data" name="form1">

<br>
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>产品';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="29%" align="right" vAlign=middle bgColor="#FBFDFF" >分类:</TD>
	  <TD width="71%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["category"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><p>名称:</p>	    </TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["productname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >图片:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" > ';if ($rs["proimg"]!="") echo '<img src="../proimgs/'.$rs["proimg"].'" width="60" height="60"/>';else echo "没有图片";;echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >零售价:</TD>
	  <TD height="27" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["scprice"];echo '元</TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >会员价格:</TD>
	  <TD height="27" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["price"];echo '元</TD>
	</TR>
	<!--<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >产品PV:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["pv"];echo 'pv</TD>
	</TR>-->
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >重量:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["weight"];echo 'kg</TD>
	</TR>
    <TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >数量:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["num"];echo '</TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >说明:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["memo"];echo '</TD>
	</TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="history.back();">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>'
?>