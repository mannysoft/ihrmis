<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <?php if ( $employee_id != '' ):?>
    <a href="<?php echo base_url().'payroll/deduction/optional_save/0/'.$employee_id;?>">Add</a>
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
    <th width="5%">ID</th>
    <th width="25%">Description</th>
    <th width="11%">Start</th>
    <th width="13%">End</th>
    <th width="15%">Status</th>
    <th width="31%">Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deduction_information();
		
		$d->get_by_id( $deduction->deduction_information_id );
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $d->desc ;?></td>
        <td><?php echo $deduction->date_from;?></td>
        <td><?php echo $deduction->date_to;?></td>
        <td><?php echo $deduction->status?>&nbsp;</td>
        <td><a href="<?php echo base_url().'payroll/deduction/optional_save/'.$deduction->id.'/'.$employee_id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/deduction/optional_delete/'.$deduction->id.'/'.$employee_id;?>">Delete</a></td>
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
