<?php
header("Cache-control: private");
error_reporting(E_ALL ^ E_NOTICE);
//import_request_variables('pg');
extract($_POST);extract($_GET);
ini_set('date.timezone','Asia/Shanghai');
$dbhost="localhost";
$dbuser="root";
$dbpwd="root";
$dbname="chuanxiao_yzx";
$dbport="3306";
$db_prefix="dg_";
include("safe_val.php");
$modtime=time();
?>