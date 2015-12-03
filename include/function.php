<?php

function mymd5($string,$action="EN")
{
global $webdb,$onlineip;
$secret_string = $webdb[mymd5].'5*j,.^&;?.%#@!';
if($string=="") return "";
if($action=="EN") $md5code=substr(md5($string),8,10);
else
{
$md5code=substr($string,-10);
$string=substr($string,0,strlen($string)-10);
}
$key = md5($md5code.$secret_string);
$string = ($action=="EN"?$string:base64_decode($string));
$len = strlen($key);
$code = "";
for($i=0;$i<strlen($string);$i++)
{
$k = $i%$len;
$code .= $string[$i]^$key[$k];
}
$code = ($action == "DE"?(substr(md5($code),8,10)==$md5code?$code:NULL) : base64_encode($code)."$md5code");
return $code;
}
function getip(){
if (getenv("HTTP_CLIENT_IP") &&strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
$ip = getenv("HTTP_CLIENT_IP");
else if (getenv("HTTP_X_FORWARDED_FOR") &&strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),"unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if (getenv("REMOTE_ADDR") &&strcasecmp(getenv("REMOTE_ADDR"),"unknown"))
$ip = getenv("REMOTE_ADDR");
else if (isset($_SERVER['REMOTE_ADDR']) &&$_SERVER['REMOTE_ADDR'] &&strcasecmp($_SERVER['REMOTE_ADDR'],"unknown"))
$ip = $_SERVER['REMOTE_ADDR'];
else
$ip = "unknown";
return($ip);
}
function getlogs($type){
$logstr="";
global $logtype_ary;
$logstr=$logtype_ary[$type];
return $logstr;
}
function getlenstr($len,$str){
for ($i=0;$i<$len;$i++){
$returnstr.=$str;
}
return $returnstr;
}
function getuserrank($rank){
global $rankary;
$rankstr="";
$rankstr=$rankary[$rank];
return $rankstr;
}
function getuserstate($state){
$state_1="";
switch($state){
case 0:$state_1="未确认";break;
case 1:$state_1="已确认";break;
}
return $state_1;
}
function getremitstate($state){
$state_1="";
switch($state){
case 0:$state_1="未审";break;
case 1:$state_1="有效";break;
case 2:$state_1="无效";break;
}
return $state_1;
}
function getcashstate($state){
$state_1="";
switch($state){
case 0:$state_1="未审";break;
case 1:$state_1="同意";break;
case 2:$state_1="拒绝";break;
}
return $state_1;
}
function gettransferstate($state){
$state_1="";
switch($state){
case 0:$state_1="失败";break;
case 1:$state_1="成功";break;
}
return $state_1;
}
function getorderstate($state){
$state_1="";
switch($state){
case 0:$state_1="未付款";break;
case 1:$state_1="已付款";break;
case 2:$state_1="已发货";break;
case 3:$state_1="已收货";break;
}
return $state_1;
}
function getapplystate($state){
$state_1="";
switch($state){
case 0:$state_1="未审核";break;
case 1:$state_1="同意";break;
case 2:$state_1="拒绝";break;
}
return $state_1;
}
function getperiodstate($state){
$state_1="";
switch($state){
case 0:$state_1="未结算";break;
case 1:$state_1="已结算";break;
case 2:$state_1="已发放";break;
}
return $state_1;
}
function timestr2unix($time){
$time=trim($time);
if($time!=""){
$ary1=split(" ",$time);
$ary2=split("-",$ary1[0]);
if (trim($ary1[1])!="")	$ary3=split(":",$ary1[1]);else $ary3=array(0,0,0);
return mktime($ary3[0],$ary3[1],$ary3[2],$ary2[1],$ary2[2],$ary2[0]);
}else{
return 0;
}
}
function m_str($string,$sublen,$start = 0,$code = 'UTF-8'){
if($code == 'UTF-8'){
$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
preg_match_all($pa,$string,$t_string);
if(count($t_string[0]) -$start >$sublen) return join('',array_slice($t_string[0],$start,$sublen))."...";
return join('',array_slice($t_string[0],$start,$sublen));
}else {
$start = $start*2;
$sublen = $sublen*2;
$strlen = strlen($string);
$tmpstr = '';
for($i=0;$i<$strlen;$i++){
if($i>=$start &&$i<($start+$sublen)) {
if(ord(substr($string,$i,1))>129){
$tmpstr.= substr($string,$i,2);
}else {
$tmpstr.= substr($string,$i,1);
}
}
if(ord(substr($string,$i,1))>129) $i++;
}
if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
return $tmpstr;
}
}
function smsGet($url)
{
if(function_exists('file_get_contents'))
{
$file_contents = file_get_contents($url);
}
else
{
$ch = curl_init();
$timeout = 5;
curl_setopt ($ch,CURLOPT_URL,$url);
curl_setopt ($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$file_contents = curl_exec($ch);
curl_close($ch);
}
return $file_contents;
}

?>