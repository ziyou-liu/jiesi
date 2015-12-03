<?php

include("../include/conn.php");
include("../include/power.php");
include("../include/access.php");
;echo '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {
	font-size: 12px;
	color: #FFFFFF;
}
.STYLE2 {font-size: 9px}
.STYLE3 {
	color: #033d61;
	font-size: 12px;
}
-->
</style>
<script language="javascript">
function welcometo(){
	window.parent.document.frames["mainFrame"].document.frames[1].location.href=\'welcome.php\';
}
function changemenu(sid,k){
	for(var i=1;i<=k;i++){
		eval("window.parent.document.frames[\'mainFrame\'].document.frames[0].document.getElementById(\'submenu" + i + "\').style.display=\\"none\\";");
	}
	eval("window.parent.document.frames[\'mainFrame\'].document.frames[0].document.getElementById(\'submenu" + sid + "\').style.display=\\"\\";");

}
function frams(){
	window.parent.document.frames["mainFrame"].document.frames[1].location.reload();
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="70" background="/images/main_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" height="24" background="/images/main_03.gif">&nbsp;</td>
            <td width="505" background="/images/main_04.gif">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="21"><img src="/images/main_07.gif" width="21" height="24"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="38"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" height="38" background="/images/main_09.gif">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="60%" height="25" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50" height="19"><div align="center"><a href="#" onClick="welcometo();"><img src="/images/main_12.gif" width="49" height="19" border="0"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:history.go(-1);"><img src="/images/main_14.gif" width="48" height="19" border="0"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:history.go(1);"><img src="/images/main_16.gif" width="48" height="19" border="0"></a></div></td>
                    <td width="50"><div align="center"><a href="javascript:frams();"><img src="/images/main_18.gif" width="48" height="19" border="0"></a></div></td>
                    <td width="50"><div align="center"><a href="logout.php" target="_parent"><img src="/images/main_20.gif" width="48" height="19" border="0"></a></div></td>
                    <td width="26"><div align="center"><img src="/images/main_21.gif" width="26" height="19" border="0"></div></td>
                    <td width="100"></td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
                <td width="350" valign="bottom"  nowrap="nowrap"><div align="right"><span class="STYLE1"><span class="STYLE2"></span><script language="javascript" src="../include/ajax.js"></script>
<div id="timer"></div>
<script language="javascript">
document.getElementById(\'timer\').innerHTML=new Date().toLocaleString()+\' 星期\'+\'日一二三四五六\'.charAt(new Date().getDay()); 
setInterval("document.getElementById(\'timer\').innerHTML=new Date().toLocaleString()+\' 星期\'+\'日一二三四五六\'.charAt(new Date().getDay());",1000); 
</script>

</span></div></td>
              </tr>
            </table></td>
            <td width="21"><img src="/images/main_11.gif" width="21" height="38"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="8" style=" line-height:8px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="270" background="/images/main_29.gif" style=" line-height:8px;">&nbsp;</td>
            <td width="505" background="/images/main_30.gif" style=" line-height:8px;">&nbsp;</td>
            <td style=" line-height:8px;">&nbsp;</td>
            <td width="21" style=" line-height:8px;"><img src="/images/main_31.gif" width="21" height="8"></td>
          </tr>
        </table></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td height="28" background="/images/main_36.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="177" height="28" background="/images/main_32.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%"  height="22">&nbsp;</td>
            <td width="59%" valign="bottom"><div align="center" class="STYLE1">当前用户：Admin</div></td>
            <td width="21%">&nbsp;</td>
          </tr>
        </table></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>

          ';
$i=1;$c=count($menuary);
foreach ($menuary as $k=>$v){
;echo '            <td width="65" height="28"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="23" valign="bottom"><table width="62" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="20" style="cursor:hand" onMouseOver="this.style.backgroundImage=\'url(/images/bg.gif)\';this.style.borderStyle=\'solid\';this.style.borderWidth=\'1\';borderColor=\'#a6d0e7\'; "onmouseout="this.style.backgroundImage=\'url()\';this.style.borderStyle=\'none\'"> <div align="center" class="STYLE3" onClick="changemenu(\'';echo $i;echo '\',\'';echo $c;echo '\')">';echo $k;echo '</div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="3"><img src="/images/main_34.gif" width="3" height="28"></td>
            ';
$i++;
}
;echo '            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="21"><img src="/images/main_37.gif" width="21" height="28"></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
';
?>