<?php

echo '<style type="text/css">';
echo '<!--';
echo '.UltraWebTab1DefT{height:28px;width:80px;cursor:Hand;}';
echo '.UltraWebTab1HovT{height:28px;width:80px;cursor:Hand;background-image:url(/skin/images/corp_main_top_menu1_buttonB.gif);}';
echo '.UltraWebTab1DisT{height:28px;width:80px;color:Gray;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;cursor:Default;}';
echo '.UltraWebTab1SelT{height:28px;width:80px;cursor:Default;background-image:url(/skin/images/corp_main_top_menu1_button.gif);}';
echo '.UltraWebTab1DefT0{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;}';
echo '.UltraWebTab1HovT0{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;background-image:url(/skin/images/corp_main_top_menu1_buttonB.gif);}';
echo '.UltraWebTab1SelT0{height:28px;width:80px;color:White;padding:2px 2px 0px 2px;cursor:Default;background-image:url(/skin/images/corp_main_top_menu1_button.gif);}';
echo '.UltraWebTab1DisT0{height:28px;width:80px;color:Gray;margin:0px 0px 0px 0px;padding:2px 2px 0px 2px;cursor:Default;}';
for($i=1;$i<=count($powerary);$i++){
echo '.UltraWebTab1DefT'.$i.'{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;}';
echo '.UltraWebTab1HovT'.$i.'{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;background-image:url(/skin/images/corp_main_top_menu1_buttonB.gif);}';
echo '.UltraWebTab1SelT'.$i.'{height:28px;width:80px;color:White;padding:2px 2px 0px 2px;cursor:Default;background-image:url(/skin/images/corp_main_top_menu1_button.gif);}';
echo '.UltraWebTab1DisT'.$i.'{height:28px;width:80px;color:Gray;margin:0px 0px 0px 0px;padding:2px 2px 0px 2px;cursor:Default;}';
}
echo '.UltraWebTab1DefT1{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;}';
echo '.UltraWebTab1HovT1{height:28px;width:80px;padding:2px 2px 0px 2px;cursor:Hand;background-image:url(/skin/images/corp_main_top_menu1_buttonB.gif);}';
echo '.UltraWebTab1SelT1{height:28px;width:80px;color:White;padding:2px 2px 0px 2px;cursor:Default;background-image:url(/skin/images/corp_main_top_menu1_button.gif);}';
echo '.UltraWebTab1DisT1{height:28px;width:80px;color:Gray;margin:0px 0px 0px 0px;padding:2px 2px 0px 2px;cursor:Default;}';
echo '-->';
echo '</style>';
?>