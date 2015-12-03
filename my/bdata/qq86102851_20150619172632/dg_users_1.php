<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_users`;");
E_C("CREATE TABLE `dg_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `pwd1` varchar(100) DEFAULT NULL,
  `pwd2` varchar(200) DEFAULT NULL,
  `wenti1` int(11) DEFAULT NULL,
  `wenti2` varchar(500) DEFAULT NULL,
  `tjrname` varchar(50) DEFAULT NULL,
  `prename` varchar(50) DEFAULT NULL,
  `pos` varchar(10) DEFAULT NULL,
  `zmdname` varchar(50) DEFAULT NULL,
  `bdmoney` float(12,2) DEFAULT '0.00' COMMENT '报单金额',
  `bdnum` varchar(100) DEFAULT NULL COMMENT '个人报单数',
  `bdnum_team` int(11) DEFAULT '0' COMMENT '团队报单数',
  `tjbdnum` int(11) DEFAULT '0' COMMENT ' 推荐份数',
  `tjnum` smallint(6) NOT NULL DEFAULT '0' COMMENT '推荐人数',
  `price` float(12,2) DEFAULT '0.00' COMMENT '电子货币',
  `j_price` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '奖金账户',
  `price_repeat` float(12,2) DEFAULT '0.00' COMMENT '重复消费',
  `price1` double(12,2) NOT NULL DEFAULT '0.00' COMMENT '会员现金钱包',
  `price_repeat1` double(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '股票回购钱包',
  `price_s` float(12,2) DEFAULT '0.00' COMMENT '奖金总额',
  `flprice` double(12,2) DEFAULT '0.00',
  `jifen` double(12,2) DEFAULT '0.00' COMMENT '会员的积分',
  `bv` float(12,2) DEFAULT '0.00' COMMENT '换购积分钱包',
  `pv_reg` float(12,2) DEFAULT '0.00' COMMENT '个人报单金额',
  `pv_consume` float(12,2) DEFAULT '0.00' COMMENT '个人二次消费',
  `pv_team_reg` float(12,2) DEFAULT '0.00' COMMENT '团队报单',
  `pv_team_con` float(12,2) DEFAULT '0.00' COMMENT '团队二次消费',
  `pv_team_regp` float(12,2) DEFAULT '0.00' COMMENT '推荐网体团队保单',
  `pv_team_conp` float(12,2) DEFAULT '0.00' COMMENT '推荐网体团队二次消费',
  `rank0` tinyint(3) DEFAULT '0' COMMENT '注册时候的级别(这个级别不会变)',
  `rank` tinyint(3) DEFAULT '1',
  `rank1` tinyint(3) DEFAULT '0',
  `isdp` tinyint(3) DEFAULT '0',
  `state` tinyint(3) DEFAULT '0',
  `lognum` int(11) DEFAULT '0',
  `regtime` int(11) DEFAULT NULL,
  `confirmtime` int(11) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `zhanghao` varchar(100) DEFAULT NULL,
  `huzhu` varchar(50) DEFAULT NULL,
  `idcard` varchar(100) DEFAULT NULL,
  `storename` varchar(200) DEFAULT NULL,
  `storerank` tinyint(4) DEFAULT '0' COMMENT '店铺级别',
  `store_province` varchar(20) DEFAULT NULL,
  `store_city` varchar(20) DEFAULT NULL,
  `store_area` varchar(20) DEFAULT NULL,
  `store_address` varchar(200) DEFAULT NULL,
  `regusername` varchar(50) DEFAULT NULL,
  `regrealname` varchar(50) DEFAULT NULL,
  `regtype` tinyint(3) DEFAULT '0' COMMENT '0 注册人类型',
  `posnum` tinyint(3) DEFAULT '2' COMMENT '该会员可以开几个区',
  `isblank` tinyint(3) DEFAULT '0' COMMENT '是否空点',
  `storeregtime` varchar(255) DEFAULT NULL COMMENT '成为加盟店的时间',
  `gldept` int(11) DEFAULT '1' COMMENT '管理深度',
  `tjdept` int(11) DEFAULT '1' COMMENT '推荐网体深度',
  `tjstr` text NOT NULL,
  `glstr` text NOT NULL,
  `receiver` varchar(255) DEFAULT NULL COMMENT '收货人姓名',
  `nationality` varchar(255) DEFAULT NULL COMMENT '国籍',
  `bankaddress` varchar(255) DEFAULT NULL COMMENT '开户行地址',
  `recontact` varchar(255) DEFAULT NULL COMMENT '收货人联系方式',
  `phone` varchar(255) DEFAULT NULL COMMENT '收货联系人座机',
  `jspv` float(12,2) DEFAULT '0.00' COMMENT '结算时用的pv',
  `timepre` varchar(50) DEFAULT NULL COMMENT '时间网络图前者',
  `fax` varchar(100) DEFAULT NULL COMMENT '传真',
  `qq` varchar(20) DEFAULT NULL COMMENT 'QQ',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `shopprice` double(12,2) NOT NULL DEFAULT '0.00',
  `buynum` int(11) NOT NULL DEFAULT '0',
  `gupiaonum` int(11) NOT NULL DEFAULT '0',
  `regbv` int(11) NOT NULL DEFAULT '0',
  `salebv` int(11) NOT NULL DEFAULT '0',
  `hgnum` int(11) NOT NULL DEFAULT '0',
  `czprice` double(12,2) NOT NULL DEFAULT '0.00',
  `bankid` int(11) DEFAULT NULL,
  `nologin` tinyint(3) NOT NULL DEFAULT '1',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `bw` tinyint(3) NOT NULL DEFAULT '0',
  `bwprice` double(12,2) NOT NULL DEFAULT '0.00',
  `rfd` tinyint(1) NOT NULL DEFAULT '0',
  `zfd` tinyint(1) NOT NULL DEFAULT '0',
  `rfd_e` double(12,2) NOT NULL DEFAULT '0.00',
  `zfd_e` double(12,2) NOT NULL DEFAULT '0.00',
  `tghttp` text,
  `timeok` tinyint(3) DEFAULT '0',
  `tjnet` tinyint(3) DEFAULT '0',
  `logintime` int(11) DEFAULT NULL,
  `fhprice` double(12,2) DEFAULT '0.00',
  `isout` tinyint(3) DEFAULT '0',
  `bdtjnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `state` (`state`),
  KEY `rank` (`rank`),
  KEY `confirmtime` (`confirmtime`),
  KEY `prename` (`prename`),
  KEY `tjrname` (`tjrname`),
  KEY `pos` (`pos`),
  KEY `isdp` (`isdp`),
  KEY `rfd` (`rfd`),
  KEY `zfd` (`zfd`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8");
E_D("replace into `dg_users` values('8','luck300','sssd','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck100','luck100','2','luck100','3000.00','300','2100','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','3000.00','0.00','9000.00','0.00','9000.00','0.00','2','2','6','0','1','0','1432649451','1432649494','男','360000','360100','360102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'2','2','luck100','luck100','',NULL,'',NULL,NULL,'0.00','luck200','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck300','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('6','luck100','sss','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f','','0','','','','0',NULL,'1000.00','300','4500','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','17000.00','0.00','17000.00','0.00','1','1','6','1','1','1','1432649168','1432649168','男','370000','370100','370102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'admin','超管','0','2','0',NULL,'1','1','','',NULL,NULL,NULL,NULL,NULL,'0.00','','','','1','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00',NULL,'1','1','1432649207','0.00','0','0');");
E_D("replace into `dg_users` values('7','luck200','sssd','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck100','luck100','1','luck100','1000.00','300','2100','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','7000.00','0.00','7000.00','0.00','1','1','6','0','1','0','1432649313','1432649402','男','410000','410100','410102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'2','2','luck100','luck100','',NULL,'',NULL,NULL,'0.00','luck100','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck200','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('9','luck201','dsfsaf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck200','luck200','1','luck100','1000.00','300','900','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','3000.00','0.00','3000.00','0.00','1','1','6','0','1','0','1432649644','1432649866','男','410000','410100','410102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'3','3','luck200,luck100','luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck202','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck201','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('10','luck202','sfasf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck200','luck200','2','luck100','1000.00','300','900','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','3000.00','0.00','3000.00','0.00','1','1','6','0','1','0','1432649694','1432649864','男','430000','430100','430102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'3','3','luck200,luck100','luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck301','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck202','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('11','luck301','sfsf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck300','luck300','1','luck100','1000.00','300','900','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','3000.00','0.00','3000.00','0.00','1','1','6','0','1','0','1432649749','1432649862','男','430000','430100','430102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'3','3','luck300,luck100','luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck302','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck301','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('12','luck302','sfsafff','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck300','luck300','2','luck100','1000.00','300','900','600','2','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','3000.00','0.00','3000.00','0.00','1','1','6','0','1','0','1432649831','1432649860','男','410000','410100','410102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'3','3','luck300,luck100','luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck300','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck302','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('13','luck201a','sfsfsfsf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck201','luck201','1','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432649952','1432650382','男','110000','110100','110101','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck201,luck200,luck100','luck201,luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck201b','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck201a','0','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('14','luck201b','sdafasf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck201','luck201','2','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650004','1432650380','男','130000','130100','130102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck201,luck200,luck100','luck201,luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck202a','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck201b','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('15','luck202a','sfsafsaf','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck202','luck202','1','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650082','1432650378','男','110000','110100','110101','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck202,luck200,luck100','luck202,luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck202b','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck202a','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('16','luck202b','sfgrr','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck202','luck202','2','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650130','1432650377','男','430000','430100','430102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck202,luck200,luck100','luck202,luck200,luck100','',NULL,'',NULL,NULL,'0.00','luck301a','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck202b','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('17','luck301a','sfeee','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck301','luck301','1','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650184','1432650375','男','420000','420100','420102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck301,luck300,luck100','luck301,luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck301b','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck301a','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('18','luck301b','seeee','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck301','luck301','2','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650236','1432650373','男','410000','410100','410102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck301,luck300,luck100','luck301,luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck302a','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck301b','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('19','luck302a','sfebbg','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck302','luck302','1','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650291','1432650371','男','420000','420100','420102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck302,luck300,luck100','luck302,luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck302b','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck302a','1','1',NULL,'0.00','0','0');");
E_D("replace into `dg_users` values('20','luck302b','sfwvv','VQNVVgUE49ba59abbe','UlsMBg0IUVFWVVY=317cb9f32f',NULL,NULL,NULL,'luck302','luck302','2','luck100','1000.00','300','300','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1000.00','0.00','1000.00','0.00','1000.00','0.00','1','1','0','0','1','0','1432650329','1432650369','男','430000','430100','430102','','','','','','','','',NULL,'0',NULL,NULL,NULL,NULL,'luck100','sss','1','2','0',NULL,'4','4','luck302,luck300,luck100','luck302,luck300,luck100','',NULL,'',NULL,NULL,'0.00','luck201','','','0','0.00','0','0','0','0','0','0.00',NULL,'1','0','0','0.00','0','0','0.00','0.00','http://www.cmob2b.com/user/register.php?tj=luck302b','1','1',NULL,'0.00','0','0');");

require("../../inc/footer.php");
?>