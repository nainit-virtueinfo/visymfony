
<font color="#FF0000"><?php if (isset($ssError)): echo $ssError; endif;?></font>
<?php echo form_tag('login/changePassword',array('name' => 'frmChangePassword')) ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="subBox">
  <tr>
    <td><h2><strong>*<?php echo __('Mandatory Field')?></strong><?php echo __('Change Password'); ?></h2>
    </td>
  </tr>
    <tr>
    <td>
			<table width="100%" cellpadding="8" cellspacing="1" border="0" align="left" class="errorb"  bgcolor="#e2e2e2">
	<?php if($sf_user->hasFlash('msgSucc')):?>
    <tr class="whitebg">
     	<td align="left" colspan="2" >
            <div class="success-msg">
                <?php echo $sf_user->getFlash('msgSucc')?>
            </div>
        </td>
    </tr>
     <?php endif; ?> 

	<tr class="odd">
		<td width="15%" align="right"><b>*</b>&nbsp;<?php echo $omForm['password']->renderLabel(); ?></td>
		<td width="85%" align="left"><div class="fleft">
                     	<?php if($sf_user->hasFlash('password_error')):?>
                         	<div class="errormsg"><?php echo "<b>".$sf_user->getFlash('password_error'); $sf_user->setFlash('password_error','') ?></div>
                         <?php endif; ?>
				    <?php echo $omForm['password']->render(); ?></div>
        	<?php if($omForm['password']->renderError()):?>
            	<div class="fleft"><?php echo $omForm['password']->renderError(); ?></div>
			<?php endif;?>
        </td>
	</tr>

	<tr class="even">
		<td align="right"><b>*</b>&nbsp;<?php echo $omForm['new_password']->renderLabel(); ?></td>
		<td align="left">
        	<div class="fleft"><?php echo $omForm['new_password']->render(); ?></div>
        	<?php if($omForm['new_password']->renderError()):?>
            	<div class="fleft"><?php echo $omForm['new_password']->renderError(); ?></div>
            <?php endif;?>
        </td>
	</tr>


	<tr class="odd">
		<td align="right"><b>*</b>&nbsp;<?php echo $omForm['confirm_password']->renderLabel(); ?></td>
		<td align="left">
        	<div class="fleft"><?php echo $omForm['confirm_password']->render(); ?></div>
            <?php if($omForm['confirm_password']->renderError()):?>
            	<div class="fleft"><?php echo $omForm['confirm_password']->renderError(); ?></div>
			<?php endif;?>            
        </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="left">
		<div class="menu"><input type="submit" value="<?php echo __('Save');?>" tabindex=40 title="<?php echo __('Save');?>" /></div>
		<div class="menu"><?php echo link_to( __('Cancel'), '/',array('tabindex' => 50,'title' => __('Cancel'))) ?></div>
		</td>
	</tr>
</table>
    </td>
  </tr>
</table>

</form>
<script type="text/javascript">
	document.getElementById("changePassword_password").focus();
<?php
	if ($omForm['password']->renderError()): ?>
	document.getElementById("changePassword_password").focus();
	<?php 
	elseif($omForm['new_password']->renderError()): ?>
    document.getElementById("changePassword_new_password").focus();
	<?php 
	elseif($omForm['confirm_password']->renderError()): ?>
	document.getElementById("changePassword_confirm_password").focus();
	<?php endif;?>
</script>
