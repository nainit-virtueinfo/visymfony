<?php
use_helper('Form');
$ssLink = $oAppCommon->ssModuleName.'/index';
echo form_tag($ssLink, array('enctype' => 'multipart/form-data','id'=>"recordUpdate","name"=>"recordUpdate"));
echo input_hidden_tag('ssSortOn',$sf_params->get('ssSortOn'));
echo input_hidden_tag('ssSortBy',$sf_params->get('ssSortBy'));
echo input_hidden_tag('ssSearchOption',$sf_params->get('ssSearchOption'));
echo input_hidden_tag('ssSearchWord',$sf_params->get('ssSearchWord'));
echo input_hidden_tag('page',$sf_params->get('page'));
echo input_hidden_tag('postLink',true);
?>
</form>
<script type="text/javascript">
window.onload = function()
{
	document.getElementById("recordUpdate").submit();
}
</script>
