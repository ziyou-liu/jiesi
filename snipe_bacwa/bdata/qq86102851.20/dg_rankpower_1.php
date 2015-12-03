<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_rankpower`;");
E_C("CREATE TABLE `dg_rankpower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `power` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `dg_rankpower` values('1','资料查看,资料修改,密码修改,会员申请,未激活会员,已激活会员,会员升级,申请店铺,一条线,公排网,安置网络,推荐网络,推荐树状图,奖金提现,电子货币转出,电子货币转入,汇款通知,内部转账,日奖金查询,现金钱包,奖金钱包,重消购物账户,报单购物账户,在线支付记录,我要订货,我的购物车,订单查询,系统公告,写邮件,收邮件,发件箱');");

require("../../inc/footer.php");
?>