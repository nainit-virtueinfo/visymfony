<table width="100%" border="0" align="left" cellpadding="0"	cellspacing="0">
	<!--		Header panel start -->
	<tr>
		<td align="left" valign="top" class="top-bg1">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" valign="bottom" width="25%" height="80px" class="rowheader">
					<?php echo link_to(image_tag('/images/admin/logo.gif', array('alt' => __('virtueinfo'),'height'=>'100','width'=>'250')),'/login/welcome',array('title'=>__('Virtueinfo'))) ?>
				</td>
			</tr>
			<!--		Header Menu start -->
			<tr align="left" valign="top">
				<td colspan="2" align="left" class="leftpadding"
					style="height: 40px;">
				<div class="menubgimg">
				<div id="adminmenu" class="leftspace"
					style="padding-bottom: 7px;"></div>

				</div>
				</td>
			</tr>
			<!--		Header Menu End -->
		</table>
	</tr>
	<!--		Header panel end -->

	<!--		content panel start -->
	<tr>
		<td align="center" valign="top" class="centerbackground">
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td class="tlcorner"></td>
				<td class="topbg"></td>
				<td class="trcorner"></td>
			</tr>
			<tr>
				<td class="leftbg"></td>
				<td bgcolor="#FFFFFF" class="padding10 suhedder4" align="center" valign="top">
				<div style="min-height: 450px;">
					 <font color="#FF0000"><?php if (isset($ssError)): echo $ssError; endif;?></font>
					 <?php echo form_tag('login/forgetPassword',array('name' => 'frmForgetPassword')) ?>
					 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="subBox">
					   <tr>
						<td><h2><strong>*<?php echo __('Mandatory Field')?></strong><?php echo __('Forget Password'); ?></h2>
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
										  <td width="15%" align="right"><b>*</b>&nbsp;<?php echo $omForm['email']->renderLabel(); ?></td>
										  <td width="85%" align="left">
												    <div class="fleft">
													 <?php if($sf_user->hasFlash('mail_error')):?>
														  <div class="errormsg"><?php echo $sf_user->getFlash('mail_error'); $sf_user->setFlash('mail_error','') ?></div>
													 <?php endif; ?>
												  <?php echo $omForm['email']->render(); ?>
												  </div>
										  <?php if($omForm['email']->renderError()):?>
											 <div class="fleft"><?php echo $omForm['email']->renderError(); ?></div>
											 <?php endif;?>
										</td>
									 </tr>
									 <tr>
										  <td>&nbsp;</td>
										  <td align="left">
										  <div class="menu"><input type="submit" value="<?php echo __('Submit');?>" tabindex=40 title="<?php echo __('Submit');?>" /></div>
										  <div class='menu'><a href='/' title="<?php echo __('Go Back To Previous Page') ?>"><?php echo __('Go Back') ?></a></div>
										  </td>
									 </tr>
								  </table>
							 </td>
					   </tr>
					 </table>

					 </form>
				</div>
				</td>
				<td class="rightbg"></td>
			</tr>
			<tr>
				<td class="blcorner"></td>
				<td class="bottambg"></td>
				<td class="brcorner"></td>
			</tr>
		</table>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
<!--	<tr>
		<td align="center">
		<table width="95%" border="0" align="center" cellpadding="0"
			cellspacing="0">
			<tr>
				<td class="footlcorner"></td>
				<td class="footopbg"></td>
				<td class="footrcorner"></td>
			</tr>
			<tr>
				<td class="fooleftbg"></td>
				<td bgcolor="#f1f0f0" class="footerlink" align="right"><?php echo link_to( __('Designed By Vendep'), 'http://www.vendep.fi', array ('popup' =>'true','title' => __('Designed By Vendep')) ); ?></td>
				<td class="foorightbg"></td>
			</tr>
			<tr>
				<td class="fooblcorner"></td>
				<td class="foobottambg"></td>
				<td class="foobrcorner"></td>
			</tr>
		</table>
		</td>
	</tr>-->
</table>
<script type="text/javascript">
	document.getElementById("forgetPassword_email").focus();
<?php
	if ($omForm['email']->renderError()): ?>
	document.getElementById("forgetPassword_pwd").focus();
	<?php endif;?>
</script>
