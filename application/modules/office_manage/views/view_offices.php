<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>

<?php if($this->session->flashdata('error_msg')): ?>
	<div class="clean-red"><?php echo $this->session->flashdata('error_msg');?></div>
<?php endif; ?>

<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url();?>office_manage/add_office">Add Office</a></td>
  </tr>
  <tr>
    <td width="9%"><?php echo $msg;?></td>
    <td width="79%">&nbsp;</td>
    <td width="12%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="5%" bgcolor="#D6D6D6">Office Code</th>
        <th width="16%" bgcolor="#D6D6D6"><strong>Office Name</strong></th>
        <th width="12%" bgcolor="#D6D6D6">Office Address</th>
        <th width="7%" bgcolor="#D6D6D6">Salary Grade</th>
        <th width="17%" bgcolor="#D6D6D6">Office Head </th>
        <th width="14%" bgcolor="#D6D6D6">Position</th>
        <th width="9%" bgcolor="#D6D6D6">Office Location</th>
        <th width="20%" bgcolor="#D6D6D6"><strong>Action</strong></th>
  </tr>
	  
	  <?php
	  
	 
	  
	foreach($rows as $row)
	{
		$office_id	   = $row['office_id'];
		$office_name   = $row['office_name'];
		$office_head   = $row['office_head'];
		$position  	   = $row['position'];
		
		$office_head	= $row['employee_id'] 
							? $office_head.' ('.$row['employee_id'].')' 
							: $office_head;
		
		$bg = $this->Helps->set_line_colors();
		?><tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	    <td bgcolor=""><?php echo $row['office_code'];?></td>
	    <td bgcolor=""><?php echo $office_name;?></td>
	    <td bgcolor=""><?php echo $row['office_address'];?></td>
	    <td bgcolor=""><?php echo $row['salary_grade_type'];?></td>
        <td bgcolor=""><?php echo $office_head;?></td>
        <td bgcolor=""><?php echo $position;?></td>
        <td bgcolor=""><?php echo $row['office_location'];?></td>
        <td align="right" bgcolor=""><a href="<?php echo base_url();?>office_manage/delete_office/<?php echo $office_id;?>" class="delete_office">Delete</a>
        <a href="<?php echo base_url();?>office_manage/edit_office/<?php echo $office_id;?>">Edit</a> | <a href="<?php echo base_url();?>office_manage/divisions/<?php echo $office_id;?>">Divisions</a></td>
        </tr>
		<?php
		
		}
	  ?>
        <tr>
          <td colspan="3"><?php echo $this->pagination->create_links(); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="op" type="hidden" id="op" value="1" /></td>
        </tr>
</table>
</form>
<script>
$('.delete_office').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});
</script>