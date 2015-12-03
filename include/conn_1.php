<?php

include("config.php");include("db_mysql.class.php");
$db=new db_mysql;
$db->connect($dbhost,$dbuser,$dbpwd,$dbname,$pconnect = 0);
?>