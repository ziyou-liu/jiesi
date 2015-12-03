<?php

function splitpage($pagenum,$pagesize,$pageno){
$qnum=5;
$hnum=5;
$qpageno=(($pageno-$qnum)>0)?($pageno-$qnum):1;
$hpageno=(($pageno+$hnum)<=$pagenum)?($pageno+$hnum):$pagenum;
;echo '	<div id="pagelist">
		
	  <ul>
		<li>';if ($pageno>1) {;echo '<a href="';echo allparam();echo '1">';};echo '首页';if ($pageno>1) {;echo '</a>';};echo '</li>
		<li>';if ($pageno>1) {;echo '<a href="';echo allparam();echo '';echo $pageno-1;echo '">';};echo '上页';if ($pageno>1) {;echo '</a>';};echo '</li>
		';
for($i=$qpageno;$i<=$hpageno;$i++){
;echo '		<li ';if ($pageno==$i) {;echo 'class="current"';};echo '><a href="';echo allparam();echo '';echo $i;echo '">';echo $i;echo '</a></li>
		';
}
;echo '		<li>';if ($pageno<$pagenum) {;echo '<a href="';echo allparam();echo '';echo $pageno+1;echo '">';};echo '下页';if ($pageno<$pagenum) {;echo '</a>';};echo '</li>
		<li>';if ($pageno<$pagenum) {;echo '<a href="';echo allparam();echo '';echo $pagenum;echo '">';};echo '尾页';if ($pageno<$pagenum) {;echo '</a>';};echo '</li>
		<li class="pageinfo">';echo $pageno."/".$pagenum;echo '</li>
	  </ul>
	  <form action="" method="post">
	  ';
$posts=$_POST;
$gets=$_GET;
$result = array_merge($posts,$gets);
foreach($result as $key=>$value){
;echo '			<input type="hidden" name="';echo $key;echo '" value="';echo $value;echo '" />
			';
}
;echo '	  <input name="pageno" size="6" type="text"> <input name="go" type="submit" value="Go"> ';echo "每页:".$pagesize."条";;echo '</form>
	</div>
	
	';
}
function getparam($param){
$posts=$_POST;
$gets=$_GET;
$result = array_merge($posts,$gets);
$paramvalue="";
return $result[$param];
}
function allparam(){
$posts=$_POST;
$gets=$_GET;
$result = array_merge($posts,$gets);
$url="?";
foreach($result as $key=>$value){
if (strtolower($key)!="pageno"){
if ($url!="?") $url.="&";
$url.=$key."=".$value;
}
}
if ($url=="?") $url.="pageno=";
else $url.="&pageno=";
return $url;
}

?>