<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/rank.php");
include("../include/pv.php");
if ($action=="setting"){
$sqlu="update {$db_prefix}setting set loginpage='$page'";
$db->query($sqlu);
echo "<script>alert('设定成功');location.href='settingpage.php';</script>";exit();
}
$sql="select * from {$db_prefix}setting where 1";
$rs=$db->get_one($sql);
;echo '</HEAD><body>
<form name="form1" method="post" action="?action=setting">
<TABLE width="800" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="800" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"  background="images/tab_05.gif"><TBODY><TR>
<TD width="50%" height=23>&nbsp;<strong>前台登录页面设定</strong></TD>
 <TD width="50%" colspan="" align="left" >
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">  
  		
         <TR>
         <td height="20" bgcolor="#FFFFFF" colspan="2">
         <div align="center" class="STYLE1">当前使用：';echo $rs['loginpage'];;echo ' 会员管理系统</div>
        
            <div align="center"><a href="../loginpage/';echo $rs['loginpage'];;echo '.jpg" target="_blank"><img src="/loginpage/';echo $rs['loginpage'];;echo '.jpg" height="60" border="0" /></a></div>
            </td>
         <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
         系统推荐使用：
         <input type="radio" name="page" id="page0" value="0" ';if($rs['loginpage']==0) echo "checked";;echo '>会员管理系统
            <div align="center"><a href="../loginpage/0.jpg" target="_blank"><img src="/loginpage/0.jpg" height="60" border="0" /></a></div>
            </div></td>
        </TR>
        
        ';for($i=1;$i<=24;$i++) {;echo '        <TR>
         <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
         	';echo $i;;echo '<input type="radio" name="page" id="page';echo $i;;echo '" value="';echo $i;;echo '" ';if($rs['loginpage']==$i) echo "checked";;echo '>';if($rs['loginpage']==$i) {;echo '<span style="color:red; font-size:18px; font-weight:bold;">会员管理系统</span>';}else {;echo '会员管理系统';};echo '              <div align="center"><a href="../loginpage/';echo $i;;echo '.jpg" target="_blank"><img src="/loginpage/';echo $i;;echo '.jpg" height="60" border="0" /></a></div>
            </div></td>
          <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
         	';echo $i+1;;echo '<input type="radio" name="page" id="page';echo $i+1;;echo '" value="';echo $i+1;;echo '" ';if($rs['loginpage']==($i+1)) echo "checked";;echo '>';if($rs['loginpage']==($i+1)) {;echo '<span style="color:red; font-size:18px; font-weight:bold;">会员管理系统</span>';}else {;echo '会员管理系统';};echo '              <div align="center"><a href="../loginpage/';echo $i+1;;echo '.jpg" target="_blank"><img src="/loginpage/';echo $i+1;;echo '.jpg" height="60" border="0" /></a></div>
            </div></td>
            
          <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
         	';echo $i+2;;echo '<input type="radio" name="page" id="page';echo $i+2;;echo '" value="';echo $i+2;;echo '" ';if($rs['loginpage']==($i+2)) echo "checked";;echo '>';if($rs['loginpage']==($i+2)) {;echo '<span style="color:red; font-size:18px; font-weight:bold;">会员管理系统</span>';}else {;echo '会员管理系统';};echo '              <div align="center"><a href="../loginpage/';echo $i+2;;echo '.jpg" target="_blank"><img src="/loginpage/';echo $i+2;;echo '.jpg" height="60" border="0" /></a></div>
            </div></td>
        </TR>
      
      ';$i=$i+2;};echo '      
	<TR>
	  <TD background="images/tab_19.gif" align="center" valign="middle" colspan="3">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>';
?>