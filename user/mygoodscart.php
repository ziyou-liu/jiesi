<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn_2.php");include("../include/goodcartcls.php");include("../include/secpwd.php");
include("../include/rank.php");
if ($action=="del"){
delgoodscart($id);
header("location:mygoodscart.php?ordertype={$ordertype}");exit();
}
if ($action=="editnum"){
$sql="select * from {$db_prefix}product where id='".$id."'";
$rs=$db->get_one($sql);
if($num>$rs['num']){
echo "<script>alert('此商品仅有库存".$rs['num']."');history.back();</script>";exit();
}
editgoodscart($rs["id"],$rs["productname"],floatval($num),$rs["price"],$rs["pv"],$rs['type']);
echo "<script>alert('修改成功');location.href='mygoodscart.php?ordertype={$ordertype}';</script>";exit();
}
$sql="select price_repeat,price_repeat1,rank,isdp from {$db_prefix}users where username='".$_SESSION["glo_username"]."'";
$rr=$db->get_one($sql);
$zktemp="glo_zhekou_".$rr['rank'];
$zhekou=$$zktemp;
if ($action=="order"){
$modtime=time();
$goodscartstr=getgoodscart();
$price=0;$pv=0;$price1=0;$pv1=0;
$goodscartary=explode("|",$goodscartstr);
foreach($goodscartary as $value_1){
$value_1_ary=explode(",",$value_1);
if($value_1_ary[6]==1){
$goodscartary2[]=$value_1;
}else if($value_1_ary[6]==0){
$goodscartary3[]=$value_1;
}
}
foreach($goodscartary3 as $value_1){
$value_1_ary=explode(",",$value_1);
$sql="select * from {$db_prefix}product where id='".$value_1_ary[0]."'";
$rs=$db->get_one($sql);
$price+=$rs["price"]*floatval($value_1_ary[2]);
$pv+=$rs["pv"]*floatval($value_1_ary[2]);
$glozhekou="glo_zhekou_".$rr['rank'];
$zhekou=$$glozhekou/10;
}
foreach($goodscartary2 as $value_1){
$value_1_ary=explode(",",$value_1);
$sql="select * from {$db_prefix}product where id='".$value_1_ary[0]."'";
$rs=$db->get_one($sql);
$price1+=$rs["price"]*floatval($value_1_ary[2]);
$pv1+=$rs["pv"]*floatval($value_1_ary[2]);
$zhekou1=1;
}
$realprice=$price*$zhekou;
$realprice1=$price1*$zhekou1;
if($realprice>$rr['price_repeat'])$hint="您的重消购物账户余额不足！";
if($realprice1>$rr['price_repeat1'])$hint="您的报单购物账户余额不足！";
$totleprice=$price;
$totleprice1=$price1;
$totlepv=$pv;
$totlepv1=$pv1;
if($hint!=''){
echo "<script>alert('".$hint."');location.href='mygoodscart.php';</script>";exit();
}
if($goodscartary2[0]!=''){
$ordertype=2;
$sql_1="insert into {$db_prefix}orders(username,realname,price,price1,price2,pv,state,addtime,zhekou,type) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".$totleprice1."','".$realprice1."','".$realprice1."','".$totlepv1."','0','".$modtime."','".$zhekou1."','".$ordertype."')";
$db->query($sql_1);
$orderid=$db->insert_id();
foreach($goodscartary2 as $value_1){
$value_1_ary=explode(",",$value_1);
$sql="select * from {$db_prefix}product where id='".$value_1_ary[0]."'";
$rs=$db->get_one($sql);
$sql1="insert into {$db_prefix}orders1(orderid,username,realname,productid,productname,num,price,pv,addtime,state,zhekou) values('".$orderid."','".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".$rs["id"]."','".$rs["productname"]."','".$value_1_ary[2]."','".$rs["price"]."','".$rs["pv"]."','".$modtime."','0','$zhekou')";
$db->query($sql1);
}
}
if($goodscartary3[0]!=''){
$ordertype=3;
$sql_1="insert into {$db_prefix}orders(username,realname,price,price1,price2,pv,state,addtime,zhekou,type) values('".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".$totleprice."','".$realprice."','".$realprice."','".$totlepv."','0','".$modtime."','".$zhekou."','".$ordertype."')";
$db->query($sql_1);
$orderid=$db->insert_id();
foreach($goodscartary3 as $value_1){
$value_1_ary=explode(",",$value_1);
$sql="select * from {$db_prefix}product where id='".$value_1_ary[0]."'";
$rs=$db->get_one($sql);
$sql1="insert into {$db_prefix}orders1(orderid,username,realname,productid,productname,num,price,pv,addtime,state,zhekou) values('".$orderid."','".$_SESSION["glo_username"]."','".$_SESSION["glo_realname"]."','".$rs["id"]."','".$rs["productname"]."','".$value_1_ary[2]."','".$rs["price"]."','".$rs["pv"]."','".$modtime."','0','$zhekou')";
$db->query($sql1);
}
}
cleargoodscart();
echo "<script>alert('订购成功');location.href='orderlst.php';</script>";exit();
}
;echo '<script language="javascript">
	function goodsedit(id,type){
		num=document.getElementsByName("num_"+id)[0].value;
		location.href=\'?action=editnum&id=\'+id+\'&num=\'+num+\'&ordertype=\'+type;
	}
	function goodsorder(){
		document.form1.action.value="order";
		document.form1.submit();
	}
</script>
</HEAD><body>
<form name="form1" method="post" action="mygoodscart.php">
<input type="hidden" value="';echo $ordertype;;echo '" name="ordertype">
  <TABLE cellSpacing=5 cellPadding=0 width="100%" border=0>
    <TBODY>
      <TR>
        <TD id=test1 vAlign=top colSpan=2><TABLE class=Table_xt cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TBODY>
              <TR>
                <TD colSpan=5  background="images/tab_05.gif"><TABLE cellSpacing=0 cellPadding=0 width="100%">
                    <TBODY>
                      <TR>
                        <TD width=213  height=23>&nbsp;<strong>我的购物车</strong></TD>
                        <TD >&nbsp;</TD>
                      </TR>
                    </TBODY>
                </TABLE></TD>
              </TR>
              <TR>
                <TD vAlign=top bgColor=#d4e8fa colSpan=5></TD>
              </TR>
              <TR>
                <TD vAlign=top bgColor=#ffffff colSpan=5><TABLE borderColor=#ffffff cellSpacing=1 cellPadding=1 width="100%" align=center bgColor=#d4e8fa border=1>
                    <TBODY>
                      <TR bgColor=#f2f9fd>
                        <TD vAlign=center  background="images/tab_05.gif"><TABLE id=UltraWebGrid1_main style="TABLE-LAYOUT: fixed; OVERFLOW: hidden; WIDTH: 100%; FONT-FAMILY: Verdana" cellPadding=0 border=0>
                              <TR>
                                <TD style="WIDTH: 100%"><TABLE id=UltraWebGrid1_main style="TABLE-LAYOUT: fixed; OVERFLOW: hidden; WIDTH: 100%; FONT-FAMILY: Verdana" cellPadding=0 border=0>
                                    <TR>
                                      <TD style="WIDTH: 100%"><DIV id=UltraWebGrid1_div hideFocus style="OVERFLOW-X: scroll; OVERFLOW: hidden; WIDTH: 100%" tabIndex=0>
                                          <TABLE style="WIDTH: 100%" cellSpacing=1 cellPadding=1 border=0 bandNo="0">
                                            <THEAD>
                                              <TR>
                                                <TH background="images/bg.gif"><NOBR>商品编号</NOBR></TH>
                                                <TH background="images/bg.gif"><NOBR>商品名称</NOBR></TH>
												<TH background="images/bg.gif"><NOBR>产品类型</NOBR></TH>
                                                <TH background="images/bg.gif"><NOBR>数量</NOBR></TH>
                                                <TH background="images/bg.gif"><NOBR>单价</NOBR></TH>
												<TH background="images/bg.gif"><NOBR>折扣</NOBR></TH>
												<TH background="images/bg.gif"><NOBR>总价</NOBR></TH>
                                                <TH background="images/bg.gif"><NOBR>操作</NOBR></TH>
                                              </TR>
                                            </THEAD>
                                            <input type="hidden" name="chknum" value="0">
                                            ';
$goodscartstr=getgoodscart();
$goodscartary=explode("|",$goodscartstr);
if (is_array($goodscartary)){
foreach($goodscartary as $key=>$value){
$items=explode(",",$value);
;echo '                                            <TR style="BACKGROUND-COLOR:#ffffff"  height=22 level="0">
                                              <TD  id=UltraWebGrid1rc_0_0  level="0_0" align="center"><NOBR>';echo $items[0];echo '                                                <input type="hidden" name="id[]" value="';echo $items[0];echo '">
                                              </NOBR></TD>
                                              <TD  id=UltraWebGrid1rc_0_1  level="0_1" align="center"><NOBR>';echo $items[1];echo '</NOBR></TD>
											  <TD  id=UltraWebGrid1rc_0_1  level="0_1" align="center"><NOBR>';if($items[6]==1)echo "报单产品";if($items[6]==0)echo "普通产品";;echo '</NOBR></TD>
                                              <TD  id=UltraWebGrid1rc_0_2  level="0_2" align="center"><NOBR>
											  <input name="num_';echo $items[0];echo '" type="text" value="';echo $items[2];echo '" size="5" />
                                              </NOBR></TD>
                                              <TD  id=UltraWebGrid1rc_0_3  level="0_3" align="center"><NOBR>';echo $items[3];echo '</NOBR></TD>
											  <TD  id=UltraWebGrid1rc_0_1  level="0_1" align="center"><NOBR>';if($items[6]==1)echo "10折";if($items[6]==0)echo $zhekou."折";;echo '</NOBR></TD>
											  <TD  id=UltraWebGrid1rc_0_1  level="0_1" align="center"><NOBR>';if($items[6]==1)echo $items[2]*$items[3];if($items[6]==0)echo ($items[2]*$items[3]*$zhekou/10);;echo '</NOBR></TD>
                                              <TD align="center"  id=UltraWebGrid1rc_0_4  level="0_4"><NOBR><a href="#" onClick="goodsedit(';echo $items[0];echo ')">修改</a>|<a href="?action=del&id=';echo $items[0];echo '">删除</a></NOBR></TD>
                                            </TR>
                                            ';
}
}else{
;echo '                                            <TR style="BACKGROUND-COLOR:#F6FAFD"  height=22 level="0">
                                              <TD  id=UltraWebGrid1rc_1_0  level="1_0" colspan="5"><NOBR></NOBR></TD>
                                            </TR>
                                            ';
}
;echo '                                          </TABLE>
                                      </DIV></TD>
                                    </TR>
                                </TABLE></TD>
                              </TR>
                          </TABLE></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                    <TABLE width="100%" cellPadding="0" cellSpacing="0">
                      <TR  background="images/tab_19.gif">
                        <TD vAlign="middle" width="20" bgColor="#d4e8fa"><input type="hidden" name="action" value="order"></TD>
                        <TD vAlign="middle" height="30" bgColor="#d4e8fa" align="right"> <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=button onClick="location.href=\'order.php?type=';echo $ordertype;echo '\';"  id="but2" value="继续购物" name="but2"><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but1" value="确定购物" name="but1"></TD></TR>
                  </TABLE></TD>
              </TR>
            </TBODY>
        </TABLE></TD>
      </TR>
    </TBODY>
  </TABLE>
</form>
</body>
</html>
';
?>