<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");include("../include/function.php");
include("../include/rank.php");
if ($action=="add"){
$hint="";
if(trim($productname)=="") $hint.="请输入名称\\n";
if(trim($price)==""||$price<=0) $hint.="请输入会员价\\n";
if(trim($num)==""||$num<=0) $hint.="请输入数量\\n";
$proimgstr="";
if ($_FILES['proimg']['size']>0){
list($width,$height,$type,$attr) = getimagesize($_FILES['proimg']['tmp_name']);
;
switch($type){
case 1:$type1=".GIF";break;
case 2:$type1=".JPG";break;
case 3:$type1=".PNG";break;
default:$type1="...";break;
}
if ($type1=="...") $hint.="图片格式错误\\n";
$proimgpth="../proimgs/";
$proimgstr=time().$type1;
if (!@copy($_FILES['proimg']['tmp_name'],$proimgpth.$proimgstr)) $hint.="图片上传失败\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sql_d="select * from {$db_prefix}productsort where id='".$categoryid."'";
$rs_d=$db->get_one($sql_d);
$category=$rs_d["name"];
$sql="insert into {$db_prefix}product(categoryid,category,productname,proimg,price,pv,weight,memo,addtime,num,scprice,isdp,dazhe,type) values('".$categoryid."','".$category."','".trim($productname)."','".$proimgstr."','".floatval($price)."','".floatval($pv)."','".floatval($weight)."','".$memo."','".time()."','$num','".floatval($scprice)."','$isdp','$dazhe','$isshops')";
$db->query($sql);
$productid=$db->insert_id();
if($num>0){
$sql1="insert into {$db_prefix}rks(productid,productname,num,addtime,adminid,adminname) values('".$productid."','".trim($productname)."','".intval($num)."','".time()."','".$_SESSION["glo_adminid"]."','".$_SESSION["glo_adminname"]."')";
$db->query($sql1);
}
echo "<script>location.href='products.php';</script>";exit();
}
if ($action=="edit1"){
$hint="";
if(trim($productname)=="") $hint.="请输入名称\\n";
if(trim($price)==""||$price<=0) $hint.="请输入会员价\\n";
$proimgstr="";
if ($_FILES['proimg']['size']>0){
list($width,$height,$type,$attr) = getimagesize($_FILES['proimg']['tmp_name']);
;
switch($type){
case 1:$type1=".GIF";break;
case 2:$type1=".JPG";break;
case 3:$type1=".PNG";break;
default:$type1="...";break;
}
if ($type1=="...") $hint.="图片格式错误\\n";
$proimgpth="../proimgs/";
$proimgstr=time().$type1;
if (!@copy($_FILES['proimg']['tmp_name'],$proimgpth.$proimgstr)) $hint.="图片上传失败\\n";
}
if ($hint!=""){
echo "<script>alert('".$hint."');history.back();</script>";exit();
}
$sqlp="select num from {$db_prefix}product where id='$id'";
$rsp=$db->get_one($sqlp);
$oldnum=$rsp['num'];
$sql_d="select * from {$db_prefix}productsort where id='".$categoryid."'";
$rs_d=$db->get_one($sql_d);
$category=$rs_d["name"];
$sql2="update {$db_prefix}product set categoryid='".$categoryid."',category='".$category."',productname='".trim($productname)."'";
if ($proimgstr!="")	$sql2.=",proimg='".$proimgstr."'";
$sql2.=",price='".floatval($price)."',scprice='".floatval($scprice)."',pv='".floatval($pv)."',weight='".floatval($weight)."',memo='".$memo."',isdp='".$isdp."',dazhe='".$dazhe."',num='$num',type='$isshops' where id='".$id."'";
$db->query($sql2);
$cha=$num-$oldnum;
if($cha!=0){
$sql1="insert into {$db_prefix}rks(productid,productname,num,addtime,adminid,adminname) values('".$id."','".trim($productname)."','".intval($cha)."','".time()."','".$_SESSION["glo_adminid"]."','".$_SESSION["glo_adminname"]."')";
$db->query($sql1);
}
echo "<script>location.href='products.php?pageno={$pageno}';</script>";exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}product where id='".$id."'";
$rs1=$db->get_one($sql1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '
<script>
function frmchk(frm){
	if (frm.productname.value=="")
	{
		alert("请输入产品名称");
		frm.productname.focus();
		return false;
	}	
	if (frm.price.value=="")
	{
		alert("请输入会员价");
		frm.price.focus();
		return false;
	}	
}
</script>
<body>
<form action="?action=';echo $action_1;echo '" method="post" enctype="multipart/form-data" name="form1" onSubmit="return frmchk(this);">
<TABLE width="600" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="600" colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%" background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>产品';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD width="22%" align="right" vAlign=middle bgColor="#FBFDFF" >产品分类:</TD>
	  <TD width="78%" height="20" align="left" vAlign=middle bgColor="#FBFDFF" >
	  <select name="categoryid" id="categoryid" onChange="change();">
	  ';
$sql_cate="select * from {$db_prefix}productsort where 1 order by orders asc";
$result_cate=$db->query($sql_cate);
while ($rs_cate=$db->fetch_array($result_cate)){
echo "<option value='".$rs_cate["id"]."'";
if ($rs_cate["id"]==$rs1["categoryid"]) echo " selected";
echo ">".str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$rs_cate["depth"])."{$rs_cate['name']}</option>";
}
$db->free_result($result_cate);
;echo '	    </select>		</TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" ><p>产品名称:</p>	    </TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="productname" type="text" id="productname" value="';echo $rs1["productname"];echo '"> <span>*</span></TD>
	</TR>	   
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >图片:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="proimg" type="file" id="proimg"> ';if ($rs1["proimg"]!="") echo '<a href="../proimgs/'.$rs1["proimg"].'" target=_blank>图片</a>';;echo '</TD>
   </TR>  
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >市场价:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="scprice" type="text" id="scprice" value="';echo $rs1["scprice"];echo '"> 元</TD>
	</TR>
	
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >会员价格:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="price" type="text" id="price" value="';echo $rs1["price"];echo '"> 元 <span>*</span></TD>
	</TR>
	
	<!--<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >产品PV:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="pv" type="text" id="pv" value="';echo $rs1["pv"];echo '"></TD>
	</TR>	
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >重量:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="weight" type="text" id="weight" value="';echo $rs1["weight"];echo '"> kg</TD>
	  </TR>-->
    <TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >数量:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="num" type="text" id="num" value="';echo $rs1["num"];echo '"> <span>*</span></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF">是否为报单购物产品:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" >
		<input name="isshops" type="radio" value="0" ';if($rs1['type']==0) echo "checked";;echo ' />否
		<input name="isshops" type="radio" value="1" ';if($rs1['type']==1) echo "checked";;echo ' />是
	  </TD>
	</TR>
	<!--<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >店铺产品:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="isdp" type="checkbox" id="isdp" value="1" ';if($rs1['isdp']) echo "checked";;echo '> </TD>
	  </TR>
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >不打折产品:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="dazhe" type="checkbox" id="dazhe" value="1" ';if($rs1['dazhe']) echo "checked";;echo '> </TD>
	  </TR>-->
	<TR>
	  <TD align="right" vAlign=middle bgColor="#FBFDFF" >说明:</TD>
	  <TD height="20" align="left" vAlign=middle bgColor="#FBFDFF" ><textarea name="memo" cols="50" rows="4" id="memo">';echo $rs1["memo"];echo '</textarea></TD>
	  </TR>
	 

	  <TR>
	  <TD background="images/tab_19.gif" colspan="2" align="center" valign="middle">
	    <input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="';echo $actionstr;echo '" name="but">	  </TD>
	  </TR>
    </table></TD>
  </TR>
</TABLE>
</form>
</body></html>'
?>