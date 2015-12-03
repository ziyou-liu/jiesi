<?php

include("config.php");include("db_mysql.class.php");
$db=new db_mysql;
$dblnk=$db->connect($dbhost,$dbuser,$dbpwd,$dbname,$pconnect = 0);
include("power.php");include("access.php");
include("permit.php");include("pv.php");include("rank.php");
if (!permit_2()){
$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$content .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$content .= '<head>';
$content .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$content .= '</head>';
$content .= '<body>无权限访问!</body>';
$content .= '</html>';
echo $content;
exit;
}

?>