<?php
echo '﻿<HTML><HEAD><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
include("../include/function.php");include("../include/smsset.php");
set_time_limit(1000);
if ($action=="sendsms"){
$hint="";
if (trim($mobilestr)=="") $hint.="请输入发送内容\\n";
if ($hint!=""){
echo "<script>alert('{$hint}');history.back();</script>";exit();
}
$modtime=time();$mobilestr1='';
foreach($mobiles as $v){
if ($mobilestr1!='') $mobilestr1.=',';$mobilestr1.=$v;
$sql="insert into {$db_prefix}smsrec(gid,mobile,content,outmsg,sendtime) values('$gid','".trim($v)."','".trim($mobilestr)."','0','".$modtime."')";
$db->query($sql);
}
$f_zhuangtai='';
$web_duanxin_paw=md5($web_duanxin_paw);
$phone=trim($mobilestr1);
$content=rawurlencode(trim($mobilestr));
$url ="http://api.52ao.com/?user={$web_duanxin_user}&pass={$web_duanxin_paw}&mobile={$phone}&content={$content}&encode=utf-8";
$smsreturn=smsGet($url);
if ($smsreturn==200){
$f_zhuangtai="群发成功";
$sqlgx="update {$db_prefix}smsrec set outmsg=1,state=1 where gid='$gid'";
$db->query($sqlgx);
}else{
$f_zhuangtai="群发失败";
}
echo "<script>alert('{$f_zhuangtai}');location.href='smsqf.php';</script>";exit();
}
;echo '<link rel="stylesheet" href="/images/datalist.css" type="text/css">
<script language="javascript">
function smsadd(){
	var frm=document.form1;
	var group=frm.smsgroup.value;
	var ifrm=document.smsiframe;
	if (document.getElementById(\'smsiframe\').contentDocument)
	{            
		ifrm = document.getElementById(\'smsiframe\').contentWindow;
	}	
	ifrm.location.href="smsuseradd.php?group="+group;
}
function smsdel(){
	var frm=document.form1;
	var lens=frm.mobiles.options.length;
	var delitm;
	delitm="";
	for(var i=0;i<lens;i++){		
		if (frm.mobiles.options[i].selected){
			//if (delitm!="") delitm+=",";delitm+=i;
			//frm.mobiles.options.remove(i);
			frm.mobiles.options[i]=null;
			--i;
			//break;
		}
	}
	/*var delary=delitm.split(",");
	for(var j=0;j<delary.length;j++){		
		frm.mobiles.options[j].remove();
	}*/
}
function usesmsdy(){
	var frm=document.form1;
	frm.mobilestr.value=frm.smsdy.value;
}
function smssend(frm){
	if (frm.mobiles.options.length<1){
		alert("请选择发送的对象!");
		frm.mobiles.focus();
		return false;
	}
	if (frm.mobilestr.value==""){
		alert("请输入发送内容!");
		frm.mobilestr.focus();
		return false;
	}
	var lens=frm.mobiles.options.length;
	for(var i=0;i<lens;i++){
		frm.mobiles.options[i].selected=true;
	}
	document.getElementById(\'but_send\').value="正在发送...";
	document.getElementById(\'but_send\').disabled=\'disabled\';
	return true;
}
</script>
</HEAD><body><br>
<iframe id="smsiframe" name="smsiframe" style="display:none;align:center" src=""></iframe>
<form name="form1" id="form1" method="post" action="?action=sendsms" onSubmit="return smssend(this);">
<TABLE width="96%" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="96%" colSpan=4 align="center">
<TABLE cellSpacing=0 cellPadding=0 width="100%"background="images/bg.gif"><TBODY><TR>
<TD>&nbsp;<strong>短信群发</strong></TD>
</TR></TBODY></TABLE>
</TD></TR>
<TR>
  <TD height="20" align="center" bgColor="#d4e8fa" ><table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
	<TR>
	  <TD rowspan="3" align="center" valign="middle" bgColor="#FBFDFF" ><select name="smsgroup" size="20" id="smsgroup" style="width:200">
	  ';
$sqlg="select * from {$db_prefix}smsgroup where 1";
$resultg=$db->query($sqlg);
while($rsg=$db->fetch_array($resultg)){
echo "<option value='".$rsg["id"]."'>".$rsg["groupname"]."(".$rsg["nums"].")"."</option>";
}
$db->free_result($resultg);
;echo '	    </select>	  </TD>
	  <TD rowspan="3" align="left" valign="middle" bgColor="#FBFDFF" ><input type="button" name="Submit2" value="添加&gt;&gt;" onClick="smsadd();" class=button_text>
	  <br>
	    <input type="button" name="Submit3" value="&lt;&lt;删除" onClick="smsdel();"class=button_text></TD>
	  <TD width="77%" align="left" valign="middle" bgColor="#FBFDFF" ><select name="smsdy" id="smsdy">
	   ';
$sqlg1="select * from {$db_prefix}smsdy where 1";
$resultg1=$db->query($sqlg1);
while($rsg1=$db->fetch_array($resultg1)){
echo "<option value='".$rsg1["title"]."'>".$rsg1["title"]."</option>";
}
$db->free_result($resultg1);
;echo '	    </select>
	    <input type="button" name="Submit" value="使用短语" onClick="usesmsdy();" class=button_text></TD>
	  </TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" ><select name="mobiles[]" size="10" multiple id="mobiles" style="width:300">
	    </select>	  </TD>
	</TR>
	<TR>
	  <TD align="left" valign="middle" bgColor="#FBFDFF" ><textarea name="mobilestr" cols="40" rows="8" id="mobilestr" style="width:300"></textarea></TD>
	</TR>
	<TR>
	  <TD colspan="3" align="center" valign="middle" background="images/tab_19.gif"><INPUT class=button_text onMouseDown="this.className=\'button_onmousedown\'" onMouseOver="this.className=\'button_onmouseover\'" onMouseOut="this.className=\'button_onMouseOut\'" type=submit  id="but_send" value="确定群发短信" name="but_send">	  </TD>
	  </TR>	
    </table></TD>
  </TR>
</TABLE>
</form>
</body>
</html>';
?>