<?php

session_start();
if (empty($_SESSION["glo_adminid"]) ||empty($_SESSION["glo_adminname"])){
$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$content .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$content .= '<head>';
$content .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$content .= '</head>';
$content .= '<body>无权限访问!</body>';
$content .= '</html>';
echo $content;
exit();
}
global $Config ;
$Config['Enabled'] = true ;
$Config['UserFilesPath'] = '/uploadfiles/';
$Config['UserFilesAbsolutePath'] = $_SERVER['DOCUMENT_ROOT'].$Config['UserFilesPath'];
$Config['ForceSingleExtension'] = true ;
$Config['SecureImageUploads'] = true;
$Config['ConfigAllowedCommands'] = array('QuickUpload','FileUpload','GetFolders','GetFoldersAndFiles','CreateFolder') ;
$Config['ConfigAllowedTypes'] = array('File','Image','Flash','Media') ;
$Config['HtmlExtensions'] = array("html","htm","xml","xsd","txt","js") ;
$Config['ChmodOnUpload'] = 0777 ;
$Config['ChmodOnFolderCreate'] = 0777 ;
$Config['AllowedExtensions']['File']	= array('7z','aiff','asf','avi','bmp','csv','doc','fla','flv','gif','gz','gzip','jpeg','jpg','mid','mov','mp3','mp4','mpc','mpeg','mpg','ods','odt','pdf','png','ppt','pxd','qt','ram','rar','rm','rmi','rmvb','rtf','sdc','sitd','swf','sxc','sxw','tar','tgz','tif','tiff','txt','vsd','wav','wma','wmv','xls','xml','zip') ;
$Config['DeniedExtensions']['File']		= array() ;
$Config['FileTypesPath']['File']		= $Config['UserFilesPath'] .'file/';
$Config['FileTypesAbsolutePath']['File']= ($Config['UserFilesAbsolutePath'] == '') ?'': $Config['UserFilesAbsolutePath'].'file/';
$Config['QuickUploadPath']['File']		= $Config['UserFilesPath'] ;
$Config['QuickUploadAbsolutePath']['File']= $Config['UserFilesAbsolutePath'] ;
$Config['AllowedExtensions']['Image']	= array('bmp','gif','jpeg','jpg','png') ;
$Config['DeniedExtensions']['Image']	= array() ;
$Config['FileTypesPath']['Image']		= $Config['UserFilesPath'] .'image/';
$Config['FileTypesAbsolutePath']['Image']= ($Config['UserFilesAbsolutePath'] == '') ?'': $Config['UserFilesAbsolutePath'].'image/';
$Config['QuickUploadPath']['Image']		= $Config['UserFilesPath'] ;
$Config['QuickUploadAbsolutePath']['Image']= $Config['UserFilesAbsolutePath'] ;
$Config['AllowedExtensions']['Flash']	= array('swf','flv') ;
$Config['DeniedExtensions']['Flash']	= array() ;
$Config['FileTypesPath']['Flash']		= $Config['UserFilesPath'] .'flash/';
$Config['FileTypesAbsolutePath']['Flash']= ($Config['UserFilesAbsolutePath'] == '') ?'': $Config['UserFilesAbsolutePath'].'flash/';
$Config['QuickUploadPath']['Flash']		= $Config['UserFilesPath'] ;
$Config['QuickUploadAbsolutePath']['Flash']= $Config['UserFilesAbsolutePath'] ;
$Config['AllowedExtensions']['Media']	= array('aiff','asf','avi','bmp','fla','flv','gif','jpeg','jpg','mid','mov','mp3','mp4','mpc','mpeg','mpg','png','qt','ram','rm','rmi','rmvb','swf','tif','tiff','wav','wma','wmv') ;
$Config['DeniedExtensions']['Media']	= array() ;
$Config['FileTypesPath']['Media']		= $Config['UserFilesPath'] .'media/';
$Config['FileTypesAbsolutePath']['Media']= ($Config['UserFilesAbsolutePath'] == '') ?'': $Config['UserFilesAbsolutePath'].'media/';
$Config['QuickUploadPath']['Media']		= $Config['UserFilesPath'] ;
$Config['QuickUploadAbsolutePath']['Media']= $Config['UserFilesAbsolutePath'] ;

?>