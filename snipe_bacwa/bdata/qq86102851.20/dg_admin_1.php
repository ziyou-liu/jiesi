<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_admin`;");
E_C("CREATE TABLE `dg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8");
E_D("replace into `dg_admin` values('11','admin','超管','UwEOV1MPUVJRAgA=6829cb5cee','7','总管','15725956032','1325981288');");

require("../../inc/footer.php");
?>