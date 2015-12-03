<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_bank`;");
E_C("CREATE TABLE `dg_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(100) DEFAULT NULL,
  `zhanghao` varchar(200) DEFAULT NULL,
  `huzhu` varchar(50) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
E_D("replace into `dg_bank` values('1','中国农业银行','111','111','1354608835');");
E_D("replace into `dg_bank` values('2','中国建设银行','222','222','1354608850');");
E_D("replace into `dg_bank` values('4','中国银行','000','33','1358134830');");

require("../../inc/footer.php");
?>