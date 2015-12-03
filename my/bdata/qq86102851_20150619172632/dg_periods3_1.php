<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_periods3`;");
E_C("CREATE TABLE `dg_periods3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periods` int(11) DEFAULT '0',
  `begintime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `jsname` varchar(20) DEFAULT '0',
  `state1` tinyint(3) DEFAULT '0',
  `jstime` varchar(255) DEFAULT NULL,
  `fftime` int(11) DEFAULT NULL,
  `state2` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `periods` (`periods`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>