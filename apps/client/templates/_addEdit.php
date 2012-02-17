<?php use_helper('JavascriptBase','Form');
include_stylesheets_for_form($oAppCommon->oForm); 
include_javascripts_for_form($oAppCommon->oForm) ;

?>
<?php if($oAppCommon->ssPostForm)
        include_partial('global/recordUpdate',array('oAppCommon'=>$oAppCommon));
?>

<div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="subBox">
  <tr>
    <td><h2><b><strong>*<?php echo __('Mandatory Field')?></strong></b><?php echo $oAppCommon->ssTitle;?></h2>
    </td>
  </tr>
    <tr>
    <td>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
<td width="100%" align="left" valign="top">

<?php	$oFormObjectData =  $oAppCommon->oForm->getObject();
echo $oAppCommon->oForm->renderFormTag(url_for($oAppCommon->ssModuleName.'/addEdit'.(!$oAppCommon->oForm->getObject()->isNew() ? '?'.$oAppCommon->ssBaseId.'='.$oFormObjectData[$oAppCommon->ssBaseId] : '' ) ),array('id'=>'frmAddEdit','name'=>'frmAddEdit'));
echo input_hidden_tag('ssSortOn',$sf_params->get('ssSortOn'));
echo input_hidden_tag('ssSortBy',$sf_params->get('ssSortBy'));
echo input_hidden_tag('ssSearchOption',$sf_params->get('ssSearchOption'));
echo input_hidden_tag('ssSearchWord',$sf_params->get('ssSearchWord'));
echo input_hidden_tag('page',$sf_params->get('page'));
echo input_hidden_tag('postLink',true);
$oErrorSchema = $oAppCommon->oForm->getErrorSchema();
?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
       
        <tr>
            <td align="left" valign="top" >
                <table width="100%" border="0" cellpadding="8" cellspacing="1" align="left" class="errorb" bgcolor="#e2e2e2">
            <?php if($sf_user->getFlash('ssErrorMsg') || isset($oErrorSchema[0])):?>
                <tr class="whitebg">
                    <td colspan="2" align="left" ><div class="error-msg" ><?php echo (isset($oErrorSchema[0])) ? $oErrorSchema[0] : $sf_user->getFlash('ssErrorMsg');?></div></td>
                </tr>
        <?php endif;
             if($sf_user->getFlash('succ_msg')):?>
                <tr class="whitebg">                   
                    <td colspan="2" align="left" ><div class="success-msg" ><?php echo  $sf_user->getFlash('succ_msg');?></div></td>
                </tr>
        	<?php endif;
       
            $snTabindex = 1;
            $ssErrorFlag = $snCnt = 0;
            
            $oEmbedeForms = $oAppCommon->oForm->getEmbeddedForms();
            foreach($oAppCommon->oForm as $ssFieldName=>$oFormdata): 
               if($oAppCommon->oForm->getWidget($ssFieldName)->getAttribute('type')!='hidden' && count($oAppCommon->oForm[$ssFieldName])==1 && !isset($oEmbedeForms[$ssFieldName])):?>
                     
                <tr class="<?php echo ($snCnt%2==0) ? "odd" : "even" ?>"  id="tbRow<?php echo $snCnt++;?>" align="left" >
                    <td width="15%" align="right" valign="middle">
                    <?php if($oAppCommon->oForm->getValidator($ssFieldName)->getOption('required')):?>
                        <b>*</b>
                     <?php endif;
                         echo $oAppCommon->oForm[$ssFieldName]->renderLabel();?></td>
                    <td width="85%" align="left" id="tbRowCell<?php echo $snTabindex;?>2" >
                    	<div class="fleft"><?php echo $oFormdata;?></div>
                       
                        	<?php if($oAppCommon->oForm[$ssFieldName]->renderError() && count($oAppCommon->oForm[$ssFieldName]) == 1 && !isset($oEmbedeForms[$ssFieldName])):?>
                            <div class="fleft"><?php echo $oAppCommon->oForm[$ssFieldName]->renderError(); ?></div>
                            <?php endif; ?>
                       
                    </td>
         
                </tr>
                
             <?php 
             		 if($oAppCommon->oForm[$ssFieldName]->renderError()): 
                                if($ssErrorFlag==0):
                                  if(count($oAppCommon->oForm[$ssFieldName])==1 && !isset($oEmbedeForms[$ssFieldName])):
                                    
                                    echo javascript_tag('document.getElementById("'.$oAppCommon->oForm[$ssFieldName]->renderId().'").focus();');
                                 	 $ssErrorFlag = 1;	
                                 
                                  endif;
    
                                endif;
                         endif;	
                                
                   elseif($oAppCommon->oForm->getWidget($ssFieldName)->getAttribute('type')=='hidden'):
                     echo $oAppCommon->oForm->renderHiddenFields();
                   endif;
            $snTabindex++ ;
            endforeach;
             
             if(count($oEmbedeForms) > 0): ?>
             		 <tr class="<?php echo ($snCnt%2==0) ? "odd" : "even" ?>"  id="tbRow<?php echo $snCnt++;?>" align="left">
             		 <td colspan="2">
    						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">

							  <tr>
								<th class="lanFieldset" align="left">
						        	<div class="innermenubtn">
								        <ul id="nav" class="nav bottomborder" style="z-index:0;">
							<?php $snNumber = 0;
								foreach ( $oEmbedeForms as $ssLanguageName =>$oSubForm ):
								
								$snNumber++;
							 ?>
                            <li id="div<?php echo $snNumber; ?>" class="<?php echo $snNumber<2 ? 'menuselected' : ''; ?>">
                            	<span>
									<?php echo link_to_function($oAppCommon->oForm[$ssLanguageName]->renderLabel(),"showcontent('$snNumber', '".count($oEmbedeForms)."',  '');",array('title'=>strip_tags($oAppCommon->oForm[$ssLanguageName]->renderLabel())));
									
?>								</span>
							</li>
							<?php endforeach; ?>
								 </ul>
								 </div>
								 <div style="width:100%; clear:both; float:left;">
								 <?php	
							$snNumber = 0;
							foreach ( $oEmbedeForms as $ssLanguageName => $oEmbedeSubForms ):
								
								$snNumber++; 
								?>
							<fieldset class="clearb" id="content<?php echo $snNumber; ?>" style="display:<?php echo $snNumber > 1 ? 'none' : ''; ?>">
							<legend align="left" style="margin-left:10px; color:#022695;"><?php echo $oAppCommon->oForm[$ssLanguageName]->renderLabel(); ?></legend>
								   
								   <span class="textbox300 widthnone errorLeftPadd" style="clear:both; display:block;">
								   
								   <table>
  <tbody>
  <?php $oEmbForm = $oAppCommon->oForm[$ssLanguageName]; 
  		foreach($oEmbForm as $snSubFieldName=>$oSubForm):?>
  <tr>
  <th><?php 		if($oEmbedeSubForms->getValidator($snSubFieldName)->getOption('required')):?>
                        <b>*</b>
                     <?php endif;
                      echo $oSubForm->renderLabel();?></th>
  <td><div class="fleft"><?php echo $oSubForm;?></div>
                       
                        	<?php if($oEmbForm[$snSubFieldName]->renderError() && count($oEmbForm[$snSubFieldName]) == 1 ):?>
                            <div class="fleft"><?php echo $oEmbForm[$snSubFieldName]->renderError(); ?></div>
                        <?php  		if($ssErrorFlag==0): 
                                            echo javascript_tag('showcontent("'.$snNumber.'", "'.count($oEmbedeForms).'",  "");document.getElementById("'.$oEmbForm[$snSubFieldName]->renderId().'").focus();');
                                            $ssErrorFlag = 1;
                                     endif;                          
                            	 endif;
                             ?>
</td>
</tr>
<?php endforeach;?>
</tbody></table></span>
								</fieldset>    
						  <?php
						   endforeach;  ?>   
                                </div>    
								</th>
                       		  </tr>
							</table>
				    </td>
					</tr>
             <?php endif; ?>	
              <tr>
			 <td>&nbsp;</td>
                <td align="left" colspan="2">
                	<div class="clearb">
                        <div class="menu clearb"><input type="submit" title="<?php echo __('Save');?>" tabindex="1" value="<?php echo __('Save');?>" name="Save"/></div>
                        <div class="menu padding0" ><?php echo link_to_function(__('Cancel'),"document.frmAddEdit.action='".url_for($oAppCommon->ssModuleName.'/index') ."';document.frmAddEdit.submit(); " ,array('tabindex'=>1,'title'=>__('Cancel'))); ?></div>
                     </div>
                </td>
              </tr>                
            </table>
            </td>
        </tr>
         <tr>
            <th bgcolor="#ffffff" valign="top" ></th>
        </tr>
	</table>
	</form>

	</td>
</tr>
</table>

     </td>
  </tr>
</table>
<?php 
if(!$oAppCommon->oForm->getObject()->isNew() && isset($oFormObjectData['active']))
echo javascript_tag('if(document.getElementById("'.$oAppCommon->oForm->getName().'_active"))
document.getElementById("'.$oAppCommon->oForm->getName().'_active").checked = '.(($oAppCommon->oForm->getObject()->getActive()=='Yes' ) ? 'true': 'false').';');
if($oAppCommon->oForm->getObject()->isNew() && count($oAppCommon->oForm->getErrorSchema())==0)
	echo javascript_tag('document.getElementById("frmAddEdit").elements[6].focus();');
elseif(!$oAppCommon->oForm->getObject()->isNew() && count($oAppCommon->oForm->getErrorSchema())==0)
	echo javascript_tag('document.getElementById("frmAddEdit").elements[7].focus();');

?>
</div>  
