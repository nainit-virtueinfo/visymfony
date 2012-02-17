<div>
<?php 
	if ($oPager->haveToPaginate()):
			if($sf_params->get('page') && $sf_params->get('page') != $oPager->getFirstPage()):
	   		echo jq_link_to_remote(image_tag('/images/admin/pag-first-icon.gif',array('title'=>__('First'))), array('url'=>$ssLink.((!strpos($ssLink, '?')) ? '?' : '&').'page='.$oPager->getFirstPage(),'update'=>$ssDivId,'with'=>"'".$ssParams."'",'complete'=>(isset($onCompelte)) ? $onCompelte:""),array('title' => __('First'),'class'=>'pager')); 
    		echo jq_link_to_remote(image_tag('/images/admin/pag-pre-icon.gif',array('title'=>__('Previous'))), array('url'=>$ssLink.((!strpos($ssLink, '?')) ? '?' : '&').'page='.$oPager->getPreviousPage(),'update'=>$ssDivId,'with'=>"'".$ssParams."'",'complete'=>(isset($onCompelte)) ? $onCompelte:""),array('title' => __('Previous'),'class'=>'pager'));
	else:
			echo '<span class="pager" >'.image_tag('/images/admin/pag-first-icon-gray.gif',array('title'=>__('First'))).'</span>'; 
			echo '<span class="pager" >'.image_tag('/images/admin/pag-pre-icon-gray.gif',array('title'=>__('Previous'))).'</span>';
	endif;
		
	$snLinks = $oPager->getLinks($oPager->getLastPage());
	$aPager = array();
	 foreach ($snLinks as $snPage):
	 	 $aPager[$snPage] = $snPage;
	 endforeach;
	 echo select_tag('pageBox', options_for_select($aPager,$oPager->getPage()),array('onChange'=>"jQuery.ajax({type:'POST',dataType:'html',data:'page='+this.value+'&".$ssParams."',success:function(data, textStatus){jQuery('#".$ssDivId."').html(data);},url:'".$ssLink."'".((isset($onCompelte)) ? ",complete:function (){".$onCompelte."}" : "")."})")); 
		if($sf_params->get('page') != $oPager->getLastPage()):
    		echo jq_link_to_remote(image_tag('/images/admin/pag-next-icon.gif',array('title'=>__('Next'))), array('url'=>$ssLink.((!strpos($ssLink, '?')) ? '?' : '&').'page='.$oPager->getNextPage(),'update'=>$ssDivId,'with'=>"'".$ssParams."'",'complete'=>(isset($onCompelte)) ? $onCompelte:""),array('title' => __('Next'),'class'=>'pager')); 
    		 echo jq_link_to_remote(image_tag('/images/admin/pag-last-icon.gif',array('title'=>__('Last'))),array('url'=>$ssLink.((!strpos($ssLink, '?')) ? '?' : '&').'page='.$oPager->getLastPage(),'update'=>$ssDivId,'with'=>"'".$ssParams."'",'complete'=>(isset($onCompelte)) ? $onCompelte:""),array('title' => __('Last'),'class'=>'pager'));
    	else :
    		echo '<span class="pager" >'.image_tag('/images/admin/pag-next-icon-gray.gif',array('title'=>__('Next'))).'</span>';
    	 	echo '<span class="pager" >'.image_tag('/images/admin/pag-last-icon-gray.gif',array('title'=>__('Last'))).'</span>';
			
		endif;		
   endif; ?>
   </div>
