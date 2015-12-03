<?php

$sql_sms="select * from {$db_prefix}smsyset where 1";
$rs_sms=$db->get_one($sql_sms);
$glo_post_1=$rs_sms["post_1"];
$glo_post_2=$rs_sms["post_2"];
$glo_post_3=$rs_sms["post_3"];
$glo_post_4=$rs_sms["post_4"];
$glo_post_5=$rs_sms["post_5"];
$glo_post_6=$rs_sms["post_6"];
$glo_post_1_close=$rs_sms["post_1_close"];
$glo_post_2_close=$rs_sms["post_2_close"];
$glo_post_3_close=$rs_sms["post_3_close"];
$glo_post_4_close=$rs_sms["post_4_close"];
$glo_post_5_close=$rs_sms["post_5_close"];
$glo_post_6_close=$rs_sms["post_6_close"];
$web_duanxin_paw=$rs_sms['sms_pwd'];
$web_duanxin_user=$rs_sms['sms_user'];
?>