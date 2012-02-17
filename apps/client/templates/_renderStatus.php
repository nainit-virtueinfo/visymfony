<?php 

echo jq_link_to_remote(image_tag($ssStaus.".gif?id=".rand()),array('update'=>'idActive'.$snId,'url'=>$oAppCommon->ssModuleName.'/'.(isset($ssAction) ? $ssAction: 'active'),'with'=>"'cValue=".($ssStaus=='Yes' ? 'No' : 'Yes')."&".$oAppCommon->ssBaseId."=".$snId."'",'confirm'=>__("Are you sure, you want to %sstitle%?",array('%sstitle%'=>$ssTitle))),array('title'=>isset($ssTitle) ? __('Click here to')." ".$ssTitle : ''));

?> 
