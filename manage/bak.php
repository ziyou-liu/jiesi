<?php
echo '<HTML><HEAD><title></title>  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
include("../include/conn.php");
if(!empty($restore)){
$tempfromfile = $_FILES['filename']['tmp_name'];
$tempfromfile_name = $_FILES['filename']['name'];
if ((!empty($tempfromfile)) &&(!empty($tempfromfile_name))) {
$fromfilefile = $tempfromfile;
$fromfile_name = $tempfromfile_name;
}
if ((!empty($fromfilefile)) &&(!empty($fromfile_name))) {
$dest1 = "../db/upload_".time().$fromfile_name;
$ext=substr($fromfile_name,-3);
if($ext=="zip"){
$tt=copy($fromfilefile,$dest1);
}else{
echo "<script>alert('请上传正确的备份文件！')</script>";
}
}
;echo '  <meta http-equiv="refresh" content="1; URL=../db/unzip.php?zipfilename=';print "$dest1";;echo '">
 ';};echo '
<link rel="stylesheet" href="/images/datalist.css" type="text/css">
</HEAD><body>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
  <TABLE cellSpacing=0 cellPadding=0 width="100%">
     <TBODY><TR>
     <TD width=213 height=23>&nbsp;<strong>数据库备份</strong></TD>
    <TD >&nbsp;</TD>
     </TR>
     </TBODY>
 </TABLE>
</TD>
</TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <TR>
	  <TD colspan="2">请保存好备份数据，以便日后恢复</TD>
	</TR>
    <TR>
	  <TD colspan="2" height="50" align="right">
      <form  action="../db/bak.php" method="post">
      <input type="submit" name="backup" value="备份当前数据" class="button_text"> <br>
      </form>
      </TD>
	</TR>
    </table>
    </TD>
  </TR>
  </tbody>
</TABLE>

<!--数据恢复-->
<br>
<TABLE width="421" border=0 align="center" cellPadding=0 cellSpacing=0 class=Table_xt>
<TBODY>
<TR><TD width="421" colSpan=4 background="images/bg.gif">
  <TABLE cellSpacing=0 cellPadding=0 width="100%">
     <TBODY><TR>
     <TD width=213 height=23>&nbsp;<strong>数据库恢复</strong></TD>
    <TD >&nbsp;</TD>
     </TR>
     </TBODY>
 </TABLE>
</TD>
</TR>
<TR>
  <TD height="20" align="left" bgColor="#d4e8fa" >
  <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <TR>
	  <TD colspan="2">
      <form action="';print "$PHP_SELF";;echo '" method="post" enctype="multipart/form-data">
    <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <TR>
	  <TD colspan="2">数据库恢复(请慎用，一旦选择了恢复文件，以前的所有数据将被覆盖!)</TD>
	</TR>
    <TR>
	  <TD>请上传数据文件(zip格式)</TD>
      <td><input type="file" name="filename"></td>
	</TR>
    <TR>
	  <TD colspan="2" align="right"><input type="submit" name="restore" value="恢复" class="button_text"></td>
	</TR>
    </table>
    </form>
      </TD>
	</TR>
    </table>
    </TD>
  </TR>
  </tbody>
</TABLE>
</body></html>';
?>