<?php 

//http://jquery.com/demo/thickbox/

if ($pop_up == 1){
	
	//exit;
	
?>
<script src="<?php echo base_url();?>js/function.js"></script>
<script>openBrWindow('<?php echo base_url()."dtr/archives/".$office_id.".pdf";?>','','scrollbars=yes,width=800,height=700')</script>

<?php
}
?>
<div id="messages"></div><br />
<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
      <tr>
        <td>&nbsp;</td>
        <td rowspan="6"><div id="outputname"><img src="<?php echo base_url();?>images/spacer.gif" /><br />
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
        <th width="71%" bgcolor="#D6D6D6"><?php echo $msg;?></th>
  </tr>
      <tr>
        <td align="right"><strong>Employee ID:
        <input name="op" type="hidden" id="op" value="1" />
        </strong></td>
        <td><input name="employee_id" type="text" id="employee_id" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" autocomplete="off"/></td>
      </tr>
      <tr>
        <td align="right"><strong>Period:</strong></td>
        <td><strong>
        <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
        <?php $js = 'id= "period_from"';echo form_dropdown('period_from', $days_options, '01', $js);?>
        </strong>
          
To:
<strong>
<?php $js = 'id= "period_to"';echo form_dropdown('period_to', $days_options, $days_selected, $js);?>
</strong><strong>
<?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
</strong><!--
<select name="year" id="year" >
  <option value="2009">2009</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
</select>--></td>
      </tr>
      <tr>
        <td align="right"><input name="multi_employee" type="checkbox" id="multi_employee" value="1" />
          <strong>Multiple Employee</strong></td>
        <td></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
      </tr>
      <tr>
        <td align="right"><strong>Office:</strong></td>
        <td align="left"><?php 
		$js = 'id = "office_id" disabled';
		echo form_dropdown('office_id', $options, $selected, $js); ?></td>
      </tr>
      <tr>
        <td align="right"><strong>Employment Status: </strong></td>
        <td>
        <?php 
		$js = 'id = "permanent_only" disabled';
		echo form_dropdown('permanent_only', $permanent_options, $permanent_selected, $js); ?></td>
      </tr>
      
      
      <?php if ( $this->session->userdata('user_type') == 1 or $this->session->userdata('user_type') == 2): ?>
      <tr>
        <td align="right">&nbsp;</td>
        <td>
        <strong>	Deduct Undertime to Leave Balances
        <?php $js = 'id= "deduct_month"';echo form_dropdown('deduct_month', $month_options, $month_selected, $js);?>
        </strong><strong>
        <?php $js = 'id= "deduct_year"';echo form_dropdown('deduct_year', $year_options, $year_selected, $js);?>
        </strong>
<input name="deduct_undertime" type="button" id="deduct_undertime" value="Deduct"/>
        <input name="cancel_deduct_undertime" type="button" id="cancel_deduct_undertime" value="Cancel Deduction"/>
          <div id="loading_undertime"></div></td>
      </tr>
      <?php endif; ?>
      
      
      <tr>
        <td align="right">&nbsp;</td>
        <td><!--<input type="submit" name="Submit" value="Submit" />-->
        <input name="view_dtr" type="submit" class="button" id="view_dtr" value="View DTR"/></td>
  </tr>
    	</table>

<!--<div id="div15" style="display:block">-->
<div id="div15" style="display:none">
		  
</div>
<script>

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


function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
}

$('#myform').submit(function(){

	$('#view_dtr').val("Please wait...")
	
	if ($('#employee_id').val() == "" || $('#employee_id').val() == undefined || $('#valid_id').val() == 0)
	{
		$('#messages').addClass('clean-red');
		//$('#messages').slideUp();
		$('#messages').html("Please enter a valid employee ID!");
		
		//$('#outputname').html("<b>Please enter a valid employee ID.</b>");
		$('#view_dtr').val("View DTR")
		return false
	}
	
	
	
});


$('#multi_employee').click(function(){

	$('#div15').html("Please wait...");
	$('#permanent_only').attr("disabled", true);
	 
	if ($('#multi_employee').attr("checked") == true)
	{
		$('#employee_id').val("check from list")
		$('#employee_id').attr("disabled", true);
		$('#permanent_only').attr("disabled", false);
		$('#office_id').attr("disabled", false);
		
		$('#div15').load("<?php echo base_url().('ajax/show_employees/'); ?>" + $('#office_id').val() + "/" + $('#permanent_only').val());
		
		
		$('#div15').show('fast');
	}
	else
	{
		$('#employee_id').val("")
		$('#employee_id').attr("disabled", false);
		$('#permanent_only').attr("disabled", true);
		$('#office_id').attr("disabled", true);
		$('#div15').hide('fast');
	}
	
});


$('#office_id').change(function(){
	
	$('#div15').html("Please wait...");
	$('#div15').load("<?php echo base_url().('ajax/show_employees/'); ?>" + $('#office_id').val() + "/" + $('#permanent_only').val());
	$('#div15').show('fast');
	
});

$('#permanent_only').change(function(){

	$('#div15').html("Please wait...");
	$('#div15').load("<?php echo base_url().('ajax/show_employees/'); ?>" + $('#office_id').val() + "/" + $('#permanent_only').val());
	$('#div15').show('fast');
	
});

$('#deduct_undertime').click(function(){

	$('#loading_undertime').html("Loading... Please wait...");
	$('#loading_undertime').load("<?php echo base_url().('ajax/deduct_undertime/'); ?>" + $('#deduct_month').val() + "/" + $('#deduct_year').val());
	
});

$('#cancel_deduct_undertime').click(function(){

	$('#loading_undertime').html("Loading... Please wait...");
	$('#loading_undertime').load("<?php echo base_url().('ajax/cancel_deduct_undertime/'); ?>" + $('#deduct_month').val() + "/" + $('#deduct_year').val());
	
});
</script>
