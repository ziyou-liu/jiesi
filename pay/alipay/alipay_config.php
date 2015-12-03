<?php

$partner         = $glo_zfb_username;
$security_code   = $glo_zfb_password;
$seller_email    = $glo_zfb_zhanghu;
$_input_charset  = "utf-8";
$sign_type       = "MD5";
$transport       = "http";
$notify_url      = $glo_cft_url."/pay/alipay/notify_url.php";
$return_url      = $glo_cft_url."/pay/alipay/return_url.php";
$show_url        = $glo_cft_url;

?>