<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_tjpan`;");
E_C("CREATE TABLE `dg_tjpan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `tjnet` tinyint(3) DEFAULT '0' COMMENT '上一轮',
  `newtjnet` tinyint(3) DEFAULT '0' COMMENT '新一轮',
  `addtime` int(11) DEFAULT NULL COMMENT '进盘时间',
  `tjnum` int(11) DEFAULT NULL COMMENT '推荐数量',
  `memo` varchar(255) DEFAULT '0' COMMENT '说明',
  `admin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>