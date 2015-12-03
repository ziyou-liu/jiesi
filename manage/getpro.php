<?php

include("../include/conn.php")
if(isset($_POST['countryCode'])){
$tempstateid=$_POST['countryCode'];
$tempcityres=$db->gettownbystateid($tempstateid);
if(!empty($tempcityres)){
while(list($key,$val)=each($tempcityres)){
$tempcityname=stripslashes($val["town"]);
$tempcityid=stripslashes($val["townid"]);
$tempcityname=str_replace("'"," ",$tempcityname);
echo "obj.options[obj.options.length] = new Option('$tempcityname','$tempcityid');";
}
}
}

?>