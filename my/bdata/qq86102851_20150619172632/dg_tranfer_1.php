<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_tranfer`;");
E_C("CREATE TABLE `dg_tranfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `tousername` varchar(50) DEFAULT NULL,
  `torealname` varchar(50) DEFAULT NULL,
  `price` float(12,2) DEFAULT '0.00',
  `state` tinyint(3) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `fee` double(12,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>