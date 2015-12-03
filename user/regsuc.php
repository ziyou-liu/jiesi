<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn_2.php");include("../include/function.php");include("../include/rank.php");
$sql="select * from {$db_prefix}users where username='".$username."'";
$rs=$db->get_one($sql);
;echo '<body>
<TABLE width="700" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="700" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif">&nbsp;<strong>会员注册成功</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="50%" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="50%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '</TD>
	</TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >密码:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo mymd5($rs["pwd"],"DE");echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo mymd5($rs["pwd1"],"DE");echo '</TD>
	  </TR>
	  <TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >级别:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rankary[$rs["rank"]];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >推荐人:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["tjrname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >接点人:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["prename"];echo '</TD>
	  </TR>
	<TR>
      <TD align="right" vAlign=middle bgColor="#FBFDFF" >区位:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';if($rs["pos"]==1) echo "左";else echo "右";;echo '区</TD>
	  </TR>
	
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >报单金额:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" >';$glorname="glo_jine_".$rs['rank0'];echo $$glorname;
;echo '积分</TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="确定" name="but" onClick="location.href=\'myhy.php\'">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</body></html>';
?>