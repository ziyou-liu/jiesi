����˵��:
��Fckeditor ��ı����ļ���������վ��Ŀ¼�ļ������/Fckeditor/��
 
��һ�ַ���
<textarea name="content" style="display:none;"></textarea><IFRAME id=memo_Frame  src="/fckeditor/editor/fckeditor.html?InstanceName=content&Toolbar=Default" frameBorder=0 width=100% scrolling=no height=150></IFRAME>


�ڶ��ַ�����
<?php
include("fckeditor.php");
$sBasePath="/Fckeditor/";//�༭������Ŀ¼
$oFCKeditor=new FCKeditor('fileinfo'); // ����һ��fckeditor����
$oFCKeditor->BasePath=$BasePath;
$oFCKeditor->Value=$fileinfo; // ���ñ���ʼֵ
$oFCKeditor->Create(); // �������з���������
?>


�ϴ����ã�
\editor\filemanager\browser\default\connectors\php\config.php

$Config['Enabled'] = true ;// 30�� �Ƿ������ϴ�

$Config['UserFilesPath'] = '/uploadfiles/' ; //33�� Ĭ���ϴ�·������վ��Ŀ¼�������Ը��ĵ���������Ӧ��Ŀ¼�½�������Ƶ�Ŀ¼��