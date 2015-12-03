<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_editrankrecord`;");
E_C("CREATE TABLE `dg_editrankrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `oldrank` tinyint(3) DEFAULT '0' COMMENT '原级别',
  `rank` tinyint(3) DEFAULT '0' COMMENT '修改为的级别',
  `edittime` varchar(255) DEFAULT NULL COMMENT '修改时间',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作人',
  `type` tinyint(3) DEFAULT '0' COMMENT '0自己申请，1后台调整',
  `applytime` varchar(255) DEFAULT NULL COMMENT '申请时间',
  `isapproved` tinyint(3) DEFAULT '0' COMMENT '是否批准,0,1,2',
  `state` tinyint(3) DEFAULT '0' COMMENT '0未处理，1已处理',
  `sjkoumoney` tinyint(3) DEFAULT '0' COMMENT '升级扣money',
  `sjleijipv` tinyint(3) DEFAULT '0' COMMENT '升级累计pv',
  `orderid` int(11) DEFAULT '0',
  `regusername` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rank` (`rank`),
  KEY `oldrank` (`oldrank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>