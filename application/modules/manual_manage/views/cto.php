<div id="messages"></div>
<div class="clean-green" style="display:none">Compensatory Timeoff has been saved!</div><br />
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="6" bgcolor="#D6D6D6">
    <?php //echo $no_record;?></th>
  </tr>
  <tr>
    <td width="15" align="right">&nbsp;</td>
    <td width="160" align="right"><strong>Emp ID/Last Name:</strong></td>
    <td width="455"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $employee_id;?>" size="20" autocomplete="off"/>
        <strong>
        <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td colspan="2" rowspan="11" align="left"><div id="outputtime">
      <input name="no_record" type="hidden" id="no_record" />
    </div></td>
    <td width="57" align="left">
	</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>
      <?php $js = 'id= "month4"';echo form_dropdown('month4', $month_options, $month_selected, $js);?>
<input name="multiple" type="text" class="ilaw" id="multiple" size="20" autocomplete="off"/>
<strong>
<?php $js = 'id= "year4"';echo form_dropdown('year4', $year_options, $year_selected, $js);?>
</strong></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Allow Sat. or Sun.:</strong></td>
    <td><input name="allow_sat_sun" type="checkbox" id="allow_sat_sun" value="1" /></td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="button" class="button" id="set_leave" value="Set CTO"/></td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
</table>
<div id="leave_card">

</div>
<script>

$(document).ready(function(){
 
	$('#month5').hide();
	$('#multiple5').hide();
	$('#year5').hide();
	
	var process = 0;
	
	show_leave_details(process); 
	
	$('#mone1').attr("disabled", true);
	$('#mone2').attr("disabled", true);
	$('#employee_id').focus();
});


$('#set_leave').click(function(){

	$('#messages').removeClass("clean-red");
	$('#messages').html('');
	//alert("set_leave");
	show_leave_details(1); 

});


$("#employee_id").keyup(function(){
 
	show_leave_details(0); 
});

$("#multiple").keyup(function(){
 
	show_leave_details(0); 
});

$('#month4').change(function(){

	show_leave_details(0);
});

$('#year4').change(function(){

	show_leave_details(0);
});

$('#allow_sat_sun').click(function(){

	show_leave_details(0);
});

function show_leave_details(process)
{	
	$('#outputtime').html("Loading..");
	
	$('#messages').removeClass("clean-red");
	$('#messages').html('');
	
	var employee_id = '';
	var multiple = '';
	
	var allow_sat_sun = 0;
	
	if ($('#allow_sat_sun').attr("checked") == true)
	{
		allow_sat_sun = 1;
	}
	
	if (process != 0 )
	{
		//if invalid employee id
		if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined)
		{
			//alert("Please enter a valid employee ID.");
			$('#messages').addClass("clean-red");
			$('#messages').html('Please enter a valid employee ID!');
			
			$('#employee_id').focus();
			return
		}
		
		if ($('#multiple').val() == '' )
		{
			$('#messages').addClass("clean-red");
			$('#messages').html("Invalid date(s)!");
			$('#multiple').focus();
			return false;
		}
	}
			
	$.post("<?php echo base_url().('ajax/file_cto/'); ?>", 
			
			{	
				employee_id:$('#employee_id').val(), 
				multiple:$('#multiple').val(), 
				month:$('#month4').val(), 
				year:$('#year4').val(), 
				allow_sat_sun:allow_sat_sun, 
				process:process
			}, 
			function(data) {
	  		$('#outputtime').html(data);
	});
	
	// View leave card if not leave manager
	<?php if ($this->session->userdata('user_type') != 5): ?>
	// Show leave card 
	$('#leave_card').load("<?php echo base_url().('ajax/show_cto/'); ?>" + $('#employee_id').val());
	<?php endif; ?>
	
	return
	//===============================================================================
	
}


function change_value2(new_value)
{
	$('#employee_id').val(new_value)
	show_leave_details();
	show_leave_card(new_value)
	
}

function change_value(new_value)
{
	
	//$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
	show_leave_details()
}

function print_preview(leave_apps_id)
{
	openBrWindow('<?php echo base_url();?>reports/cto_apps/'+leave_apps_id,'','scrollbars=yes,width=900,height=600');
	//alert(param)
}

</script>