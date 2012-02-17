<?php include_partial('company/addEdit',array('oAppCommon'=>$oAppCommon,'ssPostState'=>$ssPostState,'ssFormName'=>$ssFormName,'ssSaveLink'=>$ssSaveLink));?>
<script type="text/javascript"> 
  var ssInterest = '<?php echo $ssInterest; ?>';
  var arInterest = ssInterest.split(',');
  for (var i=0;i< arInterest.length;i++) 
  { 
      if(document.getElementById('nomination_hobby_'+arInterest[i])) 
          document.getElementById('nomination_hobby_'+arInterest[i]).checked = true; 
  }
</script>