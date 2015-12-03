<?php
echo '<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="/skin/default/css.css" type="text/css">
		<script language="javascript">
function ShowFocus(obj)
{

	var i = 0;
	var TD_NUM = 100;// 此处为所有 <td> 的数量, <td> 的id从1开始.

	for( i=1; i<=TD_NUM; i++ )
	{
		try{ var b = document.getElementById("td"+ i) }catch(e){};
		if( b != null )
		{
			b.className = "a";
			b.style.color = "white";
		}
	}
	obj.className = "Txt_9pt_H_B";
	obj.style.color = "#FFCC00";
}

function menu_over(obj){
 	//移上去的颜色
	obj.style.backgroundColor=\'#3E71BC\';
	//obj.style.color=\'#000000\';  //文字内容颜色
	obj.style.cursor=\'hand\';

}

function menu_out(obj){
    //移开后的颜色
	obj.style.backgroundColor=\'\';
	obj.style.color=\'\';
	obj.style.cursor=\'\';

}
		</script>
		<link rel="stylesheet" href="css.css" type="text/css" />
	</HEAD>
	<body>
		<form name="Form1" method="post" action="#" id="Form1">
<script type="text/javascript" src="/skin/images/js/ig_webtab.js" ></script>

	<script type="text/javascript" src="/skin/images/js/ig_shared.js" ></script>


			<!-- logo 和 一级目录 背景 -->
			<table cellSpacing="0" cellPadding="0" width="100%" border="0">
				<tr>
					<td vAlign="bottom" align="right" background="/skin/images/corp_main_top_bj.gif" height="80">&nbsp;
						<a id="HyperLink2" class="menu" href="main.php" target="mainFrame">首页</a>&nbsp;&nbsp;
						&nbsp;&nbsp;
						<a id="HyperLink1" class="menu" href="logout.php" target="_top">退出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						<table cellSpacing="0" cellPadding="0" width="100%" background="/skin/images/corp_main_top_menu_bj.gif"
							border="0">
							<tr>
								<td height="28">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<!-- logo 和 二级目录 背景 -->
			<table height="24" cellSpacing="0" cellPadding="0" width="100%" border="0">
				<tr>
					<td align="right" background="/skin/images/corp_main_top_menu1_bj.gif">
						<table cellSpacing="0" cellPadding="0" width="550" border="0">
							<tr>
								<td width="80" height="24">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div id="Layer1" style="Z-INDEX: 10; WIDTH: 100%; POSITION: absolute; TOP: 52px; HEIGHT: 24px; align: center">
				<table cellSpacing="0" cellPadding="0" width="100%" border="0">
					<tr>
						<td width="20%">&nbsp;</td>
						<td vAlign="top" align="center">
<input type="hidden" name="UltraWebTab1" id="UltraWebTab1" value="0"/>


<table border="0" cellspacing="0" cellpadding="0" id="igtabUltraWebTab1" width="100%" height="40px">
	<tr><td>
		<table id="UltraWebTab1_tbl" cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr valign="center">

			<td nowrap id="UltraWebTab1td0" align="center"class="UltraWebTab1SelT0 Txt_9pt_B_B" height="28px" width="80px">首页</td>
			<td nowrap id="UltraWebTab1td1" align="center"class="UltraWebTab1DefT1 Shadow" height="28px" width="80px">会员资料</td>
			<td nowrap id="UltraWebTab1td2" align="center"class="UltraWebTab1DefT2 Shadow" height="28px" width="80px">财务管理</td>
			<td nowrap id="UltraWebTab1td3" align="center"class="UltraWebTab1DefT3 Shadow" height="28px" width="80px">奖金综合管理</td>
			<td nowrap id="UltraWebTab1td4" align="center"class="UltraWebTab1DefT4 Shadow" height="28px" width="80px">产品管理</td>
			<td nowrap id="UltraWebTab1td5" align="center"class="UltraWebTab1DefT5 Shadow" height="28px" width="80px">订单管理</td>
			<td nowrap id="UltraWebTab1td6" align="center"class="UltraWebTab1DefT6 Shadow" height="28px" width="80px">系统管理</td>


		    <td nowrap style="font-size:2px;cursor:default;width:90%;">&nbsp;</td>
			</tr>
		</table>
	</td></tr>
	<tr><td id="UltraWebTab1_cp" bgcolor="Transparent" class="Txt_9pt_B_B" style="background-color:Transparent;padding:3px 0px 0px 3px;height:12px;width:100%;background-repeat:no-repeat;">



		<iframe id="UltraWebTab1_frame0" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div0" width="100%" style=";height:100%" ><span>

		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'main.php\' class=\'menu\'>首页</a></nobr></td></tr></table></td>

		</tr></table></span></div>

		<iframe id="UltraWebTab1_frame1" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div1" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'users.php\' class=\'menu\'>会员资料</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'applystores.php\' class=\'menu\'>店铺申请</a></nobr></td></tr></table></td>

		</tr></table></span></div>

		<iframe id="UltraWebTab1_frame2" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div2" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'remits.php\' class=\'menu\'>汇款管理</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'banks.php\' class=\'menu\'>银行账号</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'cashes.php\' class=\'menu\'>提现管理</a></nobr></td></tr></table></td>

		</tr></table></span></div>

		<iframe id="UltraWebTab1_frame3" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div3" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'salarys.php\' class=\'menu\'>奖金综合管理</a></nobr></td></tr></table></td>

		</tr></table></span></div>

		<iframe id="UltraWebTab1_frame4" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div4" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'category.php\' class=\'menu\'>产品分类</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'products.php\' class=\'menu\'>产品管理</a></nobr></td></tr></table></td>

		</tr></table></span></div>


		<iframe id="UltraWebTab1_frame5" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div5" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'orders.php\' class=\'menu\'>订单列表</a></nobr></td></tr></table></td>

		</tr></table></span></div>

		<iframe id="UltraWebTab1_frame6" src="#" style="display:none;" width="99.5%" height="9px"></iframe>
		<div id="UltraWebTab1_div6" width="100%" style="height:100%;display:none;" ><span>
		<table border=0 cellspacing=0 cellpadding=0><tr><td width=0>&nbsp;</td>

		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'managers.php\' class=\'menu\'>管理员设置</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'logs.php\' class=\'menu\'>日志管理</a></nobr></td></tr></table></td>
		<td width=5></td><td valign=top height=\'22\' align=\'center\' class=\'Shadow1\' onMouseOver=\'javascript:menu_over(this);\' onMouseOut=\'javascript:menu_out(this);\'><table width=100% ><tr><td><nobr><img src=\'/skin/images/shop_menu_jt_blove.gif\' width=\'4\' height=\'7\' hspace=\'4\' vspace=\'1\' /><a onclick=\'ShowFocus(this)\' id=td4 target=mainFrame href=\'announces.php\' class=\'menu\'>公告管理</a></nobr></td></tr></table></td>

		</tr></table></span></div>



		<div width="100%" height="100%" id="UltraWebTab1_empty">&nbsp;</div>
	</td></tr>
</table>
<script type="text/javascript">try{igtab_init("UltraWebTab1", 0, "", ["UltraWebTab111Shadow++Txt_9pt_B_B+#-1",
"1115首页Transparent",
"1115会员资料Transparent",
"1115汇款Transparent",
"1115奖金综合管理Transparent",
"1115产品管理Transparent",
"1115订单管理Transparent",
"1115系统管理Transparent"
], "");}catch(e){}</script>
</td>

						<TD width="20%"></TD>
					</tr>
				</table>
			</div>
		</form>
	</body>
</HTML>'
?>