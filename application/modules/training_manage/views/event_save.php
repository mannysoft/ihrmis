<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Course Title:</td>
    <td><?php 
		$js = 'id = "course_id"';
		echo form_dropdown('course_id', training_course(), $selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Date From</td>
    <td><input name="event_from" type="text" id="event_from" value="<?php echo $event->event_from;?>" />
      Date to: 
      <input name="event_to" type="text" id="event_to" value="<?php echo $event->event_to;?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Venue:</td>
    <td><input name="event_venue" type="text" id="event_venue" value="<?php echo $event->event_venue;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Conducted By:</td>
    <td><?php 
		$js = 'id = "contact_id"';
		echo form_dropdown('contact_id', training_contact(), $contact_id_selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Local Cost:</td>
    <td><input name="event_local_cost" type="text" id="event_local_cost" value="<?php echo $event->event_local_cost;?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Other Cost:</td>
    <td><input name="event_other_cost" type="text" id="event_other_cost" value="<?php echo $event->event_other_cost;?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Event Duration:</td>
    <td><input name="event_duration" type="text" id="event_duration" value="<?php echo $event->event_duration;?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Evaluation</td>
    <td><input name="event_eval" type="text" id="event_eval" value="<?php echo $event->event_eval;?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Remarks:</td>
    <td><input name="remarks" type="text" id="remarks" value="<?php echo $event->remarks;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="64%"><input type="submit" name="button" id="button" value="Save" />
      <input name="op" type="hidden" id="op" value="1" /></td>
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