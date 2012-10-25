<div id="messages"></div>
<div class="clean-green" style="display:none">Leave has been saved!</div><br />
<form action="" onsubmit="return false">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="7" bgcolor="#D6D6D6">
    <?php //echo $no_record;?></th>
  </tr>
  <tr>
    <td width="15" align="right">&nbsp;</td>
    <td width="160" align="right"><strong>Emp ID/Last Name:</strong></td>
    <td width="481"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo $employee_id;?>" size="20" autocomplete="off"/>
        <strong>
        <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td colspan="2" rowspan="11" align="left" valign="top"><div id="outputtime">
      <input name="no_record" type="hidden" id="no_record" />
    </div></td>
    <td width="10" rowspan="11" align="left"><img src="<?php echo base_url(); ?>images/blank.gif" width="10" height="320"/></td>
    <td width="1" align="left">
	</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Date:</strong></td>
    <td>
      <?php $lgu_code = $this->Settings->get_selected_field( 'lgu_code' );?>
      
      <?php if($lgu_code == 'laguna_province'):?>
      <?php $js = 'id= "month4_extra" size="3" autocomplete="off" class="ilaw" maxlength="2"';echo form_input('month4', '', $js);?>
      <?php else:?>
      <?php $js = 'id= "month4"';echo form_dropdown('month4', $month_options, $month_selected, $js);?>
      <?php endif;?>
      
  <input name="multiple" type="text" class="ilaw" id="multiple" size="20" autocomplete="off"/>
  <strong>
    <?php if($lgu_code == 'laguna_province'):?>
    <?php $js = 'id= "year4_extra" size="4" autocomplete="off" class="ilaw" maxlength="4"';echo form_input('year4_extra', '', $js);?>
    <?php else:?>
    <?php $js = 'id= "year4"';echo form_dropdown('year4', $year_options, $year_selected, $js);?>
    <?php endif;?>
    
</strong></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>
      <?php //$js = 'id= "month5"';echo form_dropdown('month5', $month_options, $month_selected, $js);?>
      
      <?php if($lgu_code == 'laguna_province'):?>
      <?php $js = 'id= "month5_extra" size="3" autocomplete="off" class="ilaw" maxlength="2"';echo form_input('month5', '', $js);?>
      <?php else:?>
      <?php $js = 'id= "month5"';echo form_dropdown('month5', $month_options, $month_selected, $js);?>
      <?php endif;?>
      
      <input name="multiple5" type="text" class="ilaw" id="multiple5" size="20" autocomplete="off"/>
      <?php //$js = 'id= "year5"';echo form_dropdown('year5', $year_options, $year_selected, $js);?>
      
      <?php if($lgu_code == 'laguna_province'):?>
      <?php $js = 'id= "year5_extra" size="4" autocomplete="off" class="ilaw" maxlength="4"';echo form_input('year5_extra', '', $js);?>
      <?php else:?>
      <?php $js = 'id= "year5"';echo form_dropdown('year5', $year_options, $year_selected, $js);?>
      <?php endif;?>
      
      <input type="button" name="button" id="more_months" value="More Month" />
      <input name="more_months_enabled" type="hidden" id="more_months_enabled" value="0" /></td>
    <td width="1" align="left">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Type of Leave</strong> </td>
    <td><?php //echo $this->Leave_type->leave_type_list();?>
      <?php $js = 'id= "leave_type_id"';echo form_dropdown('leave_type_id', $leave_type_options, $leave_type_selected, $js);?>
  <input name="days" type="text" disabled="disabled" id="days" size="3" maxlength="7" autocomplete="off"/>
      <input name="mone" type="radio" id="mone1" value="1" checked="checked" />
      <label for="radiobutton">VL</label>
      <input name="mone" type="radio" value="2" id="mone2" />
      <label for="radio">SL</label>
      <br />
      <?php echo form_dropdown('special_priv_id', $this->leave->special_priv(TRUE), '', 'id="special_priv_id" disabled="disabled"');?>
      </td>
    <td width="1" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Allow Sat. or Sun.:</strong></td>
    <td><input name="allow_sat_sun" type="checkbox" id="allow_sat_sun" value="1" /></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>
      <?php if ($hospital_view_leave_days == 1): ?>
      Days Equivalent:<input name="hospital_leave_days" type="text" id="hospital_leave_days" size="3" maxlength="7" /> For hospital use only
      <?php endif; ?>
    </td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="submit" class="button" id="set_leave" value="Set Leave"/></td>
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
    <td>
    <?php $show_calendar = $this->Settings->get_selected_field( 'show_calendar' );?>
    <?php if($show_calendar == 'yes'):?>
    <input name="first_day_of_service" type="text" id="first_day_of_service" value="" size="10"/>
      &nbsp; <img src="<?php echo base_url(); ?>images/img.gif" width="20" height="14" align="middle" class="calimg" id="f_trigger_a" style="" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
		    Calendar.setup({
	          inputField     :    "first_day_of_service",     // id of the input field
	          ifFormat       :    "%Y-%m-%d", // format of the input field
	          button         :    "f_trigger_a",  // trigger for the calendar (button ID)
	          align          :    "Bl",    // alignment (defaults to "Bl")
	          singleClick    :    true
		    });
		</script>
       <?php endif;?>
        </td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="1" align="left">&nbsp;</td>
  </tr>
</table>
</form>
<div id="leave_card">

</div>
<script>



$(document).ready(function(){
 
	$('#month5').hide();
	$('#multiple5').hide();
	$('#year5').hide();
	
	$('#month5_extra').hide();
	//$('#multiple5').hide();
	$('#year5_extra').hide();
	
	show_leave_details(); 
	
	$('#mone1').attr("disabled", true);
	$('#mone2').attr("disabled", true);
	$('#employee_id').focus();
});







$("#more_months").click(function(){
 
	if ($('#more_months').val() == "More Month")
	{
		$('#more_months_enabled').val("1");
		$("#more_months").val("1 Month")
		$('#month5').show();
		$('#multiple5').show();
		$('#year5').show();
		
		$('#month5_extra').show();
		//$('#multiple5').hide();
		$('#year5_extra').show();
		
	}
	else
	{
		$('#more_months_enabled').val("0");
		$("#more_months").val("More Month");
		$('#month5').hide();
		$('#multiple5').hide();
		$('#year5').hide();
		$('#multiple5').val("");
		
		$('#month5_extra').hide();
		$('#month5_extra').val("");
		//$('#multiple5').hide();
		$('#year5_extra').hide();
		$('#year5_extra').val("");
		
	}
	
	show_leave_details();
	
	
	//show_leave_details(); 
	//alert("ok")
});


$('#set_leave').click(function(){

	$('#messages').removeClass("clean-red");
	$('#messages').html('');
	//alert("set_leave");
	
	//if multiple months
	if ($('#more_months_enabled').val() == 1 && ( $('#multiple').val() == ''  || $('#multiple5').val() == ''))
	{
		//alert("Date is Saturday/Sunday/Holiday!");
		alert("Invalid date(s)!!");
		//$('#multiple').focus();
		return
	}
	
	//if sat or sun or holiday
	if ($('#sat_sun').val() == 1 && $('#multiple').val() != '')
	{
		//alert("Date is Saturday/Sunday/Holiday!");
		$('#messages').addClass("clean-red");
		$('#messages').html('Date is Saturday/Sunday/Holiday!');
		$('#multiple').focus();
		return
	}
	
	//if invalid employee id
	if ($('#no_record').val() == 0 || $('#no_record').val() == undefined)
	{
		//alert("Please enter a valid employee ID.");
		$('#messages').addClass("clean-red");
		$('#messages').html('Please enter a valid employee ID!');
		
		$('#employee_id').focus();
		return
	}
	else
	{
		if ($('#multiple').val() == '' && $('#leave_type_id').val() != 9)
		{
			//alert("Invalid date(s)!");
			$('#messages').addClass("clean-red");
			$('#messages').html("Invalid date(s)!");
			$('#multiple').focus();
			return false;
		}
		
		var mone = 0
		var employee_id = '';
		var multiple = '';
		var month5 = ''
		var year5 = '';
		var multiple5 = '';
		var special_priv_id = '';
		var days = '';
		var hospital_leave_days = '';
		
		var allow_sat_sun = 0;
		
		if ($('#allow_sat_sun').attr("checked") == "checked")
		{
			allow_sat_sun = 1;
		}
		
		if ($('#mone1').attr("checked") == "checked")
		{
			mone = 1
		}
		else
		{
			mone = 2
		}
		
		if ($('#employee_id').val() == "")
		{
			employee_id = 0;
		}
		else
		{
			employee_id = $('#employee_id').val()
		}
		if ($('#multiple').val() == "")
		{
			multiple = 0;
		}
		else
		{
			multiple = $('#multiple').val()
		}
		if ($('#month5').val() == "")
		{
			month5 = 0;
		}
		else
		{
			month5 = $('#month5').val()
		}
		if ($('#year5').val() == "")
		{
			year5 = 0;
		}
		else
		{
			year5 = $('#year5').val()
		}
		if ($('#multiple5').val() == "")
		{
			multiple5 = 0;
		}
		else
		{
			multiple5 = $('#multiple5').val()
		}
		if ($('#days').val() == "")
		{
			days = 0;
		}
		else
		{
			days = $('#days').val()
		}
		
		if (days != 0)
		{
			days = days.replace(/,/gi, "_");
		}
		
		hospital_leave_days = $('#hospital_leave_days').val();
		
		// Change the comma to underscore to allow the url to request.
		// Codeigniter doesnt allow comma on the url.
		if (multiple != "")
		{
			multiple = multiple.replace(/,/gi, "_");
		}
		
		if (employee_id != "")
		{
			employee_id = employee_id.replace("-", "_");
		}
		
		var month4 = $('#month4').val();
		var year4 = $('#year4').val();
		
		<?php if($lgu_code == 'laguna_province'):?>
	
			// If month4_extra has content // laguna settings
			if ($('#month4_extra').val() != '')
			{
				month4 = $('#month4_extra').val();
				year4 = $('#year4_extra').val();
			}
			
			if ($('#month5_extra').val() != '')
			{
				month5 = $('#month5_extra').val();
			}
			if ($('#year5_extra').val() != '')
			{
				year5 = $('#year5_extra').val();
			}
	
		<?php endif?>
	
		var url = "";
		url += employee_id + "/" + multiple + "/";
		url += month4 + "/" + year4 + "/";
		url += $('#leave_type_id').val() + "/" + month5 + "/";
		url += year5 + "/" + multiple5 + "/";
		url += $('#special_priv_id').val() + "/" + days + "/" + mone + "/";
		//url += "1";
		url += "1/"+allow_sat_sun+ "/"+ hospital_leave_days;
		//url += $('#special_priv_id').val() + "/" + days + "/" + mone + "/0/"+allow_sat_sun + "/"+ hospital_leave_days;
		
		
		//alert(url)
		$('#outputtime').load("<?php echo base_url().('ajax/file_leave/'); ?>" + url);
		//show the leave card
		//show_leave_card($('#employee_id').val())
		
		
		// View leave card if not leave manager
		<?php if ($this->session->userdata('user_type') != 5): ?>
		
		$('#leave_card').html("Loading..");
		// Show leave card 
		$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
		<?php endif; ?>
		
		//$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
	}
});



$("#mone1").click(function(){
 
	show_leave_details(); 
});

$("#mone2").click(function(){
 
	show_leave_details(); 
});

$("#days").keyup(function(){
 
	show_leave_details(); 
});

$("#employee_id").keyup(function(){
 
	show_leave_details(); 
});

$("#multiple").keyup(function(){
 
	show_leave_details(); 
});

$("#multiple5").keyup(function(){
 
	show_leave_details(); 
});

$('#month4').change(function(){

	show_leave_details();
});

$('#month4_extra').keyup(function(){

	show_leave_details();
});

$('#year4_extra').keyup(function(){

	show_leave_details();
});

$('#month5_extra').keyup(function(){

	show_leave_details();
});

$('#year5_extra').keyup(function(){

	show_leave_details();
});

$('#month5').change(function(){

	show_leave_details();
});

$('#year4').change(function(){

	show_leave_details();
});

$('#year5').change(function(){

	show_leave_details();
});

$('#special_priv_id').change(function(){

	show_leave_details();
});

$('#allow_sat_sun').click(function(){

	show_leave_details();
});

$('#hospital_leave_days').keyup(function(){

	show_leave_details();
});


$('#leave_type_id').change(function(){

	is_monetization();
	is_mc();
	is_undertime();
	show_leave_details();
	
});

function show_leave_details()
{
	
	$('#outputtime').html("Loading..");
	
	var mone = 0
	var employee_id = '';
	var multiple = '';
	var month5 = ''
	var year5 = '';
	var multiple5 = '';
	var special_priv_id = '';
	var days = '';
	var hospital_leave_days = ''
	
	var allow_sat_sun = 0;
	
	if ($('#allow_sat_sun').attr("checked") == "checked")
	{
		allow_sat_sun = 1;
	}
	
	if ($('#mone1').attr("checked") == "checked")
	{
		mone = 1
	}
	else
	{
		mone = 2
	}
	
	if ($('#employee_id').val() == "")
	{
		employee_id = 0;
	}
	else
	{
		employee_id = $('#employee_id').val()
	}
	if ($('#multiple').val() == "")
	{
		multiple = 0;
	}
	else
	{
		multiple = $('#multiple').val()
	}
	if ($('#month5').val() == "")
	{
		month5 = 0;
	}
	else
	{
		month5 = $('#month5').val()
	}
	if ($('#year5').val() == "")
	{
		year5 = 0;
	}
	else
	{
		year5 = $('#year5').val()
	}
	if ($('#multiple5').val() == "")
	{
		multiple5 = 0;
	}
	else
	{
		multiple5 = $('#multiple5').val()
	}
	if ($('#days').val() == "")
	{
		days = 0;
	}
	else
	{
		days = $('#days').val()
	}
	
	if (days != 0)
	{
		days = days.replace(/,/gi, "_");
	}
	
	
	hospital_leave_days = $('#hospital_leave_days').val();
	
	// Change the comma to underscore to allow the url to request.
	// Codeigniter doesnt allow comma on the url.
	if (multiple != "")
	{
		multiple = multiple.replace(/,/gi, "_");
	}
	
	if (employee_id != "")
	{
		employee_id = employee_id.replace("-", "_");
	}
	
	var month4 = $('#month4').val();
	var year4 = $('#year4').val();
	
	
	<?php if($lgu_code == 'laguna_province'):?>
	
		// If month4_extra has content // laguna settings
		if ($('#month4_extra').val() != '')
		{
			month4 = $('#month4_extra').val();
			year4 = $('#year4_extra').val();
		}
		
		if ($('#month5_extra').val() != '')
		{
			month5 = $('#month5_extra').val();
		}
		if ($('#year5_extra').val() != '')
		{
			year5 = $('#year5_extra').val();
		}
	
	<?php endif?>
	
	
	var url = "";
	url += employee_id + "/" + multiple + "/";
	url += month4 + "/" + year4 + "/";
	url += $('#leave_type_id').val() + "/" + month5 + "/";
	url += year5 + "/" + multiple5 + "/";
	//url += $('#special_priv_id').val() + "/" + days + "/" + mone;
	url += $('#special_priv_id').val() + "/" + days + "/" + mone + "/0/"+allow_sat_sun + "/"+ hospital_leave_days;
    
	//alert(url) 
	
	$('#outputtime').load("<?php echo base_url().('ajax/file_leave/'); ?>" + url);
	
	//ajax/file_leave/10-1/0/07/2011/1/07/2011/0/1/0/1
	
	// View leave card if not leave manager
	<?php if ($this->session->userdata('user_type') != 5): ?>
	// Show leave card 
	$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
	<?php endif; ?>
	
	return
	//===============================================================================
	
	
	if($('#multiple_check').attr("checked") == "checked")
	{
		return false;
	}  
}


function change_value2(new_value)
{
	$('#employee_id').val(new_value)
	show_leave_details();
	show_leave_card(new_value)
	
}

function is_monetization()
{
	
	var leave_type_id = document.getElementById("leave_type_id").value

	if(leave_type_id != 9)
	{
		document.getElementById("days").value = "";
		document.getElementById("days").disabled = true;
		document.getElementById("mone1").disabled = true;
		document.getElementById("mone2").disabled = true;
	}
	
	else
	{
		document.getElementById("days").value = "";
		document.getElementById("days").disabled = false;
		document.getElementById("mone1").disabled = false;
		document.getElementById("mone2").disabled = false;
		document.getElementById("days").focus();
	}
}

function is_mc()
{
	
	var leave_type_id = document.getElementById("leave_type_id").value
	//alert(permanent);
	
	if(leave_type_id != 3)
	{
		//document.getElementById("special_priv_id").value = "";
		document.getElementById("special_priv_id").disabled = true;
	}
	
	else
	{
		//document.getElementById("special_priv_id").value = "";
		document.getElementById("special_priv_id").disabled = false;
		//document.getElementById("days").focus();
	}
}



function change_value(new_value)
{
	
	//$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
	show_leave_details()
}

function print_preview(leave_apps_id)
{
	openBrWindow('<?php echo base_url();?>leave_manage/reports/leave_apps/'+leave_apps_id,'','scrollbars=yes,width=900,height=600');
	//alert(param)
}


function is_undertime()
{
	var leave_type_id = document.getElementById("leave_type_id").value

	if(leave_type_id == 'undertime')
	{
		// If invalid employee id
		if ($('#no_record').val() == 0 || $('#no_record').val() == undefined)
		{
			$('#messages').addClass("clean-red");
			$('#messages').html('Please enter a valid employee ID!');
			
			$('#employee_id').focus();
			
			$('#leave_type_id').reset();
			
			return
		}
		
		openBrWindow('<?php echo base_url()."leave_manage/undertime/";?>'+$('#employee_id').val()+'/1','','scrollbars=yes,width=400,height=250')
	}
}
</script>
