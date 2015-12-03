<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_smsrec`;");
E_C("CREATE TABLE `dg_smsrec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(100) DEFAULT NULL,
  `content` text,
  `outmsg` tinyint(3) DEFAULT '0' COMMENT '短信发送状态',
  `sendtime` int(11) DEFAULT '0' COMMENT '发送时间',
  `gid` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `adminid` int(11) DEFAULT '0',
  `admin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>