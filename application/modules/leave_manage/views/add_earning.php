<div id="messages"></div>
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
    <td colspan="2" rowspan="12" align="left"><div id="outputtime">
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
    <td align="right"><strong>Vacation Leave</strong></td>
    <td><input name="v_earned" type="text" class="ilaw" id="v_earned" size="20" autocomplete="off"/></td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>Sick Leave</strong></td>
    <td><input name="s_earned" type="text" class="ilaw" id="s_earned" size="20" autocomplete="off"/></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="button" class="button" id="set_leave" value="Add"/></td>
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
	
	var mone = 0
	var employee_id = '';
	var multiple = '';
	var month5 = ''
	var year5 = '';
	var multiple5 = '';
	var special_priv_id = '';
	var days = '';
	
	//alert("");

	var url = "";
	url += $('#employee_id').val() + "/" + $('#month4').val() + "/";
	url += $('#multiple').val() + "/" + $('#year4').val() + "/";
	url += $('#v_earned').val() + "/" + $('#s_earned').val() + "/";
	
	//alert(url)
	$('#outputtime').load("<?php echo base_url().('ajax/add_earning/'); ?>" + url);
	//show the leave card
	//show_leave_card($('#employee_id').val())
	
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
	
	// View leave card if not leave manager
	<?php if (Session::get('user_type') != 5): ?>
	// Show leave card 
	$('#leave_card').load("<?php echo base_url().('ajax/show_leave_card/'); ?>" + $('#employee_id').val());
	<?php endif; ?>
	
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




function change_value(new_value)
{
	
	//$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
	show_leave_details()
}

function print_preview(leave_apps_id)
{
	openBrWindow('<?php echo base_url();?>reports/leave_apps/'+leave_apps_id,'','scrollbars=yes,width=900,height=600');
	//alert(param)
}

</script>