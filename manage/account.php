<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<script language="javascript" type="text/javascript" src="../my97datepicker/WdatePicker.js"></script>
';
include("../include/conn.php");include("../include/rank.php");include("../include/pv.php");
if ($action=="query"){
if (trim($time1)!="") $filter.=" and confirmtime>='".strtotime(trim($time1))."'";
if (trim($time2)!="") $filter.=" and confirmtime<='".(strtotime(trim($time2))+3600*24)."'";
}
$sql_1="select count(id) as c1 from {$db_prefix}users where state=1";
if (!empty($filter)) $sql_1.=$filter;
$rs_1=$db->get_one($sql_1);
$sql_2="select count(id) as c1 from {$db_prefix}users where state=1 and rank=1";
if (!empty($filter)) $sql_2.=$filter;
$rs_2=$db->get_one($sql_2);
$sql_2_s="select count(id) as c1 from {$db_prefix}users where state=1 and rank=2";
if (!empty($filter)) $sql_2_s.=$filter;
$rs_2_s=$db->get_one($sql_2_s);
$sql_2_j="select count(id) as c1 from {$db_prefix}users where state=1 and rank=3";
if (!empty($filter)) $sql_2_j.=$filter;
$rs_2_j=$db->get_one($sql_2_j);
$sql_3="select count(id) as c1 from {$db_prefix}users where state=1 and isdp=1";
if (!empty($filter)) $sql_3.=$filter;
$rs_3=$db->get_one($sql_3);
$sql_4="select pv2 from {$db_prefix}users where ifnull(tjrname,'')='' and ifnull(prename,'')=''";
if (!empty($filter)) $sql_4.=$filter;
$rs_4=$db->get_one($sql_4);
$sql_5="select sum(pv3) as c1 from {$db_prefix}users where state=1";
if (!empty($filter)) $sql_5.=$filter;
$rs_5=$db->get_one($sql_5);
;echo '</HEAD><body>
<form name="form1" method="post" action="">

<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>数据统计</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >会员总数: <span style="color:#FF0000 ">';echo intval($rs_1["c1"]);echo ' </span> 人</TD>
	  </TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >普通会员: <span style="color:#FF0000 ">';echo intval($rs_2["c1"]);echo ' </span> 人</TD>
	  </TR>
	  <TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >银卡会员: <span style="color:#FF0000 ">';echo intval($rs_2_s["c1"]);echo ' </span> 人</TD>
	  </TR>
	  <TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >金卡会员: <span style="color:#FF0000 ">';echo intval($rs_2_j["c1"]);echo ' </span> 人</TD>
	  </TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >店铺: <span style="color:#FF0000 ">';echo intval($rs_3["c1"]);echo ' </span> 人</TD>
	  </TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >总款: <span style="color:#FF0000 ">';echo $c1=floatval($rs_4["pv2"]/$glo_pv_vs_yuan);echo ' </span> pv</TD>
	  </TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >发放奖金: <span style="color:#FF0000 ">';echo $c2=floatval($rs_5["c1"]);echo ' </span> pv</TD>
	  </TR>
	<TR>	  </TR>
	<TR>
	  <TD height="38" align="center" valign="middle" bgColor="#FBFDFF" >比率: <span style="color:#FF0000 ">';echo @number_format(($c2/$c1)*100,2);;echo '% </span></TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
<form name="form2" method="post" action="?action=query">
  <TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
    <TBODY>
      <TR>
        <TD width="421" colSpan=4><TABLE cellSpacing=0 cellPadding=0 width="100%">
            <TBODY>
              <TR>
                <TD width=213 height=23>&nbsp;<strong>数据查询</strong></TD>
                <TD >&nbsp;</TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
      <TR>
        <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
            <TR>
              <TD width="37%" align="right" valign="middle" bgColor="#FBFDFF" >时间:</TD>
              <TD width="63%" height="38" align="left" valign="middle" bgColor="#FBFDFF" ><input name="time1" type="text" id="time1" size="10" onClick="new WdatePicker()">
                -
                <input name="time2" type="text" id="time2" size="10" onClick="new WdatePicker()"></TD>
            </TR>
            <TR>
              <TD height="38" colspan="2" align="center" valign="middle" bgColor="#FBFDFF" ><INPUT class=button_text onmousedown="this.className=\'button_onmousedown\'" onmouseover="this.className=\'button_onmouseover\'" onmouseout="this.className=\'button_onMouseOut\'" type=submit  id="but" value="查询" name="but"></TD>
            </TR>
        </table></TD>
      </TR>
    </TABLE>
</form>
</body></html>';
?>