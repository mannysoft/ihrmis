<?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); 
		?>
<form method="post" action="" id="myform">
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="2%"><input name="checkall" type="checkbox" id="checkall" onclick="select_all('log', '1');" value="1"/></th>
    <th width="7%"><strong>Username</strong></th>
    <th width="10%"><strong>Name
      <input name="op" type="hidden" id="op" value="1" />
    </strong></th>
    <th width="10%"><strong>Office</strong></th>
    <th width="11%"><strong>Activity</strong></th>
    <th width="16%"><strong>Details</strong></th>
    <th width="16%"><strong>Employee Affected </strong></th>
    <th width="13%"><strong>Date</strong></th>
    <th width="15%">&nbsp;</th>
  </tr>
  <?php 
  

  foreach($logs as $log)
	{
		$id		 			= $log['id'];
		
		$username 			= $log['username'];
		
		$employee_affected 	= $log['employee_id_affected'];
		
		$command 			= $log['command'];
		
		$details 			= $log['details'];
		
		$date	 			= $log['date'];
		
		$user_lname = '';
		$user_fname = '';	
		
		$user_data			= $this->User->get_user_data($username);
		
		if (!empty($user_data))
		{
			$user_lname = $user_data['lname'];
			$user_fname = $user_data['fname'];	
		}
			
		
		$this->Employee->fields = array('lname', 'fname');
		
		$lname = '';
		$fname = '';	
		
		$employee_info = $this->Employee->get_employee_info($employee_affected);
		
		if (!empty($employee_info))
		{
			$lname = $employee_info['lname'];
			$fname = $employee_info['fname'];	
		}
		
		
		$bg = $this->Helps->set_line_colors();
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
    <td><input name="log[]" type="checkbox" id="log[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $id;?>"/></td>
    <td><?php echo $username;?></td>
    <td><?php echo $user_lname.', '.$user_fname;?></td>
    <td><?php echo $this->Office->get_office_name($log['office_id']);?></td>
    <td><?php echo $command;?></td>
    <td><?php echo $details;?></td>
    <td><?php echo $lname.', '.$fname;?></td>
    <td><?php echo $date;?></td>
    <td><a href="<?php echo base_url();?>settings_manage/audit_trail/<?php echo $id;?>">remove</a></td>
  </tr>
  <?php
  }
   ?>
  <tr>
    <td colspan="4"><input name="remove_selected" type="submit" id="remove_selected" value="Remove Selected" />
      <input name="remove_all" type="submit" id="remove_all" value="Remove All" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="9"><?php echo $this->pagination->create_links(); ?></td>
  </tr>
</table>
</form>
<script>
$('#office_id').change(function(){

	$('#myform').submit();
	
});
</script>