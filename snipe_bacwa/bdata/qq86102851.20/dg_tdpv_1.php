<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_tdpv`;");
E_C("CREATE TABLE `dg_tdpv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  `pv_1` float(12,2) DEFAULT '0.00' COMMENT '个人会员报单',
  `pv_2` float(12,2) DEFAULT '0.00' COMMENT '个人二次购物',
  `pv1` float(12,2) DEFAULT '0.00' COMMENT '团队报单业绩(包括自己)',
  `pv2` float(12,2) DEFAULT '0.00' COMMENT '团队二次消费业绩(包括自己)',
  `t_pv1` float(12,2) DEFAULT '0.00' COMMENT '推荐团队报单业绩（包括自己）',
  `t_pv2` float(12,2) DEFAULT '0.00' COMMENT '推荐团队二次消费（包括自己）',
  `num_1` int(11) DEFAULT '0' COMMENT '个人报单的单数',
  `num_2` int(11) DEFAULT '0' COMMENT '团队报单的单数，包括自己管理团队',
  `type` tinyint(3) DEFAULT '0' COMMENT '店铺累计',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `year` (`year`),
  KEY `month` (`month`),
  KEY `day` (`day`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8");
E_D("replace into `dg_tdpv` values('7','luck100','2015','05','26','1000.00','0.00','17000.00','0.00','17000.00','0.00','300','4500','0');");
E_D("replace into `dg_tdpv` values('2','','2015','05','26','0.00','0.00','-102000.00','0.00','-102000.00','0.00','0','-900','0');");
E_D("replace into `dg_tdpv` values('8','luck200','2015','05','26','1000.00','0.00','7000.00','0.00','7000.00','0.00','300','2100','0');");
E_D("replace into `dg_tdpv` values('9','luck300','2015','05','26','3000.00','0.00','9000.00','0.00','9000.00','0.00','300','2100','0');");
E_D("replace into `dg_tdpv` values('10','luck302','2015','05','26','1000.00','0.00','3000.00','0.00','3000.00','0.00','300','900','0');");
E_D("replace into `dg_tdpv` values('11','luck301','2015','05','26','1000.00','0.00','3000.00','0.00','3000.00','0.00','300','900','0');");
E_D("replace into `dg_tdpv` values('12','luck202','2015','05','26','1000.00','0.00','3000.00','0.00','3000.00','0.00','300','900','0');");
E_D("replace into `dg_tdpv` values('13','luck201','2015','05','26','1000.00','0.00','3000.00','0.00','3000.00','0.00','300','900','0');");
E_D("replace into `dg_tdpv` values('14','luck302b','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('15','luck302a','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('16','luck301b','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('17','luck301a','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('18','luck202b','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('19','luck202a','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('20','luck201b','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");
E_D("replace into `dg_tdpv` values('21','luck201a','2015','05','26','1000.00','0.00','1000.00','0.00','1000.00','0.00','300','300','0');");

require("../../inc/footer.php");
?>