<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Description:</td>
    <td><input name="name" type="text" id="name" value="<?php echo $sched->name;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Time</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td align="right">AM IN:</td>
    <td><?php 
		$js = 'id = "am_in_hour"';
		echo form_dropdown('am_in_hour', hour_options( TRUE ), $am_in_hour_selected, $js); ?>
      <?php 
		$js = 'id = "am_in_min"';
		echo form_dropdown('am_in_min', minute_options( TRUE ), $am_in_min_selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">AM OUT:</td>
    <td><?php 
		$js = 'id = "am_out_hour"';
		echo form_dropdown('am_out_hour', hour_options( TRUE ), $am_out_hour_selected, $js); ?>
      <?php 
		$js = 'id = "am_out_min"';
		echo form_dropdown('am_out_min', minute_options( TRUE ), $am_out_min_selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">PM IN:</td>
    <td><?php 
		$js = 'id = "pm_in_hour"';
		echo form_dropdown('pm_in_hour', hour_options( TRUE ), $pm_in_hour_selected, $js); ?>
      <?php 
		$js = 'id = "pm_in_min"';
		echo form_dropdown('pm_in_min', minute_options( TRUE ), $pm_in_min_selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">PM OUT:</td>
    <td><?php 
		$js = 'id = "pm_out_hour"';
		echo form_dropdown('pm_out_hour', hour_options( TRUE ), $pm_out_hour_selected, $js); ?>
      <?php 
		$js = 'id = "pm_out_min"';
		echo form_dropdown('pm_out_min', minute_options( TRUE ), $pm_out_min_selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td width="21%">&nbsp;</td>
    <td width="34%"><input type="submit" name="button" id="button" value="Save" />
      <input name="op" type="hidden" id="op" value="1" />
      <a href="<?php echo base_url();?>attendance/schedules">Cancel</a></td>
    <td width="45%"></td>
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