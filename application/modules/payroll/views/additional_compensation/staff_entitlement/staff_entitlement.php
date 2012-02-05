<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <?php if ( $employee_id != '' ):?>
    <a href="<?php echo base_url().'payroll/additional_compensation/staff_entitlement_save/0/'.$employee_id;?>">Add</a>
     <?php endif;?>
    </td>
  </tr>
  <tr>
    <td width="19%"><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?></td>
    <td width="68%"><select name="employee_id" id="employee_id">
      <option value="0">--All--</option>
    </select>
    <input type="submit" name="go" id="go" value="Go" />&nbsp;
    <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="13%"></td>
  </tr>
</table>
</form>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="4%">ID</th>
    <th width="20%">Additional Compensation</th>
    <th width="9%">Start</th>
    <th width="10%">End</th>
    <th width="12%">Amount</th>
    <th width="27%">Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Additional_compensation_m();
		
		$d->get_by_id( $deduction->additional_compensation_id );
				
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $d->name;?></td>
        <td><?php echo $deduction->effectivity_date;?></td>
        <td><?php echo $deduction->ineffectivity_date;?></td>
        <td align="right"><?php echo number_format($deduction->amount, 2)?>&nbsp;</td>
        <td><a href="<?php echo base_url().'payroll/additional_compensation/staff_entitlement_save/'.$deduction->id.'/'.$employee_id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/additional_compensation/staff_entitlement_delete/'.$deduction->id.'/'.$employee_id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td><?php echo $this->pagination->create_links();?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
    <script>

$('#office_id').change(function(){

	
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});


$(document).ready(function(){

	
	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $employee_id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#employee_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
		
		$('#employee_id').sort();
	});
	

});

</script>
