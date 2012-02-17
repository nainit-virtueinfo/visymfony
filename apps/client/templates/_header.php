<?php use_helper('jQuery') ?>

<h1 id='logo'><span class='blue'>Virtueinfo</span></h2>

<h3 align='right'>
	<?php if($sf_user->hasAttribute('username','client')): ?>
	  	<?php echo __('lbl_welcome') ?>, <?php echo $sf_user->getAttribute('username','client') ?> | <?php echo link_to('Change Password','login/changePassword') ?> | <?php echo link_to('Logout','login/logout') ?>
	<?php else: ?>
		<?php echo $sf_user->getAttribute('name') ?> | <?php echo link_to('Login', 'login/index') ?> </div>
	<?php endif; ?>
</h3>
