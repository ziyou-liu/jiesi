<?php

require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$phome=$_GET['phome'];
if(empty($phome))
{$phome=$_POST['phome'];}
$lur=islogin();
$link=db_connect();
$empire=new mysqlquery();
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
if($phome=="DelBakpath")
{
$path=$_GET['path'];
Ebak_DelBakpath($path);
}
function Ebak_DelBakpath($path){
global $bakpath;
if(strstr($path,".."))
{printerror("NotChangeDelPath","history.go(-1)");}
if(!trim($path))
{printerror("NotChangeDelPath","history.go(-1)");}
$delpath=$bakpath."/".$path;
if(!file_exists($delpath))
{
printerror("DelPathNotExists","history.go(-1)");
}
$delpath=DelPath($delpath);
printerror("DelPathSuccess","ChangePath.php?change=".$_GET['change']);
}

?>