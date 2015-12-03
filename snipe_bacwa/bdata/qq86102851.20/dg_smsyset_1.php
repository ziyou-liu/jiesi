<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_smsyset`;");
E_C("CREATE TABLE `dg_smsyset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_1` text,
  `post_2` text,
  `post_3` text,
  `post_4` text,
  `post_5` text NOT NULL,
  `post_6` text NOT NULL,
  `post_1_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_2_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_3_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_4_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_5_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_6_close` tinyint(3) NOT NULL DEFAULT '0',
  `post_7` text CHARACTER SET gbk NOT NULL,
  `post_7_close` tinyint(3) NOT NULL DEFAULT '0',
  `sms_user` varchar(20) DEFAULT NULL,
  `sms_pwd` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `dg_smsyset` values('1','','','会员编号：{\$bianhao}，提现银行：{\$bankname}，提现账号：{\$num}，提现金额：{\$money}，收款人：{\$remitname}。','','','欢迎您成为公司会员，会员查询网址：www.yhyzqj.com.您的会员编号：{\$bianhao}，会员姓名：{\$xingming}，一级密码：{\$mima}，二级密码：{\$mima2}，推荐人：{\$tuijian}，接点人：{\$jiedian}。','0','0','0','0','0','1','','0','测试01','123456');");

require("../../inc/footer.php");
?>