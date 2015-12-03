<?php

$randcode="";
$randcode=getrandcode(5);
$mobile=trim($mobile);$content=str_replace('{$randcode}',$randcode,str_replace('{$password}',$pwd,str_replace('{$username}',trim($username),$sms_regtxt)));
smsPost($mobile,$content);
if ($outmsg==2){
$sql="update {$db_prefix}users set randcode='".$randcode."',smsbt=1,sms_kq=1 where username='".trim($username)."'";
$db->query($sql);
}else{
$sql="update {$db_prefix}users set randcode='".$randcode."',smsbt=0,sms_kq=1 where username='".trim($username)."'";
$db->query($sql);
}
echo "<script>location.href='users.php';</script>";exit();

?>