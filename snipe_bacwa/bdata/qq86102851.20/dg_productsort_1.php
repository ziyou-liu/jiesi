<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_productsort`;");
E_C("CREATE TABLE `dg_productsort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topid` int(11) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `orders` int(4) DEFAULT NULL,
  `depth` int(4) DEFAULT NULL,
  `last` tinyint(1) DEFAULT '0',
  `time` int(10) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `px` tinyint(3) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8");
E_D("replace into `dg_productsort` values('5','5','0','手机类','0','1','0','0','1357813559',NULL,'0','0');");
E_D("replace into `dg_productsort` values('10','10','0','日用品','0','2','0','0','1379834070',NULL,'0','1');");
E_D("replace into `dg_productsort` values('11','11','0','保健品','0','3','0','0','1380114628',NULL,'0','0');");
E_D("replace into `dg_productsort` values('12','12','0','充值类','0','4','0','1','1380114634',NULL,'0','0');");

require("../../inc/footer.php");
?>