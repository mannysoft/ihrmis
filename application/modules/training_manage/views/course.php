<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="<?php echo base_url().'training_manage/course';?>" method="post" id="form_courses" >
<table width="100%" border="0">
  <tr>
    <td align="right">Filter:</td>
    <td><strong>
      <?php 
	  $js = 'id = "training_type_id"';
	  echo form_dropdown('training_type_id', $this->options->training_type_options(), $this->input->post('training_type_id'), $js);?>
    </strong></td>
    <td><a href="<?php echo base_url();?>training_manage/course_save">Add Training Course</a></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="74%">&nbsp;</td>
    <td width="17%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="5%" bgcolor="#D6D6D6">ID</th>
        <th width="23%" bgcolor="#D6D6D6">Title </th>
        <th width="26%" bgcolor="#D6D6D6">Description</th>
        <th width="10%" bgcolor="#D6D6D6">Estimated Duration</th>
        <th width="7%" bgcolor="#D6D6D6">Estimated Cost</th>
        <th width="7%" bgcolor="#D6D6D6">Ave. Evaluation</th>
        <th width="12%" bgcolor="#D6D6D6"><strong>Training Type</strong></th>
        <th width="10%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php $t = new Training_type();?>
	  <?php foreach($rows as $row):?>
	 	<?php $t->get_by_id($row->training_type_id);?>
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $row->course_title;?></td>
        <td><?php echo $row->course_description;?></td>
        <td><?php echo $row->course_est_duration;?></td>
        <td align="right"><?php echo number_format($row->course_est_cost, 2);?></td>
        <td align="right"><?php echo $row->course_ave_eval;?></td>
        <td align="left"><?php echo $t->training_type;?></td>
        <td align="left"><a href="<?php echo base_url();?>training_manage/course_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>training_manage/course_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="3">
		  <?php 
		  if (! $this->input->post('training_type_id'))
		  {
			  echo $this->pagination->create_links(); 
			}
		  
		  ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="op" type="hidden" id="op" value="1" /></td>
        </tr>
</table>
</form>
<script>
$('#training_type_id').change(function(){

	$('#form_courses').submit();
});

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