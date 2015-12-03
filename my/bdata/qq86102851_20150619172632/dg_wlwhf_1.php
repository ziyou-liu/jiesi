<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_wlwhf`;");
E_C("CREATE TABLE `dg_wlwhf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `whf` double(12,2) DEFAULT '0.00' COMMENT '多少钱',
  `jntime` int(11) DEFAULT '0' COMMENT '缴纳时间',
  `periods` int(11) DEFAULT '0' COMMENT '缴纳的期数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>