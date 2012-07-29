<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="3" align="left" bgcolor="#D6D6D6"><strong>
      <?php $js = 'id= "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>
      <input name="op" type="hidden" id="op" value="1" />
      <input name="date2" type="text" id="date2" value="<?php echo $date;?>" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input type="submit" name="button" id="button" value="Go" />
    </strong></th>
  </tr>
  <tr class="type-one-header">
    <th width="14%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
    <th width="27%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
    <th width="12%" bgcolor="#D6D6D6">&nbsp;</th>
  </tr>
  <?php foreach ($rows as $employee_id):?>
  
  		<?php
		$this->Employee->fields = array('lname', 'fname', 'mname');
		
		$name 	= $this->Employee->get_employee_info($employee_id);

	 	//bg
		$bg 	= $this->Helps->set_line_colors();
		?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td bgcolor=""><?php echo $employee_id;?></td>
    <td bgcolor=""><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td align="center" bgcolor="">&nbsp;</td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="3">
        </td>
  </tr>
</table>
</form>        
<script>
$('#office_id').change(function(){

	$('#myform').submit();
	
});
</script>