<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_bwnet`;");
E_C("CREATE TABLE `dg_bwnet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `realname` varchar(200) DEFAULT NULL,
  `prename` varchar(200) DEFAULT NULL,
  `preid` int(11) DEFAULT NULL,
  `pos` tinyint(3) DEFAULT NULL,
  `posnum` tinyint(3) DEFAULT NULL,
  `nums` int(11) DEFAULT '0',
  `dept` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `outtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
E_D("replace into `dg_bwnet` values('1','luck100','',NULL,NULL,NULL,'2','2','1','1432646186','1',NULL);");
E_D("replace into `dg_bwnet` values('2','luck300','sssd','luck100','1','1','2','2','2','1432649860','1',NULL);");
E_D("replace into `dg_bwnet` values('3','luck200','sssd','luck100','1','2','2','2','2','1432649864','1',NULL);");
E_D("replace into `dg_bwnet` values('4','luck302','sfsafff','luck300','2','1','2','0','3','1432650370','1',NULL);");
E_D("replace into `dg_bwnet` values('5','luck301','sfsf','luck300','2','2','2','0','3','1432650373','1',NULL);");
E_D("replace into `dg_bwnet` values('6','luck202','sfasf','luck200','3','1','2','0','3','1432650377','1',NULL);");
E_D("replace into `dg_bwnet` values('7','luck201','dsfsaf','luck200','3','2','2','0','3','1432650380','1',NULL);");

require("../../inc/footer.php");
?>