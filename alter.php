<?php

include("include/conn_1.php");
$db->query("alter table dg_users add index storerank(`storerank`)");
echo "<br>ok";exit();

?>