<?php

header("Pragma: no-cache");header("Cache-control: no-cache");
header("Content-Type: text/html; charset=utf-8");
$w=date("w",time());
$weekary=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
echo "当前时间：".date("Y年m月d日 H:i:s",time())."&nbsp;".$weekary[$w];
?>