<?php

$secpwdneed=1;
if ($secpwdneed==1){
if (empty($_SESSION["glo_usersecpwd"])){
header("location:/include/en_secpwd1.php?fromurl=".$execfile."");exit();
}
}

?>