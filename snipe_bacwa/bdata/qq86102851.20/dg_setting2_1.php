<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_setting2`;");
E_C("CREATE TABLE `dg_setting2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_realname` varchar(3) DEFAULT '0' COMMENT '可修改项 别名',
  `m_mobile` varchar(3) DEFAULT '0' COMMENT '可修改项 手机',
  `m_phone` varchar(3) DEFAULT '0' COMMENT '可修改项 座机',
  `m_fax` varchar(3) DEFAULT '0' COMMENT '可修改项 传真',
  `m_address` varchar(3) DEFAULT '0' COMMENT '可修改项 地址',
  `m_postcode` varchar(3) DEFAULT '0' COMMENT '可修改项  邮编',
  `m_zhanghao` varchar(3) DEFAULT '0' COMMENT '可修改项 银行卡号',
  `m_huzhu` varchar(3) DEFAULT '0' COMMENT '可修改项  开户名',
  `m_idcard` varchar(3) DEFAULT '0' COMMENT '可修改项 证件号码',
  `m_qq` varchar(3) DEFAULT '0' COMMENT '可修改项 QQ',
  `s_realname` varchar(3) DEFAULT '0' COMMENT '必选项 别名',
  `s_mobile` varchar(3) DEFAULT '0' COMMENT '必选项 手机',
  `s_phone` varchar(3) DEFAULT '0' COMMENT '必选项 座机',
  `s_fax` varchar(3) DEFAULT '0' COMMENT '必选项 传真',
  `s_address` varchar(3) DEFAULT '0' COMMENT '必先项 地址',
  `s_postcode` varchar(3) DEFAULT '0' COMMENT '是否必选项 邮编',
  `s_zhanghao` varchar(3) DEFAULT '0' COMMENT '是否必选项 银行卡号',
  `s_huzhu` varchar(3) DEFAULT '0' COMMENT '是否必选项开户名',
  `s_idcard` varchar(3) DEFAULT '0' COMMENT '是否必选项 证件号码',
  `s_qq` varchar(3) DEFAULT '0',
  `s_email` varchar(3) DEFAULT '0',
  `m_email` varchar(3) DEFAULT '0',
  `s_bank` varchar(3) DEFAULT '0',
  `m_bank` varchar(3) DEFAULT '0',
  `s_receiver` varchar(3) DEFAULT '0',
  `m_receiver` varchar(3) DEFAULT '0',
  `identify_1` tinyint(3) DEFAULT '0' COMMENT '前台验证码',
  `identify_2` tinyint(3) DEFAULT '0' COMMENT '后台开启验证码',
  `fweek_0` tinyint(3) DEFAULT '0' COMMENT '周日开始时间',
  `fweek_1` tinyint(3) DEFAULT '0',
  `fweek_2` tinyint(3) DEFAULT '0',
  `fweek_3` tinyint(3) DEFAULT '0',
  `fweek_4` tinyint(3) DEFAULT '0',
  `fweek_5` tinyint(3) DEFAULT '0',
  `fweek_6` tinyint(3) DEFAULT '0',
  `tweek_0` tinyint(3) DEFAULT '0' COMMENT '周日结束时间',
  `tweek_1` tinyint(3) DEFAULT '0',
  `tweek_2` tinyint(3) DEFAULT '0',
  `tweek_3` tinyint(3) DEFAULT '0',
  `tweek_4` tinyint(3) DEFAULT '0',
  `tweek_5` tinyint(3) DEFAULT '0',
  `tweek_6` tinyint(3) DEFAULT '0',
  `reguser_1` tinyint(3) DEFAULT '0' COMMENT '注册',
  `s_zmdname` varchar(3) DEFAULT '0' COMMENT '所属业务中心',
  `denglu_1` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `dg_setting2` values('2','','1','','','1','','1','','1','','','','','','','','','','','','','','','1','','1','1','1','0','0','0','0','0','0','0','0','0','0','0','0','0','0','1','','1');");

require("../../inc/footer.php");
?>