<?php

require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$lur=islogin();
$loginin=$lur['username'];
$rnd=$lur['rnd'];
$link=db_connect();
$empire=new mysqlquery();
$mydbname=$phome_db_dbname;
$udb=$empire->query("use `".$phome_db_dbname."`");
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
$mypath=$mydbname."_".date("YmdHis");
if($phpsafemod)
{
$mypath="safemod";
}
$loadfile=RepPostVar($_GET['savefilename']);
if(strstr($loadfile,'.')||strstr($loadfile,'/')||strstr($loadfile,"\\"))
{
$loadfile='';
}
if(empty($loadfile))
{
$loadfile='def';
}
$loadfile='setsave/'.$loadfile;
@include($loadfile);
if($dmypath)
{
$mypath=$dmypath;
}
$keyboard=RepPostVar($_GET['keyboard']);
if(empty($keyboard))
{
$keyboard=$dkeyboard;
if(empty($keyboard))
{
$keyboard=$baktbpre;
}
}
$and="";
if($keyboard)
{
$and=" LIKE '%$keyboard%'";
}
$sql=$empire->query("SHOW TABLE STATUS".$and);
require LoadAdminTemp('DatabaseBackup.php');
db_close();
$empire=null;
?>