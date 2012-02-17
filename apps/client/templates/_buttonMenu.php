<?php 
eval("\$"."aButtonMenu = buttonMenu::".($sf_params->get('module').ucfirst($sf_params->get('action')).'Menu()').";"); 

foreach($aButtonMenu as $aButton):  ?>
 <div class="menu">
 <?php echo $aButton;?>
 </div>
 <?php endforeach;?>
