<form method="post" action="" id="myform">
<table width="100%" border="0">
  <tr>
    <td align="right"><strong>Employee ID.:
    </strong></td>
    <td width="39%"><strong>
      <input name="employee_id" type="text" id="employee_id" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td width="37%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight: bold">Employee last Name:</span> </td>
    <td><strong>
      <input name="lname" type="text" id="lname" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
    </strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="24%" align="right">
    <strong>Office:</strong></td>
    <td colspan="2"><?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?>
      <div id="loading"></div></td>
    </tr>
</table>
</form>
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="11%"><strong>Employee ID </strong></th>
    <th width="23%"><strong>Employee Name </strong></th>
    <th width="30%">Office</th>
    <th width="25%"><strong>Leave Credits </strong></th>
    <th width="11%">History</th>
  </tr>
  <?php
  
  if (!empty($rows))
  {
  
  foreach($rows as $row)
  {
		$id 		= $row['id'];
		$employee_id 		= $row['employee_id'];
		
		//total leave 
		$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);
		
		$office_name = $this->Office->get_office_name($row['office_id']);
		
		$bg = $this->Helps->set_line_colors();
		
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td><?php echo $row['employee_id'];?></td>
    <td><?php echo $row['lname'].', '.$row['fname'].' '.$row['mname'];?></td>
    <td><?php echo $office_name;?></td>
    <td onmouseover="Tip('<center>VL = <?php echo  number_format($total_leave['vacation'], 3);?><br>SL = <?php  echo number_format($total_leave['sick'], 3);?><br>Total = <?php echo number_format($total_leave['sick'] + $total_leave['vacation'], 3);?></center>', SHADOW, true, TITLE, 'Computation')" onmouseout="UnTip()">Total = <?php echo number_format($total_leave['sick'] + $total_leave['vacation'], 3);
	
	//Update the leave credits
	$is_leave_balance_exists = $this->Leave_balance->is_leave_balance_exists($row['employee_id']);
	
	$format_sick_leave = number_format($total_leave['sick'], 3);
	$format_vacation_leave = number_format($total_leave['vacation'], 3);
	
	$office = $this->Office->get_office_info($row['office_id']);
	
	if ($row['salary_grade'] != '-' && $row['salary_grade'] != '')
	{
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		$monetary = $this->Salary_grade->monetary_equivalent($row['salary_grade'], 
															 $row['step'], 
															 $format_sick_leave,
															 $format_vacation_leave, 
															 2010
															 );
	}			
	//If exists just update
	if ($is_leave_balance_exists == TRUE)
	{
		$this->Leave_balance->update_leave_balance($row['employee_id'], $format_sick_leave, 
		$format_vacation_leave, $monetary);
	}
	//Insert
	else
	{
		$this->Leave_balance->insert_leave_balance($row['employee_id'], $format_sick_leave, 
		$format_vacation_leave, $monetary);
	}
	
	$cert_no = $this->Settings->get_selected_field('certification_no');
	$state_no = $this->Settings->get_selected_field('statement_no');
	
	?></td>
    <td><img src="<?php echo base_url();?>images/certificate_report_certificate.png" title="Certification of Vacation and Sick Leave Creadits"  style="cursor: pointer;" onclick="openBrWindow('<?php echo base_url();?>reports/leave_certification/<?php echo $total_leave['vacation'].'/'.$total_leave['sick'].'/'.$employee_id;?>','','scrollbars=yes,width=700,height=700')"/>
    
    &nbsp;<img src="<?php echo base_url();?>images/poll_poll.png" title="Statement of Vacation and Sick Leave Creadits" onclick="openBrWindow('<?php echo base_url();?>reports/statement_leave/<?php echo $state_no.'/'.$employee_id;?>','','scrollbars=yes,width=700,height=700')" style="cursor: pointer;"/>
    
    <img src="<?php echo base_url();?>images/classevent_main.png" title="History" onClick="openBrWindow('<?php echo base_url();?>leave_manage/leave_card/<?php echo $employee_id;?>','','scrollbars=yes,width=900,height=600')" style="cursor: pointer;"/></td>
  </tr>
  
  <?php 
  
  }
  
  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
$('#office_id').change(function(){

	$('#myform').submit();
	$('#loading').html("Loading...");
	
});

$('#leave_certification').click(function(){

	
	
});
</script>