<?php

class db_mysql
{
var $connid;
var $querynum = 0;
function connect($dbhost,$dbuser,$dbpw,$dbname,$pconnect = 0)
{
global $CONFIG;
$func = $pconnect == 1 ?'mysql_pconnect': 'mysql_connect';
if(!$this->connid =mysql_connect($dbhost,$dbuser,$dbpw))
{
$this->halt('Can not connect to MySQL server');
}
if($this->version() >'4.1'&&$CONFIG['dbcharset'])
{
mysql_query("SET NAMES '".$CONFIG['dbcharset']."'",$this->connid);
}
if($this->version() >'5.0') 
{
mysql_query("SET sql_mode=''",$this->connid);
}
if($dbname) 
{
if(!@mysql_select_db($dbname ,$this->connid))
{
$this->halt('Cannot use database '.$dbname);
}
}
mysql_query("SET NAMES 'utf8'",$this->connid);
return $this->connid;
}
function select_db($dbname) 
{
return mysql_select_db($dbname ,$this->connid);
}
function query($sql ,$type = '',$expires = 36000,$dbname = '') 
{
$func = $type == 'UNBUFFERED'?'mysql_unbuffered_query': 'mysql_query';
if(!($query = $func($sql ,$this->connid)) &&$type != 'SILENT')
{
$this->halt('MySQL Query Error',$sql);
}
$this->querynum++;
return $query;
}
function get_one($sql,$type = '',$expires = 3600,$dbname = '')
{
$query = $this->query($sql,$type,$expires,$dbname);
$rs = $this->fetch_array($query);
$this->free_result($query);
return $rs ;
}
function fetch_array($query,$result_type = MYSQL_ASSOC) 
{
return mysql_fetch_array($query,$result_type);
}
function affected_rows() 
{
return mysql_affected_rows($this->connid);
}
function num_rows($query) 
{
return mysql_num_rows($query);
}
function data_seek($query,$row) 
{
return mysql_data_seek($query,$row);
}
function num_fields($query) 
{
return mysql_num_fields($query);
}
function result($query,$row) 
{
return @mysql_result($query,$row);
}
function free_result($query) 
{
return mysql_free_result($query);
}
function insert_id() 
{
return mysql_insert_id($this->connid);
}
function fetch_row($query) 
{
return mysql_fetch_row($query);
}
function version() 
{
return mysql_get_server_info($this->connid);
}
function freeresult($result){
mysql_free_result($result);
}
function close() 
{
return mysql_close($this->connid);
}
function error()
{
return @mysql_error($this->connid);
}
function errno()
{
return intval(@mysql_errno($this->connid)) ;
}
function halt($message = '',$sql = '')
{
exit("MySQL Query:$sql <br> MySQL Error:".$this->error()." <br> MySQL Errno:".$this->errno()." <br> Message:$message");
}
}
?>