<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>Office:</td>
    <td><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?></td>
    <td>Employee Name:</td>
    <td>
    <select name="employee_id" id="employee_id">
      <option value="0">--All--</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Agency:</td>
    <td><select name="agency_id" id="agency_id">
    <option value="0">--All--</option>
      <?php foreach ($agencies as $agency): ?>
      <option value="<?=$agency->id;?>">
        <?=$agency->agency_name;?>
        </option>
      <?php endforeach; ?>
    </select></td>
    <td>Deduction:</td>
    <td>&nbsp;</td>
    <td>Status:
      <select name="status" id="status">
        <option value="0">--All--</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    <input type="submit" name="go" id="go" value="Go" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll_deductions/loan_save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="14%">&nbsp;</td>
    <td width="14%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="48%"></td>
    <td width="6%"></td>
  </tr>
</table>
</form>
<div id="loan_list">
<?php $this->load->view('ajax/loan_list'); ?>
</div>

<script>

$('#office_id').change(function(){

	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>json/employees/' + office_id, null, function (data) {
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		//$('#price').empty().append("<option value=''>--Select Price--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});
	
	
	return 
	
	
	$('#loan_list').html("Loading...");
	$('#loan_list').load("<?php echo base_url().'payroll_deductions/loan/1';?>");

});


$('#go').click(function(){

	//$('#office_id')
	
	$('#loan_list').html('<?php echo loading_image();?>');
	
	$('#loan_list').load("<?php echo base_url().'payroll_deductions/ajax_loan_list/1/1/1/1/';?>");
	
	return false;
	
});
</script>