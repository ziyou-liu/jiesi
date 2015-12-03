<?php

require('./config.php') ;
require('./util.php') ;
require('./io.php') ;
require('./commands.php') ;
require('./phpcompat.php') ;
function SendError( $number,$text )
{
SendUploadResults( $number,'','',$text ) ;
}
if ( !$Config['Enabled'] )
SendUploadResults( '1','','','This file uploader is disabled. Please check the "editor/filemanager/connectors/php/config.php" file') ;
$sCommand = 'QuickUpload';
$sType = isset( $_GET['Type'] ) ?$_GET['Type'] : 'File';
$sCurrentFolder	= "/";
if ( !IsAllowedCommand( $sCommand ) )
SendUploadResults( '1','','','The ""'.$sCommand .'"" command isn\'t allowed') ;
if ( !IsAllowedType( $sType ) )
SendUploadResults( 1,'','','Invalid type specified') ;
FileUpload( $sType,$sCurrentFolder,$sCommand )

?>