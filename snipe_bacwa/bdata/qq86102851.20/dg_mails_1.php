<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_mails`;");
E_C("CREATE TABLE `dg_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  `fromusername` varchar(50) DEFAULT NULL,
  `fromrealname` varchar(50) DEFAULT NULL,
  `fromtype` tinyint(3) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `readstate` tinyint(3) DEFAULT '0' COMMENT '是否阅读过,0未阅，1已阅',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>