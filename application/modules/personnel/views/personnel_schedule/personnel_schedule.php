<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form method="post" action="">
<table width="100%" border="0" class="type-one">
      <tr>
        <td width="70%">
        <?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?>
        <strong>
        <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
        </strong></td>
        <td width="30%"></td>
	</tr>
</table>
</form>
		
		<div id="employee_list" style="display:block">
		</div>
        
  
<script>

$(document).ready(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('personnel/plantilla_ajax/plantilla/'.$selected.'/'.$year_selected); ?>" );
});

$('#office_id').change(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('personnel/plantilla_ajax/plantilla/'); ?>" +$('#office_id').val() + "/" + $('#year').val());
});

$('#year').change(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('personnel/plantilla_ajax/plantilla/'); ?>" +$('#office_id').val() + "/" + $('#year').val());
});


</script>