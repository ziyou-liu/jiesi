﻿<?php

include("../include/conn.php");
include("../include/power.php");
include("../include/access.php");
;echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
.STYLE3 {
	font-size: 12px;
	color: #033d61;
}
a:link{
font-size: 12px;
	color: #033d61; text-decoration:none;
}
a:visited{
font-size: 12px;
	color: #033d61; text-decoration:none;
}
a:hover{
font-size: 12px;
	color: #033d61; text-decoration:underline;
}
-->
</style>
<style type="text/css">
.menu_title SPAN {
	FONT-WEIGHT: bold; LEFT: 3px; COLOR: #ffffff; POSITION: relative; TOP: 2px
}
.menu_title2 SPAN {
	FONT-WEIGHT: bold; LEFT: 3px; COLOR: #FFCC00; POSITION: relative; TOP: 2px
}
</style>

<table width="165" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="28" background="/images/main_40.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%">&nbsp;</td>
        <td width="81%" height="20"><span class="STYLE1">管理菜单</span></td>
      </tr>
    </table></td>
  </tr>
 ';
$i=1;$c=count($menuary);
foreach($menuary as $key=>$value){
;echo '  <tr>
    <td valign="top"><table width="151" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="/images/main_47.gif" id="imgmenu';echo $i;echo '" class="menu_title" onMouseOver="this.className=\'menu_title2\';" onClick="showsubmenu1(';echo $i;echo ',';echo $c;echo ')" onMouseOut="this.className=\'menu_title\';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="18%">&nbsp;</td>
                <td width="82%" class="STYLE1">';echo $key;echo '</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td background="/images/main_51.gif" id="submenu';echo $i;echo '" ';if($i>1) echo "style='display:none'";echo '>
			 <div class="sec_menu" >
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                ';
foreach($value as $key1=>$value_1){
;echo '						<!--1-->
						  <tr>
							<td width="16%" height="25"><div align="center"><img src="/images/left.gif" width="10" height="10" /></div></td>
							<td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td height="20" style="cursor:hand" onmouseover="this.style.borderStyle=\'solid\';this.style.borderWidth=\'1\';borderColor=\'#7bc4d3\'; "onmouseout="this.style.borderStyle=\'none\'"><span class="STYLE3"><a href="';echo $execary[$key][$key1];echo '" target="I2">';echo $value_1;echo '</a></span></td>
								</tr>
							</table></td>
						  </tr>
						  <!--2-->
						  ';
}
;echo '
                </table></td>
              </tr>
              <tr>
                <td height="5"><img src="/images/main_52.gif" width="151" height="5" /></td>
              </tr>
            </table></div></td>
          </tr>

        </table></td>
      </tr>
      ';
$i++;
}
;echo '
  <tr>
    <td height="18" background="/images/main_58.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="18" valign="bottom"><div align="center" class="STYLE3"><script src="http://s95.cnzz.com/stat.php?id=1254057586&web_id=1254057586" language="JavaScript"></script> 版本：v';echo date("Y");;echo '</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
function showsubmenu(sid)
{
whichEl = eval("submenu" + sid);
imgmenu = eval("imgmenu" + sid);
if (whichEl.style.display == "none")
{
eval("submenu" + sid + ".style.display=\\"\\";");
imgmenu.background="/images/main_47.gif";
}
else
{
eval("submenu" + sid + ".style.display=\\"none\\";");
imgmenu.background="/images/main_48.gif";
}
}


function showsubmenu1(sid,k)
{
	for(var i=1;i<=k;i++){
		eval("submenu" + i + ".style.display=\\"none\\";");
	}
	eval("submenu" + sid + ".style.display=\\"\\";");
}

</script>';
?>