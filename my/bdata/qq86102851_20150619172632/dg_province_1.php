<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_province`;");
E_C("CREATE TABLE `dg_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinceID` varchar(6) DEFAULT NULL,
  `province` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `provinceID` (`provinceID`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8");
E_D("replace into `dg_province` values('1','110000','北京');");
E_D("replace into `dg_province` values('2','120000','天津市');");
E_D("replace into `dg_province` values('3','130000','河北省');");
E_D("replace into `dg_province` values('4','140000','山西省');");
E_D("replace into `dg_province` values('5','150000','内蒙古自治区');");
E_D("replace into `dg_province` values('6','210000','辽宁省');");
E_D("replace into `dg_province` values('7','220000','吉林省');");
E_D("replace into `dg_province` values('8','230000','黑龙江省');");
E_D("replace into `dg_province` values('9','310000','上海市');");
E_D("replace into `dg_province` values('10','320000','江苏省');");
E_D("replace into `dg_province` values('11','330000','浙江省');");
E_D("replace into `dg_province` values('12','340000','安徽省');");
E_D("replace into `dg_province` values('13','350000','福建省');");
E_D("replace into `dg_province` values('14','360000','江西省');");
E_D("replace into `dg_province` values('15','370000','山东省');");
E_D("replace into `dg_province` values('16','410000','河南省');");
E_D("replace into `dg_province` values('17','420000','湖北省');");
E_D("replace into `dg_province` values('18','430000','湖南省');");
E_D("replace into `dg_province` values('19','440000','广东省');");
E_D("replace into `dg_province` values('20','450000','广西自治区');");
E_D("replace into `dg_province` values('21','460000','海南省');");
E_D("replace into `dg_province` values('22','500000','重庆市');");
E_D("replace into `dg_province` values('23','510000','四川省');");
E_D("replace into `dg_province` values('24','520000','贵州省');");
E_D("replace into `dg_province` values('25','530000','云南省');");
E_D("replace into `dg_province` values('26','540000','西藏自治区');");
E_D("replace into `dg_province` values('27','610000','陕西省');");
E_D("replace into `dg_province` values('28','620000','甘肃省');");
E_D("replace into `dg_province` values('29','630000','青海省');");
E_D("replace into `dg_province` values('30','640000','宁夏自治区');");
E_D("replace into `dg_province` values('31','650000','新疆自治区');");
E_D("replace into `dg_province` values('32','710000','台湾省');");
E_D("replace into `dg_province` values('33','810000','香港特别行政区');");
E_D("replace into `dg_province` values('34','820000','澳门特别行政区');");
E_D("replace into `dg_province` values('36','830000','国外和其他');");

require("../../inc/footer.php");
?>