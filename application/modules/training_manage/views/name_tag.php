<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td align="right"><strong>Office:</strong></td>
    <td colspan="2"><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <div id="loading"></div></td>
    </tr>
  <tr>
    <td width="23%" align="right"><strong>Employee Name:</strong></td>
    <td width="29%"><select name="employee_id" id="employee_id">
      <option value="0">--All--</option>
      </select>
      <input type="submit" name="go" id="go" value="-- G O --" /></td>
    <td width="48%"><input name="active_tab_name_tag" type="hidden" id="active_tab_name_tag" value="<?php echo ($this->input->post('active_tabs')) ? $this->input->post('active_tabs') : $this->input->post('active_tab_name_tag')?>" /></td>
  </tr>
</table>
</form>
<!---->
<div class="clean-gray">
    <table width="100%" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td align="right">Employee Number:</td>
        <td align="left"><?php echo $employee->employee_id;?></td>
        <td align="right">Office/Department:</td>
        <td align="left"><?php echo office_name($employee->office_id);?></td>
        <td width="21%" rowspan="7" align="left" valign="top"><?php echo img($pics);?></td>
      </tr>
      <tr>
        <td align="right">Employe Name:</td>
        <td rowspan="2" align="left" valign="top"><?php echo $employee->lname.', '.$employee->fname.' '.$employee->mname;?></td>
        <td align="right">Employment Status:</td>
        <td>
		<?php 
		$employment = $this->options->type_employment(); 
		echo (isset($employment[$employee->permanent])) ? $employment[$employee->permanent] : '';;
		?></td>
      </tr>
      <?php if ($employee->id != ''):?>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="right" valign="middle">Employment Movement:</td>
        <td valign="middle"><?php echo $employment_movement;?></td>
      </tr>
      <tr>
        <td align="right">Birthday:</td>
        <td><?php echo $employee->birth_date;?></td>
        <td align="right" valign="middle">Educational Attainment:</td>
        <td align="left" valign="middle"><?php echo $employee->course;?></td>
      </tr>
      <tr>
        <td align="right">Start Date:</td>
        <td><?php echo $employee->first_day_of_service;?></td>
        <td align="right" valign="middle">&nbsp;</td>
        <td align="left" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">Sex:</td>
        <td><?php echo $employee->sex;?></td>
        <td align="right" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">Position/Designation:</td>
        <td width="22%" rowspan="2" align="left" valign="top"><?php echo $employee->position;?></td>
        <td align="left">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
      </tr>
      <tr>
        <td width="16%" align="right"><!--<a href="#" onclick="openBrWindow('<?php echo base_url();?>pds/training_preview/<?php echo $employee->id;?>','','scrollbars=yes,width=700,height=700');return false;" style="cursor: pointer;" title="PDS"/>Training Record Print Preview</a>--></td>
        <td width="17%" align="right" valign="middle">&nbsp;</td>
        <td width="24%" align="center" valign="middle">&nbsp;</td>
        <td width="21%" align="left" valign="top">&nbsp;</td>
      </tr>
      <?php endif;?>
    </table>
</div>
    <script>

$('#office_id').change(function(){

	
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>json/employees/' + office_id, null, function (data) {
				
		//data = [data];
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});
	

});

//$.colorbox({href:"<?php echo base_url().'json/haha'?>"});
//$.colorbox({href:"http://www.google.com"});

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
		
	$.getJSON('<?php echo base_url();?>json/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
				
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $employee->id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#employee_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
	});
	//alert("<?php echo $employee->id;?>")
	

});

</script>