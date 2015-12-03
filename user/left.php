<?php

include("../include/conn_2.php");
include("../include/rank.php");
include("../include/upower.php");
include("../include/hypower.php");
$sql_rank="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs_rank=$db->get_one($sql_rank);
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
a{ text-decoration: none}
.ic_22{padding:0px;margin:0 auto;overflow:hidden;}
.ic_22 ul{float:left;width:140px;margin:0px;padding-left:15px;}
.ic_22 li{float:left;width:60px;text-align:center; }
.ic_22 li p{padding:2px 0px;margin:2px 0px;text-align:center;color:#000000; }
.ic_22 li img{border-style:none;}
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


<table width="165" height="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:-20px">
  <tr>
    <td height="28" background="images/main_40.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%">&nbsp;</td>
        <td width="81%" height="20"><span class="STYLE1">管理菜单</span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="151" border="0" align="center" cellpadding="0" cellspacing="0">
      <!--start -->
      ';
$i=0;
$c=count($menuary);
foreach($menuary as $k=>$v){
$i++;
;echo '      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="images/main_47.gif" id="imgmenu';echo $i;echo '" class="menu_title" onMouseOver="this.className=\'menu_title';echo $i;echo '\';" onClick="showsubmenu1(';echo $i;echo ',';echo $c;echo ')" onMouseOut="this.className=\'menu_title\';" style="cursor:hand"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="18%">&nbsp;</td>
                <td width="82%" class="STYLE1">';echo $k;;echo '</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td background="images/main_51.gif" id="submenu';echo $i;echo '" style="display:none">
			 <div class="sec_menu" >
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              ';
foreach($v as $k1=>$v1){
;echo '
                  <tr>
                    <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                    <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="20" style="cursor:hand" onMouseOver="this.style.borderStyle=\'solid\';this.style.borderWidth=\'1\';borderColor=\'#7bc4d3\'; "onmouseout="this.style.borderStyle=\'none\'"><a href="';echo $execary[$k][$k1];echo '"  target="I2"><span class="STYLE3">';echo $v1;;echo '</span></a></td>
                        </tr>
                    </table></td>
                  </tr>
                  ';};echo '                </table></td>
              </tr>
              <tr>
                <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
              </tr>
            </table></div></td>
          </tr>

        </table></td>
      </tr>
      ';
}
;echo '      <!--dd-->
    </table></td>
  </tr>
  <tr>
    <td height="18" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="18" align="center"><div class="STYLE1">
		<div class="ic_22">
	    <ul class="kj">
		 
		 <li class="c2"><a href="userreg.php" target="I2" onmouseover="javascript:document.getElementById(\'2a\').src=\'images/kj_2b.gif\';" onmouseout="javascript:document.getElementById(\'2a\').src=\'images/kj_2a.gif\';"><img src="images/kj_2a.gif" id="2a"><p>会员注册</p></a></li>
		 <li class="c4"><a href="receviewmail.php" target="I2" onmouseover="javascript:document.getElementById(\'4a\').src=\'images/kj_4b.gif\';" onmouseout="javascript:document.getElementById(\'4a\').src=\'images/kj_4a.gif\';"><img src="images/kj_4a.gif" id="4a"><p>收件箱</p></a></li>
		 <li class="c6"><a href="salaryquery.php" target="I2" onmouseover="javascript:document.getElementById(\'6a\').src=\'images/kj_6b.gif\';" onmouseout="javascript:document.getElementById(\'6a\').src=\'images/kj_6a.gif\';"><img src="images/kj_6a.gif" id="6a"><p>日奖金查询</p></a></li>
		 <li class="c1"><a href="wangyinzf.php" target="I2" onmouseover="javascript:document.getElementById(\'1a\').src=\'images/kj_1b.gif\';" onmouseout="javascript:document.getElementById(\'1a\').src=\'images/kj_1a.gif\';"><img src="images/kj_1a.gif" id="1a"><p>在线支付</p></a></li>
		</ul>
	  </div></div></td>
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
imgmenu.background="images/main_47.gif";
}
else
{
eval("submenu" + sid + ".style.display=\\"none\\";");
imgmenu.background="images/main_48.gif";
}
}
function showsubmenu1(sid,k)
{
	for(var i=1;i<=k;i++){
		eval("submenu" + i + ".style.display=\\"none\\";");
	}
	eval("submenu" + sid + ".style.display=\\"\\";");
}


</script>'
?>