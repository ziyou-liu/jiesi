<?php

include("config.php");include("db_mysql.class.php");
$db=new db_mysql;
$db->connect($dbhost,$dbuser,$dbpwd,$dbname,$pconnect = 0);
include("permit.php");include("pv.php");
if (!permit_1()){
echo "<script>top.location.href='../login.php';</script>";exit();
}
$execfile=$_SERVER['REQUEST_URI'];
?>