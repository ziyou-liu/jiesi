<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_delta`;");
E_C("CREATE TABLE `dg_delta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `money` float(12,2) DEFAULT '0.00',
  `state` tinyint(3) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `adminname` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `dg_delta` values('6','luck100','sss','3000.00','1','1432649485','admin','1');");
E_D("replace into `dg_delta` values('5','luck100','sss','1000.00','1','1432649397','admin','1');");
E_D("replace into `dg_delta` values('7','luck100','sss','4000.00','1','1432649856','admin','1');");
E_D("replace into `dg_delta` values('8','luck100','sss','8000.00','1','1432650365','admin','1');");

require("../../inc/footer.php");
?>