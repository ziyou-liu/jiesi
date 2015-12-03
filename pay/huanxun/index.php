<?php
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
';
header("Content-type:text/html; charset=utf-8");
require_once("../../include/conn_2.php");require_once("../../include/pv.php");
$BillDate = date('Ymd');
$sql="select * from {$db_prefix}wangyin where id='$v_oid'";
$rs=$db->get_one($sql);
;echo '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>标准商户订单支付接口(新接口)</title>
<style type="text/css">
  <!--
  TD {FONT-SIZE: 9pt}
  SELECT {FONT-SIZE: 9pt}
  OPTION {COLOR: #5040aa; FONT-SIZE: 9pt}
  INPUT {FONT-SIZE: 9pt}
  -->
</style>
<script type="text/javascript">
function judge(){
	var frm=document.getElementById(\'frm1\');
	var but=document.getElementById(\'sub_hx\');
	but.value="正在提交......";
	but.disabled=true;
	frm.submit();
}
</script>
</head>
<body bgcolor="#FFFFFF">
    <form action="redirect.php" method="post" name="frm1" id="frm1">	
      <table width="450px" border="1" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" bordercolorlight="#333333" bgcolor="#F0F0FF" align="center">
        <tr bgcolor="#8070FF"> 
          <td colspan="2" align="center">
            <font color="#FFFF00"><b>标准商户订单支付接口(新接口)</b></font>
          </td>
        </tr>
		<tbody style="display:none">
        <tr>
		
          <td width="37%">提交地址</td>
          <td width="63%">
            <select name="test">
			  
              <option value="0">正式环境</option>
			  <option value="1">测试环境</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>商户号</td>
          <td>
            <input type="text" name="Mer_code" size="18" value="';echo $glo_hx_username;echo '"><!--测试商户号-->
          </td>
        </tr>
        <tr>
          <td>商户证书</td>
          <td>
            <input type="text" name="Mer_key" size="40" value="';echo $glo_hx_password;echo '"><!--测试商户号-->
          </td>
        </tr>
        <tr>
          <td>订单号</td>
          <td>
            <input type="text" name="Billno" size="24" value="';echo $v_oid;;echo '">
          </td>
        </tr>
		</tbody>
        <tr>
          <td>金&nbsp;&nbsp;额</td>
          <td>
            <input type="text" name="Amount" size="18" value="';echo floatval($rs['money']);echo '"><!--保留两位小数-->
          </td>
        </tr>
		<tbody style="display:none">
        <tr>
          <td>显示金额</td>
          <td>
            <input type="text" name="DispAmount" size="18" value="￥0.10">
          </td>
        </tr>
        <tr>
          <td>日&nbsp;&nbsp;期</td>
          <td>
            <input type="text" name="Date" size="18" value="';echo $BillDate;;echo '">
          </td>
        </tr>
        <tr>
          <td>支付币种</td>
          <td>
            <select name="Currency_Type">
              <option value="RMB" selected="selected">人民币</option>
              <option value="HKD">港币</option>
              <option value="MYR" >马币</option>
              <option value="USD" >USD</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>支付方式</td>
          <td>
            <select name="Gateway_Type">
              <option value="01" selected="selected">借记卡</option>
              <option value="02">信用卡</option>
              <option value="04">IPS账户支付</option>
              <option value="08">IB支付</option>
              <option value="16">电话支付</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>语言</td>
          <td>
            <select name="Lang">
              <option value="GB">GB中文</option>
              <option value="EN">英语</option>
              <option value="BIG5">BIG中文</option>
              <option value="JP">日文</option>
              <option value="FR">法文</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>支付成功返回URL</td>
          <td>
            <input type="text" name="Merchanturl" size="40" value="';echo $glo_cft_url."/pay/huanxun/OrderReturn1.php";echo '">
          </td>
        </tr>
        <tr>
          <td>支付失败返回URL</td>
          <td>
            <input type="text" name="FailUrl" size="40" value="">
          </td>
        </tr>
        <tr>
          <td>支付错误返回URL</td>
          <td>
            <input type="text" name="ErrorUrl" size="40" value="">
          </td>
        </tr>
        <tr>
          <td>商户附加数据包</td>
          <td>
            <input type="text" name="Attach" size="40" value="">
          </td>
        </tr>
        <tr>
          <td>订单支付加密方式</td>
          <td>
            <select name="OrderEncodeType">
              <option value="0">不加密</option>
              <option value="5" selected="selected">md5摘要</option>
              <option value="2">md5摘要_ALL</option>
              <option value="9">错误</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>交易返回加密方式</td>
          <td>
            <select name="RetEncodeType">
              <option value="10">老接口</option>
              <option value="16">md5withRsa</option>
              <option value="17" selected="selected">md5摘要</option>
              <option value="9">错误</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>是否提供Server返回方式</td>
          <td>
            <select name="Rettype">
              <option value="0">无Server to Server</option>
              <option value="1" selected="selected">有Server to Server</option>
              <option value="9">错误</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Server to Server返回页面</td>
          <td>
            <input type="text" name="ServerUrl" size="40" value="';echo $glo_cft_url."/pay/huanxun/OrderReturn1.php";echo '">
          </td>
        </tr>
		</tbody>
        <tr>
          <td colspan="2" align="center">
            <input  type="button" value="提交" id="sub_hx" onclick="judge();" />
          </td>
        </tr>
      </table>
    </form> 
  </body> 
</html>';
?>