配置说明:
将Fckeditor 里的保留文件拷贝到网站根目录文件夹里，即/Fckeditor/下
 
第一种方法
<textarea name="content" style="display:none;"></textarea><IFRAME id=memo_Frame  src="/fckeditor/editor/fckeditor.html?InstanceName=content&Toolbar=Default" frameBorder=0 width=100% scrolling=no height=150></IFRAME>


第二种方法：
<?php
include("fckeditor.php");
$sBasePath="/Fckeditor/";//编辑器所在目录
$oFCKeditor=new FCKeditor('fileinfo'); // 创建一个fckeditor对象
$oFCKeditor->BasePath=$BasePath;
$oFCKeditor->Value=$fileinfo; // 设置表单初始值
$oFCKeditor->Create(); // 调用类中方法，必须
?>


上传设置：
\editor\filemanager\browser\default\connectors\php\config.php

$Config['Enabled'] = true ;// 30行 是否允许上传

$Config['UserFilesPath'] = '/uploadfiles/' ; //33行 默认上传路径（网站根目录），可以更改但必须在相应的目录下建这个名称的目录。