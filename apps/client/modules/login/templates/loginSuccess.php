<?php use_helper('JavascriptBase','I18N');  ?>
<script type="text/javascript">
	window.onload = function()
	{
		document.getElementById("login_username").select();
		document.getElementById("login_username").focus();
	}
</script>

<div>&nbsp;</div>
<?php echo form_tag("login/index", array('name'=>'frmlogin')); ?>
<div class="loginbg">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="55%" height="200px" align="center" valign="middle" class="logo"><?php echo link_to(image_tag('/images/admin/logo.gif', array('alt' => __('virtueinfo'),'height'=>'100','width'=>'250')),'/login/welcome',array('title'=>__('Virtueinfo'))) ?></td>
        <td width="45%" align="center" valign="top">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
              	<td height="40" align="left"><h1><?php echo __('Login'); ?></h1></td>
              </tr>
              <tr>
                <td align="right">
                    <table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                              <td>&nbsp;</td>
                              <td align="left" class="errormsg">
                              	<?php if($sf_user->hasFlash('login_error')):?>
                                	<div class="red"><?php echo $sf_user->getFlash('login_error'); $sf_user->setFlash('login_error','') ?></div>
                                 <?php endif; ?>
                                 <div class="red"><?php echo $form['username']->renderError(); ?></div>
                              </td>
                            </tr>
                            <tr>
                              <td width="30%"  align="right" style="color:#000; font-weight:bold;" ><?php echo $form['username']->renderLabel(); ?></td>
                              <td width="70%"  align="left" ><?php echo $form['username']->render(); ?></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td align="left"><div class="red"><?php echo $form['password']->renderError(); ?></div></td>
                            </tr>
                            <tr>
                              <td  align="right" style="color:#000; font-weight:bold;" ><?php echo $form['password']->renderLabel(); ?></td>
                              <td  align="left" ><?php echo $form['password']->render(); ?></td>
                            </tr>
                            <tr>
                              <td  align="left" >&nbsp;</td>
                              <td  align="left" >
                              		<input class="loginbtn<?php echo ($sf_user->getCulture()=='fi') ? '-fin' : '';?>" type = "submit" name="<?php echo __('Login')?>" value="<?php //echo __('Login')?>" tabindex=1 title="<?php echo __('Login')?>">
                              		&nbsp;&nbsp;&nbsp;<?php //echo link_to('Forget Password','login/forgetPassword',array('title' => __('Forget Password'),))  ?>

                              </td>
                            </tr>
                          </table>
                </td>
              </tr>
		</table>
        </td>
      </tr>
    </table>
    <!--<div class="designby"><?php echo link_to( __('Designed By Vendep'), 'http://www.vendep.com', array ('popup' =>'true','title' => __('Designed By Vendep')) ); ?></div>-->
</div>
  <!--<table width="250" border="0" cellpadding="7" cellspacing="0" bgcolor="#05b1fd">
  <tr>
  <td>
  <table width="462px" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>
		  
	  </td>
    </tr>
  </table>
  </td>
  </tr>
  </table>-->
</form>
