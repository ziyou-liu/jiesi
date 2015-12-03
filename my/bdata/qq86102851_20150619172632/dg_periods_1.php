<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_periods`;");
E_C("CREATE TABLE `dg_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periods` int(11) DEFAULT NULL,
  `begintime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `jsname` varchar(20) DEFAULT '0',
  `state1` tinyint(3) DEFAULT '0',
  `state2` tinyint(3) DEFAULT '0',
  `jstime` varchar(255) DEFAULT NULL,
  `ranktag` tinyint(3) DEFAULT '0' COMMENT '是否更新过本期级别',
  `fftime` int(11) DEFAULT NULL,
  `delmemo` text COMMENT '删除记录',
  `kzhi` tinyint(3) DEFAULT '0',
  `olddpprice` double(12,2) DEFAULT '0.00',
  `display` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `periods` (`periods`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>