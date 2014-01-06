<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form method="post" action="">
<table width="100%" border="0" class="type-one">
      <tr>
        <td width="20%">
        <?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?></td>
        <td width="71%"></td>
  </tr>
    	</table></form>
		
		<div id="employee_list" style="display:block">
		</div>
        
  
<script>

$(document).ready(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('ajax/show_cto_balance/'); ?>" );
});

$('#employee_id').keyup(function(){

	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		return
	}
	else
	{
	
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
	}
});

$('#office_id').change(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('ajax/show_cto_balance/');?>"+$('#office_id').val() );
});


function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);	
	$('#employee_id').val(new_value);
}
</script>