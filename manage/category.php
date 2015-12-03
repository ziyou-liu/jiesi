<?php

include("../include/conn.php");include("../include/function.php");
;echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD><body>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>产品分类</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
  ';
$sql="select * from ".$db_prefix."productsort order by orders asc";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
echo "<tr>
          <TD height=20  rowspan=1 align=left vAlign=middle bgColor='#FBFDFF' >".($rs['depth']+1)."、".getlenstr($rs['depth'],"——");
if ($rs['depth']==0) echo "<span style='color:red;font-weight:bold'>";
echo $rs['name'];
if ($rs['depth']==0) echo "</span>";
echo " <a href='category1.php?parent=".$rs['id']."'>添加</a> <a href='category4.php?id=".$rs['id']."'>修改</a> <a href='category5.php?id=".$rs['id']."' onclick=\"return confirm('确定删除?');\">删除</a>";
echo "</td>
        </tr>";
}
}else{
;echo '		<tr>
          <TD height=50  rowspan=1 align=left vAlign=middle bgColor=\'#FBFDFF\' ></td></tr>
		';
}
$db->freeresult($result);
$db->close();
;echo '	<TR>
	  <TD align="center" valign="middle" background="images/tab_19.gif">
	  <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="添加1级分类" name="but" onClick="location.href=\'category1.php\'">
	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>

</body></html>';
?>