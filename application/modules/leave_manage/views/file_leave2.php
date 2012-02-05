<div class="clean-green" style="display:none">Leave has been saved!</div><br />
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
    <td align="right"><strong>
    Date: </strong></td>
    <td>
      <?php $js = 'id= "month5"';echo form_dropdown('month5', $month_options, $month_selected, $js);?>
      <input name="multiple5" type="text" class="ilaw" id="multiple5" size="20" autocomplete="off"/>
      <?php $js = 'id= "year5"';echo form_dropdown('year5', $year_options, $year_selected, $js);?>
      <input type="button" name="button" id="more_months" value="More Month" />
      <input name="more_months_enabled" type="hidden" id="more_months_enabled" value="0" /></td>
    <td width="57" align="left">&nbsp;</td>
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
    <select name="special_priv_id" id="special_priv_id" disabled="disabled">
      <option value="1">Personal Milestone</option>
      <option value="2">Parental Obligation</option>
      <option value="3">Filial Obligation</option>
      <option value="4">Domestic Emergency</option>
      <option value="5">Personal Transaction</option>
    </select>    </td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="button" class="button" id="set_leave" value="Set Leave"/></td>
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
  <?php
  

	$include_hidden = 0;
	
	if($this->input->post('include_hidden'))
	{
		$include_hidden = 1;
	}
	
	$rows = $this->Manual_log->office_manual_log($this->session->userdata('office_id'), $log_type = '', $include_hidden);
	
	foreach($rows as $row)
	{
		$manual_log_id = $row['id'];
		$employee_id = $row['employee_id'];
		$log_type = $row['log_type'];
		$cover_if_ob_or_leave = $row['cover_if_ob_or_leave'];
		$cover_if_ob_or_leave2 = $row['cover_if_ob_or_leave2'];
		$notes = $row['notes'];
			
		$name = $Employee->get_employee_info($employee_id);
		$office_id = $row1['office_id'];
			
		
		if($x>$y)
		{
			$y+=2;
			$bg="#F2F2F2";

		}else{
			$x+=2;
			$bg="#Ffffff";
		}
		
  ?>
  <?php
  } 
  ?>
</table>
<div id="leave_card">

</div>
<script>



$(document).ready(function(){
 
	$('#month5').hide();
	$('#multiple5').hide();
	$('#year5').hide();
	
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
		
	}
	else
	{
		$('#more_months_enabled').val("0");
		$("#more_months").val("More Month");
		$('#month5').hide();
		$('#multiple5').hide();
		$('#year5').hide();
		$('#multiple5').val("");
		
	}
	
	show_leave_details();
	
	
	//show_leave_details(); 
	//alert("ok")
});


$('#set_leave').click(function(){

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
		alert("Date is Saturday/Sunday/Holiday!");
		$('#multiple').focus();
		return
	}
	
	//if invalid employee id
	if ($('#no_record').val() == 0 || $('#no_record').val() == undefined)
	{
		alert("Please enter a valid employee ID.");
		$('#employee_id').focus();
		return
	}
	else
	{
		if ($('#multiple').val() == '' && $('#leave_type_id').val() != 9)
		{
			alert("Invalid date(s)!");
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
		
		if ($('#mone1').attr("checked") == true)
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
		
		
		
		//alert(employee_id);
	
		var url = "";
		url += employee_id + "/" + multiple + "/";
		url += $('#month4').val() + "/" + $('#year4').val() + "/";
		url += $('#leave_type_id').val() + "/" + month5 + "/";
		url += year5 + "/" + multiple5 + "/";
		url += $('#special_priv_id').val() + "/" + days + "/" + mone + "/";
		url += "1";
		
		//alert(url)
		$('#outputtime').load("<?php echo base_url().('ajax/file_leave/'); ?>" + url);
		//show the leave card
		//show_leave_card($('#employee_id').val())
		$('#leave_card').html("Loading..");
		$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
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

$('#leave_type_id').change(function(){

	is_monetization();
	is_mc();
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
	
	if ($('#mone1').attr("checked") == true)
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
	
	var url = "";
	url += employee_id + "/" + multiple + "/";
	url += $('#month4').val() + "/" + $('#year4').val() + "/";
	url += $('#leave_type_id').val() + "/" + month5 + "/";
	url += year5 + "/" + multiple5 + "/";
	url += $('#special_priv_id').val() + "/" + days + "/" + mone;
    
	//alert(url) 
	
	$('#outputtime').load("<?php echo base_url().('ajax/file_leave/'); ?>" + url);
	
	//ajax/file_leave/10-1/0/07/2011/1/07/2011/0/1/0/1
	
	
	
	// Show leave card 
	$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
	
	return
	//===============================================================================
	
	
	if($('#multiple_check').attr("checked") == false)
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
</script>