<div id="messages"></div>
<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="<?php echo base_url().'training_manage/attendance/';?>" method="post" id="myform">
<table width="100%" border="0">
  <tr>
    <td width="9%"><?php echo $msg;?></td>
    <td width="66%">&nbsp;</td>
    <td><!--<a href="<?php echo base_url();?>training_manage/attendance_save">Add Training Attendance</a>--></td>
  </tr>
  <tr>
    <td colspan="2">Select Training Event:
      <?php 
		$js = 'id = "event_id" style="width:350px"';
		echo form_dropdown('event_id', training_event(), $event_id, $js); ?></td>
    <td width="25%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="8%" bgcolor="#D6D6D6">ID</th>
        <th width="21%" bgcolor="#D6D6D6">Name</th>
        <th width="10%" bgcolor="#D6D6D6">Local</th>
        <th width="10%" bgcolor="#D6D6D6">Other</th>
        <th width="9%" bgcolor="#D6D6D6">Relevant</th>
        <th width="9%" bgcolor="#D6D6D6">Certified</th>
        <th width="15%" bgcolor="#D6D6D6">Remarks</th>
        <th width="18%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php
	  $course = new Training_course();
	  $event = new Training_event();
	  $employee = new Training_employee();
	  ?>
	  <?php foreach($rows as $row):?>
        <?php $event->get_by_id($row->event_id);?>
        <?php $course->get_by_id($event->course_id);?>
        <?php $employee->get_by_id($row->employee_id);?>
        
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" id="tr-<?php echo $row->id;?>">
	    <td><?php echo $row->id;?></td>
	    <td align="left"><?php echo $employee->lname.', '.$employee->fname;?></td>
	    <td align="right"><?php echo number_format($row->employee_local_cost, 2);?></td>
        <td align="right"><?php echo number_format($row->employee_other_cost, 2);?></td>
        <td><?php echo $row->relevant;?></td>
        <td><?php echo $row->certified;?></td>
        <td><?php echo $row->remarks;?></td>
        <td align="right">
        <?php 
		$params = array(
					'attendance_id' 		=> $row->id,
					'employee_id' 			=> $row->employee_id,
					'employee_local_cost' 	=> $row->employee_local_cost,
					'employee_other_cost' 	=> $row->employee_other_cost,
					'relevant' 				=> $row->relevant,
					'certified' 			=> $row->certified,
					'remarks' 				=> $row->remarks,
					'class' 				=> 'edit_attendance',
					)
		?>
        <?php echo anchor('#', 'Edit', $params);?>
        | <a href="#" attendance_id="<?php echo $row->id;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="2" align="right"><input name="id" type="hidden" id="id" />            <?php 
		$js = 'id = "employee_id"';
		echo form_dropdown('employee_id', training_employees(), '', $js); ?></td>
          <td align="right"><label for="employee_local_cost"></label>
          <input name="employee_local_cost" type="text" id="employee_local_cost" size="8" /></td>
          <td align="right"><input name="employee_other_cost" type="text" id="employee_other_cost" size="8" /></td>
          <td><input name="relevant" type="checkbox" id="relevant" value="yes" />
          <label for="relevant"></label></td>
          <td><input name="certified" type="checkbox" id="certified" value="yes" /></td>
          <td colspan="2"><input name="remarks" type="text" id="remarks" size="20" /></td>
        </tr>
        <tr>
          <td><?php //echo $this->pagination->create_links(); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="op" type="hidden" id="op" value="1" />
          <input type="submit" name="btn_save" id="btn_save" value="Save" /></td>
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
	
	$('#messages').hide('fast');
	
	$('#messages').addClass("clean-green");
	$.get("<?php echo base_url().('training_manage/attendance_delete/'); ?>" + $(this).attr("attendance_id"));
	$('#messages').html('Deleted!<br>');
	
	$('#messages').slideDown('slow');
	
	$('#tr-' + $(this).attr("attendance_id")).remove();
	
	$('#messages').fadeOut(10000);
	
});

$('.row_highlight').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});

$('#event_id').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});

$('.edit_attendance').click(function(){

	//
	$('#id').val($(this).attr("attendance_id"))
	$('#employee_local_cost').val($(this).attr("employee_local_cost"))
	$('#employee_other_cost').val($(this).attr("employee_other_cost"))
	$('#remarks').val($(this).attr("remarks"))
	$("#employee_id").val($(this).attr("employee_id"));
	var checked_relevant = $(this).attr("relevant") == 'Yes' ? true : false
	var checked_certified = $(this).attr("certified") == 'Yes' ? true : false
	$("#relevant").attr('checked', checked_relevant);
	$("#certified").attr('checked', checked_certified);
	//$("#certified").attr('checked', true);
	//alert(checked_certified)
	$('#employee_local_cost').focus();
	return false;
	
});
</script>