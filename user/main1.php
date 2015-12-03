<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn_2.php");
include("../include/rank.php");
include("../include/upower.php");
include("../include/hypower.php");
$rss=$db->get_one("select realname,rank from {$db_prefix}users where username='".$_SESSION['glo_username']."'");
;echo '<LINK href="css/gaoqi.css" type=text/css rel=stylesheet>
<SCRIPT type="text/javascript" language="javascript" src="js/transfer.js"></SCRIPT>
<script language="javascript" src="js/ajax.js"></script>
<SCRIPT src="js/tbra-aio.js" type=text/javascript></SCRIPT>
<SCRIPT src="js/main2.js" type=text/javascript></SCRIPT>
<link rel="stylesheet" type="text/css" href="css/main2.css">

</HEAD>
<BODY>
<FORM id=aspnetForm name=aspnetForm onSubmit="return checkForm(this)" action=# 
method=post encType=multipart/form-data>

<DIV class=wrap><!--<div id="shuaxin">222</div>-->
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="21%" background="../login_new/header_top_bj.gif"><img src="../login_new/header_logo.gif" width="200" height="58"></td>
        <td width="46%" background="../login_new/header_top_bj.gif">&nbsp;</td>
        <td width="33%" background="../login_new/header_top_bj.gif"><img src="../login_new/love_donation_img02.gif" width="310" height="67"></td>
      </tr>
    </table></TD></TR></TBODY></TABLE>
<TABLE width="100%" height=25 align=center cellPadding=0 cellSpacing=0 background="../login_new/headernav_contentbg.gif">
  <TBODY>
  <TR>
    <TD width="68%"  class=w12>
      <TABLE cellSpacing=0 cellPadding=0 width="70%" align=left border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" align=center 
            border=0>
              <TBODY>
              <TR>
                <TD width="96%">
                  <ul id="nav">
					 ';
$i=0;
$c=count($menuary);
foreach($menuary as $k=>$v){
$i++;
;echo '                     <li><a href="#">';echo $k;;echo '</a>
                    
                     <ul style="margin-left:-10px">
                    ';
foreach($v as $k1=>$v1){
;echo '
						<li><a href="';echo $execary[$k][$k1];echo '" target="I2">';echo $v1;echo '</a></li>
                      	  ';
}
;echo '                         </ul>
                    </li>
                    ';
$i++;
}
;echo '		  </ul></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD><td width="22%"><span id="timer" style="color:#ffffff;"></span><script language="javascript">
document.getElementById(\'timer\').innerHTML=new Date().toLocaleString()+\' 星期\'+\'日一二三四五六\'.charAt(new Date().getDay()); 
setInterval("document.getElementById(\'timer\').innerHTML=new Date().toLocaleString()+\' 星期\'+\'日一二三四五六\'.charAt(new Date().getDay());",1000); 
</script></td>
    <TD width="10%" align=middle class=w12><!--<a href="#" onClick="jianti()">【简体版】</a>
    <a href="#" onClick="fanti()">【繁体版】</a> --><a href="logout.php" target="_top">【安全退出】</a></TD>
  </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD vAlign=center height=20></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="100%" height="100%" align=center border=0 >
  <TBODY>
  <TR>
    <TD vAlign=top width="13%">
    &nbsp; &nbsp; &nbsp; <span style="font-size:13px; font-weight:bold;"><img src="images/welcome.png" width="34" height="32">
    ';echo $_SESSION['glo_username'];;echo '</span>
    <br /><br />
    &nbsp; &nbsp; &nbsp; <span style="font-size:13px; font-weight:bold;">姓名:&nbsp;&nbsp;<font color="#993300">';echo $rss['realname'];;echo '</font></span>
    <br /><br />
  
  
    &nbsp; &nbsp; &nbsp;  <span style="font-size:13px; font-weight:bold;">级别:&nbsp;&nbsp;<font color="#993300">';echo $rankary[$rss["rank"]];echo '</font></span>
    <br />
    
     
    </TD>
    <TD vAlign=top width="70%" height="400">
      <TABLE  cellSpacing=0 cellPadding=0 width="100%"  height="100%" style="table-layout:fixed;">
        <TBODY>
        <TR>
          <TD class=xian4 vAlign=top bgColor=#f1f8fe>
            <SPAN id=ctl00_ContentPlaceHolder1_Lblalert></SPAN>
            <TABLE cellSpacing=0 cellPadding=5 width="100%" align=center 
            border=0 >
              <TBODY>
              <TR>
                <TD vAlign=center width="1%">
                  <DIV align=left></DIV></TD>
               </TR></TBODY></TABLE>
            <TABLE class=ptfont cellSpacing=5 cellPadding=0 width="95%"  height="100%"
            align=center border=0 style="table-layout:fixed;">
              <TBODY>
              <TR>
                <TD colSpan=3>
                  <!--右边开始-->
   
    <iframe name="I2" height="100%" width="100%"  frameborder="0" allowtransparency="true" src="welcome.php"  >浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe>
  
<!--右边结束-->
</TD></TR>
              </TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
    <TD vAlign=top width="2%">&nbsp;</TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD>&nbsp;</TD></TR></TBODY></TABLE>
<TABLE style="BORDER-TOP: #568bc4 3px solid" cellSpacing=0 cellPadding=0 
width="100%" align=center border=0>
  <TBODY>
  <TR>
    <TD align=middle width=980 height=80>
      <DIV align=center>Copyright @ 2012  All Right Reserved Powered by JinDan 
      </DIV></TD></TR></TBODY></TABLE>

</DIV></FORM></BODY></HTML>
'
?>