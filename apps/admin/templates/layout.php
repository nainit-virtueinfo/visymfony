<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas();
include_metas();
include_title() ;
include_stylesheets();
include_javascripts(); ?>
<!-- <script type="text/javascript">  -->
<!--     var GB_ROOT_DIR = "http://<?php echo $sf_request->getHost() ?>/js/greybox/";  -->
<!-- </script> -->
<?php  $ssname= sfContext::getInstance()->getUser()->getAttribute('username');?>
<link rel="shortcut icon" href="/images/favicon.ico" />

<style type="text/css">
body {
	behavior: url("/js/csshover.htc");
}
</style>
<?php  if($ssname): ?>
<script type="text/javascript" src="/js/admin/JSCookMenu/JSCookMenu.js"></script>
<script type="text/javascript"
	src="/js/admin/JSCookMenu/VauvaOffice/theme1.js"></script>
<link rel="stylesheet" type="text/css"
	href="/js/admin/JSCookMenu/VauvaOffice/theme.css" />
<?php endif;
use_helper('I18N','Form');
if($ssname): ?>
<script language="JavaScript" type="text/javascript"><!--
	var animMenu =
[

	
	[null, '<?php echo __('Home');?>', '<?php echo url_for('login/welcome')?>', null, null],
	
	//_cmSplit,
	[null, '<?php echo __('Users');?>', '<?php echo url_for('login/index')?>', null, null],

// 	_cmSplit,
// 	[null, '<?php echo __('Language');?>', '<?php echo url_for('language/index')?>', null, null],

	//_cmSplit,
// 	[null, '<?php echo __('Company');?>', null, null, null,
//     ['', '<?php echo __('List Company');?>', '<?php echo url_for('company/index')?>', null, null],
//     ['', '<?php echo __('Create Company');?>', '<?php echo url_for('company/addEdit')?>', null, null],
//     ],


    //_cmSplit,
//     [null, '<?php echo __('Nominator');?>', '<?php echo url_for('nominator/index')?>', null, null],
// 
// 	//_cmSplit,
// 	[null, '<?php echo __('Nomination');?>', '<?php echo url_for('nomination/index')?>', null, null],
// 	
// 	//_cmSplit,
// 	[null, '<?php echo __('Report');?>', null, null, null,
//     ['', '<?php echo __('Most View Nomination');?>', '<?php echo url_for('report/index')?>', null, null],
//     ['', '<?php echo __('Most View Company');?>', '<?php echo url_for('report/mostViewCompany')?>', null, null]],
// 	
// 	//_cmSplit,
 	[null, '<?php echo __('Settings');?>', null, null, null,
 	['', '<?php echo __('Change Password');?>', '<?php echo url_for('login/changePassword')?>', null, null],
// 	['', '<?php echo __('Reminder Service Setting');?>', '<?php echo url_for('reminderservice/index')?>', null, null],
//      ['', '<?php echo __('Clear Cache');?>', '<?php echo url_for('language/clearCache')?>', null, null],
 	],
	
];
--></script>

<?php endif;?>

</head>
<body>

<table width="100%" border="0" align="left" cellpadding="0"	cellspacing="0">
	<!--		Header panel start -->
	<tr>
		<td align="left" valign="top" class="top-bg1"><?php if($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" valign="bottom" width="25%" height="80px" class="rowheader">
					<?php echo link_to(image_tag('/images/admin/logo.gif',array('alt' => __('virtueinfo'),'height'=>'100','width'=>'250')),'/login/welcome',array('title'=>__('virtueinfo'))) ?>
				</td>
				<td height="85px" width="75%" align="left" valign="bottom" class="rowheader">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="right" class="headertextbg">&nbsp;</td>
					</tr>
					<tr>

						<td align="right" class="headertextbg"><?php  if($ssname): ?> <?php echo __('Welcome')." ".$ssname;?>&nbsp; | &nbsp;<?php echo link_to(__('Logout'),'login/logout', array('title' => __('Log Out'))) ?>
						<?php endif;?></td>
					</tr>
					<tr>
						<td align="right" class="headertextbg"><?php //include_partial('global/Language');?>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<!--		Header Menu start -->
			<tr align="left" valign="top">
				<td colspan="2" align="left" class="leftpadding"
					style="height: 40px;">
				<div class="menubgimg">
				<div id="adminmenu" class="leftspace"
					style="padding-bottom: 7px;"></div>

				<script type="text/javascript">
							cmDraw ('adminmenu', animMenu, 'hbr','<?php echo ($sf_user->getAttribute("ssSelected")) ? __($sf_user->getAttribute("ssSelected")) : '';?>', cmVauvaOffice, 'VauvaOffice');
						</script></div>
				</td>
			</tr>
			<!--		Header Menu End -->
		</table>
		<?php endif; ?></td>
	</tr>
	<!--		Header panel end -->

	<!--		content panel start -->
	<tr>
		<td align="center" valign="top" class="centerbackground"><?php if($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>
		<table width="95%" border="0" align="center" cellpadding="0"
			cellspacing="0">
			<tr>
				<td class="tlcorner"></td>
				<td class="topbg"></td>
				<td class="trcorner"></td>
			</tr>
			<tr>
				<td class="leftbg"></td>
				<td bgcolor="#FFFFFF" class="padding10 suhedder4" align="center"
					valign="top">
				<div style="min-height: 450px;"><?php echo $sf_content; ?></div>
				</td>
				<td class="rightbg"></td>
			</tr>
			<tr>
				<td class="blcorner"></td>
				<td class="bottambg"></td>
				<td class="brcorner"></td>
			</tr>
		</table>
		<?php else: ?>
		<div style="min-height: 450px;"><?php echo $sf_content; ?></div>
		<?php endif; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<!--<tr>
		<td align="center"><?php if($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>
		<table width="95%" border="0" align="center" cellpadding="0"
			cellspacing="0">
			<tr>
				<td class="footlcorner"></td>
				<td class="footopbg"></td>
				<td class="footrcorner"></td>
			</tr>
			<tr>
				<td class="fooleftbg"></td>
				<td bgcolor="#f1f0f0" class="footerlink" align="right"><?php echo link_to( __('Designed By Vendep'), 'http://www.vendep.com', array ('popup' =>'true','title' => __('Designed By Vendep')) ); ?></td>
				<td class="foorightbg"></td>
			</tr>
			<tr>
				<td class="fooblcorner"></td>
				<td class="foobottambg"></td>
				<td class="foobrcorner"></td>
			</tr>
		</table>
		<?php endif; ?></td>
	</tr>-->
</table>

</body>
</html>
