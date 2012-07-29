<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
}
-->
</style>
<form action="" method="post">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="6" bgcolor="#D6D6D6">
    <?php echo $msg;?><?php echo $this->session->flashdata('msg');?></th>
  </tr>
  <tr>
    <td colspan="2" align="right">
    <strong>Emp ID/Last Name:</strong></td>
    <td width="43%"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" onkeyup="ob_log(this.form);" value="" size="20" autocomplete="off"/>
        <strong>
<input name="action" type="hidden" id="action" value="<?php echo $this->input->get('q'); ?>" />
  <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
    <td colspan="2" rowspan="8" align="left"><div id="outputtime"></div></td>
    <td width="17%" rowspan="8" align="left">
	<div id="employees">
	</div></td>
  </tr>
  <tr>
    <td width="2%" align="right">&nbsp;</td>
    <td width="12%" align="right"><strong>Period:
      <input name="whole" type="checkbox" id="whole" value="1"/>
    </strong></td>
    <td><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      </strong><strong>
      <?php $js = 'id= "day"';echo form_dropdown('day', $days_options, $days_selected, $js);?>
      </strong><strong>
      <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
      </strong><strong>
    <input name="this_date_only" type="checkbox" id="this_date_only" value="1" onclick="ob_log(this.form)" />
          this date only(for 1 day) </strong></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><strong>
      <?php $js = 'id= "month2"';echo form_dropdown('month2', $month_options, $month_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "day2"';echo form_dropdown('day2', $days_options, $days_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year2"';echo form_dropdown('year2', $year_options, $year_selected, $js);?>
    </strong></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Half day:
      <input name="half" type="checkbox" id="half" value="1" />
    </strong></td>
    <td><strong>
      <?php $js = 'id= "month3" disabled="disabled"';echo form_dropdown('month3', $month_options, $month_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "day3" disabled="disabled"';echo form_dropdown('day3', $days_options, $days_selected, $js);?>
    </strong><strong>
    <?php $js = 'id= "year3" disabled="disabled"';echo form_dropdown('year3', $year_options, $year_selected, $js);?>
    </strong></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><select name="am_or_pm" id="am_or_pm" disabled="disabled" onchange="ob_log(this.form)">
      <option value="AM">AM</option>
      <option value="PM">PM</option>
    </select>
      <input name="hour" type="hidden" id="hour" />
      <input name="minute" type="hidden" id="minute" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Notes:</strong></td>
    <td><input name="notes" type="text" class="ilaw" id="notes" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="" size="40" onkeyup="ob_log(this.form)" />
        <input name="execute_half" type="hidden" id="execute_half" value="0" />
        <input name="operation" type="hidden" id="operation" value="14" /></td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>
    <input name="Submit" type="submit" class="button" value="Set OB"/></td>
  </tr>
 
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>
      <strong>
      <input name="multiple_check" type="hidden" id="multiple_check" value="1"/>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input name="include_hidden" type="checkbox" id="include_hidden" onclick="this.form.submit()" value="1" <?php //echo $checked;?>/>
    Include Hidden</label></td>
    <td></td>
    <td width="15%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="type-one-header">
    <th bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('ob', '1');" value="1" /></th>
    <th bgcolor="#D6D6D6"><strong>Employee No. </strong></th>
    <th bgcolor="#D6D6D6"><strong>Employee Name </strong></th>
    <th bgcolor="#D6D6D6"><strong>Period</strong></th>
    <th bgcolor="#D6D6D6"><strong>Place</strong></th>
    <th bgcolor="#D6D6D6"><span style="font-weight: bold">Actions</span></th>
  </tr>
  <?php
  
	$include_hidden = 0;
	
	if(isset($_POST['include_hidden']))
	{
		$include_hidden = 1;
	}
	
	$rows = $this->Manual_log->office_manual_log($this->session->userdata('office_id'), $log_type = 1, 0);
	
	foreach($rows as $row)
	{
		$manual_log_id 					= $row['id'];
		$employee_id 					= $row['employee_id'];
		$log_type 						= $row['log_type'];
		$cover_if_ob_or_leave 			= $row['cover_if_ob_or_leave'];
		$cover_if_ob_or_leave2 			= $row['cover_if_ob_or_leave2'];
		$notes 							= $row['notes'];
		$name 							= $this->Employee->get_employee_info($employee_id);
		$office_id	  					= $row['office_id'];
			
		$bg = $this->Helps->set_line_colors();
	  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#EDFEF1'" onclick="this.bgColor = 'RED'"
    onmouseout ="this.bgColor = '<?php echo $bg;?>'">
    <td><input name="ob[]" type="checkbox" id="ob[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $manual_log_id;?>"/></td>
    <td><?php echo $employee_id;?></td>
    <td><?php echo $name['fname'].' '.$name['mname'].' '.$name['lname'];?></td>
    <td><?php echo $cover_if_ob_or_leave.' to '.$cover_if_ob_or_leave2;?></td>
    <td><?php echo $notes;?></td>
    <td align="right"><a href="<?php echo base_url();?>manual_manage/delete_ob/<?php echo $manual_log_id;?>" class="delete_ob">Delete</a></td>
  </tr>
  <?php
  } 
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script>
$('#whole').click(function(){

	if ($('#whole').attr("checked") == true)
	{
		//enable elements
		$('#month3').attr("disabled", true);
		$('#day3').attr("disabled", true);
		$('#year3').attr("disabled", true);
		$('#hour').attr("disabled", true);
		$('#minute').attr("disabled", true);
		$('#am_or_pm').attr("disabled", true);
		
		//disable the elements
		$('#month').attr("disabled", false);
		$('#day').attr("disabled", false);
		$('#year').attr("disabled", false);
		$('#month2').attr("disabled", false);
		$('#day2').attr("disabled", false);
		$('#year2').attr("disabled", false);
		
		//disable the checkbox
		$('#whole').attr("disabled", true);
		
		//enable
		$('#half').attr("checked", false);
		$('#half').attr("disabled", false);
		$('#execute_half').val(0);
		
	}
	
});

$('#half').click(function(){

	if ($('#half').attr("checked") == true)
	{
		//enable elements
		$('#month3').attr("disabled", false);
		$('#day3').attr("disabled", false);
		$('#year3').attr("disabled", false);
		$('#hour').attr("disabled", false);
		$('#minute').attr("disabled", false);
		$('#am_or_pm').attr("disabled", false);
		
		//disable the elements
		$('#month').attr("disabled", true);
		$('#day').attr("disabled", true);
		$('#year').attr("disabled", true);
		$('#month2').attr("disabled", true);
		$('#day2').attr("disabled", true);
		$('#year2').attr("disabled", true);
		
		//enable the checkbox
		$('#whole').attr("checked", false);
		
		//enable
		$('#half').attr("checked", false);
		$('#whole').attr("disabled", false);
		$('#execute_half').val(1);
			
	}
	
});

$('.delete_ob').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});

</script>