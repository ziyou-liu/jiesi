<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_jsrec3`;");
E_C("CREATE TABLE `dg_jsrec3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periods` int(11) DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `rank` tinyint(3) DEFAULT '1' COMMENT '级别',
  `weihufei` double(12,2) DEFAULT '0.00' COMMENT '网络维护费',
  `fax` double(12,2) DEFAULT '0.00' COMMENT '税',
  `fee` double(12,2) DEFAULT '0.00',
  `total` double(12,2) DEFAULT '0.00',
  `fenhong1` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '公司利润分红',
  `totalyj` double(12,2) NOT NULL DEFAULT '0.00',
  `cfxf` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '纳税',
  PRIMARY KEY (`id`),
  KEY `periods` (`periods`,`username`),
  KEY `username` (`username`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>