<?php

function datediff($date1,$date2){
$date_1=strtotime($date1);
$date_2=strtotime($date2);
$dayt=24*3600;
$xc=($date_2-$date_1)/$dayt+1;
return $xc;
}

?>