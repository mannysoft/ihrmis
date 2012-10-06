<form method="post" action="" id="myform">
<table width="100%" border="0" cellpadding="4" cellspacing="4">
  <tr>
    <td width="13%" align="right">Office:</td>
    <td width="78%"><?php 
		$js = 'id = "office_id" ';
		echo form_dropdown('office_id', $options, $selected, $js); 
		?></td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Username:	</td>
    <td><?php 
	$this->load->helper('options');
	echo form_dropdown('username', user_options());?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Module:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Date:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

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
  $u = new User_m();

  foreach($logs as $log)
	{
		$id		 			= $log['id'];
		
		$username 			= $log['username'];
		
		$employee_affected 	= $log['employee_id_affected'];
		
		$command 			= $log['command'];
		
		$details 			= $log['details'];
		
		$date	 			= $log['date'];
		
		$u->get_by_username($username);
		
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
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td><input name="log[]" type="checkbox" id="log[]" ONCLICK="highlightRow(this,'#ABC7E9');" value="<?php echo $id;?>"/></td>
    <td><?php echo $username;?></td>
    <td><?php echo $u->lname.', '.$u->fname;?></td>
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