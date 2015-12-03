<?php
echo '<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/images/datalist.css" type="text/css"></HEAD>
';
include("../include/conn.php");
include("../include/function.php");
include("../include/power.php");
$power_1_ary=array();
if ($action=="add"){
$sqld="select id from {$db_prefix}department where department='".trim($department)."'";
$rsd=$db->get_one($sqld);
if($rsd['id']) {
echo "<script>alert('已经有此名称的部门存在，请重新输入');history.back();</script>";exit();
}
$power="";
foreach($qxCheckBox as $key=>$value){
if ($power!="") $power.=",";
$power.=$value;
}
$sql="insert into {$db_prefix}department(department,power,addtime) values('".trim($department)."','".trim($power)."','".time()."')";
$db->query($sql);
header("location:departments.php");exit();
}
if ($action=="edit1"){
$sqld="select id from {$db_prefix}department where department='".trim($department)."' and id<>'$id'";
$rsd=$db->get_one($sqld);
if($rsd['id']) {
echo "<script>alert('已经有此名称的部门存在，请重新输入');history.back();</script>";exit();
}
$power="";
foreach($qxCheckBox as $key=>$value){
if ($power!="") $power.=",";
$power.=$value;
}
$sql2="update {$db_prefix}department set department='".trim($department)."',power='".$power."' where id='".$id."'";
$db->query($sql2);
header("location:departments.php?pageno={$pageno}");exit();
}
if ($action=="edit"){
$sql1="select * from {$db_prefix}department where id='".$id."'";
$rs1=$db->get_one($sql1);
$power_1=$rs1["power"];
$power_1_ary=explode(",",$power_1);
}
$actionstr=($action=="edit")?"修改":"添加";
$action_1=($action=="edit")?"edit1":"add";
;echo '<SCRIPT language=javascript>
function menu( menu,img,plus )
		{
			if( menu.style.display == "none"){

				menu.style.display="";
				img.src="/skin/images/foldopen.gif";
				plus.src="/skin/images/MINUS2.GIF";
			}
			else
			{
				menu.style.display = "none";
				img.src="/skin/images/foldclose.gif";
				plus.src="/skin/images/PLUS3.GIF";
			}

		}

		function checkallbox(obj)
		{
		   var checkall=document.getElementById(\'checkall\');
		   var checkcencl=document.getElementById(\'checkcencl\');

		    var checkqx=document.getElementsByName(\'qxCheckBox[]\');
		   //alert(checkqx);
		    if(obj=="1")
		    {


				if(checkall.checked==true)
				{
					checkcencl.checked=false;
					for(var i=0;i<checkqx.length;i++)
					{

						checkqx[i].checked=true;
					}
				}


		    }
		    else
		    {

		      if(checkcencl.checked==true)
				{
					checkall.checked=false;

					for(var i=0;i<checkqx.length;i++)
					{
						checkqx[i].checked=false;
					}
		        }
		    }

		}
		function getpermission(obj)
		{
		    var checkqx=document.getElementsByName(\'qxCheckBox[]\');
		     for(var i=0;i<checkqx.length;i++)
		      {
		         if(checkqx[i].value==obj)
		         {

		            checkqx[i].checked=true;
		         }
		      }
		}
		function  checkpid(obj,obj1)
		{
		   var checkpid=document.getElementById(obj);
		   if(obj1.checked==true)
		   {
		     checkpid.checked=true;
		   }

		}
</SCRIPT>
<body>
<form name="form1" method="post" action="?action=';echo $action_1;echo '">
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY><TR>
<TD width=213 height=23>&nbsp;<strong>部门';echo $actionstr;echo '</strong></TD>
<TD >&nbsp;</TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1">
	<TR>
	  <TD  rowspan="1" align="right" vAlign=middle bgColor="#FBFDFF" >部门名：</TD>
	  <TD height="20"  rowspan="1" align="left" vAlign=middle bgColor="#FBFDFF" ><input name="department" type="text" id="department" value="';echo $rs1["department"];echo '"></TD>
	  </TR>
	<TR>
	  <TD align="right" valign="middle" bgColor="#FBFDFF" ><input type="hidden" name="id" value="';echo $id;echo '">
        <input type="hidden" name="pageno" value="';echo $pageno;echo '">
        权限:</TD>
	  <TD height="38" align="left" valign="middle" bgColor="#FBFDFF" ><FONT face=ËÎÌå>
	    <TABLE cellSpacing=0 borderColorDark=lightblue cellPadding=0 width="100%" borderColorLight=#ffffff border=0>
          <TBODY>
            <TR>
              <TD vAlign=top>
			  	 ';
$i=1;
foreach($powerary as $key=>$value){
;echo '			      <DIV><IMG class=menutop id=plus';echo $i;echo ' onclick=menu(menu';echo $i;echo ',img';echo $i;echo ',this) src="/images/MINUS2.GIF" align=absMiddle><IMG id=img';echo $i;echo ' src="/images/foldopen.gif" align=absMiddle>';echo $key;echo '</DIV>
                  <DIV id=menu';echo $i;echo ' style="MARGIN-TOP: -3px; DISPLAY: block">
				  	  ';
foreach($value as $key1=>$value1){
;echo '				  	  <IMG src="/images/line1.gif" align=absMiddle>
				  	  <img src="/images/line3.gif" align=absMiddle>
				  	  <INPUT id=checkbox2 type=checkbox value=';echo $value1;echo ' name=qxCheckBox[] ';if (in_array($value1,$power_1_ary)) echo "checked";echo '>
                      ';if($ismenusary[$key][$key1]=='1') echo "<strong>";else echo "<font color='red'>----";echo $value1;echo '';if($ismenusary[$key][$key1]=='1') echo "</strong>";else echo "</font>";echo '<BR>
						';
}
;echo '                  </DIV>
				  ';
$i++;
}
;echo '				  </TD>
            </TR>
          </TBODY>
	      </TABLE>
	  </FONT>

	  </TD>
	  </TR>
	<TR>
	  <TD colspan="2" align="center" valign="middle" background="images/tab_19.gif">
	    <INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but" value="';echo $actionstr;echo '" name="but">	  </TD>
	  </TR>

    </table></TD>
  </TR>
</TABLE>
<br>
<br>
</form>
</body></html>';
?>