<?php if ($pop_up == 1): ?>
<script src="<?php echo base_url();?>js/function.js"></script>
<script>openBrWindow('<?php echo base_url().$report_file;?>','','scrollbars=yes,width=900,height=700')</script>
<?php endif; ?>

<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="<?php echo base_url();?>employees" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td align="right"></td>
    <td width="30%"><strong>
      <input name="employee_id" type="text" id="employee_id" class="ilaw" placeholder="Employee No."/>
      <input name="include_not_active" type="checkbox" id="include_not_active" value="1" onclick="this.form.submit()" <?php //echo $checked;?>/>
Include not active </strong></td>
    <td width="20%">&nbsp;</td>
    <td width="30%" align="right"><a href="<?php echo base_url();?>employees/add_employee"> Add Employee</a>
    </td>
  </tr>
  <tr>
    <td align="right"></td>
    <td>
      <input name="lname" type="text" id="lname" class="ilaw" placeholder="Employee Last Name"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/></td>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
  <tr>
    <td width="17%" align="right"><strong>Office:</strong></td>
    <td><?php $js = 'id = "office_id"';echo form_dropdown('office_id', $options, $selected, $js);?>&nbsp;
      <div id="loading"></div></td>
    <td>&nbsp;</td>
    <td width="11%" align="right">
	     <?php $enable_id_maker = Setting::getField( 'enable_id_maker' );?>
    
    <?php if($enable_id_maker == 'yes'):?>
	<?php echo $cart; ?> <?php echo $btn_cart; ?></a>
    <?php endif; ?>
    </td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" bgcolor="#D6D6D6"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('employee', '1');" value="1"/></td>
        <th width="7%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
        <th width="21%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
        <th width="19%" bgcolor="#D6D6D6">Designation</th>
        <th width="27%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
        <th width="6%" bgcolor="#D6D6D6"><strong>Status</strong></th>
        <th width="18%" bgcolor="#D6D6D6"><strong>Action</strong></th>
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
		
		
		$status = ($status == 1) ? 'Active' : 'Not Active';
		
		
		if($pics == "" || !file_exists("pics/$pics"))
		{
			$pics = 'not_available.jpg';
		}
		
		//START --- check if id was already existing in session --- added by : MICHAEL RAFALLO ---
		$e = new Employee_id_request_m();
		$results = $e->get();
		
		$office = Session::get('office_id');
		$add_to_cart ="<a href='".base_url()."employees/add_cart/".$page."/".$id."/".$office."'>Add to Request<a>";
				
		if($e->count() >= '1'):
			foreach($results as $result):
				if($id == $result->employee_id):
					$add_to_cart ="<a href='".base_url()."employees/remove_cart/".$page."/".$id."/".$office."'>Remove to Request<a>";
				endif;
			endforeach;	
		endif;
		
		if($enable_id_maker == 'no')
		{
			$add_to_cart = '';
		}
		//END --- check if id was already exisiting in session --- added by : MICHAEL RAFALLO ---
		
		$bg = $this->Helps->set_line_colors();
		
		?><tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td bgcolor=""><input name="employee[]" type="checkbox" value="<?php echo $id;?>" ONCLICK="highlightRow(this,'#ABC7E9');" id="employee"/></td>
		<td bgcolor=""><?php echo $employee_id;?></td>
        <td bgcolor=""><a href="<?php echo base_url();?>pds/personal_info/<?php echo $id;?>"><?php echo $lname.', '.$fname.' '.$mname;?></a></td>
        <td bgcolor=""><?php echo $position;?></td>
        <td bgcolor=""><?php echo $office_name;?></td>
        <td bgcolor=""><?php echo $status;?></td>
        <td align="right" bgcolor="">
        <?php echo $add_to_cart; ?>
        <a href="<?php echo base_url();?>employees/edit_employee/<?php echo $employee_id.'/'.$office_id.'/'.$page;?>">Edit</a>
        <a href="#" onclick="delete_employee('<?php echo $employee_id;?>','Delete Employee <?php echo $lname.', '.$fname?>?', '<?php echo base_url();?>employees/delete_employee/<?php echo $employee_id.'/'.$office_id.'/'.$page;?>')">Delete</a> <a href="#" onmouseover="Tip('<img src=\'<?php echo base_url();?>pics/<?php echo $pics;?>\'><br><center><?php echo $position;?></center>', SHADOW, true, TITLE, '<?php echo $fname.' '.$mname.' '.$lname.' Details';?>')" onmouseout="UnTip()" style="cursor: pointer;">Picture</a></td>
        </tr>
		<?php } ?>
        <tr>
          <td colspan="7">
		<select name="action" id="action" onchange="this.form.submit();">
          <option>With Selected:</option>
          <option value="0">Deactivate</option>
		  <option value="1">Activate</option>
        </select>
          <input name="op" type="hidden" id="op" value="1" />          <?php echo $this->mi_pagination->create_links(); ?></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="5"></td>
  </tr>
</table>
</form>



<script>

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

