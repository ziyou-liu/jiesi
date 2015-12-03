<?php

session_start();
$enablegd = 1;
$funcs = array('imagecreatetruecolor','imagecolorallocate','imagefill','imagestring','imageline','imagerotate','imagedestroy','imagecolorallocatealpha','imageellipse','imagepng');
foreach($funcs as $func)
{
if(!function_exists($func))
{
$enablegd = 0;
break;
}
}
ob_clean();
if($enablegd)
{
$consts = '0123456789';
$vowels = '0123456789';
for ($x = 0;$x <6;$x++)
{
$const[$x] = substr($consts,mt_rand(0,strlen($consts)-1),1);
$vow[$x] = substr($vowels,mt_rand(0,strlen($vowels)-1),1);
}
$radomstring = $const[0] .$vow[0] .$const[2] .$const[1] .$vow[1] .$const[3] .$vow[3] .$const[4];
$_SESSION['code_2'] = $string = substr($radomstring,0,4);
$imageX = strlen($radomstring)*8;
$imageY = 20;
$im = imagecreatetruecolor($imageX,$imageY);
$background = imagecolorallocate($im,rand(180,250),rand(180,250),rand(180,250));
$foregroundArr = array(imagecolorallocate($im,rand(0,20),rand(0,20),rand(0,20)),
imagecolorallocate($im,rand(0,20),rand(0,10),rand(245,255)),
imagecolorallocate($im,rand(245,255),rand(0,20),rand(0,10)),
imagecolorallocate($im,rand(245,255),rand(0,20),rand(245,255))
);
$foreground2 = imagecolorallocatealpha($im,rand(20,100),rand(20,100),rand(20,100),80);
$middleground = imagecolorallocate($im,rand(200,160),rand(200,160),rand(200,160));
$middleground2 = imagecolorallocatealpha($im,rand(180,140),rand(180,140),rand(180,140),80);
imagefill($im,0,0,imagecolorallocate($im,250,253,254));
imagettftext($im,12,rand(30,-30),5,rand(14,16),$foregroundArr[rand(0,3)],'fonts/ALGER.TTF',$string[0]);
imagettftext($im,12,rand(50,-50),20,rand(14,16),$foregroundArr[rand(0,3)],'fonts/ARIALNI.TTF',$string[1]);
imagettftext($im,12,rand(50,-50),35,rand(14,16),$foregroundArr[rand(0,3)],'fonts/ALGER.TTF',$string[2]);
imagettftext($im,12,rand(30,-30),50,rand(14,16),$foregroundArr[rand(0,3)],'fonts/arial.ttf',$string[3]);
$border = imagecolorallocate($im,133,153,193);
imagerectangle($im,0,0,$imageX -1,$imageY -1,$border);
$pointcol = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
for ($i=0;$i<80;$i++)
{
imagesetpixel($im,rand(2,$imageX-2),rand(2,$imageX-2),$pointcol);
}
for ($x=0;$x<9;$x++)
{
if(mt_rand(0,$x)%2==0)
{
imageline($im,rand(0,120),rand(0,120),rand(0,120),rand(0,120),rand(0,999999));
imageellipse($im,rand(0,120),rand(0,120),rand(0,120),rand(0,120),$middleground2);
}
else
{
imageline($im,rand(0,120),rand(0,120),rand(0,120),rand(0,120),rand(0,999999));
imageellipse($im,rand(0,120),rand(0,120),rand(0,120),rand(0,120),$middleground);
}
}
header("content-type:image/png\r\n");
imagepng($im);
imagedestroy($im);
}
else
{
$files = glob('/images/checkcode/*.jpg');
if(!is_array($files)) die('请检查文件目录完整性:/images/checkcode/');
$checkcodefile = $files[rand(0,count($files)-1)];
$_SESSION['code_2'] = substr(basename($checkcodefile),0,4);
header("content-type:image/jpeg\r\n");
include $checkcodefile;
}
;echo ' ';
?>