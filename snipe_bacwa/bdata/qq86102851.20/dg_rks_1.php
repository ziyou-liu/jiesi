<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_rks`;");
E_C("CREATE TABLE `dg_rks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) DEFAULT NULL,
  `productname` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  `adminid` int(11) DEFAULT NULL,
  `adminname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `dg_rks` values('1','1','小米四手机移动版','100','1432618740','11','admin');");
E_D("replace into `dg_rks` values('2','2','完美洗化产品','100','1432618843','11','admin');");
E_D("replace into `dg_rks` values('3','3','安利健康产品','1000','1432618955','11','admin');");
E_D("replace into `dg_rks` values('4','4','移动联通充值卡','1000','1432619030','11','admin');");
E_D("replace into `dg_rks` values('5','2','完美洗化产品','9900','1432619107','11','admin');");
E_D("replace into `dg_rks` values('6','1','小米四手机移动版','9900','1432619118','11','admin');");
E_D("replace into `dg_rks` values('7','3','安利健康产品','9000','1432619126','11','admin');");
E_D("replace into `dg_rks` values('8','4','移动联通充值卡','9000','1432619131','11','admin');");

require("../../inc/footer.php");
?>