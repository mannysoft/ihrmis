<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="10" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
      <input name="Go" type="submit" id="Go" value="Go" />
      <input name="print2" type="submit" id="print2" value="Print" />
    </strong></th>
  </tr>
  <tr class="type-one-header">
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">Tardiness</th>
    <th colspan="2" bgcolor="#D6D6D6">Late</th>
    <th colspan="2" bgcolor="#D6D6D6">Undertime</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
  <tr class="type-one-header">
    <th width="8%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="16%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="9%" bgcolor="#D6D6D6">No of Tardiness </th>
    <th width="9%" bgcolor="#D6D6D6">No of Late </th>
    <th width="10%" bgcolor="#D6D6D6">Hours</th>
    <th width="11%" bgcolor="#D6D6D6">No of Undertime </th>
    <th width="10%" bgcolor="#D6D6D6">Hours</th>
    <th width="10%" bgcolor="#D6D6D6">Total</th>
    <th width="10%" bgcolor="#D6D6D6">VL Equivalent </th>
    <th width="7%" bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
  <?php 
  foreach($rows as $id)
  {				
		$tardiness = $this->Tardiness->count_tardiness($id, $month1, $year1, 1, 3);
		$tardiness2 = $this->Tardiness->count_tardiness($id, $month1, $year1, 2, 4);
		
		$total_tardiness = $tardiness['tardi_count'] + $tardiness2['tardi_count'];
		
		$late = $this->Tardiness->count_late($id, $month1, $year1, 1, 3);
		$underTime = $this->Tardiness->count_late($id, $month1, $year1, 2, 4);
		
		$totalLate = $this->Tardiness->compute_late_undertime('late', $id, $month1, $year1);
		$totalUnderTime = $this->Tardiness->compute_late_undertime('undertime', $id, $month1, $year1);
		
		$total = $late['number_seconds'] + $underTime['number_seconds'];
		
		if ($late['tardi_count'] == 0)
		{
			$late['tardi_count'] = '';
		}
		
		if ($underTime['tardi_count'] == 0)
		{
			$underTime['tardi_count'] = '';
		}
		
		$this->Employee->fields = array(
										'shift_type',
										'lname',
										'fname',
										'mname'
										);
		
		$name = $this->Employee->get_employee_info($id);
		
	 	//bg
		$bg 	= $this->Helps->set_line_colors();
		?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td bgcolor=""><?php echo $id;?></td>
    <td bgcolor=""><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td align="center" bgcolor=""><?php echo $total_tardiness;?></td>
    <td align="center" bgcolor=""><?php echo $late['tardi_count'];?></td>
    <td align="center" bgcolor=""><?php echo $this->Helps->compute_time($totalLate);?></td>
    <td align="center" bgcolor=""><?php echo $underTime['tardi_count'];?></td>
    <td align="center" bgcolor=""><?php echo $this->Helps->compute_time($totalUnderTime);?></td>
    <td align="center" bgcolor=""><?php echo $this->Helps->compute_time($total);?></td>
    <td align="center" bgcolor=""><?php echo $this->Conversion_table->compute_hour_minute($total);?></td>
    <td align="center" bgcolor=""><a href="#">DTR</a></td>
  </tr>
  <?php
		
		}
	  ?>
  <tr>
    <td></td>
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
  <tr>
    <td colspan="2"><!--<input type="submit" name="Submit" value="Submit" />-->
      <input name="print" type="submit" id="print" value="Print" /></td>
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
</form>