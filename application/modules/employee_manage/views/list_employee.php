<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="<?php echo base_url();?>employee_manage/list_employee" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td align="right"><strong>Employee No.:</strong></td>
    <td><strong>
      <input name="employee_id" type="text" id="employee_id" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="op" type="hidden" id="op" value="1" />
        <input name="include_not_active" type="checkbox" id="include_not_active" value="1" onclick="this.form.submit()" <?php //echo $checked;?>/>
Include not active </strong></td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url();?>employee_manage/add_employee">Add Employee</a></td>
  </tr>
  <tr>
    <td align="right"><strong>Employee Last Name</strong>: </td>
    <td><strong>
      <input name="lname" type="text" id="lname" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
    </strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" align="right"><strong>Office:</strong></td>
    <td width="69%"><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>&nbsp;
      <div id="loading"></div></td>
    <td width="3%">&nbsp;</td>
    <td width="11%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="3%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('employee', '1');" value="1"/></td>
        <th width="13%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
        <th width="25%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
        <th width="33%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
        <th width="7%" bgcolor="#D6D6D6"><strong>Status</strong></th>
        <th width="19%" bgcolor="#D6D6D6"><strong>Action</strong></th>
  </tr>
	  
	  <?php 
	  
	foreach($query_result as $row)
	{
		$fname 		= $row['fname'];
		$mname 		= $row['mname'];
		$lname 		= $row['lname'];
		$id	   		= $row['id'];
		$employee_id= $row['employee_id'];
		$office_id	= $row['office_id'];
		$status	   	= $row['status'];
		$pics	   	= $row['pics'];
		$position	= $row['position'];
		
		$office_name = $this->Office->get_office_name($office_id);
		
		if($status==1)
		{
			$status='Active';
		}
		
		else{
			$status='Not Active';
		}
		
		if($pics == "" || !file_exists("pics/$pics"))
		{
			$pics = 'not_available.jpg';
		}
		
		$bg = $this->Helps->set_line_colors();
		
		?><tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td bgcolor=""><input name="employee[]" type="checkbox" value="<?php echo $id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		<td bgcolor=""><?php echo $employee_id;?></td>
        <td bgcolor=""><a href="<?php echo base_url();?>pds/employee_profile/<?php echo $id;?>"><?php echo $lname.', '.$fname.' '.$mname;?></a></td>
        <td bgcolor=""><?php echo $office_name;?></td>
        <td bgcolor=""><?php echo $status;?></td>
        <td align="right" bgcolor="">
          <a href="<?php echo base_url();?>employee_manage/edit_employee/<?php echo $employee_id.'/'.$office_id.'/'.$page;?>">Edit</a>
        <a href="#" onclick="delete_employee('<?php echo $employee_id;?>','Delete Employee <?php echo $lname.', '.$fname?>?', '<?php echo base_url();?>employee_manage/delete_employee/<?php echo $employee_id.'/'.$office_id.'/'.$page;?>')">Delete</a> <a href="#" onmouseover="Tip('<img src=\'<?php echo base_url();?>pics/<?php echo $pics;?>\'><br><center><?php echo $position;?></center>', SHADOW, true, TITLE, '<?php echo $fname.' '.$mname.' '.$lname.' Details';?>')" onmouseout="UnTip()" style="cursor: pointer;">Picture</a></td>
        </tr>
		<?php
		
		}
	  ?>
        <tr>
          <td colspan="2">
		<select name="action" id="action" onchange="this.form.submit();">
          <option>With Selected:</option>
          <option value="0">Deactivate</option>
		  <option value="1">Activate</option>
        </select>
          <input name="op" type="hidden" id="op" value="1" /></td>
          <td colspan="4"><?php echo $this->mi_pagination->create_links(); ?></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4"></td>
  </tr>
</table>
</form>
<script>

$('#delete_employee').click(function(){

	
	alert("2")
});

$('#office_id').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});

function delete_employee(delete_id, msg, url)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	//alert(url)
	window.location = url
}

</script>