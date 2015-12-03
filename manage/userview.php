<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/area.php");include("../include/function.php");include("../include/rank.php");
$sql="select * from {$db_prefix}users where id='".$id."'";
$rs=$db->get_one($sql);
;echo '</HEAD><body>

<br>
<TABLE width="550" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="550" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>用户查看</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="30%"  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >会员编号:</TD>
	  <TD width="70%" height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" >';echo $rs["username"];echo '</TD>
	  </TR>
	 <!-- <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >昵称:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["nicheng"];echo '</TD>
	  </TR>-->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["realname"];echo '</TD>
	  </TR>
	  ';if($rs['rank0']!=$rs['rank']){;echo '	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >注册级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getuserrank($rs["rank0"]);echo '</TD>
	  </TR>
	  ';};echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >当前级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getuserrank($rs["rank"]);echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >身份证:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["idcard"];echo '</TD>
	  </TR>
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >注册时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$rs["regtime"]);echo '</TD>
	  </TR>
	';
$sqlc="select * from {$db_prefix}editrankrecord where username='".$rs["username"]."' and state=1 order by id asc";
$cs=$db->query($sqlc);
if(!empty($cs)){
while($c_rs=$db->fetch_array($cs)){;echo '	   <TR>
	  <TD valign="middle" bgColor="#FBFDFF"  align="right" >升级时间（';echo $rankary[$c_rs["oldrank"]]."->".$rankary[$c_rs["rank"]];;echo '）:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo date("Y-m-d H:i:s",$c_rs["applytime"]);;echo '</TD>
	  </TR>
	 ';}
}
;echo '	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >一级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo mymd5($rs["pwd"],"DE");echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >二级密码:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo mymd5($rs["pwd1"],"DE");echo '</TD>
	  </TR>
	  <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >旅游记录:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["lvyou"];echo '</TD>
	  </TR>-->
	
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >推荐人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["tjrname"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["prename"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >位置:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($rs["pos"]==1) echo "左";elseif($rs['pos']==2) echo "右";;echo '区</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >推广链接:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["tghttp"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >报单中心:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["zmdname"];echo '</TD>
	  </TR>
    <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否店铺:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["idsp"]?'是':'否';;echo '</TD>
	  </TR>-->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否空点:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';if($rs["isblank"]==1){echo "是";}else{echo "否";};echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >报单金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["bdmoney"];;echo '元</TD>
	  </TR>	
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >性别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["sex"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >省份、城市、地区:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo getprovince($rs["province"])."-".getcity($rs["city"])."-".getarea($rs["area"]);echo '</TD>
	  </TR>
     <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >详细收货地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["address"];echo '</TD>
	  </TR>
	
    <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >收货人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["receiver"];echo '</TD>
	  </TR>
     <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >联系手机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["mobile"];echo '</TD>
	  </TR>
    <!--<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >联系座机:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["phone"];echo '</TD>
	  </TR>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >传真:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["fax"];echo '</TD>
	  </TR>
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >邮编:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["postcode"];echo '</TD>
	  </TR>
	<TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >Email:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["email"];echo '</TD>
	  </TR>
	 <TR>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >QQ:</TD>
      <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["qq"];echo '</TD>
	  </TR>-->
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >银行:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["bank"];echo '</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >账号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["zhanghao"];echo '</TD>
	  </TR>
	<TR style=\'display:\'>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >户主:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["huzhu"];echo '</TD>
	  </TR>
    <TR style=\'display:\'>
      <TD align="right" valign="middle" bgColor="#FBFDFF" >开户行地址:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >';echo $rs["bankaddress"];echo '</TD>
	  </TR>
	<TR>
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