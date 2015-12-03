<?php

function CombinePaths( $sBasePath,$sFolder )
{
return RemoveFromEnd( $sBasePath,'/') .'/'.RemoveFromStart( $sFolder,'/') ;
}
function GetResourceTypePath( $resourceType,$sCommand )
{
global $Config ;
if ( $sCommand == "QuickUpload")
return $Config['QuickUploadPath'][$resourceType] ;
else
return $Config['FileTypesPath'][$resourceType] ;
}
function GetResourceTypeDirectory( $resourceType,$sCommand )
{
global $Config ;
if ( $sCommand == "QuickUpload")
{
if ( strlen( $Config['QuickUploadAbsolutePath'][$resourceType] ) >0 )
return $Config['QuickUploadAbsolutePath'][$resourceType] ;
return Server_MapPath( $Config['QuickUploadPath'][$resourceType] ) ;
}
else
{
if ( strlen( $Config['FileTypesAbsolutePath'][$resourceType] ) >0 )
return $Config['FileTypesAbsolutePath'][$resourceType] ;
return Server_MapPath( $Config['FileTypesPath'][$resourceType] ) ;
}
}
function GetUrlFromPath( $resourceType,$folderPath,$sCommand )
{
return CombinePaths( GetResourceTypePath( $resourceType,$sCommand ),$folderPath ) ;
}
function RemoveExtension( $fileName )
{
return substr( $fileName,0,strrpos( $fileName,'.') ) ;
}
function ServerMapFolder( $resourceType,$folderPath,$sCommand )
{
$sResourceTypePath = GetResourceTypeDirectory( $resourceType,$sCommand ) ;
$sErrorMsg = CreateServerFolder( $sResourceTypePath ) ;
if ( $sErrorMsg != '')
SendError( 1,"Error creating folder \"{$sResourceTypePath}\" ({$sErrorMsg})") ;
return CombinePaths( $sResourceTypePath ,$folderPath ) ;
}
function GetParentFolder( $folderPath )
{
$sPattern = "-[/\\\\][^/\\\\]+[/\\\\]?$-";
return preg_replace( $sPattern,'',$folderPath ) ;
}
function CreateServerFolder( $folderPath,$lastFolder = null )
{
global $Config ;
$sParent = GetParentFolder( $folderPath ) ;
while ( strpos($folderPath,'//') !== false )
{
$folderPath = str_replace( '//','/',$folderPath ) ;
}
if ( !empty($sParent) &&!file_exists( $sParent ) )
{
if ( !is_null( $lastFolder ) &&$lastFolder === $sParent) {
return "Can't create $folderPath directory";
}
$sErrorMsg = CreateServerFolder( $sParent,$folderPath ) ;
if ( $sErrorMsg != '')
return $sErrorMsg ;
}
if ( !file_exists( $folderPath ) )
{
error_reporting( 0 ) ;
$php_errormsg = '';
ini_set( 'track_errors','1') ;
if ( isset( $Config['ChmodOnFolderCreate'] ) &&!$Config['ChmodOnFolderCreate'] )
{
mkdir( $folderPath ) ;
}
else
{
$permissions = 0777 ;
if ( isset( $Config['ChmodOnFolderCreate'] ) )
{
$permissions = $Config['ChmodOnFolderCreate'] ;
}
$oldumask = umask(0) ;
mkdir( $folderPath,$permissions ) ;
umask( $oldumask ) ;
}
$sErrorMsg = $php_errormsg ;
ini_restore( 'track_errors') ;
ini_restore( 'error_reporting') ;
return $sErrorMsg ;
}
else
return '';
}
function GetRootPath()
{
if (!isset($_SERVER)) {
global $_SERVER;
}
$sRealPath = realpath( './') ;
$sRealPath = rtrim($sRealPath,"\\/");
$sSelfPath = $_SERVER['PHP_SELF'] ;
$sSelfPath = substr( $sSelfPath,0,strrpos( $sSelfPath,'/') ) ;
$sSelfPath = str_replace( '/',DIRECTORY_SEPARATOR,$sSelfPath ) ;
$position = strpos( $sRealPath,$sSelfPath ) ;
if ( $position === false ||$position <>strlen( $sRealPath ) -strlen( $sSelfPath ) )
SendError( 1,'Sorry, can\'t map "UserFilesPath" to a physical path. You must set the "UserFilesAbsolutePath" value in "editor/filemanager/connectors/php/config.php".') ;
return substr( $sRealPath,0,$position ) ;
}
function Server_MapPath( $path )
{
if ( function_exists( 'apache_lookup_uri') )
{
$info = apache_lookup_uri( $path ) ;
return $info->filename .$info->path_info ;
}
return GetRootPath() .$path ;
}
function IsAllowedExt( $sExtension,$resourceType )
{
global $Config ;
$arAllowed	= $Config['AllowedExtensions'][$resourceType] ;
$arDenied	= $Config['DeniedExtensions'][$resourceType] ;
if ( count($arAllowed) >0 &&!in_array( $sExtension,$arAllowed ) )
return false ;
if ( count($arDenied) >0 &&in_array( $sExtension,$arDenied ) )
return false ;
return true ;
}
function IsAllowedType( $resourceType )
{
global $Config ;
if ( !in_array( $resourceType,$Config['ConfigAllowedTypes'] ) )
return false ;
return true ;
}
function IsAllowedCommand( $sCommand )
{
global $Config ;
if ( !in_array( $sCommand,$Config['ConfigAllowedCommands'] ) )
return false ;
return true ;
}
function GetCurrentFolder()
{
if (!isset($_GET)) {
global $_GET;
}
$sCurrentFolder	= isset( $_GET['CurrentFolder'] ) ?$_GET['CurrentFolder'] : '/';
if ( !preg_match( '|/$|',$sCurrentFolder ) )
$sCurrentFolder .= '/';
if ( strpos( $sCurrentFolder,'/') !== 0 )
$sCurrentFolder = '/'.$sCurrentFolder ;
while ( strpos ($sCurrentFolder,'//') !== false ) {
$sCurrentFolder = str_replace ('//','/',$sCurrentFolder) ;
}
if ( strpos( $sCurrentFolder,'..') ||strpos( $sCurrentFolder,"\\"))
SendError( 102,'') ;
if ( preg_match(",(/\.)|[[:cntrl:]]|(//)|(\\\\)|([\:\*\?\"\<\>\|]),",$sCurrentFolder))
SendError( 102,'') ;
return $sCurrentFolder ;
}
function SanitizeFolderName( $sNewFolderName )
{
$sNewFolderName = stripslashes( $sNewFolderName ) ;
$sNewFolderName = preg_replace( '/\\.|\\\\|\\/|\\||\\:|\\?|\\*|"|<|>|[[:cntrl:]]/','_',$sNewFolderName ) ;
return $sNewFolderName ;
}
function SanitizeFileName( $sNewFileName )
{
global $Config ;
$sNewFileName = stripslashes( $sNewFileName ) ;
if ( $Config['ForceSingleExtension'] )
$sNewFileName = preg_replace( '/\\.(?![^.]*$)/','_',$sNewFileName ) ;
$sNewFileName = preg_replace( '/\\\\|\\/|\\||\\:|\\?|\\*|"|<|>|[[:cntrl:]]/','_',$sNewFileName ) ;
return $sNewFileName ;
}
function SendUploadResults( $errorNumber,$fileUrl = '',$fileName = '',$customMsg = '')
{
echo "<script type=\"text/javascript\">
(function(){var d=document.domain;while (true){try{var A=window.parent.document.domain;break;}catch(e) {};d=d.replace(/.*?(?:\.|$)/,'');if (d.length==0) break;try{document.domain=d;}catch (e){break;}}})();";
if ($errorNumber &&$errorNumber != 201) {
$fileUrl = "";
$fileName = "";
}
$rpl = array( '\\'=>'\\\\','"'=>'\\"') ;
echo 'window.parent.OnUploadCompleted('.$errorNumber .',"'.strtr( $fileUrl,$rpl ) .'","'.strtr( $fileName,$rpl ) .'", "'.strtr( $customMsg,$rpl ) .'") ;';
echo '</script>';
exit ;
}

?>