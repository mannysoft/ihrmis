<?php if (validation_errors() || $error_msg != ''): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif ($this->session->flashdata('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form method="post" action="">
<table width="100%" border="0" class="type-one">
      <tr>
        <td>&nbsp;</td>
        <td rowspan="6"><div id="outputname"><img src="images/spacer.gif" /><br />
          <font color="#FFFFFF">.</font></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr class="type-one-header">
        <th width="20%" bgcolor="#D6D6D6">&nbsp;</th>
        <th width="71%" bgcolor="#D6D6D6"></th>
  </tr>
      <tr>
        <td align="right"><strong>Employee No./Last Name:
            <input name="op" type="hidden" id="op" value="1" />
        </strong></td>
        <td><input name="employee_id" type="text" id="employee_id" value="<?php //echo $employee_no; ?>" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
          <strong>
          <input name="month" type="hidden" id="month" value="1" />
          <input name="period_from" type="hidden" id="period_from" value="1" />
          <input name="period_to" type="hidden" id="period_to" value="1" />
          <input name="year" type="hidden" id="year" value="1" />
          </strong></td>
      </tr>
      <tr>
        <td align="right"><strong>Vacation Leave Balance:</strong> </td>
        <td><input name="vacation" type="text" id="vacation"  class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      </tr>
      <tr>
        <td align="right"><strong>Sick Leave Balance:</strong></td>
        <td><input name="sick" type="text" id="sick"  class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      </tr>
      <tr>
        <td align="right"><strong>As of:</strong></td>
        <td><input name="forwarded_note" type="hidden" id="forwarded_note"  class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
        <input name="lname" type="hidden" id="lname" />
        <input name="fname" type="hidden" id="fname" />
        <strong>
        <?php $lgu_code = $this->Settings->get_selected_field( 'lgu_code' );?>
        <?php $js = 'id= "month2"';echo form_dropdown('month2', $month_options, $month_selected, $js);?>
        </strong><strong>
        <?php $js = 'id= "day2"';echo form_dropdown('day2', $days_options, $days_selected, $js);?>
        </strong><strong>
        <?php if($lgu_code == 'laguna_province'):?>
			<?php $js = 'id= "year2" size="4" autocomplete="off" class="ilaw" maxlength="4"';echo form_input('year2', '', $js);?>
        <?php else:?>
        	<?php $js = 'id= "year2"';echo form_dropdown('year2', $year_options, $year_selected, $js);?>
        <?php endif;?>
        </strong></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input name="view_dtr" type="submit" class="button" id="view_dtr" onclick="please_wait();" value="Update Leave"/></td>
      </tr>
      <tr>
        <td><input type="checkbox" name="checkbox" value="checkbox" tabindex="1" id="checkbox" onclick="show_hide_office('employee_list', this)"/>
        <label for="checkbox">Show Offices<strong></strong></label>
        <?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); ?></td>
        <td></td>
  </tr>
    	</table></form>
		
		<div id="employee_list" style="display:block">
		</div>

<script>

$(document).ready(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('ajax/show_leave_forwarded/'); ?>" );
});

$('#employee_id').keyup(function(){

	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
	{
		//alert("Please enter a valid employee no.");
		$('#outputname').html("Please enter a valid employee no.");
		return
	}
	else
	{
	
		$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + $('#employee_id').val());
	}
});

$('#office_id').change(function(){

	$('#employee_list').html("<b>Loading...</b>");
	$('#employee_list').load("<?php echo base_url().('ajax/show_leave_forwarded/'); ?>" + $(this).val());
});


function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	
	// Show leave card 
	//$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + new_value);
	
	$('#employee_id').val(new_value);
}
</script>