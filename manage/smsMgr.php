<?php
echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/function.php");
if ($Action=="Save"){
$post_1_close=$_POST['post_1_close'];
$post_2_close=$_POST['post_2_close'];
$post_3_close=$_POST['post_3_close'];
$post_4_close=$_POST['post_4_close'];
$post_5_close=$_POST['post_5_close'];
$post_6_close=$_POST['post_6_close'];
$sql1="update {$db_prefix}smsyset set post_1_close='".trim($post_1_close)."',post_2_close='".trim($post_2_close)."',post_3_close='".trim($post_3_close)."',post_4_close='".trim($post_4_close)."',post_5_close='".trim($post_5_close)."',post_6_close='".trim($post_6_close)."',post_7_close='".trim($post_7_close)."',sms_user='".trim($sms_user)."',sms_pwd='".trim($sms_pwd)."' where id=1";
$db->query($sql1);
echo "<script>alert('设置成功!');location.href='smsMgr.php';</script>";exit();
}
$rs1=$db->get_one("select * from {$db_prefix}smsyset where 1");
;echo '
<title>短信管理</title>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.STYLE2 {color: #FF9933}
-->
</style>
</head>
<body>

<TABLE cellSpacing=5 cellPadding=0 width="400" border=0 align="center">
  <TBODY>
<form name="form1" method="post" action="?Action=Save" onSubmit="return confirm(\'您确定要执行此操作吗？\')?true:false;">
	<TR>
      <TD id=test1 vAlign=top><table class="Table_xt" cellspacing="0" cellpadding="0" width="100%" border="0">
        <tbody>
          <tr>
            <td><table cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                  <tr>
                    <td width="145"  background="images/tab_05.gif" height="23">&nbsp;<strong>短信平台 - 短信管理  </strong></td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#d4e8fa"><TABLE borderColor=#ffffff cellSpacing=1 cellPadding=1 width="100%" align=center bgColor=#d4e8fa border=1>
  <TBODY>
   <TR>
	  <TD width="40%" align="right" valign="middle" bgColor="#FBFDFF">短信参数</td>
      <TD width="60%" align="left" valign="middle" bgColor="#FBFDFF">
	  帐号：<input type="text" name="sms_user" value="';echo $rs1["sms_user"];;echo '" size="12" ><br>
	  密码：<input type="text" name="sms_pwd" value="';echo $rs1["sms_pwd"];;echo '"  size="12">
	  </td>
    </TR>
  <!--<TR bgColor=#f2f9fd>
    <TD width="50%" align="right" vAlign=center>
     
  
    注册验证通知：
    </TD>
    <td width="50%">
	<input name="post_1_close" type="radio"  value="1" ';if ($rs1['post_1_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_1_close" type="radio"  value="0" ';if ($rs1['post_1_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>-->
      <TR bgColor=#f2f9fd>
    <TD  align="right" vAlign=center>
     
  
    会员注册通知：
    </TD>
    <td>
	<input name="post_6_close" type="radio"  value="1" ';if ($rs1['post_6_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_6_close" type="radio"  value="0" ';if ($rs1['post_6_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>
      <TR bgColor=#f2f9fd>
    <TD  align="right" vAlign=center>
    会员提现通知：
    </TD>
    <td>
	<input name="post_3_close" type="radio"  value="1" ';if ($rs1['post_3_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_3_close" type="radio"  value="0" ';if ($rs1['post_3_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR> 
  <!--
    会员充值通知：
    </TD>
    <td>
	<input name="post_4_close" type="radio"  value="1" ';if ($rs1['post_4_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_4_close" type="radio"  value="0" ';if ($rs1['post_4_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>
      <TR bgColor=#f2f9fd>
    <TD width="50%" align="right" vAlign=center>
     
  
    发货订单通知：
    </TD>
    <td>
	<input name="post_2_close" type="radio"  value="1" ';if ($rs1['post_2_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_2_close" type="radio"  value="0" ';if ($rs1['post_2_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>
      <TR bgColor=#f2f9fd>
    <TD width="50%" align="right" vAlign=center>
     
  
    会员升级通知：
    </TD>
    <td>
	<input name="post_5_close" type="radio"  value="1" ';if ($rs1['post_5_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_5_close" type="radio"  value="0" ';if ($rs1['post_5_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>
      <TR bgColor=#f2f9fd>
    <TD width="50%" align="right" vAlign=center>
     
  
  
   <TR bgColor=#f2f9fd>
    <TD width="50%" align="right" vAlign=center>
     
  
    找回密码通知：
    </TD>
    <td>
	<input name="post_7_close" type="radio"  value="1" ';if ($rs1['post_7_close']==1) echo "checked";echo '>开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="post_7_close" type="radio"  value="0" ';if ($rs1['post_7_close']==0) echo "checked";echo '>关闭
	</td>  
	 </TR>-->
  
              <tr align="center"><td colspan="2" background="images/tab_19.gif">
                    <input type="submit" name="Submit" value="设置" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
                 
              </td>
          </tr>
        </tbody>
      </table></td>
	</TR></tbody></table></TD></TR></form>
 </tbody>
</table>
</body>
</html>
';
?>