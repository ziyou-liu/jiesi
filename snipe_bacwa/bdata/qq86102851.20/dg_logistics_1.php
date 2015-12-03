<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_logistics`;");
E_C("CREATE TABLE `dg_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL COMMENT '订单编号',
  `companyid` int(3) DEFAULT NULL COMMENT '物流公司编号',
  `log_no` varchar(255) DEFAULT NULL COMMENT '物流单号',
  `memo` text COMMENT '备注',
  `address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `tel` varchar(50) DEFAULT NULL COMMENT '座机',
  `mobile` varchar(255) DEFAULT NULL COMMENT '收货人手机',
  `state` tinyint(3) DEFAULT '0' COMMENT '状态0未发货1已发货2收货',
  `sendtime` varchar(255) DEFAULT NULL COMMENT '发货时间',
  `confirmtime` int(11) DEFAULT NULL,
  `receiver` varchar(255) DEFAULT NULL COMMENT '收货人',
  `postcode` varchar(255) DEFAULT NULL COMMENT '邮编',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>