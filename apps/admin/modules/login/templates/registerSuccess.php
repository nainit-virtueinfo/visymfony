<?php 
		$param = ($snId !='') ? 'id='.$snId:'';  
		echo $form->renderFormTag('/login/register'.(($param !='')? '?'.$param:''));
 ?>
  <?php foreach ($form as $field): ?>
    <li>
      <?php echo $field->renderLabel() ?>
      <?php echo $field->render() ?>
	  <?php echo $field->renderError() ?>
    </li>
  <?php endforeach; ?>
  <table>
	<tr>
      <td colspan="2">
        <input type="submit" />
      </td>
    </tr>
  </table>
 </form>