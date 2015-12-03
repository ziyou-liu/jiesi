<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<style type="text/css">
<!--
.memo{
	color:red;
}
-->
</style>
';
include("../include/conn.php");
if ($action=="setting"){
if($intocx>100){
echo "<script>alert('比例应小于100');location.href='javascript:history.back()';</script>";exit();
}
$pv_vs_yuan=1;
$sql="update {$db_prefix}setting set pv_vs_yuan='$pv_vs_yuan'";
foreach($_POST as $key=>$value) {
$sql.=",".$key."='".$value."'";
}
if(empty($_POST['sjleijipv'])){
$sql.=",sjleijipv='$sjleijipv'";
}
if(empty($_POST['sjkoumoney'])){
$sql.=",sjkoumoney='$sjkoumoney'";
}
if(empty($_POST['hy_sjleijipv'])){
$sql.=",hy_sjleijipv='$hy_sjleijipv'";
}
$db->query($sql);
echo "<script>alert('设定成功');location.href='setting.php';</script>";exit();
}
$sql="select * from {$db_prefix}setting where 1";
$rs=$db->get_one($sql);
;echo '<script language="javascript" src="../include/ajax.js"></script>
</HEAD><body>
<form name="form1" method="post" action="?action=setting">
<TABLE width="1000" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt style="margin:0 auto;">
<TBODY>
<TR><TD width="800" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"  background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>奖金参数设定</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <TR>
      <TD width="9%" align="left" valign="middle" bgColor="#FBFDFF"><strong>会员级别</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD width="18%" align="left" valign="middle" bgColor="#FBFDFF"><strong><input name="rank_name_';echo $key;echo '" type="text" value=\'';echo $rs["rank_name_".$key];echo '\'  size="15"></strong></TD>
	  ';};echo '    </TR>
	<TR>
      <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>消费额</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF"><input name="member_';echo $key;echo '" type="text" value=\'';echo $rs["member_".$key];echo '\'  size="7">
	    元</TD>
	  ';};echo '    </TR>
	<TR>
      <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>返购物金额</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF"><input name="shopmon_';echo $key;echo '" type="text" value=\'';echo $rs["shopmon_".$key];echo '\'  size="7">
	    元</TD>
	  ';};echo '    </TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>返利份数</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF"><input name="num_';echo $key;echo '" type="text" value=\'';echo $rs["num_".$key];echo '\'  size="7">
	  单</TD>
	    ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>静态返利形式1</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">日返<input name="flfs1_';echo $key;echo '" type="text" value=\'';echo $rs["flfs1_".$key];echo '\'  size="7"> 元<br />
	  </TD>
	  ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>静态返利形式1</strong></TD>
	  <TD align="left" valign="middle" colspan="';echo count($rankary);echo '" bgColor="#FBFDFF">
		周末是否返利<input name="isweekend" value="0" type="radio" ';if($rs['isweekend']==0) echo "checked";;echo '/>返利<input name="isweekend" value="1" type="radio" ';if($rs['isweekend']==1) echo "checked";;echo '/>不返利
	  <br />
	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>静态返利形式2</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">每日新增业绩<input name="flfs2" type="text" value="';echo $rs['flfs2'];echo '" size="7" > % 加权</TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>选择静态返利形式</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  <input name="flxs" value="1" type="radio" ';if($rs['flxs']==1) echo "checked";;echo '>返利形式1
	  <input name="flxs" value="2" type="radio" ';if($rs['flxs']==2) echo "checked";;echo '>返利形式2
	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>静态奖金</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  <input name="intocx" value="';echo $rs['intocx'];echo '" type="text" size="7"/> %进重复消费购物账户
	  ';echo (100-$rs['intocx']);echo ' %进奖金金账户
	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>碰对奖</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">每碰<input name="dprate_';echo $key;echo '" type="text" value=\'';echo $rs["dprate_".$key];echo '\'  size="7"> 元<br />
	  </TD>
	  ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>碰对奖日封顶</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF"><input name="dpmax_';echo $key;echo '" type="text" value=\'';echo $rs["dpmax_".$key];echo '\'  size="7"> 元<br />
	  </TD>
	  ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>碰对说明</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF"><strong>比例为：<input name="dbbl1" type="text" value="';echo $rs['dbbl1'];echo '" size="2"> : <input name="dbbl2" type="text" value="';echo $rs['dbbl2'];echo '" size="2">，按照人数碰</strong></TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>销售奖</strong></TD>
	  ';foreach($rankary as $key1=>$value1){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
		  ';foreach($rankary as $key2=>$value2){;echo '		  推荐';echo $value2;echo '拿<input name="tjrate_';echo $key2;echo '_';echo $key1;echo '" type="text" value=\'';echo $rs["tjrate_".$key2."_".$key1];echo '\'  size="7"> 元/位<br />
		  ';};echo '	  </TD>
	   ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>互动奖</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">';foreach($rankary as $key=>$value){;echo '遇';echo $value;echo '，拿<input name="jdrate_';echo $key;echo '" type="text" value=\'';echo $rs["jdrate_".$key];echo '\'  size="7"> 元<br /> ';};echo '	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>互动奖封顶</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  ';for($i=0;$i<=3;$i++) {$j=$i+1;if($i<3){;echo '销售<input name="xsfh_';echo $j;;echo '" type="text" value="';echo $rs['xsfh_'.$j];echo '"  size="3" />份,拿<input name="bei_';echo $j;echo '" type="text" value=\'';echo $rs["bei_".$j];echo '\' size="7"> 倍投资额<br /> ';}else{;echo '	  销售<input name="xsfh_';echo $j;;echo '" type="text" value="';echo $rs['xsfh_'.$j];echo '"  size="3" />份以上,拿满<input name="maxceng" type="text" value=\'';echo $rs["maxceng"];echo '\' size="7"> 层<br />
	  ';}};echo '	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>对碰领导奖</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="top" bgColor="#FBFDFF">
	  ';for($i=1;$i<=$key;$i++) {;echo '	  拿';echo $i;echo '代碰对奖的<input name="dlrate_';echo $key;echo '_';echo $i;echo '" type="text" value=\'';echo $rs["dlrate_".$key."_".$i];echo '\'  size="7"> %<br />
	  ';};echo '	  </TD> ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>互吃奖</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  双轨左右旁线的两个人，左右各推荐<input name="hctjnum" type="text" value="';echo $rs['hctjnum'];echo '" size="7">个以上可以享受旁线另外一个人对碰奖的<input name="hcrate" type="text" value="';echo $rs['hcrate'];echo '" size="7">%
	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>互吃奖封顶</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
	  <input name="hcfd_';echo $key;echo '" type="text" value="';echo $rs['hcfd_'.$key];echo '" size="7"> 元
	  </TD>';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>回本奖</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  ';for($i=1;$i<=3;$i++) {;echo '	  拿上';echo $i;echo '代碰对收入的<input name="hbrate_';echo $i;echo '" type="text" value="';echo $rs['hbrate_'.$i];echo '" size="7">%<br>
	  ';};echo '	  ';for($i=1;$i<=3;$i++) {;echo '	  拿下';echo $i;echo '代碰对收入的<input name="hbdrate_';echo $i;echo '" type="text" value="';echo $rs['hbdrate_'.$i];echo '" size="7">%<br>
	  ';};echo '	  <strong>推荐人数达到<input name="hbtjnum" type="text" value="';echo $rs['hbtjnum'];echo '" size="7"> 人</strong>
	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>回本封顶</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
	  <input name="hbfd_';echo $key;echo '" type="text" value="';echo $rs['hbfd_'.$key];echo '" size="7"> 元<br>
	  </TD>
	  ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>销售绩效考核标准</strong></TD>
	  <TD align="left" valign="top" bgColor="#FBFDFF" colspan=\'';echo count($rankary);echo '\'>
	  ';foreach($rank1ary as $key=>$value){;echo '		推荐<input name="xstjnum_';echo $key;echo '" type="text" value="';echo $rs['xstjnum_'.$key];echo '" size="7" >人，成为';echo $value;echo '，见点代数<input name="xsjdnum_';echo $key;echo '" type="text" value="';echo $rs['xsjdnum_'.$key];echo '" size="7">代，见点<input name="xsjdmoney_';echo $key;echo '" type="text" value="';echo $rs['xsjdmoney_'.$key];echo '" size="7">元<br />
	  ';};echo '	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>销售管理奖封顶</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
	  <input name="xgfd_';echo $key;echo '" type="text" value="';echo $rs['xgfd_'.$key];echo '" size="7"> 元<br>
	  </TD>
	  ';};echo '	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>服务中心</strong></TD>
	  ';foreach($rankary as $key=>$value){if($key>1){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
	  拿<input name="bdrate_';echo $key;echo '" type="text" value=\'';echo $rs["bdrate_".$key];echo '\'  size="7"> %的报单费<br />
	  </TD>
	  ';}else{;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
	  &nbsp;
	  </TD>
	  ';}};echo '	</TR>
	<TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>同县管理奖与同县重消奖</strong></TD>
		<TD align="left" valign="middle" colspan="';echo count($rankary);echo '" bgColor="#FBFDFF">
			报单中心级别申请成为报单中心后，推荐<input name="bdtjnum" type="text" value="';echo $rs['bdtjnum'];echo '" size="7">名会员后，享受县区内所有注册会员的对碰奖的<input name="bddprate" type="text" value="';echo $rs['bddprate'];echo '" size="7">% 和重复消费的<input name="bdcxrate" type="size" value="';echo $rs['bdcxrate'];echo '" size="7">%
		</TD>
	</TR>
	';foreach($rankary as $k=>$val){;echo '	<TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>重消返点推荐';echo $val;echo '</strong></TD>
	  ';foreach($rankary as $key=>$value){;echo '	  <TD align="left" valign="middle" bgColor="#FBFDFF">
		<input name="fdrate_';echo $key;echo '_';echo $k;echo '" type="text" value="';echo $rs['fdrate_'.$key.'_'.$k];echo '" size="7"> %<br>
	  </TD>
	  ';};echo '	</TR>
	';};echo '	<TR>
      <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>一线线公排网</strong></TD>
	  <TD align="left" valign="middle" colspan="';echo count($rankary);echo '" bgColor="#FBFDFF">拿一条线下的<input name="maxdai" type="text" value="';echo $rs['maxdai'];echo '" size="7">人，以及推荐的<input name="dainum" type="text" value="';echo $rs['dainum'];echo '" size="7">代，第一个除外，见点
		<input name="recommend" type="text" value=\'';echo $rs["recommend"];echo '\' size="7">元
      </TD>
    </TR>
	<TR>
      <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>';echo $rs['gui'];echo '轨公排网</strong></TD>
	  <TD align="left" valign="middle" colspan="';echo count($rankary);echo '" bgColor="#FBFDFF">
		推荐<input name="tjnum" type="text" value="';echo $rs['tjnum'];echo '" size="7">人进网公排，
		公排网按<input name="gui" type="text" value="';echo $rs['gui'];echo '" size="7">轨公排，见点<input name="recommend2" type="text" value="';echo $rs['recommend2'];echo '" size="7">元，最大见点<input name="maxbceng" type="text" value="';echo $rs['maxbceng'];echo '" size="7">层
      </TD>
    </TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>公排拿奖方式</strong></TD>
	  <TD align="left" valign="middle" colspan=\'';echo count($rankary);echo '\' bgColor="#FBFDFF">
	  <input name="gpfs" value="1" type="radio" ';if($rs['gpfs']==1) echo "checked";;echo '>一条线公排网
	  <input name="gpfs" value="2" type="radio" ';if($rs['gpfs']==2) echo "checked";;echo '>';echo $rs['gui'];echo '轨公排网
	  </TD>
	</TR>
      <TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF"><strong>重消账户</strong></TD>
	    <TD align="left" valign="middle" bgColor="#FBFDFF" colspan="';echo count($rankary);;echo '">扣奖金总额的
	      <input name="cfxfrate" type="text" id="cfxfrate" value="';echo $rs['cfxfrate'];echo '" size="7"> 
	      % </TD>
	  </TR>  
	  <TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>网络维护费</strong></TD>
		<TD align="left" valign="middle" bgColor="#FBFDFF" colspan="';echo count($rankary);echo '">
		每年扣<input name="ever_year" type="text" value=\'';echo $rs["ever_year"];echo '\' size="8">元
        </TD>
	  </TR>
	  <TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>购物折扣</strong></TD>
		';foreach($rankary as $key=>$value){;echo '		<TD align="left" valign="middle" bgColor="#FBFDFF">
		<input name="zhekou_';echo $key;echo '" type="text" value=\'';echo $rs["zhekou_".$key];echo '\' size="8">（10表示不打折）
        </TD>
		';};echo '	  </TR>
	  <TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>在线支付接口</strong></TD>
		<TD align="left" valign="middle" bgColor="#FBFDFF" colspan="';echo count($rankary);echo '">
			链接域名：<input name="cft_url" type="text" value=\'';echo $rs["cft_url"];echo '\' size="80"><br />
			账户：<input name="hx_username" type="text" value=\'';echo $rs["hx_username"];echo '\' size="8" /><br />
			密码：<input name="hx_password" type="text" value=\'';echo $rs["hx_password"];echo '\' size="80" /><br />
        </TD>
	  </TR>
      <TR>
		<TD align="left" valign="middle" bgColor="#FBFDFF"><strong>其他</strong></TD>
		<TD align="left" valign="middle" bgColor="#FBFDFF" colspan="';echo count($rankary);;echo '">
		汇款至少
        <input name="remits_low" type="text" id="remits_low" value="';echo $rs['remits_low'];echo '" size="7">
        元<br>
      提现金额至少
        <input name="withdraw_low" type="text" id="withdraw_low" value="';echo $rs['withdraw_low'];echo '" size="7">
        元，且为100元的整数倍&nbsp;&nbsp;&nbsp;
	  提现手续费&nbsp;
	  <input name="withdraw_fee" type="text" value=\'';echo $rs["withdraw_fee"];echo '\' size="7">%<br>
	  转账手续费<input name="transfer_rate" type="text" value=\'';echo $rs["transfer_rate"];echo '\' size="7">%<br>
	  后台修改会员级别扣电子货币
	  <input name="sjkoumoney" type="checkbox"  value="1" ';if($rs["sjkoumoney"]){echo "checked";};echo '>
	  &nbsp;&nbsp;&nbsp;
	  后台修改会员级别累计业绩
	  <input name="sjleijipv" type="checkbox"  value="1" ';if($rs["sjleijipv"]){echo "checked";};echo '><br>
	  <label>前台升级累计业绩
	  <input name="hy_sjleijipv" type="checkbox"  value="1" ';if($rs["hy_sjleijipv"]){echo "checked";};echo '></label>
	  <!--综合管理费<input name="fee" type="text" value=\'';echo $rs["fee"];echo '\' size="7">元
	  开启<input type="checkbox" name="switch1" value="1" ';if($rs["switch1"]){echo "checked";};echo ' >--></TD>
    </TR>
	<TR>
	  <TD background="images/tab_19.gif" colspan="6" align="center" valign="middle">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit   value="确定" >	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>'
?>