<?php

include("../include/conn_2.php");include("../include/function.php");include("../include/rank.php");
session_start();
$sql_rank="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rs_rank=$db->get_one($sql_rank);
;echo '<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>办公自动化系统</title>
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.STYLE17 {color: #333333}
-->
</style>
<script type="text/javascript" src="ZeroClipboard.js"></script>
<script type="text/javascript">
function init() {
  clip=new ZeroClipboard.Client();
  clip.setHandCursor(true);
  clip.addEventListener(\'mouseOver\', function (client){
    clip.setText( document.getElementById(\'fe_text\').value );
  });
  clip.addEventListener(\'complete\', function (client, text) {
	if(!+[1,])window.clipboardData.setData("Text",val); 
    alert("复制成功，您可以使用Ctrl+V粘贴了！");
  });
  clip.glue(\'clip_button\', \'clip_container\');
}
</script>
</head>

<body onLoad="init()">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="6" rowspan="5"><table width="100%" border=0 align="center" cellpadding=0 cellspacing=0 class=Table_xt>
        <tbody>
          <tr>
            <td width="100%" colspan=4 background="images/bg.gif"><table cellspacing=0 cellpadding=0 width="100%">
                <tbody>
                  <tr>
                    <td width=213 height=23>&nbsp;<strong><font color="#000000" size="3">事务提醒</font></strong></td>
                    <td >&nbsp;</td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
          <tr>
            <td height="20" align="left" bgcolor="#d4e8fa" ><table width="100%" height="291" border="0" align="center" cellpadding="3" cellspacing="1">
                ';
$timelimit=strtotime(date('Y-m-d',time()));$timelimit1=$timelimit+3600*24;
$sql_1="select count(id) as c1 from {$db_prefix}announce where datediff(from_unixtime(".time()."),from_unixtime(addtime))=0";
$rs_1=$db->get_one($sql_1);
$sql_2="select count(id) as c2 from {$db_prefix}announce where 1";
$rs_2=$db->get_one($sql_2);
$sql_c1="select count(id) as c1 from {$db_prefix}mails where datediff(from_unixtime(".time()."),from_unixtime(addtime))=0 and username='".$_SESSION["glo_username"]."'";
$rs_c1=$db->get_one($sql_c1);
$sql_c2="select count(id) as c1 from {$db_prefix}mails where username='".$_SESSION["glo_username"]."'";
$rs_c2=$db->get_one($sql_c2);
$sqlall="select sum(bdmoney) as a,sum(bdnum) as b from {$db_prefix}users where state=1 and isblank=0 and confirmtime>'".$timelimit."' and confirmtime<='".$timelimit1."'";
$rsall=$db->get_one($sqlall);
$sqlall1="select sum(bdnum) as b from {$db_prefix}users where state=1 and isblank=0 and confirmtime<='".$timelimit1."'";
$rsall1=$db->get_one($sqlall1);
;echo '				';if($rs_rank["tghttp"]){;echo '                <tr>
                  <td height="20" align="center" valign="middle" bgcolor="#FBFDFF" colspan="2">
					推广链接:<strong> <span style="color:#FF0000 "><input id="fe_text" cols="50" rows="5" size="70" value="';echo $rs_rank["tghttp"];echo '"></span></strong><span id="clip_container"><span id="clip_button"><input name="button" type="button" value="复制"></span></span>
				  </td>
                </tr>
				';};echo '				<tr>
                  <td height="38" width="50%" align="left" valign="middle" bgcolor="#FBFDFF" >您好<span class="STYLE17">：</span><strong> <span style="color:#FF0000 ">';echo $_SESSION["glo_username"];;echo '</span></strong></td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ><span style="color:#FF0000 "><span class="STYLE17">您的客户级别为：</span><span class="STYLE1"><strong>';echo $rankary[$rs_rank["rank"]];echo '</strong></span></span><span class="STYLE1"><strong>';if($rs_rank['isdp']) echo "【店铺】";;echo '</strong></span><span class="STYLE1"><strong>';if($rs_rank['rank1']>0) echo " 兼【".$rank1ary[$rs_rank['rank1']]."】";;echo '</strong></span>
				  </td>
                </tr>
                <tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >您的奖金累计为：<span style="color:#FF0000 ">';echo $rs_rank["price_s"];echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >您的购物账户余额为：<span style="color:#FF0000 ">';echo $rs_rank["price_repeat1"];echo '</span> 元</td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >您的帐户余额为: <span style="color:#FF0000 ">';echo $rs_rank["j_price"];echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >您的重复消费帐户余额为：<span style="color:#FF0000 ">';echo $rs_rank["price_repeat"];echo '</span> 元</td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >您已累计办理：<span style="color:#FF0000 ">';echo $rs_rank["tjnum"];echo '</span> 人</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >您的报单币余额为：<span style="color:#FF0000 ">';echo $rs_rank["price"];echo '</span> 元</td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >您已累计领取的静态奖金：<span style="color:#FF0000 ">';echo $rs_rank["flprice"];echo '</span></td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >今天全国新增营业额：<span style="color:#FF0000 ">';echo $rsall["a"];echo '</span></td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >您的对碰奖封顶金额为：<span style="color:#FF0000 ">';$glodpfd="glo_dpmax_".$rs_rank["rank"];echo $$glodpfd;;echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >当前全国分红总份数为：<span style="color:#FF0000 ">';echo $rsall1["b"];echo '</span></td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >回本奖封顶金额为：<span style="color:#FF0000 ">';$glohbfd="glo_hbfd_".$rs_rank["rank"];echo $$glohbfd;;echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >今天新增分红份数：<span style="color:#FF0000 ">';echo $rsall["b"];echo '</span></td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >互吃奖封顶金额为：<span style="color:#FF0000 ">';$glohcfd="glo_hcfd_".$rs_rank["rank"];echo $$glohcfd;;echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" >我的分红份数为：<span style="color:#FF0000 ">';echo $rs_rank["bdnum"];echo '</span></td>
                </tr>
				<tr>
                  <td height="20" align="left" valign="middle" bgcolor="#FBFDFF" >销售管理奖封顶金额为：<span style="color:#FF0000 ">';$gloxgfd="glo_xgfd_".$rs_rank["rank"];echo $$gloxgfd;;echo '</span> 元</td>
				  <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ><!--您的报单币余额为：<span style="color:#FF0000 ">';echo $rs_rank["price"];echo '</span>--></td>
                </tr>
                <tr>
					<td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ><div style="float:left ">今天新增留言 ';echo $rs_c1["c1"];echo ' 条; 共有留言 ';echo $rs_c2["c1"];echo ' 条</div>
                      <div style="float:right "><a href="receviewmail.php">进入留言</a></div></td>
					 <td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ></td>
                </tr>
                <tr>
					<td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ><div style="float:left ">今天新增公告 ';echo $rs_1["c1"];echo ' 条 ; 系统共有公告 ';echo $rs_2["c2"];echo ' 条</div>
                      <div style="float:right "><a href="announces.php">进入公告</a></div></td>
					<td height="38" align="left" valign="middle" bgcolor="#FBFDFF" ></td>
                </tr>
            </table></td>
          </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
'
?>