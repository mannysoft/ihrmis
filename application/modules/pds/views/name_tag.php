<form action="<?php echo base_url()?>pds/employee_profile" method="post" class="myform">
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
      <!--<input type="submit" name="go" id="go" value="-- G O --" />--></td>
    <td width="48%"></td>
  </tr>
</table>
</form>
<!---->
<div class="clean-gray">
    <table width="100%" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td align="right">Employee Number:</td>
        <td align="left"><?php echo $employee->employee_id;?></td>
        <td width="29%" rowspan="7" align="center" valign="middle"><!--<img src="<?php echo base_url();?>pics/<?php echo $employee->pics;?>" />--></td>
      </tr>
      <tr>
        <td align="right">Employe Name:</td>
        <td align="left"><?php echo $employee->lname.', '.$employee->fname.' '.$employee->mname;?></td>
      </tr>
      <tr>
        <td align="right">Office/Department:</td>
        <td align="left"><?php echo office_name($employee->office_id);?></td>
      </tr>
      <tr>
        <td align="right">Position/Designation:</td>
        <td align="left"><?php echo $employee->position;?></td>
      </tr>
      <?php if ($employee->id != ''):?>
      <tr>
        <td align="right"><a href="#" onclick="openBrWindow('<?php echo base_url();?>pds/pds_print_preview/<?php echo $employee->id;?>','','scrollbars=yes,width=700,height=700');return false;" style="cursor: pointer;" title="PDS"/>PDS Print Preview</a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><a href="#" onclick="openBrWindow('<?php echo base_url();?>pds/sr_print_preview/<?php echo $employee->id;?>','','scrollbars=yes,width=700,height=700');return false;" style="cursor: pointer;" title="PDS"/>Service Record Print Preview</a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="35%" align="right"><a href="#" onclick="openBrWindow('<?php echo base_url();?>pds/training_preview/<?php echo $employee->id;?>','','scrollbars=yes,width=700,height=700');return false;" style="cursor: pointer;" title="PDS"/>Training Record Print Preview</a></td>
        <td width="36%">&nbsp;</td>
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

		var select = $('#employee_id');
		  select.html(select.find('option').sort(function(x, y) {
		    // to change to descending order switch "<" for ">"
		    return $(x).text() > $(y).text() ? 1 : -1;
		  }));

		  $('#employee_id').get(0).selectedIndex = 0;
	});

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});

$('#employee_id').change(function(){

	
	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}
	
	$('.myform').submit();

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

		var select = $('#employee_id');
		  select.html(select.find('option').sort(function(x, y) {
		    // to change to descending order switch "<" for ">"
		    return $(x).text() > $(y).text() ? 1 : -1;
		  }));

		  // select default item after sorting (first item)
  			$('#employee_id').val(<?php echo $employee->id;?>);
	});
	//alert("<?php echo $employee->id;?>")
	

});

</script>
