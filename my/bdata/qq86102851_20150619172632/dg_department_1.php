<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `dg_department`;");
E_C("CREATE TABLE `dg_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) DEFAULT NULL,
  `power` text,
  `addtime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8");
E_D("replace into `dg_department` values('7','总管','后台会员注册,公司注册,未确认会员,会员列表,授权登录,会员查看,会员修改,查看货币明细,会员查询,前台会员升级记录,后台级别修改,级别修改,后台级别修改记录,会员申请店铺记录,一线网,公排网,安置网络图,推荐网络图,安置网体修改,推荐网体修改,安置体系树状图,推荐体系树状图,财务充值,充值,银行账号,添加修改帐号,汇款管理,提现管理,会员转账,财务明细,在线支付记录,日奖金管理,结算添加,奖金结算,执行奖金结算,奖金列表,平衡奖金,奖金发放,奖金修改,会员统计,会员数查询,日奖金查询,个人收入统计,总奖金拨出率,产品分类,分类添加,分类修改,分类删除,产品管理,产品产看,产品添加修改,入库列表,出库列表,订单列表,订单查看,订单发货,物流管理,物流修改添加,写邮件,收件箱,查看收件箱,发件箱,查看发件箱,公告管理,公告修改添加,短信余额,短信管理,短信模版,常用语设定,常用语添加修改,短信分组,分组添加修改,分组用户添加,分组用户列表,短信群发,短信发送记录,数据库备份,数据库恢复,数据库备份压缩,数据库备份管理,执行数据库备份,删除备份目录,管理员设置,管理员添加修改,部门列表,部门添加修改,日志管理,区域设置,添加修改省份,所辖市列表,添加修改市,所辖区域列表,添加修改县区,奖金参数设定,参数设定,会员使用权限,前台登录页面设定,修改密码,系统初始化','1325981288');");
E_D("replace into `dg_department` values('10','客服部','会员列表,授权登录,会员查看,会员修改,查看货币明细,会员查询,前台会员升级记录,后台级别修改,级别修改,后台级别修改记录,共享排网记录,共享排网修改,排网修改,排网修改记录,一线网,安置网络图,推荐网络图,产品分类,分类添加,分类修改,分类删除,产品管理,产品产看,产品添加修改,入库列表,出库列表,订单列表,订单查看,订单发货,物流管理,物流修改添加,写邮件,收件箱,查看收件箱,发件箱,查看发件箱,公告管理,公告修改添加,短信余额,短信管理,短信模版,常用语设定,常用语添加修改,短信分组,分组添加修改,分组用户添加,分组用户列表,短信群发,短信发送记录,修改密码','1358298595');");
E_D("replace into `dg_department` values('11','财务部','会员列表,会员查看,会员查询,财务充值,充值,银行账号,添加修改帐号,汇款管理,提现管理,会员转账,财务明细,奖金结算,奖金发放,日奖金查询,秒奖金查询,产品分类,分类添加,分类修改,分类删除,产品管理,产品产看,产品添加修改,入库列表,出库列表,订单列表,订单查看,订单发货,物流管理,物流修改添加,修改密码','1358299241');");
E_D("replace into `dg_department` values('12','物流部','会员列表,会员查询,产品分类,分类添加,分类修改,分类删除,产品管理,产品产看,产品添加修改,入库列表,出库列表,订单列表,订单查看,订单发货,物流管理,物流修改添加,写邮件,收件箱,查看收件箱,发件箱,查看发件箱,公告管理,公告修改添加,短信管理,短信模版,常用语设定,常用语添加修改,短信分组,分组添加修改,分组用户添加,分组用户列表,短信群发,短信发送记录,修改密码','1358299334');");
E_D("replace into `dg_department` values('13','客服部1','会员列表,会员查看,会员修改,安置网络图,推荐网络图,充值,财务明细,在线支付记录','1384755327');");

require("../../inc/footer.php");
?>