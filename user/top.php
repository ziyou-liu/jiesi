<?php

include("../include/conn_2.php");
include("../include/upower.php");
include("../include/rank.php");
include("../include/hypower.php");
include("../include/setting.php");
$sql_rank="select rank,isdp,price,price1 from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs_rank=$db->get_one($sql_rank);
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<STYLE type=text/css>
BODY {
	margin:0px auto;
	text-align:center;overflow:hidden;
}
.STYLE1 {
	FONT-SIZE: 12px; COLOR: #ffffff
}
.STYLE2 {
	FONT-SIZE: 9px
}
.STYLE3 {
	FONT-SIZE: 12px; COLOR: #ffffff
}
</STYLE>

<SCRIPT>
function changemenu(sid,k){
	for(var i=1;i<=k;i++){
		eval("top.frames[\'mainFrame\'].frames[0].document.getElementById(\'submenu" + i + "\').style.display=\\"none\\";");
	}
	eval("top.frames[\'mainFrame\'].frames[0].document.getElementById(\'submenu" + sid + "\').style.display=\\"\\";");

}
function welcometo(){
	top.frames["mainFrame"].frames[1].location.href=\'welcome.php\';
}
function frams(){
	top.frames["mainFrame"].frames[1].location.reload();
}
</SCRIPT>
<BODY>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD vAlign="bottom" style="background:url(images/top2.jpg) no-repeat;">
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TBODY>
              <TR>
                <TD>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=bottom width="100%">
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD colSpan=7 height=150>
                            <EMBED 
                              pluginspage=http://www.macromedia.com/go/getflashplayer 
                              src=images/3.swf width="100%" height="100%" 
                              type=application/x-shockwave-flash quality="high" 
                              wmode="transparent"> </EMBED> </TD></TR>
                          <TR>
                            <TD width=50 height=19>
                              <DIV align=center><a href="#" onClick="welcometo();"><IMG 
                              height=19 src="images/main_12.gif" width=49 
                              border=0></A></DIV></TD>
                            <TD width=50>
                              <DIV align=center><a href="javascript:history.go(-1);"><IMG height=19 
                              src="images/main_14.gif" width=48 
                              border=0></A></DIV></TD>
                            <TD width=50>
                              <DIV align=center><a href="javascript:history.go(1);"><IMG height=19 
                              src="images/main_16.gif" width=48 
                              border=0></A></DIV></TD>
                            <TD width=50>
                              <DIV align=center><a href="javascript:frams();"><IMG height=19 
                              src="images/main_18.gif" width=48 
                              border=0></A></DIV></TD>
                            <TD width=50>
                              <DIV align=center><a href="logout.php" target="_parent"><IMG height=19 
                              src="images/main_20.gif" width=48 
                              border=0></A></DIV></TD>
                            <TD width=26>
                              <DIV align=center></DIV></TD>
                            <TD>&nbsp;</TD></TR></TBODY></TABLE></TD>
                      </TR></TBODY></TABLE></TD>
                <TD width=21>&nbsp;</TD></TR></TBODY>
			</TABLE>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" 
            bgColor=#c60000 border=0>
              <TBODY>
              <TR>
                <TD width=177 background="">
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                      <TD width="20%" >&nbsp;</TD>
                      <TD vAlign=bottom width="59%">
                        <DIV class=STYLE1 align=left>';echo "欢迎您:".$_SESSION["glo_username"];
;echo '</DIV></TD>
                      <TD width="21%">&nbsp;</TD></TR></TBODY></TABLE></TD>
                <TD>
                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <TBODY>
                    <TR>
                     ';
$i=0;$c=count($menuary);
foreach($menuary as $k=>$v){
$i++;
;echo '                      <TD width=65>
                        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                          <TBODY>
                          <TR>
                            <TD vAlign=bottom height=23>
                              <TABLE cellSpacing=0 cellPadding=0 width=58 
                              align=center border=0>
                                <tr>
									<td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage=\'url(/images/bg.gif)\';this.style.borderStyle=\'solid\';this.style.borderWidth=\'1\';borderColor=\'#a6d0e7\'; document.getElementById(\'memu_';echo $i;;echo '\').style.color=\'#000000\';"
									onmouseout="this.style.backgroundImage=\'url()\';this.style.borderStyle=\'none\';document.getElementById(\'memu_';echo $i;;echo '\').style.color=\'#ffffff\';"> <div align="center" class="STYLE3" onClick="changemenu(\'';echo $i;echo '\',\'';echo $c;echo '\')" id="memu_';echo $i;;echo '">';echo $k;echo '</div></td>
								  </tr></TABLE></TD></TR></TBODY></TABLE></TD>
								<TD width=3><IMG height=28 src="images/main_34.gif"  width=3></TD>
						';
}
;echo '                     <!-- <TD width=63><A style="COLOR: #ffffff" onclick=jianti() 
                        href="#">简体版</A></TD>
                      <TD width=63><A style="COLOR: #ffffff" onclick=fanti() 
                        href="#">繁体版</A></TD> -->
                      <TD>
                        <DIV align=right><SPAN class=STYLE1><SPAN 
                        class=STYLE2></SPAN>
                        <script language="javascript" src="../include/ajax.js"></script>
                        <DIV id=timer></DIV>
                        <script language="javascript">
							 document.getElementById(\'timer\').innerHTML="当前时间："+new Date().toLocaleString()+\' \'.charAt(new Date().getDay()); 
							 setInterval("document.getElementById(\'timer\').innerHTML=\'当前时间：\'+new Date().toLocaleString()+\' \'.charAt(new Date().getDay());",1000); 
						</script>
                        </SPAN></DIV></TD></TR></TBODY></TABLE></TD>
						<TD width=21>&nbsp;</TD>
					</TR></TBODY>
				</TABLE></TD>
			</TR></TBODY>
		</TABLE></TD>
	</TR></TBODY>
</TABLE>
 </BODY>
 </HTML>
';
?>