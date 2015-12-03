<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");include("../include/pos.php");include("../include/rank.php");
;echo '<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
</HEAD><body>
<form name="form1" method="post" action="users.php">
<input type="hidden" name="action" value="query">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/tab_05.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>会员查询</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >会员编号:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="username" type="text" id="username"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >姓名:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="realname" type="text" id="realname"></TD>
	  </TR>
	  
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >推荐人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="tjrname" type="text" id="tjrname"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >接点人:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="prename" type="text" id="prename"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >区位:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="pos">
	  <option value="">不限</option>
        ';
foreach($posary as $key=>$value){echo "<option value='".$key."'>".$value."区</option>";}
;echo '      </select></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="rank" id="rank">
	  <option value="">不限</option>
	    ';
foreach($rankary as $key_1=>$value_1){
echo "<option value='{$key_1}'>{$value_1}</option>";
}
;echo '	    </select>	    </TD>
	  </TR>
	 <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >开店级别:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="storerank" id="storerank">
	  <option value="">不限</option>
	    ';
foreach($dprankary as $key_1=>$value_1){
echo "<option value='{$key_1}'>{$value_1}</option>";
}
;echo '	    </select>	    </TD>
	  </TR>
       <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否空点:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="isblank">
	  	<option value="">不限</option>
        <option value="0" ';if(isset($isblank)&&$isblank==0) echo "selected";;echo '>否</option>
        <option value="1" ';if(isset($isblank)&&$isblank==1) echo "selected";;echo '>是</option>
      </select>
	 	 </TD>
	  </TR>

	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >是否店铺:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><select name="isdp" id="isdp">
	  <option value="all">不限</option>
	  <option value="0">否</option>
	  <option value="1">是</option>
	    </select>	    </TD>
	  </TR>
	
	<!--  <TR>
	    <TD align="right" valign="middle" bgColor="#FBFDFF" >所属店铺:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="zmdname" type="text" id="zmdname"></TD>
	  </TR>	-->
	  <TR>
	    <TD align="right" valign="middle" bgColor="#FBFDFF" >注册人编号:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="regusername" type="text" id="regusername"></TD>
	    </TR>
	  <TR>
	    <TD align="right" valign="middle" bgColor="#FBFDFF" >注册人姓名:</TD>
	    <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="regrealname" type="text" id="regrealname"></TD>
	    </TR>
      	
	  <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >电子货币:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price_1" type="text" id="price_1" size="10">
	    -
	      <input name="price_2" type="text" id="price_2" size="10">
	    元</TD>
	  </TR>
	<!-- <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >现金金额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price_c1" type="text" id="price_c1" size="10">
	    -
	      <input name="price_c2" type="text" id="price_c2" size="10">
	    元</TD>
	  </TR>
     
	   <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >重复消费:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price_s11" type="text" id="price_s11" size="10">
	    -
	      <input name="price_s22" type="text" id="price_s22" size="10">
	    元</TD>
	  </TR> -->
      <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >奖金总额:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="price_s1" type="text" id="price_s1" size="10">
	    -
	      <input name="price_s2" type="text" id="price_s2" size="10">
	    元</TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >注册时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="regtime1" type="text" id="regtime1" size="10" onClick="new WdatePicker()">
	    -
	      <input name="regtime2" type="text" id="regtime2" size="10" onClick="new WdatePicker()"></TD>
	  </TR>
	 <!-- <TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" >确认时间:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="confirmtime1" type="text" id="confirmtime1" size="10" onClick="new WdatePicker()">
	    -
	      <input name="confirmtime2" type="text" id="confirmtime2" size="10" onClick="new WdatePicker()"></TD>
	  </TR>-->
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>