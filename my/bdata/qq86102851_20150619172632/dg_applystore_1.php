<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_applystore`;");
E_C("CREATE TABLE `dg_applystore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `applyrank` tinyint(3) DEFAULT '0' COMMENT '申请级别',
  `storename` varchar(200) DEFAULT NULL,
  `store_address` varchar(200) DEFAULT NULL,
  `applytime` int(11) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `edittime` int(11) DEFAULT '0',
  `oldrank` tinyint(3) DEFAULT '0',
  `store_province` varchar(20) DEFAULT NULL,
  `store_city` varchar(20) DEFAULT NULL,
  `store_area` varchar(20) DEFAULT NULL,
  `type` tinyint(3) DEFAULT '0' COMMENT '0自己申请，1后台调整',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作人',
  `first` tinyint(3) DEFAULT '0' COMMENT '第一次实升为店铺',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>