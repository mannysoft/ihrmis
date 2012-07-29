<span id="dtr.span">
<form method="post" action="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="5" cellspacing="5" class="type-one" id="dtr.table">
  <tr class="type-one-header">
    <th colspan="4" align="left" bgcolor="#D6D6D6"><div id="outputname"></div></th>
    </tr>
  <tr class="type-one-header">
    <th colspan="4" align="left" bgcolor="#D6D6D6"><strong>
      Office: <?php $js = 'id="office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <input name="op" type="hidden" id="op" value="1" />
      <br />
      Employee: 
      <select name="employee_id" id="employee_id">
        <option value="0">--All--</option>
        </select>
      <input name="date" type="hidden" class="ilaw" id="date" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php //echo $date;?>" size="11" maxlength="10" />
      <input name="date2" type="hidden" class="ilaw" id="date2" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" value="<?php //echo $date2;?>" size="11" maxlength="10" />
      
      <input name="go" type="submit"  id="go"  value="-- Go --"/>
      <input name="lname" type="hidden" id="lname" />
      <input name="fname" type="hidden" id="fname" />
      <input name="una" type="hidden" id="una" size="2" />
      <input name="dalawa" type="hidden" id="dalawa" size="2" />
      <input name="log" type="hidden" id="log" size="10" />
      <input name="row_id" type="hidden" id="row_id" size="10" />
      <input name="keycode" type="hidden" id="keycode" size="10" />
      <input name="new_val" type="hidden" id="new_val" value="<?php echo $am_initial = 0;?>" size="10" />
      <input name="arrow" type="hidden" id="arrow" value="1" size="6" />
    </strong></th>
    </tr>
  <tr class="type-one-header">
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    <th bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
  <tr class="type-one-header">
    <th width="3%" bgcolor="#D6D6D6">&nbsp;</th>
    <th width="28%" bgcolor="#D6D6D6">Date</th>
    <th width="47%" bgcolor="#D6D6D6">Type of Leave</th>
    <th width="22%" bgcolor="#D6D6D6">Date and Action</th>
    </tr>
  <?php $lines = 20;?>
  <?php $i = 1;?>
	 <?php while($lines != 0):?>
		<?php $bg = $this->Helps->set_line_colors();?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td align="center" bgcolor="#CADBFB"><?php echo $i;?></td>
    <td bgcolor=""><?php //echo ($row->period != '0000-00-00') ? $row->period : '';?>
      <input name="month[]" type="text" id="month[]" size="3" maxlength="2" /> <input name="days[]" type="text" id="days[]" maxlength="60" /> <input name="year[]" type="text" id="year[]" size="5" maxlength="4" /></td>
    <td bgcolor=""><?php //echo $this->Leave_type->leave_type_list();?>
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
    <td bgcolor=""><?php //echo ($row->v_earned != 0) ? $row->v_earned : '';?></td>
    </tr>
    <?php $lines --;?>
    <?php $i ++;?>
  <?php endwhile;?>
  <tr>
    <td colspan="3">
    <?php if($this->input->post('op')):?>
    <!--<input type="submit" name="add_10rows" id="add_10rows" value="Add 10 rows" />-->
    <?php endif;?>
    </td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</span>

<script type="text/javascript">

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

	
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>json/employees/' + office_id + '/1', null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$(document).ready(function(){

	
	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>json/employees/' + office_id + '/1', null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
				
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $this->input->post('employee_id');?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#employee_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
	});
	

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});
//dg_editCell(dtr,'994','am_login','dtr.0.8','dtr')
</script>