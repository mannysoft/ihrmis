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
    <td align="right"><a href="<?php echo base_url();?>training_manage/event_save">Add Training Event</a></td>
  </tr>
  <tr>
    <td width="9%"><?php echo $msg;?></td>
    <td width="67%">&nbsp;</td>
    <td width="24%"></td>
  </tr>
</table>
<table width="97%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" bgcolor="#D6D6D6">ID</th>
        <th width="8%" bgcolor="#D6D6D6"><strong>Course Title</strong></th>
        <th width="7%" bgcolor="#D6D6D6">Date From</th>
        <th width="5%" bgcolor="#D6D6D6">Date To</th>
        <th width="14%" bgcolor="#D6D6D6">Venue</th>
        <th width="13%" bgcolor="#D6D6D6">Conducted By</th>
        <th width="8%" bgcolor="#D6D6D6">Attendees</th>
        <th width="5%" bgcolor="#D6D6D6">Local Cost</th>
        <th width="5%" bgcolor="#D6D6D6">Other Cost</th>
        <th width="7%" bgcolor="#D6D6D6">Actual Duration</th>
        <th width="8%" bgcolor="#D6D6D6">Evaluation</th>
        <th width="7%" bgcolor="#D6D6D6">Remarks</th>
        <th width="11%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php
	  $course = new Training_course();
	  $contact = new Training_contact();
	  ?>
	  <?php foreach($rows as $row):?>
	 	<?php $course->get_by_id($row->course_id);?>
        <?php $contact->get_by_id($row->contact_id);?>
        
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $course->course_title;?></td>
	    <td><?php echo $row->event_from;?></td>
        <td><?php echo $row->event_to;?></td>
        <td><?php echo $row->event_venue;?></td>
        <td><a href="#"><?php echo $contact->contact_name;?></a></td>
        <td align="right">
		<?php 
		$ta = new Training_attendee();
		$ta->get_by_event_id($row->id);
		//echo $ta->result_count();
		
		?>
        <a href="<?php echo base_url().'training_manage/attendance/'.$row->id;?>"><?php echo $ta->result_count();?></a>
        </td>
        <td align="right"><?php echo number_format($row->event_local_cost, 2);?></td>
        <td align="right"><?php echo number_format($row->event_other_cost, 2);?></td>
        <td><?php echo $row->event_duration;?></td>
        <td><?php echo $row->event_eval;?></td>
        <td><?php echo $row->event_remarks;?></td>
        <td align="right"><a href="<?php echo base_url();?>training_manage/event_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>training_manage/event_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="5"><?php echo $this->pagination->create_links(); ?></td>
          <td>&nbsp;</td>
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