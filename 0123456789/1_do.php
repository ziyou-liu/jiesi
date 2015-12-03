<?php

set_time_limit(100000);
include("../include/conn.php");
include("../include/rank.php");
include("../include/pv.php");
include("../include/periodscls.php");
include("../include/logcls.php");
include("../include/function.php");
include("1_s.php");
$periods=$_GET["periods"];
$sql="select * from {$db_prefix}periods where periods='".$periods."'";
$periods_rs=$db->get_one($sql);
$timelimit=$periods_rs["begintime"];
$timelimit1=$periods_rs["endtime"]+24*60*60;
$timelimit2=$periods_rs["endtime"];
$jsfloer=" and confirmtime<='".$timelimit1."'";
$jsfloer1=" and confirmtime>'".$timelimit."' and confirmtime<='".$timelimit1."'";
$jsfloer2=" and confirmtime<'".$timelimit."'";
$jsfloer3=" and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit2."))<=0";
$jsfloer4=" and datediff(concat(year,'-',month,'-',day),from_unixtime(".($timelimit1-24*60*60)."))=0";
$unixtime1=mktime(0,0,0,$month,1,$year);
$maxt=date('t',$unixtime1);
$unixtime2=mktime(0,0,0,$month,$maxt,$year)+24*3600;
$jsfloer5=" and datediff(concat(year,'-',month,'-',day),from_unixtime(".$unixtime1."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$unixtime2."))<=0";
$jsfloer6=" and datediff(concat(year,'-',month,'-',day),from_unixtime(".$unixtime2."))<=0";
$jsfloer7=" and confirmtime<='".$unixtime2."'";
$modtime=time();
$week=date('w',$timelimit);
$isno=0;
if($glo_isweekend==1 &&($week==0 ||$week==6)){
$isno=1;
}
$db->free_result($result);
$last_periods=$periods-1;
$userrankary=array();
$userrank1ary=array();
$usertjnumary=array();
$usertjrary=array();
$tjdeptary=array();
$sql="select username,rank,tjnum,rank1,tjrname,tjdept,confirmtime from {$db_prefix}users where state=1";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$userrankary[$rs['username']]=$rs['rank'];
$userrank1ary[$rs['username']]=$rs['rank1'];
$usertjnumary[$rs['username']]=$rs['tjnum'];
$usertjrary[$rs['username']]=$rs['tjrname'];
$tjdeptary[$rs['username']]=$rs['tjdept'];
$confirmtimeary[$rs['username']]=$rs['confirmtime'];
}
$db->free_result($result);
$sqlalls="select sum(bdmoney) as a from {$db_prefix}users where state=1 and isblank=0".$jsfloer1;
$rsalls=$db->get_one($sqlalls);
$sqlalls2="select sum(bdnum) as b from {$db_prefix}users where state=1 and isblank=0 and isout=0 ".$jsfloer;
$rsalls2=$db->get_one($sqlalls2);
$sql="select * from {$db_prefix}users where state=1 and isblank=0 ".$jsfloer;
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$all=$rsalls['a'];$flprice=0;
$cxprice=0;$merank=$rs['rank'];
if($glo_flxs==1){
if($isno==0){
if($merank>0){
$glogetname="glo_flfs1_".$merank;
$flprice=$$glogetname;
}
}
}else{
if($all>0){
$flrate=$glo_flfs2/100;
$flprice=$all*$flrate*$rs['bdnum']/$rsalls2['b'];
}
}
if($flprice>0){
$sqlall="select sum(flprice) as a from {$db_prefix}jsrec where username='".$rs["username"]."' and periods<='".$periods."'";
$rsall=$db->get_one($sqlall);
$allprice=$flprice+$rsall['a'];
$maxflprice=$rs['bdmoney'];
if($allprice>=$maxflprice){
$flprice=$maxflprice-$rsall['a'];
}
$cxprice=$flprice*$glo_intocx/100;
if($flprice>0){
$sqlj="update {$db_prefix}jsrec set flprice=flprice+".$flprice." where periods='".$periods."' and username='".$rs["username"]."'";
$db->query($sqlj);
}
if($cxprice>0){
$sqlj="update {$db_prefix}jsrec set cxprice=cxprice+".$cxprice." where periods='".$periods."' and username='".$rs["username"]."'";
$db->query($sqlj);
}
}
}
$db->free_result($result);
$dppriceary=array();
$sql="select username,rank from {$db_prefix}users where state=1 and rank>0 ";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$userrank=$rs['rank'];$leftnum=0;$rightnum=0;$dpprice=0;
$username=$rs['username'];
$sqltj="select count(id) as a from {$db_prefix}users where state=1 and (find_in_set('".$username."',glstr) or prename='".$username."') and tjrname='".$username."'";
$rstj=$db->get_one($sqltj);
$sqllast="select leftsy,rightsy from {$db_prefix}jsrec where username='".$username."' and periods='".$last_periods."'";
$rssy=$db->get_one($sqllast);
$leftnum=0;$rightnum=0;
$sqll="select username from {$db_prefix}users where prename='".$username."' and pos=1 and state=1";
$rsl=$db->get_one($sqll);
if($rsl['username']){
$sqllc="select count(id) as a from {$db_prefix}users where (find_in_set('".$rsl['username']."',glstr) or prename='".$rsl['username']."')".$jsfloer1;
$rslc=$db->get_one($sqllc);
if($confirmtimeary[$rsl['username']]>$timelimit &&$confirmtimeary[$rsl['username']]<=$timelimit1){
$leftnum=$rslc['a']+1;
}else{
$leftnum=$rslc['a'];
}
if($rssy['leftsy']!=0){
$leftnum=$leftnum+$rssy['leftsy'];
}
}
$sqlr="select username from {$db_prefix}users where prename='".$username."' and pos=2 and state=1";
$rsr=$db->get_one($sqlr);
if($rsr['username']){
$sqlrc="select count(id) as a from {$db_prefix}users where (find_in_set('".$rsr['username']."',glstr) or prename='".$rsr['username']."')".$jsfloer1;
$rsrc=$db->get_one($sqlrc);
if($confirmtimeary[$rsr['username']]>$timelimit &&$confirmtimeary[$rsr['username']]<=$timelimit1){
$rightnum=$rsrc['a']+1;
}else{
$rightnum=$rsrc['a'];
}
if($rssy['rightsy']!=0){
$rightnum=$rightnum+$rssy['rightsy'];
}
}
$leftnum1=0;$rightnum1=0;$num=0;$rightsy=0;$leftsy=0;
$leftnum1=intval($leftnum/$glo_dbbl1);
$rightnum1=intval($rightnum/$glo_dbbl2);
if($leftnum1<$rightnum1){
$num=$leftnum1;
}else if($leftnum1>=$rightnum1){
$num=$rightnum1;
}
$rightsy=$rightnum-$num*$glo_dbbl1;
$leftsy=$leftnum-$num*$glo_dbbl2;
$glodpname="glo_dprate_".$userrank;
$dprate=$$glodpname;
$dpprice=$num*$dprate;
$glodfname="glo_dpmax_".$userrank;
$sqlt="select dpprice from {$db_prefix}jsrec where periods='".$periods."' and username='".$username."'";
$rst=$db->get_one($sqlt);
$dbtotle=$rst['dpprice']+$dpprice;
if($dbtotle>$$glodfname){
$dpprice=$$glodfname-$rst['dpprice'];
}
$sqlj="update {$db_prefix}jsrec set dpprice=dpprice+".$dpprice.",leftnum='".$leftnum."',leftsy='".$leftsy."',rightnum='".$rightnum."',rightsy='".$rightsy."' where periods='".$periods."' and username='".$username."'";
$db->query($sqlj);
}
$db->free_result($result);
$hbpriceary=array();
$xgpriceary=array();
$sql="select * from {$db_prefix}users where 1 and state=1 and isblank=0".$jsfloer1;
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$urank=$rs['rank'];
if($rs["tjrname"]){
$trank=$userrankary[$rs["tjrname"]];
$gloratename="glo_tjrate_".$urank."_".$trank;
$gloratename=$$gloratename;
$tjprice=$gloratename;
if($tjprice>0){
$sqlj="update {$db_prefix}jsrec set tjprice=tjprice+".$tjprice." where periods='".$periods."' and username='".$rs["tjrname"]."'";
$db->query($sqlj);
}
if($usertjnumary[$rs['username']]>=$glo_hbtjnum){
$tjnetupstrdai='';
gettjnetupstrdai($rs['tjrname'],1,3);
$tjnetupry=explode(',',$tjnetupstrdai);
foreach ($tjnetupry as $k1=>$v1){
$tjdept1=$tjdeptary[$v1]+1;
$tjdept2=$tjdeptary[$v1]+3;
$realdai=$k1+1;
$sqlup="select dpprice from {$db_prefix}jsrec where username='".$v1."' and periods='".$periods."'";
$rsup=$db->get_one($sqlup);
if($rsup['dpprice']>0){
$hbtotle=0;
$sqlnum="select count(id) as a from {$db_prefix}users where gldept>='".$tjdept1."' and gldept<='".$tjdept2."' and find_in_set('".$v1."',tjstr)";
$rsnum=$db->get_one($sqlnum);
if($tjdeptary[$v1]>3){
$nums=$rsnum['a']+3;
}else{
$nums=$rsnum['a']+$tjdeptary[$v1]-1;
}
if($nums>0){
$glohbname="glo_hbrate_".$realdai;
$hbrate=$$glohbname/100;
$hbprice=$rsup['dpprice']*$hbrate/$nums;
$hbtotle=$hbpriceary[$rs['username']]+$hbprice;
$glofdname="glo_hbfd_".$urank;
if($hbtotle>$$glofdname){
$hbprice=$$glofdname-$hbpriceary[$rs['username']];
}
if($hbprice>0){
if($hbpriceary[$rs['username']]){
$hbpriceary[$rs['username']]+=$hbprice;
}else{
$hbpriceary[$rs['username']]=0;
$hbpriceary[$rs['username']]+=$hbprice;
}
}
}
}
}
}
$udept1=$tjdeptary[$rs['username']]+1;
$udept2=$tjdeptary[$rs['username']]+3;
$sqldp="select dpprice from {$db_prefix}jsrec where username='".$rs['username']."' and periods='".$periods."'";
$rsdp=$db->get_one($sqldp);
if($rsdp['dpprice']>0){
$tjnetupstrdai='';
gettjnetupstrdai($rs['tjrname'],1,3);
$tjnetupry=explode(',',$tjnetupstrdai);
foreach ($tjnetupry as $k1=>$v1){
$hbtotle=0;
$realdai=$k1+1;
if($usertjnumary[$v1]>=$glo_hbtjnum){
$sqlnum="select count(id) as a from {$db_prefix}users where gldept>='".$udept1."' and gldept<='".$udept2."' and find_in_set('".$rs['username']."',tjstr)";
$rsnum=$db->get_one($sqlnum);
if($tjdeptary[$rs['username']]>3){
$nums=$rsnum['a']+3;
}else{
$nums=$rsnum['a']+$tjdeptary[$rs['username']]-1;
}
if($nums>0){
$glohbname="glo_hbrate_".$realdai;
$hbrate=$$glohbname/100;
$hbprice=$rsdp['dpprice']*$hbrate/$nums;
$hbtotle=$hbpriceary[$v1]+$hbprice;
$glofdname="glo_hbfd_".$urank;
if($hbtotle>$$glofdname){
$hbprice=$$glofdname-$hbpriceary[$v1];
}
if($hbprice>0){
if($hbpriceary[$v1]){
$hbpriceary[$v1]+=$hbprice;
}else{
$hbpriceary[$v1]=0;
$hbpriceary[$v1]+=$hbprice;
}
}
}
}
}
}
}
if($rs['prename']){
$glnetupstrceng='';
getglnetupstrceng($rs['prename'],1,$glo_maxceng);
$glnetupary=explode(',',$glnetupstrceng);
foreach ($glnetupary as $key=>$value){
$glohdname="glo_jdrate_".$urank;
$hdprice=$$glohdname;$maxfd=0;
$sqlbd="select * from {$db_prefix}users where username='".$value."'";
$rsbd=$db->get_one($sqlbd);
$sqlup="select tjbdnum from {$db_prefix}users where username='".$value."' and state=1";
$rsup=$db->get_one($sqlup);
for($i=1;$i<=3;$i++){
$n=$i+1;
$gloxsname1="glo_xsfh_".$i;
$gloxsname2="glo_xsfh_".$n;
if($rsup['tjbdnum']>=$$gloxsname1 &&$rsup['tjbdnum']<=$$gloxsname2){
$gloname="glo_bei_".$i;
$maxfd=$$gloname*$rsbd['bdmoney'];
}
}
$sqlhd="select sum(hdprice) as a from {$db_prefix}jsrec where username='".$value."' and periods<='".$periods."'";
$rshd=$db->get_one($sqlhd);
$total=$rshd['a']+$hdprice;
if($maxfd>0 &&$total>$maxfd){
$hdprice=$maxfd-$rshd['a'];
}
if($hdprice>0){
$sqlj="update {$db_prefix}jsrec set hdprice=hdprice+".$hdprice." where periods='".$periods."' and username='".$value."'";
$db->query($sqlj);
}
}
}
if($rs['tjrname']){
$sqltj="select tjrname from {$db_prefix}users where username='".$rs['tjrname']."' and state=1";
$rstj=$db->get_one($sqltj);
if($rstj['tjrname']){
$tjnetupstrdai='';
gettjnetupstrdai($rstj['tjrname'],1,$glo_xsjdnum_6);
$tjnetupary=explode(',',$tjnetupstrdai);
foreach($tjnetupary as $key=>$val){
$rank1=$userrank1ary[$val];
$realdai=$key+1;
$glodainame="glo_xsjdnum_".$rank1;
if($realdai<=$$glodainame){
$glodlname="glo_xsjdmoney_".$rank1;
$xgprice=$$glodlname;
$totle=$xgpriceary[$val]+$xgprice;
$maxmoney="glo_xgfd_".$userrankary[$val];
if($totle>$$maxmoney){
$xgprice=$$maxmoney-$xgpriceary[$val];
}
if($xgprice>0){
if($xgpriceary[$val]){
$xgpriceary[$val]+=$xgprice;
}else{
$xgpriceary[$val]=0;
$xgpriceary[$val]+=$xgprice;
}
}
}
}
}
}
if($rs['zmdname']){
$sqltj="select id,rank,isdp from {$db_prefix}users where username='".$rs['zmdname']."' and state=1";
$rstj=$db->get_one($sqltj);
if($rstj['id'] &&$rstj['isdp']==1){
$dprank=$rstj['rank'];
$glodbname="glo_bdrate_".$dprank;
$bdprice=$rs['bdmoney']*$$glodbname/100;
if($bdprice>0){
$sqlj="update {$db_prefix}jsrec set bdprice=bdprice+".$bdprice." where periods='".$periods."' and username='".$rs['zmdname']."'";
$db->query($sqlj);
}
}
}
}
$db->free_result($result);
if(count($hbpriceary)>0) {
$sqlup="update dg_jsrec set hbprice =  case username ";
foreach($hbpriceary as $k=>$v) {
$sqlup.=" when '".$k."' then '".$v."' ";
}
$sqlup.=" end where periods='$periods'";
$db->query($sqlup);
}
unset($hbpriceary);
if(count($xgpriceary)>0) {
$sqlup="update dg_jsrec set xgprice =  case username ";
foreach($xgpriceary as $k=>$v) {
$sqlup.=" when '".$k."' then '".$v."' ";
}
$sqlup.=" end where periods='$periods'";
$db->query($sqlup);
}
unset($xgpriceary);
if($glo_gpfs==1){
$sql="select * from {$db_prefix}users where 1 and state=1 and isblank=0".$jsfloer1;
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if($rs['tjrname']){
$tjnetupstrdai='';
gettjnetupstrdai($rs['tjrname'],1,$glo_dainum);
$tjnetupary=explode(',',$tjnetupstrdai);
}
if($rs["timepre"]){
$timepreupstr='';
gettimepreupstr($rs["timepre"],1,$glo_maxdai);
$timepreupary=explode(',',$timepreupstr);
foreach($timepreupary as $k1=>$v1){
if(!in_array($v1,$tjnetupary)){
$bjdprice=$glo_recommend;
if($bjdprice>0){
$sqlj="update {$db_prefix}jsrec set bjdprice=bjdprice+".$bjdprice." where periods='".$periods."' and username='".$v1."'";
$db->query($sqlj);
}
}
}
}
if($tjnetupary){
foreach($tjnetupary as $k2=>$v2){
$sqlf="select username from {$db_prefix}users where tjrname='".$v2."' order by id asc limit 1";
$rsf=$db->get_one($sqlf);
if($rsf['username']!=$rs['username']){
$bjdprice=$glo_recommend;
if($bjdprice>0){
$sqlj="update {$db_prefix}jsrec set bjdprice=bjdprice+".$bjdprice." where periods='".$periods."' and username='".$v2."'";
$db->query($sqlj);
}
}
}
}
}
$db->free_result($result);
}else{
$sql="select * from {$db_prefix}bwnet where state=1 and addtime<'".$timelimit1."' and addtime>='".$timelimit."'";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if($rs["preid"]){
$gppreupstr='';
getgppreupstr($rs["preid"],1,$glo_maxbceng);
$gppreupary=explode(',',$gppreupstr);
foreach ($gppreupary as $key=>$val){
$bjdprice=$glo_recommend2;
if($bjdprice>0){
$sqlj="update {$db_prefix}jsrec set bjdprice=bjdprice+".$bjdprice." where periods='".$periods."' and username='".$val."'";
$db->query($sqlj);
}
}
}
}
$db->free_result($result);
}
$hcpriceary=array();
$sql="select username,dpprice from {$db_prefix}jsrec where dpprice>0 and periods='".$periods."'";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$money=$rs['dpprice'];
$sqlt="select prename,pos,tjrname from {$db_prefix}users where username='".$rs['username']."' and state=1";
$rst=$db->get_one($sqlt);
if($rst['tjrname']){
$tjnetupstrdai='';
gettjnetupstrdai($rst['tjrname'],1,5);
$tjnetupary=explode(',',$tjnetupstrdai);
foreach ($tjnetupary as $k1=>$v1) {
$realdai=$k1+1;
$sqlup="select rank from {$db_prefix}users where username='".$v1."'";
$rsup=$db->get_one($sqlup);
if($realdai<=$rsup['rank']) {
$glorname="glo_dlrate_".$rsup['rank']."_".$realdai;
$dlrate=$$glorname/100;
$dlprice=$money*$dlrate;
if($dlprice>0){
$sqlj="update {$db_prefix}jsrec set dlprice=dlprice+".$dlprice." where periods='".$periods."' and username='".$v1."'";
$db->query($sqlj);
}
}
}
}
if($rst['prename']){
$sqln="select username from {$db_prefix}users where prename='".$rst['prename']."' and pos!='".$rst['pos']."'";
$rsn=$db->get_one($sqln);
if($rsn['username']){
$lefttj=0;$righttj=0;
$rsl=$db->get_one("select username from {$db_prefix}users where prename='".$rsn['username']."' and pos='1'");
$rsr=$db->get_one("select username from {$db_prefix}users where prename='".$rsn['username']."' and pos='2'");
if($rsr['username'] &&$rsl['username']){
$sqlln="select count(id) as a from {$db_prefix}users where state=1 and find_in_set('".$rsl['username']."',glstr) and tjrname='".$rsn['username']."'";
$rsln=$db->get_one($sqlln);
$sqlrn="select count(id) as a from {$db_prefix}users where state=1 and find_in_set('".$rsr['username']."',glstr) and tjrname='".$rsn['username']."'";
$rsrn=$db->get_one($sqlrn);
if($usertjrary[$rsl['username']]==$rsn['username']){
$lefttj=$rsln['a']+1;
}else{
$lefttj=$rsln['a'];
}
if($usertjrary[$rsr['username']]==$rsn['username']){
$righttj=$rsrn['a']+1;
}else{
$righttj=$rsrn['a'];
}
if($lefttj>=$glo_hctjnum &&$righttj>=$glo_hctjnum){
$hcprice=$rs['dpprice']*$glo_hcrate/100;
$hctotle=$hcprice+$hcpriceary[$rsn['username']];
$glohcfd="glo_hcfd_".$userrankary[$rsn['username']];
if($hctotle>$$glohcfd){
$hcprice=$$glohcfd-$hcpriceary[$rsn['username']];
}
if($hcprice>0){
if(!$hcpriceary[$rsn['username']]){
$hcpriceary[$rsn['username']]=0;
$hcpriceary[$rsn['username']]+=$hcprice;
}
}
}
}
}
}
}
$db->free_result($result);
if(count($hcpriceary)>0) {
$sqlup="update dg_jsrec set hcprice =  case username ";
foreach($hcpriceary as $k=>$v) {
$sqlup.=" when '".$k."' then '".$v."' ";
}
$sqlup.=" end where periods='$periods'";
$db->query($sqlup);
}
unset($hcpriceary);
$sql="SELECT * FROM {$db_prefix}jsrec where periods='$periods' and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice)>0";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$sqls="select flprice,(dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice) as a from {$db_prefix}jsrec where username='".$rs['username']."' and periods='".$periods."'";
$rss=$db->get_one($sqls);
$cxrate=$glo_cfxfrate/100;
$rate=1-$glo_intocx/100;
$cxprice=($rss['a']+($rss['flprice']*$rate))*$cxrate;
if($cxprice>0){
$sqlj="update {$db_prefix}jsrec set cxprice=cxprice+".$cxprice." where periods='".$periods."' and username='".$rs["username"]."'";
$db->query($sqlj);
}
}
$db->free_result($result);
$sql="select cxprice,dpprice,username from {$db_prefix}jsrec where periods='".$periods."'";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
if($rs['cxprice']>0 ||$rs['dpprice']>0 ){
$sqlu="select area from {$db_prefix}users where username='".$rs['username']."'";
$rsu=$db->get_one($sqlu);
$sqlc="select count(id) as a from {$db_prefix}users where isdp=1 and rank>4 and bdtjnum>=".$glo_bdtjnum." and username!='".$rs['username']."' and area='".$rsu['area']."'";
$rsc=$db->get_one($sqlc);
$sqls="select username from {$db_prefix}users where isdp=1 and rank>4 and bdtjnum>=".$glo_bdtjnum." and username!='".$rs['username']."' and area='".$rsu['area']."'";
$results=$db->query($sqls);
while($rss=$db->fetch_array($results)){
$tgprice=0;$tcprice=0;
$bddprate=$glo_bddprate/100;
if($rs['dpprice']>0){
$tgprice=$rs['dpprice']*$bddprate/$rsc['a'];
}
$bdcxrate=$glo_bdcxrate/100;
if($rs['cxprice']>0){
$tcprice=$rs['cxprice']*$bdcxrate/$rsc['a'];
}
if($cxprice>0 ||$tcprice>0){
$sqlj="update {$db_prefix}jsrec set tgprice=tgprice+".$tgprice.",tcprice=tcprice+".$tcprice." where periods='".$periods."' and username='".$rss["username"]."'";
$db->query($sqlj);
}
}
$db->free_result($results);
}
if($rs['cxprice']>0){
$urank=$userrankary[$rs['username']];
$tjrname=$usertjrary[$rs['username']];
$trank=$userrankary[$tjrname];
$glofdname="glo_fdrate_".$trank."_".$urank;
$fdrate=$$glofdname;
$fdprice=$rs['cxprice']*$fdrate/100;
if($fdprice>0){
$sqlj="update {$db_prefix}jsrec set fdprice=fdprice+".$fdprice." where periods='".$periods."' and username='".$tjrname."'";
$db->query($sqlj);
}
}
}
$db->free_result($result);
$sql="SELECT * FROM {$db_prefix}jsrec where periods='".$periods."' and (flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice+fdprice+tcprice+tgprice-cxprice)>0";
$result=$db->query($sql);
while($rs=$db->fetch_array($result)){
$sqlu="select confirmtime from {$db_prefix}users where username='".$rs['username']."'";
$rsu=$db->get_one($sqlu);
$confirmtime=strtotime(date('Y-m-d',$rsu['confirmtime']));
$timecha=$timelimit1-$confirmtime;
$n=intval($timecha/3600*24*365);
$endtime=$confirmtime+($n*3600*24*365);
$sqlp="select periods from {$db_prefix}periods where endtime>='".$endtime."' order by id asc limit 1";
$rsp=$db->get_one($sqlp);
$sqls="select sum(flprice+dpprice+tjprice+hdprice+dlprice+hbprice+xgprice+bjdprice+bdprice-cxprice) as a from {$db_prefix}jsrec where username='".$rs['username']."' and periods='".$periods."'";
$rss=$db->get_one($sqls);
$wlwhf=0;
$totle=0;
if($rss['a']>0){
$sqla="select sum(wlwhf) as a from {$db_prefix}jsrec where username='".$rs["username"]."' and periods<='".$periods."'";
if($rsp['periods']){
$sqla.=" and periods>='".$rsp['periods']."'";
}
$rsa=$db->get_one($sqla);
$totle+=$rsa['a'];
if($totle<$glo_ever_year){
$wlwhf=$glo_ever_year-$totle;
if($wlwhf>$rss['a']){
$wlwhf=$rss['a'];
}
}
}
if($wlwhf>0){
$sqlj="update {$db_prefix}jsrec set wlwhf=wlwhf+".$wlwhf." where periods='".$periods."' and username='".$rs["username"]."'";
$db->query($sqlj);
}
}
$db->free_result($result);
$sql_upt="update {$db_prefix}periods set state1=0,state=1,jsname='".$_SESSION["glo_adminname"]."',jstime='$modtime' where periods='$periods'";
$db->query($sql_upt);
unset($userrankary);
unset($userrank1ary);
unset($usertjnumary);
unset($usertjrary);
unset($tjdeptary);
unset($confirmtimeary);
$log_adminid=$_SESSION["glo_adminid"];$log_admin=$_SESSION["glo_adminname"];$log_type=6;$log_addtime=time();$log_ip=getip();$log_memo="管理员{$log_admin}结算第{$periods}期日奖金";
setlogstype($log_adminid,$log_admin,$log_type,$log_addtime,$log_ip,$log_memo);
echo "<script>location.href='2.php?periods={$periods}';</script>";exit();
function getusertimeteam_num($username,$prename){
global $db,$db_prefix,$timelimit,$timelimit1,$glnetupstr2;
$sqlt="select rank1,uptime from {$db_prefix}users where username='$prename'";
$rst=$db->get_one($sqlt);
if($prename){
$sql="select sum(pv1) as c from {$db_prefix}tdpv where username='$username' and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit."))>=0 and datediff(concat(year,'-',month,'-',day),from_unixtime(".$timelimit1."))<=0";
$result=$db->get_one($sql);
}
return $result["c"];
}

?>