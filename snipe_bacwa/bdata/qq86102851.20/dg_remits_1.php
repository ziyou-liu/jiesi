<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_remits`;");
E_C("CREATE TABLE `dg_remits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `bankid` int(11) DEFAULT NULL,
  `bank` text,
  `hkname` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT '',
  `memo` text,
  `state` tinyint(3) DEFAULT '0' COMMENT '0:未审核',
  `hktime` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>