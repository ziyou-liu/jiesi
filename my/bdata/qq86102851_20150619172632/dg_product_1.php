<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_product`;");
E_C("CREATE TABLE `dg_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `productname` varchar(50) DEFAULT NULL,
  `proimg` varchar(200) DEFAULT NULL,
  `price` float(12,2) DEFAULT '0.00',
  `pv` float(12,2) DEFAULT '0.00',
  `weight` float(12,2) DEFAULT '0.00',
  `memo` text,
  `addtime` int(11) DEFAULT NULL,
  `num` bigint(32) DEFAULT '0' COMMENT '产品数量',
  `zcprice` float(12,2) DEFAULT '0.00',
  `scprice` double(12,2) DEFAULT '0.00',
  `isdp` tinyint(3) DEFAULT '0',
  `dazhe` tinyint(3) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `dg_product` values('1','5','手机类','小米四手机移动版','1432618740.JPG','2000.00','0.00','0.00','小米四手机移动版,购买前请咨询报单中心商家','1357578493','10000','0.00','2000.00','0','0','1');");
E_D("replace into `dg_product` values('2','10','日用品','完美洗化产品','1432618843.JPG','3000.00','0.00','0.00','完美洗化产品','1357622482','10000','0.00','3000.00','0','0','1');");
E_D("replace into `dg_product` values('3','11','保健品','安利健康产品','1432618955.JPG','5000.00','0.00','0.00','安利健康产品','1384754672','10000','0.00','5000.00','0','0','1');");
E_D("replace into `dg_product` values('4','12','充值类','移动联通充值卡','1432619030.JPG','1000.00','0.00','0.00','移动联通充值卡','1384754880','10000','0.00','1000.00','0','0','1');");

require("../../inc/footer.php");
?>