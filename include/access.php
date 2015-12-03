<?php

session_start();
$accstr="";
$sql_acc="select * from {$db_prefix}admin where id='".$_SESSION["glo_adminid"]."'";
$rs_acc=$db->get_one($sql_acc);
$departmentid=$rs_acc["departmentid"];
$sql_dpt="select * from {$db_prefix}department where id='".$departmentid."'";
$rs_dpt=$db->get_one($sql_dpt);
$accstr=$rs_dpt["power"];
$accary=explode(",",$accstr);
$menuary=array();
$execary=array();
foreach($powerary as $key_p=>$value_p)
{
$menu_b=0;
foreach($value_p as $value_p1)
{
if (in_array($value_p1,$accary)) $menu_b=1;
}
if ($menu_b==1)
{
foreach($value_p as $value_key1=>$value_p1)
{
if ( in_array($value_p1,$accary) ) 
{
$execary[$key_p][$value_key1] = $filesary[$key_p][$value_key1];
if(  $ismenusary[$key_p][$value_key1] == '1')	
{
$menuary[$key_p][$value_key1] = $value_p1;
}
}
}
}
}

?>