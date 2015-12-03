<?php
echo '环迅充值
在线充值的时候请不要关闭页面！充值成功后页面自动跳转.. 
';
include("../../include/conn_1.php");
include("../../include/pv.php");
include("../../include/function.php");
$form_url = 'https://pay.ips.com.cn/ipayment.aspx';
$sqlj="select * from {$db_prefix}wangyin where id='".$Billno."'";
$rsj=$db->get_one($sqlj);
$Mer_code = $glo_hx_username;
$Mer_key = $glo_hx_password;
$Billno = $Billno;
$Amount =$rsj['money'];
$Date = date("Ymd");
$Currency_Type = "RMB";
$Gateway_Type = "01";
$Lang = "GB";
$Merchanturl = $glo_cft_url."/pay/huanxun/OrderReturn1.php";
$FailUrl = $_POST['FailUrl'];
$ErrorUrl = $_POST['ErrorUrl'];
$Attach = $_POST['Attach'];
$DispAmount = $_POST['DispAmount'];
$OrderEncodeType = $_POST['OrderEncodeType'];
$RetEncodeType = $_POST['RetEncodeType'];
$Rettype = $_POST['Rettype'];
$ServerUrl = $_POST['ServerUrl'];
$SignMD5 = md5( 'billno'.$Billno .'currencytype'.$Currency_Type .'amount'.$Amount .'date'.$Date .'orderencodetype'.$OrderEncodeType .$Mer_key);
$hint="";
;echo '<html>
<head>
    <title>跳转......</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body>
  
    <form target="_self" action="';echo $form_url ;echo '" method="post" id="frm1">
      <input type="hidden" name="Mer_code" value="';echo $Mer_code ;echo '">
      <input type="hidden" name="Billno" value="';echo $Billno ;echo '">
      <input type="hidden" name="Amount" value="';echo $Amount ;echo '" >
      <input type="hidden" name="Date" value="';echo $Date ;echo '">
      <input type="hidden" name="Currency_Type" value="';echo $Currency_Type ;echo '">
      <input type="hidden" name="Gateway_Type" value="';echo $Gateway_Type ;echo '">
      <input type="hidden" name="Lang" value="';echo $Lang ;echo '">
      <input type="hidden" name="Merchanturl" value="';echo $Merchanturl ;echo '">
      <input type="hidden" name="FailUrl" value="';echo $FailUrl ;echo '">
      <input type="hidden" name="ErrorUrl" value="';echo $ErrorUrl ;echo '">
      <input type="hidden" name="Attach" value="';echo $Attach ;echo '">
      <input type="hidden" name="DispAmount" value="';echo $DispAmount ;echo '">
      <input type="hidden" name="OrderEncodeType" value="';echo $OrderEncodeType ;echo '">
      <input type="hidden" name="RetEncodeType" value="';echo $RetEncodeType ;echo '">
      <input type="hidden" name="Rettype" value="';echo $Rettype ;echo '">
      <input type="hidden" name="ServerUrl" value="';echo $ServerUrl ;echo '">
      <input type="hidden" name="SignMD5" value="';echo $SignMD5 ;echo '">
    </form>
    <script language="javascript">
      document.getElementById("frm1").submit();
    </script>
  </body>
</html>
'
?>