<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_logs`;");
E_C("CREATE TABLE `dg_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) DEFAULT NULL,
  `admin` varchar(50) DEFAULT NULL,
  `type` tinyint(3) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `memo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8");
E_D("replace into `dg_logs` values('1','11','admin','0','1432603665','112.233.156.229',NULL);");
E_D("replace into `dg_logs` values('2','11','admin','15','1432604679','112.233.156.229','会员luck100');");
E_D("replace into `dg_logs` values('3','11','admin','8','1432604732','112.233.156.229','管理员admin给会员luck100充现金钱包100000');");
E_D("replace into `dg_logs` values('4','11','admin','110','1432604745','112.233.156.229','管理员admin进入会员luck100前台');");
E_D("replace into `dg_logs` values('5','11','admin','5','1432604858','112.233.156.229','删除会员luck100,推荐人,接点人,注册人admin');");
E_D("replace into `dg_logs` values('6','11','admin','15','1432604950','112.233.156.229','会员luck100');");
E_D("replace into `dg_logs` values('7','11','admin','8','1432604973','112.233.156.229','管理员admin给会员luck100充现金钱包10000');");
E_D("replace into `dg_logs` values('8','11','admin','110','1432604980','112.233.156.229','管理员admin进入会员luck100前台');");
E_D("replace into `dg_logs` values('9','11','admin','0','1432615246','112.233.156.229',NULL);");
E_D("replace into `dg_logs` values('10','11','admin','5','1432615263','112.233.156.229','删除会员luck100,推荐人,接点人,注册人admin');");
E_D("replace into `dg_logs` values('11','11','admin','6','1432619660','112.233.156.229','管理员admin结算第期日奖金');");
E_D("replace into `dg_logs` values('12','11','admin','0','1432641046','112.233.156.229',NULL);");
E_D("replace into `dg_logs` values('13','11','admin','0','1432645685','112.233.156.229',NULL);");
E_D("replace into `dg_logs` values('14','11','admin','15','1432646024','112.233.156.229','会员luck100');");
E_D("replace into `dg_logs` values('15','3','luck100','9','1432646047','112.233.156.229','');");
E_D("replace into `dg_logs` values('16','11','admin','8','1432646181','112.233.156.229','管理员admin给会员luck100充现金钱包1000');");
E_D("replace into `dg_logs` values('17','11','admin','8','1432646304','112.233.156.229','管理员admin给会员luck100充现金钱包3000');");
E_D("replace into `dg_logs` values('18','11','admin','5','1432647932','112.233.156.229','删除会员luck102,推荐人luck100,接点人luck100,注册人luck100');");
E_D("replace into `dg_logs` values('19','11','admin','5','1432647934','112.233.156.229','删除会员luck101,推荐人luck100,接点人luck100,注册人luck100');");
E_D("replace into `dg_logs` values('20','11','admin','5','1432647935','112.233.156.229','删除会员luck100,推荐人,接点人,注册人admin');");
E_D("replace into `dg_logs` values('21','11','admin','0','1432648626','112.233.156.229',NULL);");
E_D("replace into `dg_logs` values('22','11','admin','15','1432649175','112.233.156.229','会员luck100');");
E_D("replace into `dg_logs` values('23','6','luck100','9','1432649207','112.233.156.229','');");
E_D("replace into `dg_logs` values('24','11','admin','8','1432649397','112.233.156.229','管理员admin给会员luck100充现金钱包1000');");
E_D("replace into `dg_logs` values('25','11','admin','8','1432649485','112.233.156.229','管理员admin给会员luck100充现金钱包3000');");
E_D("replace into `dg_logs` values('26','11','admin','8','1432649856','112.233.156.229','管理员admin给会员luck100充现金钱包4000');");
E_D("replace into `dg_logs` values('27','11','admin','8','1432650365','112.233.156.229','管理员admin给会员luck100充现金钱包8000');");
E_D("replace into `dg_logs` values('28','11','admin','110','1434604310','119.176.228.216','管理员admin进入会员luck302b前台');");

require("../../inc/footer.php");
?>