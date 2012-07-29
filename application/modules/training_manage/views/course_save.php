<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Training Type:</td>
    <td><?php 
		$js = 'id = "training_type_id"';
		echo form_dropdown('training_type_id', training_type(), $selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Title:</td>
    <td><input name="course_title" type="text" id="course_title" value="<?php echo $course->course_title;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Description:</td>
    <td><input name="course_description" type="text" id="course_description" value="<?php echo $course->course_description;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Estimated Duration:</td>
    <td><input name="course_est_duration" type="text" id="course_est_duration" value="<?php echo $course->course_est_duration;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Estimated Cost:</td>
    <td><input name="course_est_cost" type="text" id="course_est_cost" value="<?php echo $course->course_est_cost;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Average Evaluation:</td>
    <td><input name="course_ave_eval" type="text" id="course_ave_eval" value="<?php echo $course->course_ave_eval;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="64%"><input type="submit" name="button" id="button" value="Save" />
      <a href="<?=base_url().'training_manage/course'?>">Cancel</a>      <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="12%"></td>
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

$('.row_highlight').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});
</script>