<?php

require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$lur=islogin();
$link=db_connect();
$empire=new mysqlquery();
$mypath=$_GET['mypath'];
$mydbname=$_GET['mydbname'];
$selectdbname=$phome_db_dbname;
if($mydbname)
{
$selectdbname=$mydbname;
}
$db = $empire;
include("../include/power.php");
include("../include/access.php");
include("../include/permit.php");
if (!permit_2()){
$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$content .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$content .= '<head>';
$content .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$content .= '</head>';
$content .= '<body>';
$content .= '<div style="padding:10px;margin:10px;border:1px solid #999999;text-align:center;color:#999999"><p>无权限访问!&nbsp;&nbsp;如有疑问请联系管理员!</p>';
$content .= '</div></body></html>';
echo $content;
exit;
}
$phome=$_GET['phome'];
if(empty($phome)){$phome=$_POST['phome'];}
if($phome=="ReData")
{
$add=$_POST['add'];
$mypath=$_POST['mypath'];
Ebak_ReData($add,$mypath);
}
else
{
$db='';
if($canlistdb)
{
$db.="<option value='".$selectdbname."' selected>".$selectdbname."</option>";
}
else
{
$sql=$empire->query("SHOW DATABASES");
while($r=$empire->fetch($sql))
{
if($r[0]==$selectdbname)
{$select=" selected";}
else
{$select="";}
$db.="<option value='".$r[0]."'".$select.">".$r[0]."</option>";
}
}
require LoadAdminTemp('DatabaseRestore.php');
db_close();
$empire=null;
}

?>