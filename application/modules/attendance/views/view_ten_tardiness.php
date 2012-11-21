<form method="post" action="">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="15" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <select name="month1" id="month1">
        <option value="01" <?php echo set_select('month1', '01'); ?>>January</option>
        <option value="07" <?php echo set_select('month1', '07'); ?>>July</option>
      </select>
to
<select name="month2" id="month2">
  <option value="06" <?php echo set_select('month2', '06'); ?>>June</option>
  <option value="12" <?php echo set_select('month2', '12'); ?>>December</option>
</select>
<?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
<input name="Go" type="submit" id="Go" value="Go" />
      <input name="print2" type="submit" id="print2" value="Print" />
    </strong>
    <?php 
	$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
	if ( $lgu_code == 'marinduque_province' )
	{
		$lgu_check = $this->input->post('all_tardiness') ? TRUE : FALSE;
		echo form_checkbox('all_tardiness', 'all_tardiness', $lgu_check);
		echo 'View all';
	}
	?></th>
  </tr>
  <tr class="type-one-header">
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th width="7%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="13%" bgcolor="#D6D6D6">&nbsp;</th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m1;?></th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m2;?></th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m3;?></th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m4;?></th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m5;?></th>
    <th colspan="2" bgcolor="#D6D6D6"><?php echo $m6;?></th>
  </tr>
  <tr class="type-one-header">
    <th width="2%" bgcolor="#D6D6D6">&nbsp;</th>
    <th colspan="2" bgcolor="#D6D6D6"><strong>Name</strong></th>
    <th width="6%" bgcolor="#D6D6D6">Tardy</th>
    <th width="6%" bgcolor="#D6D6D6">UT</th>
    <th width="6%" bgcolor="#D6D6D6">Tardy</th>
    <th width="5%" bgcolor="#D6D6D6">UT</th>
    <th width="7%" bgcolor="#D6D6D6">Tardy</th>
    <th width="6%" bgcolor="#D6D6D6">UT </th>
    <th width="7%" bgcolor="#D6D6D6">Tardy</th>
    <th width="7%" bgcolor="#D6D6D6">UT</th>
    <th width="7%" bgcolor="#D6D6D6">Tardy</th>
    <th width="7%" bgcolor="#D6D6D6">UT</th>
    <th width="6%" bgcolor="#D6D6D6">Tardy</th>
    <th width="8%" bgcolor="#D6D6D6">UT</th>
  </tr>
  <?php 
  
  $months = array();
  
   $last_month = $month2;
		
	while($last_month >= $month1)
	{
		$months[] = $last_month;
		$last_month --;
	}
	
	sort($months);
	
if (!empty($offices))
{
  	foreach($offices as $office)
	{		
		
			$office_name = $this->Office->get_office_name($office);
			
			$tardis = $employees[$office];
			
			//bg
			$bg 	= $this->Helps->set_line_colors();
			?>
	  <tr bgcolor="#D7FFD7" >
	    <td><input name="offices[]" type="checkbox" id="offices[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $office;?>"/></td>
		<td colspan="14"><a href="index.php?q=42&memo_office_id=<?php echo $office;?>"><em><?php echo $office_name;?></em></a></td>
	  </tr>
	  <?php 
	  foreach($tardis as $tardi)
	  {
	  	$this->Employee->fields = array(
										'employee_id',
										'id',
										'shift_type',
										'lname',
										'fname',
										'mname'
										);
		
		$name = $this->Employee->get_employee_info($tardi['employee_id'], $field ='');
	
		$late1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 1, 3);
		$late2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 1, 3);
		$late3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 1, 3);
		$late4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 1, 3);
		$late5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 1, 3);
		$late6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 1, 3);
		
		$under_time1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 2, 4);
		$under_time2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 2, 4);
		$under_time3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 2, 4);
		$under_time4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 2, 4);
		$under_time5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 2, 4);
		$under_time6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 2, 4);
		
		$late1['tardi_count'] = $this->Tardiness->is_tardy_zero($late1['tardi_count']);
		$late2['tardi_count'] = $this->Tardiness->is_tardy_zero($late2['tardi_count']);
		$late3['tardi_count'] = $this->Tardiness->is_tardy_zero($late3['tardi_count']);
		$late4['tardi_count'] = $this->Tardiness->is_tardy_zero($late4['tardi_count']);
		$late5['tardi_count'] = $this->Tardiness->is_tardy_zero($late5['tardi_count']);
		$late6['tardi_count'] = $this->Tardiness->is_tardy_zero($late6['tardi_count']);
		
		$under_time1['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time1['tardi_count']);
		$under_time2['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time2['tardi_count']);
		$under_time3['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time3['tardi_count']);
		$under_time4['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time4['tardi_count']);
		$under_time5['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time5['tardi_count']);
		$under_time6['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time6['tardi_count']);
		
		//echo '<pre>';
		//var_dump($late1);
		//echo '</pre>';
		
	  ?>
	  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
		onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'" style="border-bottom: 1px solid #999999;">
	    <td bgcolor="">&nbsp;</td>
	    <td colspan="2" bgcolor=""><?php echo $name['fname'].' '.$name['mname'].' '.$name['lname'];?></td>
		<td align="center" bgcolor=""><?php echo $late1['tardi_count'];?>&nbsp;</td>
		<td align="center" bgcolor=""><?php echo $under_time1['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $late2['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $under_time2['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $late3['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $under_time3['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $late4['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $under_time4['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $late5['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $under_time5['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $late6['tardi_count'];?></td>
		<td align="center" bgcolor=""><?php echo $under_time6['tardi_count'];?></td>
	  </tr>
	  <?php 
	  }
	  ?>
	  
	   <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center"><a href="#"></a></td>
	  </tr>
	  
	  <?php
		
		
		}
	}
	  ?>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td><input name="op" type="hidden" id="op" value="1" /></td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="15">
      <input name="print" type="submit" id="print" value="Print" />
      <input name="memo" type="submit" id="memo" value="Print Memo" /></td>
  </tr>
</table>
</form>