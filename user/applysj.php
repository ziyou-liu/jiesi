<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">

';
include("../include/conn_2.php");include("../include/function.php");
include("../include/secpwd.php");
include("../include/rank.php");
include("../0123456789/1_s.php");
include("../include/ecls.php");
include("../include/logcls.php");
include("../include/net.php");
$modtime=time();
if($id>0){
$sql="select * from {$db_prefix}users where id='$id' and state=1 and regusername='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
if(empty($rs['id'])){
echo "<script>alert('参数有误');history.back();</script>";exit();
}
$sqlreg="select price from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rsreg=$db->get_one($sqlreg);
$regusername=$_SESSION["glo_username"];
}else{
$sql="select * from {$db_prefix}users where username='".$_SESSION["glo_username"]."' ";
$rs=$db->get_one($sql);
$regusername='';
}
$realname=$rs['realname'];
if ($action=="apply"){
$sql_e="select id from {$db_prefix}editrankrecord where username='".$rs['username']."' and type=0 and state=0";
$rs_e=$db->get_one($sql_e);
if($rs_e['id']){
echo "<script>alert('已经有未审核的升级申请，请耐心等待平台审核！');location.href='applysj.php?id={$id}';</script>";exit();
}
$glo_rname="glo_member_".$torank;
$bdmoney=$$glo_rname;
$glo_rname_o="glo_member_".$rs["rank"];
$o_bdmoney=$$glo_rname_o;
$span_bdmoney=$bdmoney-$o_bdmoney;
$buyproprice=0;
foreach($proid as $k_1=>$v_1){
if ($v_1>0){
$buyproprice+=$tprice[$v_1-1]*$buynum[$v_1-1];
}
}
if ($buyproprice<$span_bdmoney){
$hint="您选择的产品的价格不足{$span_bdmoney}\\n";
}
if($hint==''&&((empty($id) &&$rs["price"]<$span_bdmoney) ||($id>0 &&$rsreg['price']<$span_bdmoney))){
$hint="您没有足够的金额！请充值足额后在升级！此操作需要花费{$span_bdmoney}！";
}
if($hint!=''){
echo "<script>alert('".$hint."');location.href='applysj.php?id={$id}';</script>";exit();
}
$sql_1="insert into {$db_prefix}orders(username,realname,price,pv,zhekou,state,addtime,zftime,type1) values('".$rs["username"]."','".trim($realname)."','".$buyproprice."','".$buypropv."',1,'0','".$modtime."','0',2)";
$db->query($sql_1);
$orderid=$db->insert_id();
foreach($proid as $k_1=>$v_1){
if ($v_1>0){
$sqlp="select * from {$db_prefix}product where id='".$proid1[$v_1-1]."'";
$rsp=$db->get_one($sql);
$sql1="insert into {$db_prefix}orders1(orderid,username,realname,productid,productname,num,price,pv,addtime,state,zftime,type1) values('".$orderid."','".$rs["username"]."','".trim($realname)."','".$rsp["id"]."','".$rsp["productname"]."','".$buynum[$v_1-1]."','".$rsp["price"]."','".$rsp["pv"]."','".$modtime."','0','0',2)";
$db->query($sql1);
}
}
$sql="insert into {$db_prefix}editrankrecord (username,oldrank,rank,applytime,state,isapproved,orderid,regusername) values ('".$rs["username"]."','".$rs["rank"]."','$torank','$modtime','0','0','$orderid','$regusername')";
$db->query($sql);
echo "<script>alert('您的申请已经提交，请等待管理员审核！');location.href='applysj.php?id={$id}';</script>";exit();
}
;echo '<script language="javascript" type="text/javascript" src="../include/js.js"></script>
<script language="javascript" type="text/javascript" src="../include/area.js"></script>
<script language="javascript" type="text/javascript" src="../include/ajax.js"></script>
<script language=\'javascript\'>
function buypro(){
	
	var t1=document.getElementsByName(\'proid[]\').length;
	
	var tprice=0;var tpv=0;
		for(var i=0;i<t1;i++)	{
			if (document.getElementsByName(\'proid[]\')[i].checked){
				tprice+=document.getElementsByName(\'tprice[]\')[i].value*document.getElementsByName(\'buynum[]\')[i].value;
				//tpv+=document.getElementsByName(\'tpv[]\')[i].value*document.getElementsByName(\'buynum[]\')[i].value;
			}
		}
	var jbstr=\'\';
	var t2=document.getElementsByName(\'trank[]\').length;
	for(var i=0;i<t2;i++){
		if (tprice>=document.getElementsByName(\'trank[]\')[i].value){
			document.form1.torank.options[i+1].selected=true;
			jbstr=document.getElementsByName(\'trank1[]\')[i].value;
		}
	}
	document.getElementById(\'buyproinfo\').innerHTML=\'总计：\'+tprice+\'元， 已达到会员级别【\'+jbstr+\'】\';//\'+tpv+\'BV；
}
</script>
</HEAD><body bgcolor="#FFFFFF">
<center>
';if($rs["rank"]<count($rankary)){
if($rs['isdp']==0 &&empty($id)) echo "只能从注册中心升级";
else{
;echo '	<form name="form1" method="post" action="applysj.php">
	<input type="hidden" name="action" value="apply">
	';if($id>0){;echo '	<input type="hidden" name="id" value="';echo $id;;echo '">
	';};echo '	<TABLE width="650" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
	<TBODY>
	<TR><TD width="650" colSpan=4 background="images/bg.gif">
	<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
	<TD height=23>&nbsp;<strong>升级申请</strong></TD>
	</TR></TBODY></TABLE>
	</TD></TR>
	<TR>
	  <TD height="20" align="left" bgColor="#d4e8fa" >
	   <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		 <td width="10%">选择</td>
		  <td width="21%">产品名称</td>
		  <td width="19%">说明</td>
		  <td width="10%">会员价</td>	 
		  <td width="6%">数量</td>
		</tr>
		';
$p=1;
$sqlreg="select * from {$db_prefix}product where 1 and num>0";
$resultreg=$db->query($sqlreg);
while($rsreg=$db->fetch_array($resultreg)){
;echo '		<tr>
		 <td><label>
			<input name="proid[]" type="checkbox" id="proid" value="';echo $p;echo '" onClick="buypro()">
			<input name="proid1[]" id="proid1" type="hidden" value="';echo $rsreg['id'];echo '">
		  </label></td>
		  <td>';echo $rsreg['productname'];echo '</td>
		  <td>';echo m_str($rsreg['memo'],20);echo '</td>
		  <td>';echo $rsreg['price'];echo '			  <input name="tprice[]" id="tprice" type="hidden" value="';echo $rsreg['price'];echo '"></td>
		 <!--<td>';echo $rsreg['pv'];echo '			  <input name="tpv[]" id="tpv" type="hidden" value="';echo $rsreg['pv'];echo '"></td>-->
		  <td width="18%"><select name="buynum[]" onChange="buypro()">
			  ';
for($i=1;$i<21;$i++){
echo "<option value='{$i}'>{$i}</option>";
}
;echo '		  </select></td>
		</tr>
		';
$p++;
}$db->free_result($resultreg);
;echo '		<tr>
		  <td colspan="6"><span id="buyproinfo"></span><div  style="display:none;"> &nbsp;&nbsp;&nbsp;&nbsp; 请选择级别
			';
$glorname="glo_member_".$rs['rank'];
$ysbdmoney=$$glorname;
foreach($regrankary as $key_1=>$value_1){
if($key_1>$rs['rank']){
$glorname="glo_member_".$key_1;
$newbdmoney=$$glorname-$ysbdmoney;
;echo '				<input name="trank[]" type="hidden" value="';echo $newbdmoney;;echo '">
				<input name="trank1[]" type="hidden" value="';echo $value_1;echo '">
				';
}
}
;echo '			  <select name="torank" id="torank">
				<option value=\'\'>请选择</option>
				';
foreach($regrankary as $key_1=>$value_1){
if($key_1>$rs['rank']){
if($rank==$key_1){
echo "<option value='{$key_1}' selected>{$value_1}</option>";
}else{
echo "<option value='{$key_1}'>{$value_1}</option>";
}
}
}
;echo '			  </select></div>
		  </td>
		</tr>
	  </table>
	  <table width="100%" border="0" cellpadding="3" cellspacing="1">
		<TR>
		  <TD width="49%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >申请会员:</TD>
		  <TD width="51%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '</TD>
		</TR>
		<TR>
		  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >现级别为:</TD>
		  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rankary[$rs["rank"]];;echo '</TD>
		</TR>
		
		<TR>
		  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
			<INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
		  </TR>
		</table>
		</TD>
	  </TR>
	</TABLE>
	</form>
';
}
}else{;echo '	<div align="center">已经是最高级别</div>
';};echo '<br>
</center>
<table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="30" background="images/tab_05.gif">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5%"><div align="center"><img src="images/tb.gif" width="16" height="16" /></div></td>
                <td width="95%" class="STYLE1"><span class="STYLE3">升级申请记录</span></td>
              </tr>
            </table></td>
            <td width="54%"><table border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="14">&nbsp;</td>
                <td width="106">&nbsp;</td>
                <td width="83"></td>
                <td width="29"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="STYLE1">&nbsp;</td>
                    <td class="STYLE1">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onMouseOver="changeto()"  onmouseout="changeback()">
          <tr>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             会员编号</span>
            </div></td>
		    <td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             原级别</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             申请级别</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             申请时间</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             处理时间</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             订单编号</span>
            </div></td>
			<td height="22" background="images/bg.gif" bgcolor="#FFFFFF"><div align="center"><span class="STYLE1">
             状态</span>
            </div></td>
          </tr>
         ';
$sql="select * from {$db_prefix}editrankrecord where 1 and type=0 and username='".$_SESSION["glo_username"]."' or regusername='".$_SESSION["glo_username"]."'";
if ($filter!='') $sql.=$filter;
$sql.=" order by id desc";
$result=$db->query($sql);
if ($db->num_rows($result)>0){
while($rs=$db->fetch_array($result)){
;echo '          <tr>
		    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rs["username"];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rankary[$rs["oldrank"]];echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo $rankary[$rs["rank"]];echo '</div>
            </div></td>
		    <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';echo date("Y-m-d H:i:s",$rs["applytime"]);echo '</div>
            </div></td>
			 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if(!empty($rs["edittime"])){echo date("Y-m-d H:i:s",$rs["edittime"]);};echo '</div>
            </div></td>
			<td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';if($rs['orderid']) echo $rs["orderid"];echo '</div>
            </div></td>
			 <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE1">
              <div align="center">';
switch($rs["state"]){
case 0: echo "未处理";break;
case 1:echo "同意";break;
case 2:echo "拒绝";break;
}
;echo '</div>
            </div></td>
          </tr>
          ';
}
}else{
;echo '      <tr>
            <td height="20" bgcolor="#FFFFFF" colspan="7"><div align="center"></div></td>
          </tr>
      ';
}
$db->free_result($result);
;echo '        </table></td>
        <td width="8" background="images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;</td>
            <td>
            </td>
          </tr>
        </table></td>
        <td width="16"><img src="images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body></html>';
?>