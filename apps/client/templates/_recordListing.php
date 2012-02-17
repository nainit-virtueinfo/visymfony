<?php if($snCount > 0): ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	<?php if($sf_user->getFlash('succ_msg')):?>
        <tr>
         <td align="left" >
            <div  class="success-msg">
              <?php  echo ($sf_user->hasFlash('succ_msg')) ?  $sf_user->getFlash('succ_msg'): "&nbsp;" ;
      				  $sf_user->setFlash('succ_msg','')?>
            </div>
            </td>
        </tr>
         <?php else: ?> 
        <tr><td>&nbsp;</td></tr>
         <?php endif; ?> 
	<tr>
		<td>
		<table width="100%" cellpadding="2" cellspacing="1" class="adminlist" border="0" align="left" id="adminlist">
			<thead>
				<tr>
				<?php if($oAppCommon->ssShowCheckBox):?>
				<th width="5%" class="checkboxborder" style="text-align:center;padding:0px;"><?php echo __("Check All")?><br/><input type="checkbox" name="deleteId" id="deleteId" value="0" onclick="checkUncheckAll(document.frmList);" /></th>
				<?php endif; ?>
			    <?php foreach($oAppCommon->aFields as $ssField=>$aField): ?>
      <th <?php echo "width=".((isset($aField['width']))? $aField['width'] : "10%"); ?>  align="left" valign="middle"><?php echo  ($aField['caption']!="") ? $aField['caption'] : "&nbsp;";?>
      <?php 
      if(isset($aField['sortkey'])):
          echo ($oAppCommon->ssSortOn==$aField['sortkey'] && $oAppCommon->ssSortBy=="asc") ? image_tag("admin/up_selected.gif",array("title"=>__('Ascending'))) : jq_link_to_remote(image_tag("admin/up.gif",array("title"=>__('Ascending'))),array('update'=>$oAppCommon->ssDivId,'with'=>"'ssSortOn=".$aField['sortkey']."&ssSortBy=asc".($sf_params->get('page')!='' ? "&page=".$sf_params->get('page') : "").(substr($oAppCommon->ssParams,0,1)=="&" ? $oAppCommon->ssParams : "&".$oAppCommon->ssParams)."'",'url'=>$oAppCommon->ssLink)); 
	      echo ($oAppCommon->ssSortOn==$aField['sortkey'] && $oAppCommon->ssSortBy=="desc") ? image_tag("admin/down_selected.gif",array("title"=>__('Descending'))) : jq_link_to_remote(image_tag("admin/down.gif",array("title"=>__('Descending'))),array('update'=>$oAppCommon->ssDivId,'with'=>"'ssSortOn=".$aField['sortkey']."&ssSortBy=desc".($sf_params->get('page')!='' ? "&page=".$sf_params->get('page') : "").(substr($oAppCommon->ssParams,0,1)=="&" ? $oAppCommon->ssParams : "&".$oAppCommon->ssParams)."'",'url'=>$oAppCommon->ssLink)); 
      endif;
      ?>
       	 </th>
 <?php endforeach;?>
<?php if($oAppCommon->ssShowEditButton):?>
	<th width="2%" style="text-align:center;padding:0px;"> <?php echo __('Modify') ?></th>
 <?php endif; ?>
                </tr>
			</thead>
			<tbody>
<?php   
	$snRecordNumber = 0;
	foreach($oAppCommon->oResults as $oResult):
	if($oAppCommon->ssRankRequired):
			echo input_hidden_tag('aIdRank[]',$oResult[$oAppCommon->ssBaseId]);
   endif;
   $snRecordNumber++;?>
<tr class="<?php echo ($snRecordNumber%2==0) ? "even" : "odd" ?>">
<?php if($oAppCommon->ssShowCheckBox):?>
<td width="5%" style="text-align:center;padding:0px;" class="checkboxborder" >
<input type="checkbox" name="deleteIds[]" id="deleteIds_<?php echo $oResult[$oAppCommon->ssBaseId] ?>" value="<?php echo $oResult[$oAppCommon->ssBaseId] ?>" onclick="checkUncheckOne(this.form);" /></td>
<?php endif; 
	foreach($oAppCommon->aFields as $ssField=>$aField):
		if(preg_match('/Translation/',$ssField))
			eval("\$"."ssFieldName = ".(("\$"."oResult".$ssField) ? "\$"."oResult".$ssField : '').";");
		elseif(!preg_match('/Translation/',$ssField))
			eval("\$"."ssFieldName = ".(("\$"."oResult".$ssField) ? "\$"."oResult".$ssField : '').";");
		elseif(preg_match('/Translation/',$ssField) && count($oResult['Translation']) == 0)
			$ssFieldName = "";
		 ?>
	<td height="22"  align="right">
	<?php if(isset($aField['link']) || isset($aField['grayboxLink']) || (isset($aField['image']) && (isset($aField['link']) || isset($aField['grayboxLink']) || isset($aField['priceformat'])))):
	
		$ssLinkParams = '';
		 if(isset($aField['aLinkParams'])):
			foreach($ssFieldValue['aLinkParams'] as $ssField)
			 	$ssLinkParams.="&".strtolower($ssField)."=".$asKey[$ssField];
		     $ssLinkParams = (isset($aField['includeBaseId'])) ? $ssLinkParams : "?".substr($ssLinkParams,1,strlen($ssLinkParams)-1);
		    	
		 endif;
			 if(isset($aField['postLink']))
			 {
				 echo link_to_function(isset($aField['image']) ? image_tag($aField['image'],array('title'=>$aField['title'],'alt'=>__('View'))): ($ssFieldName!='' ? $ssFieldName : __("Edit")),"document.frmList.action = '".url_for($aField['link'].(isset($aField['includeBaseId']) ? "?".$oAppCommon->ssBaseId."=".$oResult[$oAppCommon->ssBaseId]: "").$ssLinkParams)."';document.frmList.submit();",array('class'=>'listlink','title'=> __('Edit')." ".$ssFieldName));
			 } 
			 elseif(isset($aField['grayboxLink']))
			 {
			 	echo link_to_function(isset($aField['image']) ? image_tag($aField['image'],array('title'=>$aField['title'])): $ssFieldName,"GB_showFullScreen('".$aField['title']."','".url_for($aField['grayboxLink'].(isset($aField['includeBaseId']) ? "?".$oAppCommon->ssBaseId."=".$oResult[$oAppCommon->ssBaseId]: "").$ssLinkParams)."');",array('class'=>'listlink','title'=>$aField['title']));
			 }
			 elseif(isset($aField['confirm']))
			 {
			 	echo link_to_function(isset($aField['image']) ? image_tag($aField['image'],array('title'=>$aField['title'])): $ssFieldName,"if(!confirm('".$aField['confirm']."')) return false; document.location.href = '".url_for($aField['link'].(isset($aField['includeBaseId']) ? "?".$oAppCommon->ssBaseId."=".$oResult[$oAppCommon->ssBaseId]: "").$ssLinkParams)."'",array('class'=>'listlink','title'=>$aField['title']));
			 }
			 else
			 	echo link_to(isset($aField['image']) ? image_tag($aField['image'],array('title'=>$aField['title'],'alt'=>__('View'))): $ssFieldName,$aField['link'].(isset($aField['includeBaseId']) ? "?".$oAppCommon->ssBaseId."=".$oResult[$oAppCommon->ssBaseId]: "").$ssLinkParams,array('class'=>'listlink','title'=>$aField['title']));  
			
		 elseif(isset($aField['active'])): ?>
		 	<span id="idActive<?php echo $oResult[$oAppCommon->ssBaseId] ?>">
		 <?php include_partial('global/renderStatus',array('ssStaus'=>$ssFieldName,'snId'=>$oResult[$oAppCommon->ssBaseId],'oAppCommon'=>$oAppCommon,'ssAction'=>$aField['active'],'ssTitle'=>$aField['aTitle'][$ssFieldName])); ?>
		 	</span>
		  <?php 
		  elseif(isset($aField['image'])):
		  {
			  if($ssFieldName && $ssFieldName !='no-image-company.gif')
				  echo image_tag($aField['pathImage'].$ssFieldName,array('title'=>$oResult['company_name']));
			  else
				  echo image_tag('no-image-company.gif',array('title'=>$oResult['company_name']));
		  }
		  elseif(isset($aField['maillink'])):
			echo mail_to($ssFieldName,$ssFieldName,array('title'=>$ssFieldName));

		  elseif(isset($aField['seperator']) && isset($aField['fieldName']) && $ssFieldName):
			  foreach($ssFieldName as  $snKey=>$aValues):
			  $ssTranslation = (preg_match('/Translation/',$aField["fieldName"])) ? substr(htmlspecialchars_decode($aField["fieldName"]),0,strpos(htmlspecialchars_decode($aField["fieldName"]), 'Translation')+13) : htmlspecialchars_decode($aField["fieldName"]);
				  eval("\$"."ssFieldValue = ((count("."\$"."aValues".$ssTranslation.") > 0) ? "."\$"."aValues".htmlspecialchars_decode($aField["fieldName"])." : '');");
				  
			  echo $ssFieldValue.((count($ssFieldName)-1 > $snKey)?$aField['seperator']:"" )." ";
			  endforeach;
		  elseif(isset($aField['rank'])):
				echo ( $snRecordNumber > 1 ) ?  link_to_function(image_tag('admin/up.gif',array('title'=>__('Up'))),jq_remote_function(array('update' => $oAppCommon->ssDivId,'url'=>$aField['linkRank'],'with'=>'jQuery("#frmList").serialize()+"&snRank1='.($snRecordNumber-2).'&snRank2='.($snRecordNumber-1).'"')))  : image_tag('admin/blank.gif');
				echo "&nbsp;&nbsp;";
				if ( $snRecordNumber < $snCount ): echo  link_to_function(image_tag('admin/down.gif',array('title'=>__('Down'))),jq_remote_function(array('update' => $oAppCommon->ssDivId,'url'=>$aField['linkRank'],'with'=>'jQuery("#frmList").serialize()+"&snRank1='.($snRecordNumber-1).'&snRank2='.($snRecordNumber).'"'))) ;
				endif;
			elseif(isset($aField['priceformat']) && $aField['priceformat'] == 'yes'):
				echo sfGeneral::setPriceFormat($ssFieldName);
			elseif(isset($aField['dateformat']) && $aField['dateformat'] == 'yes'):
				echo sfGeneral::setDateFormat($ssFieldName);
		  	else:
	           echo $ssFieldName;
	      endif; 
		 
	?></td>
	<?php endforeach;?>
 <?php if($oAppCommon->ssShowEditButton):?>
	 <td height="22"  align="center"  style="text-align:center;">
		<?php echo link_to_function(image_tag('super/view_blog.png', array('title' => __('Modify Reminder Service'))),'document.frmList.action = "'.url_for($oAppCommon->ssModuleName."/addEdit")."/".$oAppCommon->ssBaseId."/".$oResult[$oAppCommon->ssBaseId].'";document.frmList.submit();',array('title'=>__('Modify Reminder Service')))?>
	 </td>
 <?php endif; ?>
</tr>
<?php endforeach;?>	
			</tbody>
		</table>
		</td>
	</tr>
</table>
<?php else: ?>
<?php if($sf_user->getFlash('succ_msg')):?>
<div  class="success-msg">
  <?php  echo ($sf_user->hasFlash('succ_msg')) ?  $sf_user->getFlash('succ_msg'): "&nbsp;" ;
		  $sf_user->setFlash('succ_msg','')?>
</div>
<?php endif; ?>
<div class="errormsg"><?php echo __('No Record(s) Found'); ?></div>
<?php  endif;?> 

