<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_orders`;");
E_C("CREATE TABLE `dg_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `price` float(12,2) DEFAULT '0.00',
  `price1` double(12,2) DEFAULT '0.00',
  `price2` double(12,2) DEFAULT '0.00',
  `pv` float(12,2) DEFAULT '0.00',
  `state` tinyint(3) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `zftime` int(11) DEFAULT '0',
  `zhekou` float(12,2) DEFAULT '0.00' COMMENT '购物价格折扣',
  `pvzhekou` float(6,2) DEFAULT '0.00' COMMENT 'pv折扣',
  `confirmtime` int(11) DEFAULT NULL,
  `type` tinyint(3) DEFAULT '0' COMMENT '类型，用购物款还是电子货币',
  `shouhuotime` int(11) DEFAULT NULL,
  `fahuotime` int(11) DEFAULT '0',
  `type1` tinyint(3) DEFAULT '0',
  `ziti` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>