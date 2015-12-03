<?php

require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
require LoadLang('f.php');
$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
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
if($phome=="DoEbak")
{
Ebak_DoEbak($_POST);
}
elseif($phome=="BakExe")
{
$t=$_GET['t'];
$s=$_GET['s'];
$p=$_GET['p'];
$mypath=$_GET['mypath'];
$alltotal=$_GET['alltotal'];
$thenof=$_GET['thenof'];
$fnum=$_GET['fnum'];
$stime=$_GET['stime'];
Ebak_BakExe($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$stime);
}
elseif($phome=="BakExeT")
{
$t=$_GET['t'];
$s=$_GET['s'];
$p=$_GET['p'];
$mypath=$_GET['mypath'];
$alltotal=$_GET['alltotal'];
$thenof=$_GET['thenof'];
$fnum=$_GET['fnum'];
$auf=$_GET['auf'];
$aufval=$_GET['aufval'];
$stime=$_GET['stime'];
Ebak_BakExeT($t,$s,$p,$mypath,$alltotal,$thenof,$fnum,$auf,$aufval,$stime);
}
else
{
printerror("ErrorUrl","history.go(-1)");
}
?>