<?php

function GetRandID($prefix) {
$seedstr =split(" ",microtime(),5);
$seed =$seedstr[0]*10000;
srand($seed);
$random =rand(1,10000);
$filename = date("dHis",time()).$random.'.'.$prefix;
return $filename;
}
function GetFolders( $resourceType,$currentFolder )
{
$sServerDir = ServerMapFolder( $resourceType,$currentFolder,'GetFolders') ;
$aFolders	= array() ;
$oCurrentFolder = @opendir( $sServerDir ) ;
if ($oCurrentFolder !== false)
{
while ( $sFile = readdir( $oCurrentFolder ) )
{
if ( $sFile != '.'&&$sFile != '..'&&is_dir( $sServerDir .$sFile ) )
$aFolders[] = '<Folder name="'.ConvertToXmlAttribute( $sFile ) .'" />';
}
closedir( $oCurrentFolder ) ;
}
echo "<Folders>";
natcasesort( $aFolders ) ;
foreach ( $aFolders as $sFolder )
echo $sFolder ;
echo "</Folders>";
}
function GetFoldersAndFiles( $resourceType,$currentFolder )
{
$sServerDir = ServerMapFolder( $resourceType,$currentFolder,'GetFoldersAndFiles') ;
$aFolders	= array() ;
$aFiles		= array() ;
$oCurrentFolder = @opendir( $sServerDir ) ;
if ($oCurrentFolder !== false)
{
while ( $sFile = readdir( $oCurrentFolder ) )
{
if ( $sFile != '.'&&$sFile != '..')
{
if ( is_dir( $sServerDir .$sFile ) )
$aFolders[] = '<Folder name="'.ConvertToXmlAttribute( $sFile ) .'" />';
else
{
$iFileSize = @filesize( $sServerDir .$sFile ) ;
if ( !$iFileSize ) {
$iFileSize = 0 ;
}
if ( $iFileSize >0 )
{
$iFileSize = round( $iFileSize / 1024 ) ;
if ( $iFileSize <1 )
$iFileSize = 1 ;
}
$aFiles[] = '<File name="'.ConvertToXmlAttribute( $sFile ) .'" size="'.$iFileSize .'" />';
}
}
}
closedir( $oCurrentFolder ) ;
}
natcasesort( $aFolders ) ;
echo '<Folders>';
foreach ( $aFolders as $sFolder )
echo $sFolder ;
echo '</Folders>';
natcasesort( $aFiles ) ;
echo '<Files>';
foreach ( $aFiles as $sFiles )
echo $sFiles ;
echo '</Files>';
}
function CreateFolder( $resourceType,$currentFolder )
{
if (!isset($_GET)) {
global $_GET;
}
$sErrorNumber	= '0';
$sErrorMsg		= '';
if ( isset( $_GET['NewFolderName'] ) )
{
$sNewFolderName = $_GET['NewFolderName'] ;
$sNewFolderName = SanitizeFolderName( $sNewFolderName ) ;
if ( strpos( $sNewFolderName,'..') !== FALSE )
$sErrorNumber = '102';
else
{
$sServerDir = ServerMapFolder( $resourceType,$currentFolder,'CreateFolder') ;
if ( is_writable( $sServerDir ) )
{
$sServerDir .= $sNewFolderName ;
$sErrorMsg = CreateServerFolder( $sServerDir ) ;
switch ( $sErrorMsg )
{
case '':
$sErrorNumber = '0';
break ;
case 'Invalid argument':
case 'No such file or directory':
$sErrorNumber = '102';
break ;
default :
$sErrorNumber = '110';
break ;
}
}
else
$sErrorNumber = '103';
}
}
else
$sErrorNumber = '102';
echo '<Error number="'.$sErrorNumber .'" />';
}
function FileUpload( $resourceType,$currentFolder,$sCommand )
{
if (!isset($_FILES)) {
global $_FILES;
}
$sErrorNumber = '0';
$sFileName = '';
if ( isset( $_FILES['NewFile'] ) &&!is_null( $_FILES['NewFile']['tmp_name'] ) )
{
global $Config ;
$oFile = $_FILES['NewFile'] ;
$sServerDir = ServerMapFolder( $resourceType,$currentFolder,$sCommand ) ;
$sFileName = $oFile['name'] ;
$sFileName = SanitizeFileName( $sFileName ) ;
$sOriginalFileName = $sFileName ;
$sExtension = substr( $sFileName,( strrpos($sFileName,'.') +1 ) ) ;
$sExtension = strtolower( $sExtension ) ;
$sOriginalFileName = $sFileName = GetRandID($sExtension);
if ( isset( $Config['SecureImageUploads'] ) )
{
if ( ( $isImageValid = IsImageValid( $oFile['tmp_name'],$sExtension ) ) === false )
{
$sErrorNumber = '202';
}
}
if ( isset( $Config['HtmlExtensions'] ) )
{
if ( !IsHtmlExtension( $sExtension,$Config['HtmlExtensions'] ) &&
( $detectHtml = DetectHtml( $oFile['tmp_name'] ) ) === true )
{
$sErrorNumber = '202';
}
}
if ( !$sErrorNumber &&IsAllowedExt( $sExtension,$resourceType ) )
{
$iCounter = 0 ;
while ( true )
{
$sFilePath = $sServerDir .$sFileName ;
if ( is_file( $sFilePath ) )
{
$iCounter++;
$sFileName = RemoveExtension( $sOriginalFileName ) .'('.$iCounter .').'.$sExtension ;
$sErrorNumber = '201';
}
else
{
move_uploaded_file( $oFile['tmp_name'],$sFilePath ) ;
if ( is_file( $sFilePath ) )
{
if ( isset( $Config['ChmodOnUpload'] ) &&!$Config['ChmodOnUpload'] )
{
break ;
}
$permissions = 0777;
if ( isset( $Config['ChmodOnUpload'] ) &&$Config['ChmodOnUpload'] )
{
$permissions = $Config['ChmodOnUpload'] ;
}
$oldumask = umask(0) ;
chmod( $sFilePath,$permissions ) ;
umask( $oldumask ) ;
}
break ;
}
}
if ( file_exists( $sFilePath ) )
{
if ( isset( $isImageValid ) &&$isImageValid === -1 &&IsImageValid( $sFilePath,$sExtension ) === false )
{
@unlink( $sFilePath ) ;
$sErrorNumber = '202';
}
else if ( isset( $detectHtml ) &&$detectHtml === -1 &&DetectHtml( $sFilePath ) === true )
{
@unlink( $sFilePath ) ;
$sErrorNumber = '202';
}
}
}
else
$sErrorNumber = '202';
}
else
$sErrorNumber = '202';
$sFileUrl = CombinePaths( GetResourceTypePath( $resourceType,$sCommand ) ,$currentFolder ) ;
$sFileUrl = CombinePaths( $sFileUrl,$sFileName ) ;
SendUploadResults( $sErrorNumber,$sFileUrl,$sFileName ) ;
exit ;
}

?>