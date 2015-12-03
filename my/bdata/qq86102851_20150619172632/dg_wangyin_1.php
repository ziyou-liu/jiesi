<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_wangyin`;");
E_C("CREATE TABLE `dg_wangyin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `money` double(12,2) NOT NULL DEFAULT '0.00',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1???????0???????',
  `paytype` tinyint(3) NOT NULL DEFAULT '1' COMMENT '???????',
  `addtime` int(11) DEFAULT NULL,
  `paytime` int(11) DEFAULT NULL,
  `fee` double(12,2) NOT NULL DEFAULT '0.00',
  `realmoney` double(12,0) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `sno` varchar(50) DEFAULT NULL,
  `pd_frpid` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8");
E_D("replace into `dg_wangyin` values('1','cn495060','300.00','0','1','2','1380115679',NULL,'0.00',NULL,NULL,NULL,'','hsz9999');");
E_D("replace into `dg_wangyin` values('2','cn502098','100.00','0','1','2','1381482737',NULL,'0.00',NULL,NULL,NULL,'','2');");
E_D("replace into `dg_wangyin` values('3','cn858539','100.00','0','1','2','1381644854',NULL,'0.00',NULL,NULL,NULL,'','2');");

require("../../inc/footer.php");
?>