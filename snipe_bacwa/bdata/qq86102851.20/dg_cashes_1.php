<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_cashes`;");
E_C("CREATE TABLE `dg_cashes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `zhanghao` varchar(100) DEFAULT NULL,
  `huzhu` varchar(50) DEFAULT NULL,
  `price` float(12,2) DEFAULT '0.00',
  `addtime` int(11) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `fee` float(12,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>