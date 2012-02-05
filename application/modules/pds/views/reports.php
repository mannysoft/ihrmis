<?php 

//http://jquery.com/demo/thickbox/

if ($pop_up == 1){
	
	//exit;
	
?>
<script src="<?php echo base_url();?>js/function.js"></script>
<script>openBrWindow('<?php echo base_url().$report_file;?>','','scrollbars=yes,width=900,height=700')</script>

<?php
}
?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td width="22%" align="right"><?php 
		//$js = 'id = "search_by"';
		//echo form_dropdown('search_by', $options, $selected, $js); ?>
      <?php 
		//$js = 'id = "search_key"';
		//echo form_dropdown('search_key', $search_key_options, $search_key_selected, $js); ?></td>
    <td width="55%">&nbsp;</td>
    <td width="12%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Last Name:</td>
    <td><input name="lname" type="text" id="lname" value="<?php echo $this->input->post('lname');?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">First Name:</td>
    <td><input name="fname" type="text" id="fname" value="<?php echo $this->input->post('fname');?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Position/Designation:</td>
    <td><input name="position" type="text" id="position" value="<?php echo $this->input->post('position');?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Employment Status:</td>
    <td><span class="type-one"><?php echo form_dropdown('permanent', $permanent_options, $permanent_selected); ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Office/Department:</td>
    <td><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Salary Grade:</td>
    <td><input name="salary_grade" type="text" id="salary_grade" value="<?php echo $this->input->post('salary_grade');?>" size="4" />
      Ex: 18-5</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Number of Years in service:</td>
    <td><input name="years_service" type="text" id="years_service" value="<?php echo $this->input->post('years_service');?>" size="4" />
      <?php //$js = 'id = "years_service_above"';echo form_dropdown('years_service_above', $years_service_above_options, $years_service_above_selected, $js);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Civil Service Eligibility: </td>
    <td><input name="eligibility" type="text" id="eligibility" value="<?php echo $this->input->post('eligibility');?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Course:</td>
    <td><input name="course" type="text" id="course" value="<?php echo $this->input->post('course');?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Age:</td>
    <td><input name="age" type="text" id="age" value="<?php echo $this->input->post('age');?>" size="4" />
      <?php //$js = 'id = "age_above"';echo form_dropdown('age_above', $age_above_options, $age_above_selected, $js);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Sex:</td>
    <td><input name="sex" type="text" id="sex" value="<?php echo $this->input->post('sex');?>" size="4" />
      ex: M or F</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Address:</td>
    <td><input name="location" type="text" id="location" value="<?php echo $this->input->post('location');?>" /></td>
    <td colspan="2">Report Name:
      <input name="report_name" type="text" id="report_name" value="<?php echo $this->input->post('report_name');?>" /></td>
    </tr>
  <tr>
    <td align="right"><input type="button" name="Button" id="reset" value="Reset" /></td>
    <td><input type="submit" name="search" id="search" value="Search" />
      <input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="search_preview" id="search_preview" value="Search and Print Preview" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<table width="100%" border="0" class="type-one">
  <tr>
    <th width="6%">Emp ID</th>
    <th width="11%">Name</th>
    <th width="4%">Sex</th>
    <th width="14%">Position/Designation</th>
    <th width="13%">Office</th>
    <th width="10%">Employment Status</th>
    <th width="6%">SG</th>
    <th width="7%">Eligibility</th>
    <th width="13%">Education</th>
    <th width="8%">Birthday</th>
    <th width="8%">Address</th>
  </tr>
  <?php $office = new Orm_office();?>
  
  <?php foreach ($rows as $row):?>
  <?php $bg = $this->Helps->set_line_colors();?>
  	<?php $office->get_by_office_id($row->office_id);?>
    <?php $type_employment = $this->options->type_employment();?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
        onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td><?php echo $row->id;?></td>
    <td><?php echo $row->lname.', '.$row->fname;?></td>
    <td><?php echo $row->sex;?></td>
    <td><?php echo $row->position;?></td>
    <td><?php echo $office->office_name;?></td>
    <td><?php echo $type_employment[$row->permanent];?></td>
    <td><?php echo $row->salary_grade.'-'.$row->step;?></td>
    <td><?php echo $row->eligibility;?></td>
    <td><?php echo $row->course;?></td>
    <td><?php echo $row->birth_date;?></td>
    <td><?php echo $row->res_address;?></td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
$('#search_by').change(function(){

	alert("");
	return false;
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$('#reset').click(function(){

	
	$('#lname').val("");
	$('#fname').val("");
	$('#position').val("");
	$('#permanent').val("");
	$('#office_id').val("");
	$('#salary_grade').val("");
	$('#age').val("");
	$('#sex').val("");
	$('#years_service').val("");
	$('#eligibility').val("");
	$('#course').val("");
	$('#location').val("");
	$('#years_service_above').val("");
	

});

</script>