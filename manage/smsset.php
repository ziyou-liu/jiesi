<?php
echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>短信发送设置</title>
';
include("../include/conn.php");
include("../include/function.php");
if ($action=="set1"){
$post_1=$_POST['post_1'];
$post_2=$_POST['post_2'];
$post_3=$_POST['post_3'];
$post_4=$_POST['post_4'];
$post_5=$_POST['post_5'];
$post_6=$_POST['post_6'];
$sql="update {$db_prefix}smsyset set post_1='".trim($post_1)."',post_2='".trim($post_2)."',post_3='".trim($post_3)."',post_4='".trim($post_4)."',post_5='".trim($post_5)."',post_6='".trim($post_6)."',post_7='".trim($post_7)."' where id=1";
$db->query($sql);
echo "<script>alert('设置成功');location.href='smsset.php';</script>";exit();
}
$sql="select * from {$db_prefix}smsyset where 1";
$rs=$db->get_one($sql);
;echo '
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<script language="javascript">
function checkLength(num) { 
	var str="post_"+num;
	var str1="chLeft"+num; 
	var curr =  document.getElementById(str).value.length;  
	document.getElementById(str1).innerHTML = curr.toString();  
} 
</script>
</head>

<body>
<form name="form1" method="post" action="?action=set1" onSubmit="return confirm(\'您确定要执行此操作吗？\')?true:false;">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD height=23 background="images/tab_05.gif">&nbsp;<strong>短信平台-短信模板</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
     <td valign="top" bgcolor="#d4e8fa"><TABLE borderColor=#ffffff cellSpacing=1 cellPadding=1 width="100%" align=center bgColor=#d4e8fa border=1>
  <TBODY>
    <TR bgColor=#f2f9fd>
    <TD align="right" >备注:</TD>
    <TD align="left" >1.一条短信的标准是<span style="color:red;">70个汉字</span>或<span style="color:red;">160个英文字母</span>（包括标点符号，加上短信网关后缀字数）</TD>
   
  </TR>
 <!-- <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>注册验证通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_1" cols="40" rows="6" id="post_1"onkeyup="checkLength(1);">';echo $rs["post_1"];echo '</textarea></TD>
    <TD height="30" align="left" vAlign=center><span id="chLeft1" style="color:red;font-weight:bold;font-size:14px;"></span>&nbsp;&nbsp;说明:[会员编号] [验证码] 分别代表变量</TD>
  </TR>-->
  <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>会员注册通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_6" cols="60" rows="8" id="post_6"onkeyup="checkLength(6);">';echo $rs["post_6"];echo '</textarea><span id="chLeft6" style="color:red;font-weight:bold;font-size:14px;"></span>
	</TD>
  </TR>
  <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>会员提现通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_3" cols="60" rows="8" id="post_3" onKeyUp="checkLength(3);">';echo $rs["post_3"];echo '</textarea><span id="chLeft3" style="color:red;font-weight:bold;font-size:14px;"></span>
	</TD>
  </TR>
   <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>说明:</TD>
    <TD align="left" vAlign=center><span class="hint">‘{&nbsp;}’ 内的内容请不要更改</span>
	</TD>
  </TR>
  <!--<TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>会员充值通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_4" cols="40" rows="6" id="post_4"onkeyup="checkLength(4);">';echo $rs["post_4"];echo '</textarea></TD>
    <TD height="30" align="left" vAlign=center><span id="chLeft4" style="color:red;font-weight:bold;font-size:14px;"></span>&nbsp;&nbsp;说明:[会员编号] [金额] 分别代表变量</TD>
  </TR>
  <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>发货订单通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_2" cols="40" rows="6" id="post_2"onkeyup="checkLength(2);">';echo $rs["post_2"];echo '</textarea></TD>
    <TD height="30" align="left" vAlign=center><span id="chLeft2" style="color:red;font-weight:bold;font-size:14px;"></span>&nbsp;&nbsp;说明:[会员编号] [订单号] [物流]分别代表变量</TD>
  </TR>
  
  <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>会员升级通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_5" cols="40" rows="6" id="post_5"onkeyup="checkLength(5);">';echo $rs["post_5"];echo '</textarea></TD>
    <TD height="30" align="left" vAlign=center><span id="chLeft5" style="color:red;font-weight:bold;font-size:14px;"></span>&nbsp;&nbsp;说明:[会员编号]代表变量</TD>
  </TR>
  
  <TR bgColor=#f2f9fd>
    <TD align="right" vAlign=center>找回密码通知:</TD>
    <TD align="left" vAlign=center><textarea name="post_7" cols="40" rows="6" id="post_7" onKeyUp="checkLength(7);">';echo $rs["post_7"];echo '</textarea></TD>
    <TD height="30" align="left" vAlign=center><span id="chLeft3" style="color:red;font-weight:bold;font-size:14px;"></span>&nbsp;&nbsp;说明:[会员编号] [密码]代表变量</TD>
  </TR>--> 
  <TR>
                  <TD height="35" align="center" vAlign="middle" bgColor="#d4e8fa" colspan="3" background="images/tab_19.gif"><LABEL for="chkSelectAll">
                    
                    <input type="submit" name="Submit" value="设置" class="button_text" onMouseOver="this.className=\'button_onmouseover\'" onMouseDown="this.className=\'button_onmousedown\'" onMouseOut="this.className=\'button_onMouseOut\'">
                  </LABEL></TD>
                  </TR>
  </TBODY>
  </TABLE>
</td></TR></TBODY></TABLE>            
	</form>
 
</body>
</html>
';
?>