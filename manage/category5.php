<?php

include("../include/conn.php");
$rs=$db->get_one("select count(id) as c from ".$db_prefix."productsort where parentid='".$id."'");
if($rs['c']>0){
;echo '	<script>alert(\'有子节点不允许删除\');location.href=\'category.php\';</script>
	';
exit;
}
$rs=$db->get_one("select * from ".$db_prefix."productsort where id='".$id."'");
$orders=$rs['orders'];
$last=$rs['last'];
$parentid=$rs['parentid'];
$db->query("update ".$db_prefix."productsort set orders=orders-1 where orders>'".$orders."'");
$db->query("delete from ".$db_prefix."productsort where id='".$id."'");
if ($last==1){
$rs=$db->get_one("select max(id) as c from ".$db_prefix."productsort where parentid='".$parentid."'");
$db->query("update ".$db_prefix."productsort set last=1 where id='".$rs['c']."'");
}
header("location:category.php");

?>