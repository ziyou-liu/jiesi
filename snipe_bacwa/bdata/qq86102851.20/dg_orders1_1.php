<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_orders1`;");
E_C("CREATE TABLE `dg_orders1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `username1` varchar(50) DEFAULT NULL,
  `realname1` varchar(50) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `productname` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `price` float(12,2) DEFAULT '0.00',
  `pv` float(12,2) DEFAULT '0.00',
  `addtime` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT '0',
  `zftime` int(11) DEFAULT '0',
  `zhekou` double(4,2) NOT NULL DEFAULT '1.00',
  `type1` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>