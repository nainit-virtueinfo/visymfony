<?php 
eval("\$"."aButtonMenu = buttonMenu::".($sf_params->get('module').ucfirst($sf_params->get('action')).'TopMenu()').";"); 
foreach($aButtonMenu as $aButton):  ?>
 <div class="menu">
 <?php echo $aButton;?>
 </div>
 <?php endforeach;?>
