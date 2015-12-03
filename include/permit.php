<?php

function permit_1(){
if (!empty($_SESSION["glo_userid"]) &&!empty($_SESSION["glo_username"])) return true;else return false;
}
function permit_2()
{
global $execary;
session_start();
if (!empty($_SESSION["glo_adminid"]) &&!empty($_SESSION["glo_adminname"]))
{
$dir_file = $_SERVER['SCRIPT_NAME'];
$filename = basename($dir_file);
$passed_files = 'top.php,center.php,left.php,welcome.php,down.php,logout.php';
$passed_ary		= explode(',',$passed_files);
if( in_array($filename,$passed_ary) )
{
return true;
}
else
{
if( array_multi_search($filename,$execary)==false )
{
if( array_multi_search($dir_file,$execary)==false ){
return false;
}else{
return true;
}
}
else
{
return true;
}
}
}
else
{
return false;
}
}
function array_multi_search( $p_needle,$p_haystack ) 
{
if(!is_array($p_haystack)) return false;
if( in_array( $p_needle,$p_haystack ) ) 
{
return true;
}
foreach( $p_haystack as $row ) 
{
if( array_multi_search( $p_needle,$row ) ) 
{
return true;
}
}
return false;
}

?>