<?php

function setgoodscart($productid,$productname,$num,$price,$pv,$shopname,$type1){
$goodscartstr=getgoodscart();
$goodscartstr_1="";$goodscartexist=0;
$gstr=$productid.",".$productname.",".$num.",".$price.",".$pv.",".$shopname.",".$type1;
if (empty($goodscartstr)){
$goodscartstr_1=$gstr;
}else{
$goodscartary=explode("|",$goodscartstr);
foreach($goodscartary as $value_1){
$value_1_ary=explode(",",$value_1);
if ($value_1_ary[0]==$productid){
$goodscartexist=1;
$gstr2=$value_1_ary[0].",".$value_1_ary[1].",".($value_1_ary[2]+$num).",".$value_1_ary[3].",".$value_1_ary[4].",".$value_1_ary[5].",".$value_1_ary[6];
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr2;
}else{
$gstr1=$value_1_ary[0].",".$value_1_ary[1].",".$value_1_ary[2].",".$value_1_ary[3].",".$value_1_ary[4].",".$value_1_ary[5].",".$value_1_ary[6];
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr1;
}
}
if ($goodscartexist==0){
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr;
}
}
setcookie("glo_goodscart",$goodscartstr_1);
}
function getgoodscart(){
return $_COOKIE["glo_goodscart"];
}
function cleargoodscart(){
setcookie("glo_goodscart","");
}
function delgoodscart($productid){
$goodscartstr=getgoodscart();
$goodscartstr_1="";
if (empty($goodscartstr)){
}else{
$goodscartary=explode("|",$goodscartstr);
foreach($goodscartary as $value_1){
$value_1_ary=explode(",",$value_1);
if ($value_1_ary[0]==$productid){
}else{
$gstr=$value_1_ary[0].",".$value_1_ary[1].",".$value_1_ary[2].",".$value_1_ary[3].",".$value_1_ary[4].",".$value_1_ary[5].",".$value_1_ary[6];
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr;
}
}
}
setcookie("glo_goodscart",$goodscartstr_1);
}
function editgoodscart($productid,$productname,$num,$price,$pv,$type){
$goodscartstr=getgoodscart();
$goodscartstr_1="";
$gstr=$productid.",".$productname.",".$num.",".$price.",".$pv.",".$shopname.",".$type1;
if (empty($goodscartstr)){
$goodscartstr_1=$gstr;
}else{
$goodscartary=explode("|",$goodscartstr);
foreach($goodscartary as $value_1){
$value_1_ary=explode(",",$value_1);
if ($value_1_ary[0]==$productid){
$gstr2=$value_1_ary[0].",".$value_1_ary[1].",".$num.",".$value_1_ary[3].",".$value_1_ary[4].",".$value_1_ary[5].",".$value_1_ary[6];
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr2;
}else{
$gstr1=$value_1_ary[0].",".$value_1_ary[1].",".$value_1_ary[2].",".$value_1_ary[3].",".$value_1_ary[4].",".$value_1_ary[5].",".$value_1_ary[6];
if ($goodscartstr_1!="") $goodscartstr_1.="|";
$goodscartstr_1.=$gstr1;
}
}
}
setcookie("glo_goodscart",$goodscartstr_1);
}

?>