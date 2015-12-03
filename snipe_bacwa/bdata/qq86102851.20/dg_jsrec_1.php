<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_jsrec`;");
E_C("CREATE TABLE `dg_jsrec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periods` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `rank` tinyint(3) DEFAULT '1' COMMENT '级别',
  `fee` double(12,2) NOT NULL DEFAULT '0.00',
  `total` double(12,2) NOT NULL DEFAULT '0.00',
  `flprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '静态返利',
  `dpprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '对碰奖',
  `leftnum` int(11) NOT NULL DEFAULT '0' COMMENT 'A区',
  `leftsy` int(11) NOT NULL DEFAULT '0',
  `rightnum` int(11) NOT NULL DEFAULT '0' COMMENT 'B',
  `rightsy` int(11) NOT NULL DEFAULT '0',
  `tjprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '销售奖',
  `hdprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '互动奖',
  `dlprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '对碰领导奖',
  `hbprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '回本奖',
  `xgprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '销售管理奖',
  `bjdprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT 'B网见点',
  `hcprice` double(12,2) NOT NULL DEFAULT '0.00',
  `bdprice` double(12,2) NOT NULL DEFAULT '0.00',
  `cxprice` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '重消账户',
  `rankok` tinyint(3) NOT NULL DEFAULT '0',
  `cfxf` double(12,2) NOT NULL DEFAULT '0.00' COMMENT ' 聚宝盆奖励',
  `shui` double(12,2) NOT NULL DEFAULT '0.00',
  `wlwhf` double(12,2) NOT NULL DEFAULT '0.00',
  `fdprice` double(12,2) NOT NULL DEFAULT '0.00',
  `tgprice` double(12,2) NOT NULL DEFAULT '0.00',
  `tcprice` double(12,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `periods` (`periods`,`username`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>