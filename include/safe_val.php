<?php

function var_filter($var)
{
if( preg_match('/select|insert|update|delete|join|union|into|load_file|outfile/',$var,$matches) )
{
$content1 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$content1 .= '<div style="padding:10px;margin:10px;border:1px solid #999999;text-align:center;color:#999999"><p>您提交的请求中存在不安全的值:&nbsp;<font color="red" size="15">'.$matches[0].'</font> &nbsp;请修改后重新提交!</p>';
$content1 .= '<p><a href="javascript:window.history.back();" style="color:#000000">点此返回上一页</a></p>';
$content1 .= '</div></head></html>';
echo $content1;
exit;
}
if ( !get_magic_quotes_gpc() )
{
$var = addslashes($var);
}
return $var;
}
function var_array_filter($val)
{
if( is_array($val) &&count($val) >0 )
{
foreach($val as $k=>$v)
{
if( is_array($v) &&count($v) >0 )
{
$val[$k] = var_array_filter($v);
}
else if( is_string($v) )
{
$val[$k] = var_filter($v);
}
}
}
else if( is_string($val) )
{
return var_filter($val);
}
return $val;
}
$_GET		= var_array_filter($_GET);
$_POST		= var_array_filter($_POST);
$_COOKIE	= var_array_filter($_COOKIE);
if( !isset($_SESSION) ) session_start();
$_SESSION	= var_array_filter($_SESSION);

?>