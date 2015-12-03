<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");
include("../include/upower.php");
$power_1_ary=array();
if ($action=='set'){
$hint="";
$num=count($powerary111);
$power="";
for($i=1;$i<=$num;$i++){
$qx="qxCheckBox".$i;
if(count($$qx)>0){
foreach($$qx as $key=>$value){
if ($power!="") $power.=",";
$power.=$value;
}
}
}
$sql="update {$db_prefix}rankpower set power='".$power."' where id=1 ";
$db->query($sql);
echo "<script>alert('修改成功');location.href='userpower2.php';</script>";exit();
}
$sql1="select * from {$db_prefix}rankpower where 1";
$rs1=$db->get_one($sql1);
$power_1=$rs1["power"];
$power_1_ary=explode(",",$power_1);
;echo '<script language="javascript">
function CheckAll(){
  var form=document.form1; 
  for (var i=0;i<form.elements.length;i++){
    var e = form.elements[i];
    if (e.Name != "chkAll"&&e.disabled==false){
       e.checked = document.getElementById(\'chkAll\').checked;
    }
  }
}
  </script>
</HEAD><body>
<form name="form1" method="post" action="?action=set">
<TABLE width="750" border=0 align="center" cellPadding=1 cellSpacing=5 class=Table_xt>
<TBODY>
<TR><TD colSpan=4>
<TABLE cellSpacing=0 cellPadding=0 width="100%"  background="images/tab_05.gif"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>前台会员使用权限设定</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
';
$i=1;
foreach($powerary111 as $key=>$value){
;echo '  <tr> 
  
  <td width="14%" align="right" valign="middle" bgColor="#f2f9fd"><input type="checkbox" name="qxcheck';echo $i;;echo '" id="qxcheck';echo $i;;echo '" onclick=\'change(';echo $i;echo ')\'><span style="font-weight:bold;">';echo $key;;echo '</span></td><td width="86%" align="left" bgColor="#f2f9fd">
 <TABLE cellSpacing=0 borderColorDark=lightblue cellPadding=0 width="100%" borderColorLight=#f2f9fd border=0>
          <TBODY>
            <TR>
              <TD>
			  
				  	  ';
$j=0;$n=$i.$j;
foreach($value as $value1){
;echo '				  	 
				  	  <INPUT id=checkbox';echo $n;;echo ' type=checkbox value=';echo $value1;echo ' name="qxCheckBox';echo $i;echo '[]" ';if (in_array($value1,$power_1_ary)) echo "checked";echo '>
                      ';echo $value1;echo '						';
}
;echo '             				  </TD>
            </TR>
          </TBODY>
	      </TABLE></td>
         </tr>
         ';$i++;};echo '<script type="text/javascript">
 function change(num) 
{	var str=\'qxCheckBox\'+num+\'[]\';
	var str1=\'qxcheck\'+num;
	var val=document.getElementById(str1).checked;
	var chkArray=document.getElementsByName(str);
	for (var i = 0 ; i < chkArray.length ; i ++) //遍历指定组中的所有项
	    chkArray[i].checked = val;              //设置项为指定的值-是否选中
}
</script>
	<TR>
	  <TD background="images/tab_19.gif" colspan="5" align="center" valign="middle"><input name="chkAll" type="checkbox" id="chkAll" onClick=CheckAll() value="checkbox">
                  全选
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="确定" name="but">	  </TD>
	  </TR>
    </table></TD>

  </TR>
</TABLE>
</form>
</body></html>';
?>