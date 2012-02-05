<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif ($this->session->flashdata('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div><br />
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
	$('#employee_list').load("<?php echo base_url().('payroll/ajax/tax/'); ?>" );
});

$('#office_id').change(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('payroll/ajax/tax/');?>"+$('#office_id').val() );
});

</script>