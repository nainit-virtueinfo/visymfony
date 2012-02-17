<?php $oLanguages = Doctrine::getTable('Language')->getActiveCulture();
if(count($oLanguages) > 0)
{
 echo form_tag('language/changeLanguage',array('name'=>'changeLang','id'=>'changeLang')) ;
  echo select_tag('current_lang', options_for_select($oLanguages,sfContext::getInstance()->getUser()->getCulture()),array('id'=>"language",'onChange'=>'document.changeLang.submit();'));
?>
</form> 
<?php } ?>
