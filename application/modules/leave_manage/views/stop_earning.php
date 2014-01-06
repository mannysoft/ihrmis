<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $msg; ?></div><br />
<?php elseif (Session::flashData('msg') || $msg != ''): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?><?php echo $msg;?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="5" bgcolor="#D6D6D6"><th bgcolor="#D6D6D6">
   </th>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td></td>
    <td colspan="2" rowspan="6" align="left"><div id="outputname">
      <input name="no_record2" type="hidden" id="no_record2" />
    </div></td>
    <td align="left"></td>
  </tr>
  <tr>
    <td width="15" align="right">&nbsp;</td>
    <td width="275" align="right">Employee Number/Last Name:</td>
    <td width="340"><input name="employee_id" type="text" class="ilaw" id="employee_id" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php echo set_value('employee_id', $employee_id);?>" size="20" autocomplete="off"/>
        <strong>
        <input name="op" type="hidden" id="op" value="1" />
    </strong></td>
    <td width="57" align="left">
    </td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">Stop of earning:</td>
    <td><input name="stop_date" type="text" id="stop_date" value="<?php echo set_value('stop_date', date('Y-m-d')); ?>" size="20" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" readonly/>
 <img src="<?php echo base_url(); ?>images/img.gif" width="20" height="14" align="middle" class="calimg" id="f_trigger_a" style="" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''" />
      <script type="text/javascript">
		    Calendar.setup({
	          inputField     :    "stop_date",     // id of the input field
	          ifFormat       :    "%Y-%m-%d", // format of the input field
	          button         :    "f_trigger_a",  // trigger for the calendar (button ID)
	          align          :    "Bl",    // alignment (defaults to "Bl")
	          singleClick    :    true
		    });
		</script></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td><input name="set_leave" type="submit" class="button" id="set_leave" value="Stop earning"/></td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="57" align="left">&nbsp;</td>
  </tr>
</table>
</form>
<script>


$(document).ready(function(){
 
	if ($('#employee_id').val() != "")
	{
		$('#outputname').load("<?php echo base_url().('Ajax/view_name/'); ?>" + $('#employee_id').val());
		
	}
	
	$('#employee_id').focus();
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

$('#stop_date').change(function(){

	alert("");
});

function change_value(new_value)
{
	
	$('#outputname').load("<?php echo base_url().('ajax/view_name/'); ?>" + new_value);
	$('#employee_id').val(new_value);
}
</script>