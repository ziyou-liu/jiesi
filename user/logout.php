<?php

session_start();
$_SESSION["glo_userid"]='';$_SESSION["glo_username"]='';$_SESSION["glo_usersecpwd"]='';$_SESSION["glo_realname"]='';
header("location:../login.php");exit();

?>