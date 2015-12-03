<?php

function verifycode_1(){
$code_1="";
for($i=0;$i<4;$i++){
$code_1.=rand(0,9);
}
return $code_1;
}

?>