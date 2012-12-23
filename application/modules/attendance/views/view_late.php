<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="6" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <input name="date2" type="text" id="date2" value="<?php echo $date;?>" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input type="submit" name="button" id="button" value="Go" />
      <input name="op" type="hidden" id="op" value="1" />
    </strong></th>
  </tr>
  <tr class="type-one-header">
    <th width="14%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="27%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="12%" bgcolor="#D6D6D6">AM Login </th>
    <th width="12%" bgcolor="#D6D6D6">AM Logout </th>
    <th width="12%" bgcolor="#D6D6D6">PM Login </th>
    <th width="12%" bgcolor="#D6D6D6">PM Logout </th>
  </tr>
  <?php
 	foreach ($rows as $row) 
	{
		$employeeId = $row['employee_id'];
		$amLogin	= $row['am_login'];
		$amLogout	= $row['am_logout'];
		$pmLogin	= $row['pm_login'];
		$pmLogout	= $row['pm_logout'];
		
		$this->Employee->fields = array(
										'shift_type',
										'lname',
										'fname',
										'mname'
										);
		
		$name 		= $this->Employee->get_employee_info($employeeId);
		
		//If shift type is equal to 1 or regular working hours
		if ($name['shift_type'] == 1)
		{
			//Tell if log is pm or not
			$isLogPm = FALSE;
		
			$amLogin = $this->Helps->set_font_red($amLogin, "08:00", $isLogPm);
			
			//Tell if log is pm or not
			$isLogPm = TRUE;
			
			$pmLogin = $this->Helps->set_font_red($pmLogin, "13:00", $isLogPm);
		}

	 	//bg
		$bg 		= $this->Helps->set_line_colors();
		?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
    <td bgcolor=""><?php echo $employeeId;?></td>
    <td bgcolor=""><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td align="center" bgcolor=""><?php echo $amLogin;?></td>
    <td align="center" bgcolor=""><?php echo $amLogout;?></td>
    <td align="center" bgcolor=""><?php echo $pmLogin;?></td>
    <td align="center" bgcolor=""><?php echo $pmLogout;?></td>
  </tr>
  <?php
		
		}
	  ?>
  <tr>
    <td colspan="6"><!--<input type="submit" name="Submit" value="Submit" />--></td>
  </tr>
</table>
</form>
<script>
$('#office_id').change(function(){

	$('#myform').submit();
	
});
</script>