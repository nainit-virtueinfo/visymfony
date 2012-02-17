<?php
    use_helper('Form');
    echo select_tag($ssFormName."[state]",options_for_select($arState),array('style'=>'width:200px;','tabindex'=>'7','onchange'=>'checkOption(this.options[this.selectedIndex].value,"company_state_text")'));
?>
<div id='company_state_text' style="display:none;width:200px;">
<?php echo input_tag($ssFormName.'[otherState]','',array('tabindex'=>'7')); ?></div>