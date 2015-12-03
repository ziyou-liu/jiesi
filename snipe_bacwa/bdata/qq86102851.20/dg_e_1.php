<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_e`;");
E_C("CREATE TABLE `dg_e` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `memo` tinyint(3) DEFAULT '0',
  `money` float(12,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '1',
  `addtime` int(11) DEFAULT '0',
  `periods` varchar(20) DEFAULT NULL,
  `memo1` varchar(200) DEFAULT NULL,
  `type1` tinyint(3) DEFAULT '1' COMMENT '1电子货币，2报单款',
  `rank` tinyint(3) DEFAULT '0',
  `tjnet` tinyint(3) DEFAULT '1',
  `sjtjnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tjnet` (`tjnet`),
  KEY `username` (`username`),
  KEY `memo` (`memo`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8");
E_D("replace into `dg_e` values('9','luck100','1','3000.00','1','1432649485',NULL,'后台充现金钱包','1','0','1','0');");
E_D("replace into `dg_e` values('8','luck100','11','1000.00','2','1432649402',NULL,'luck100确认会员luck200','1','0','1','0');");
E_D("replace into `dg_e` values('7','luck100','1','1000.00','1','1432649397',NULL,'后台充现金钱包','1','0','1','0');");
E_D("replace into `dg_e` values('10','luck100','11','3000.00','2','1432649494',NULL,'luck100确认会员luck300','1','0','1','0');");
E_D("replace into `dg_e` values('11','luck100','1','4000.00','1','1432649856',NULL,'后台充现金钱包','1','0','1','0');");
E_D("replace into `dg_e` values('12','luck100','11','1000.00','2','1432649860',NULL,'luck100确认会员luck302','1','0','1','0');");
E_D("replace into `dg_e` values('13','luck100','11','1000.00','2','1432649862',NULL,'luck100确认会员luck301','1','0','1','0');");
E_D("replace into `dg_e` values('14','luck100','11','1000.00','2','1432649864',NULL,'luck100确认会员luck202','1','0','1','0');");
E_D("replace into `dg_e` values('15','luck100','11','1000.00','2','1432649866',NULL,'luck100确认会员luck201','1','0','1','0');");
E_D("replace into `dg_e` values('16','luck100','1','8000.00','1','1432650365',NULL,'后台充现金钱包','1','0','1','0');");
E_D("replace into `dg_e` values('17','luck100','11','1000.00','2','1432650369',NULL,'luck100确认会员luck302b','1','0','1','0');");
E_D("replace into `dg_e` values('18','luck100','11','1000.00','2','1432650371',NULL,'luck100确认会员luck302a','1','0','1','0');");
E_D("replace into `dg_e` values('19','luck100','11','1000.00','2','1432650373',NULL,'luck100确认会员luck301b','1','0','1','0');");
E_D("replace into `dg_e` values('20','luck100','11','1000.00','2','1432650375',NULL,'luck100确认会员luck301a','1','0','1','0');");
E_D("replace into `dg_e` values('21','luck100','11','1000.00','2','1432650377',NULL,'luck100确认会员luck202b','1','0','1','0');");
E_D("replace into `dg_e` values('22','luck100','11','1000.00','2','1432650378',NULL,'luck100确认会员luck202a','1','0','1','0');");
E_D("replace into `dg_e` values('23','luck100','11','1000.00','2','1432650380',NULL,'luck100确认会员luck201b','1','0','1','0');");
E_D("replace into `dg_e` values('24','luck100','11','1000.00','2','1432650382',NULL,'luck100确认会员luck201a','1','0','1','0');");

require("../../inc/footer.php");
?>