<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" href="/images/datalist.css" type="text/css">
';
include("../include/conn.php");
$sql="delete from {$db_prefix}logs where 1";
$db->query($sql);
echo "<script>alert('已经全部删除');location.href='logs.php';</script>";exit();
?>