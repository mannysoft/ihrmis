<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url();?>training_manage/attendance_save">Add Training Attendance</a></td>
  </tr>
  <tr>
    <td width="9%"><?php echo $msg;?></td>
    <td width="79%">&nbsp;</td>
    <td width="12%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="6%" bgcolor="#D6D6D6">ID</th>
        <th width="20%" bgcolor="#D6D6D6"><strong>Course Title</strong></th>
        <th width="17%" bgcolor="#D6D6D6">Name</th>
        <th width="8%" bgcolor="#D6D6D6">Local</th>
        <th width="8%" bgcolor="#D6D6D6">Other</th>
        <th width="6%" bgcolor="#D6D6D6">Relevant</th>
        <th width="6%" bgcolor="#D6D6D6">Certified</th>
        <th width="13%" bgcolor="#D6D6D6">Remarks</th>
        <th width="16%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php
	  $course = new Training_course();
	  $event = new Training_event();
	  $employee = new Training_employee();
	  ?>
	  <?php foreach($rows as $row):?>
        <?php $event->get_by_id($row->event_id);?>
        <?php $course->get_by_id($event->course_id);?>
        <?php $employee->get_by_employee_id($row->employee_id);?>
        
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $course->course_title;?></td>
	    <td align="left"><?php echo $employee->lname.', '.$employee->fname;?></td>
	    <td align="right"><?php echo number_format($row->employee_local_cost, 2);?></td>
        <td align="right"><?php echo number_format($row->employee_other_cost, 2);?></td>
        <td><?php echo $row->relevant;?></td>
        <td><?php echo $row->certified;?></td>
        <td><?php echo $row->remarks;?></td>
        <td align="right"><a href="<?php echo base_url();?>training_manage/event_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>training_manage/event_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="2"><?php echo $this->pagination->create_links(); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="op" type="hidden" id="op" value="1" /></td>
        </tr>
</table>
</form>
<script>
$('.delete_row').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});

$('.row_highlight').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});
</script>