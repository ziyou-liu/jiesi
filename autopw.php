<?php

$glotjnum=$glo_tjnum-1;
$prename='';$pos=0;
if($glo_tjnum>0){
$tjrname=trim($tjrname);
}else{
$tjrname=trim($username);
}
if($tjrname){
$sqlc="select count(id) as a from {$db_prefix}users where tjrname='".$tjrname."' and state=1";
$rsc=$db->get_one($sqlc);
if($rsc['a']>=$glotjnum){
$sqlu="select username,realname from {$db_prefix}users where username='".$tjrname."'";
$rsu=$db->get_one($sqlu);
$sqln="select id from {$db_prefix}bwnet where username='".$tjrname."'";
$rsn=$db->get_one($sqln);
if(!isset($rsn['id'])){
$sqlnum="select * from {$db_prefix}bwnet where state=1 and nums<'".$glo_gui."' order by id asc limit 1";
$rsnum=$db->get_one($sqlnum);
if($rsnum['username']){
$pos=$rsnum['nums']+1;$dept=$rsnum['dept']+1;
$sqlin="insert into {$db_prefix}bwnet (username,realname,prename,preid,pos,posnum,dept,addtime,state) values ('".$rsu['username']."','".$rsu['realname']."','".$rsnum['username']."','".$rsnum['id']."','".$pos."','$glo_gui','".$dept."','".time()."',1)";
$db->query($sqlin);
$db->query("update {$db_prefix}bwnet set nums='".$pos."' where id='".$rsnum['id']."'");
}else{
$sqlin="insert into {$db_prefix}bwnet (username,realname,posnum,dept,addtime,state) values ('".$rsu['username']."','".$rsu['realname']."','$glo_gui','1','".time()."',1)";
$db->query($sqlin);
}
}
}
}

?>