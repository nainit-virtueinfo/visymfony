<?php use_helper('Url','JavascriptBase','jQuery','Form')?>
<script type="text/javascript"> 
	$(function() { 
            $("input[type='text']:enabled:first").focus(); 
    });
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0"
	class="subBox">
	<tr>
		<td>
		  <h2 id="ssTitle"><?php
		echo $oAppCommon->ssTitle;
		if($oAppCommon->ssShowPaging):
		$snCount = $oAppCommon->oPager->getNbResults();
		?> &nbsp;[<span> <?php echo  __('Displaying').' '.(($oAppCommon->oPager->getNbResults() > 0) ?  '<b>'.$oAppCommon->oPager->getFirstIndice().'</b> '. __('To').' <b>'.$oAppCommon->oPager->getLastIndice().'</b> '.__('Of').'<b> '.$oAppCommon->oPager->getNbResults().'</b>' : '<b> 0 </b>'. __('To').' <b>0</b> '.__('Of').'<b> 0 </b>'); ?>
		</span>] <?php else:
		$snCount = count($oAppCommon->oPager);
		endif;?></h2>
		</td>
	</tr>
	<tr>
		<td>
		<div class="inputbox" ><?php 
		if($oAppCommon->ssShowPaging)
		include_partial('global/paging',array('oPager'=>$oAppCommon->oPager,'ssLink'=>$oAppCommon->ssLink,'ssDivId'=>$oAppCommon->ssDivId,'ssParams'=>"ssSortBy=".$oAppCommon->ssSortBy."&ssSortOn=".$oAppCommon->ssSortOn."&".htmlspecialchars_decode($oAppCommon->ssParams)));?>

		<?php if($oAppCommon->ssButtonTopMenu)
		include_partial('global/buttonTopMenu');
		echo jq_form_remote_tag(array('update' => $oAppCommon->ssDivId,'url'=>$oAppCommon->ssLink),array('name' => 'frmSearch','id'=>'frmSearch','method'=>'post','class'=>'fright'));
		echo input_hidden_tag('ssSortOn',$oAppCommon->ssSortOn);
		echo input_hidden_tag('ssSortBy',$oAppCommon->ssSortBy);
		?>
		<div><?php echo __("Search By") ?>&nbsp; <?php echo select_tag('ssSearchOption', options_for_select($oAppCommon->aSearchOptions,$sf_params->get('ssSearchOption')),array('tabindex'=>2));  ?>
		</div>
		<div class="searchinput"><?php echo __('Search For') ?>&nbsp;<?php echo input_tag('ssSearchWord',trim($sf_params->get('ssSearchWord')),array('size'=>'20','maxlength'=>'100','tabindex'=>1)); ?></div>
		<div class="menu padding0"><?php  echo submit_tag(__('Search'),array('title'=>__('Search'),'tabindex'=>1));?>
		</div>
		<div class="menu padding0"><?php echo link_to(__('Show All'),$oAppCommon->ssLink,array('title'=>__('Show All'),'tabindex'=>1));?>
		</form>
		</div>
		<div>
		</td>
	</tr>
</table>
		<?php echo jq_form_remote_tag(array('update' => $oAppCommon->ssDivId,'url'=>$oAppCommon->ssLink),array('name' => 'frmList','id'=>'frmList','method'=>'post','class'=>'fright'));
		echo input_hidden_tag('ssSortOn',$oAppCommon->ssSortOn);
		echo input_hidden_tag('ssSortBy',$oAppCommon->ssSortBy);
		echo input_hidden_tag('ssSearchOption',$sf_params->get('ssSearchOption'));
		echo input_hidden_tag('ssSearchWord',$sf_params->get('ssSearchWord'));
		echo input_hidden_tag('page',$sf_params->get('page'));

		include_partial($oAppCommon->ssRenderListFileName,array('oAppCommon'=>$oAppCommon,'snCount'=>$snCount));?>
<br />
<div class="menu"><?php 
if($oAppCommon->ssShowDeleteButton && $snCount > 0)
echo button_to_function(__('Delete'),"if(deleteAll(document.frmList,'".$oAppCommon->ssTitle."','','".__("Are you sure, you want to delete selected %sstitle%?",array('%sstitle%'=>$oAppCommon->ssTitle))."','".__("Select Atleast One Item")."'))".jq_remote_function(array('url'=>$oAppCommon->ssLink.(strstr($oAppCommon->ssLink,'?') ? "&" : "?")."ssAction=delete",'update'=>$oAppCommon->ssDivId,'with'=>'jQuery(this.form.elements).serialize()')),array('id'=>'delete','name'=>__("Delete"),'title'=>__('Delete')));

?></div>
<div class="menu"><?php if($oAppCommon->ssShowCreateButton)
echo link_to_function(__('Create'),'document.frmList.action = "'.url_for($oAppCommon->ssModuleName."/addEdit").'";document.frmList.submit();',array('title'=>__('Create')))?>

</div>
<!--Shows send Button at bootom  -->
<div class="menu"><?php if($oAppCommon->ssShowSendButton)
echo button_to_function(__('Send'),"if(deleteAll(document.frmList,'".$oAppCommon->ssTitle."','','".__("Are you sure, you want to Send Newsletter %sstitle%?",array('%sstitle%'=>$oAppCommon->ssTitle))."','".__("Select Atleast One Item")."'))".jq_remote_function(array('url'=>$oAppCommon->ssLink.(strstr($oAppCommon->ssLink,'?') ? "&" : "?")."ssAction=send",'update'=>$oAppCommon->ssDivId,'with'=>'jQuery(this.form.elements).serialize()')),array('id'=>'send','name'=>__("Send"),'title'=>__('Send')));
?></div>
<!--End Shows -->
<?php if(($oAppCommon->ssButtonMenu && $snCount > 0) || ($oAppCommon->ssButtonMenu && $sf_params->get('module')=='accounthistory' && $sf_params->get('money')=='In'))
include_partial('global/buttonMenu');?>
</form>