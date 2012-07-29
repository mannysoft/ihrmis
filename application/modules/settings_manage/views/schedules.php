<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<table width="100%" border="0">
  <tr>
    <td width="8%">&nbsp;</td>
    <td width="72%">&nbsp;</td>
    <td width="20%"><a href="<?php echo base_url().'settings_manage/schedules_save'?>">Create Schedule</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<form method="post" action="" enctype="multipart/form-data">
<table id="dtr.table" width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="3%" bgcolor="#D6D6D6">ID</th>
    <th width="19%" bgcolor="#D6D6D6"><strong>Description</strong></th>
    <th width="9%" bgcolor="#D6D6D6">AM IN</th>
    <th width="10%" bgcolor="#D6D6D6">AM OUT</th>
    <th width="10%" bgcolor="#D6D6D6">PM IN</th>
    <th width="11%" bgcolor="#D6D6D6"><strong>PM OUT</strong></th>
    <th width="38%" bgcolor="#D6D6D6">Actions</th>
    </tr>
  <?php foreach($rows as $row):?>
  <?php $times  = unserialize($row->times);?>
  <?php $bg = $this->Helps->set_line_colors();?>
		
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td><?php echo $row->id;?></td>
    <td><?php echo $row->name;?></td>
    <td><?php echo ($times['am_in_hour'] and $times['am_in_min']) ? $times['am_in_hour'].':'.$times['am_in_min'] : '';?></td>
    <td><?php echo ($times['am_out_hour'] and $times['am_out_min']) ? $times['am_out_hour'].':'.$times['am_out_min'] : '';?></td>
    <td><?php echo ($times['pm_in_hour'] and $times['pm_in_min']) ? $times['pm_in_hour'].':'.$times['pm_in_min'] : '';?></td>
    <td><?php echo ($times['pm_out_hour'] and $times['pm_out_min']) ? $times['pm_out_hour'].':'.$times['pm_out_min'] : '';?></td>
    <td><a href="<?php echo base_url();?>settings_manage/schedules_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>settings_manage/schedules_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
    </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td> <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> 
    <td></td> 
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
</script>