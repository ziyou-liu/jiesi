<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/area.php");include("../include/function.php");include("../include/rank.php");include("../include/pos.php");
if($id!=''){
$sql="select * from {$db_prefix}users where id='".$id."' and regusername='".$_SESSION["glo_username"]."'";
$rs=$db->get_one($sql);
}else{
$sql="select * from {$db_prefix}users where id='".$_SESSION["glo_userid"]."'";
$rs=$db->get_one($sql);
}
;echo '
</HEAD><body>

<br>
<TABLE width="550" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="550" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23><strong><span style=\'margin-left:10px;\'>资料查看</span></strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="30%" vAlign=middle bgColor="#FBFDFF"  align="right">会员编号:</TD>
	  <TD width="70%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '</TD>
	  </TR>
	<!-- <TR>
	  <TD valign="middle" bgColor="#FBFDFF" align="right">昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["nicheng"];echo '</TD>
	  </TR>-->
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF" align="right">姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">会员级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getuserrank($rs["rank"]);echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">推广链接:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["tghttp"];echo '</TD>
	  </TR>
	  <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">注册时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</TD>
	  </TR>
	';
$sqlc="select * from {$db_prefix}editrankrecord where username='".$rs["username"]."'  and state=1 order by id desc";
$cs=$db->query($sqlc);
if(!empty($cs)){
while($c_rs=$db->fetch_array($cs)){;echo '	   <TR>
	  <TD valign="middle" bgColor="#FBFDFF" align="right">升级时间（';echo $rankary[$c_rs["oldrank"]]."->".$rankary[$c_rs["rank"]];;echo '）:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$c_rs["applytime"]);;echo '</TD>
	  </TR>
	 ';}
}
;echo '
	  <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >旅游记录:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["lvyou"];echo '</TD>
	  </TR>-->
	  <tr>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">推荐人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["tjrname"];echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">接点人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["prename"];echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">位置:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $posary[$rs['pos']];;echo '区</TD>
	  </TR>
	<!--<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">所属店铺:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["zmdname"];echo '</TD>
	  </TR>
       <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">是否店铺:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($rs['isdp']) echo "是";else echo "否";;echo '</TD>
	  </TR>-->
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">性别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["sex"];echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">省份、城市、地区:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getprovince($rs["province"])."-".getcity($rs["city"])."-".getarea($rs["area"]);echo '</TD>
	  </TR>
     <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">收货地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["address"];echo '</TD>
	  </TR>
       <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["receiver"];echo '</TD>
	  </TR>
      <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["idcard"];echo '</TD>
	  </TR>
     <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">联系手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["mobile"];echo '</TD>
	  </TR>
   <!-- <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">联系座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["phone"];echo '</TD>
	  </TR>
    <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["fax"];echo '</TD>
	  </TR>
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["postcode"];echo '</TD>
	  </TR>
	<TR>
      <TD valign="middle" bgColor="#FBFDFF"  align="right">Email:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["email"];echo '</TD>
	  </TR>
    <TR>
      <TD valign="middle" bgColor="#FBFDFF"  align="right">QQ:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["qq"];echo '</TD>
	  </TR>-->';if($id=='') {;echo '	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">银行:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["bank"];echo '</TD>
	  </TR>
	  
	<TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right">银行账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["zhanghao"];echo '</TD>
	  </TR>
	 
	<TR>
      <TD valign="middle" bgColor="#FBFDFF"  align="right">户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["huzhu"];echo '</TD>
	  </TR>
    <TR>
      <TD valign="middle" bgColor="#FBFDFF"  align="right">开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["bankaddress"];echo '</TD>
	  </TR> ';};echo '	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button  id="but" value="返回" name="but" onClick="history.back();">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</body></html>'
?>