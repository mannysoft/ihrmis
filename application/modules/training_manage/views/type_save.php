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
    <td><input name="training_type" type="text" id="training_type" value="<?php echo $type->training_type;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Description:</td>
    <td><textarea name="training_type_desc" cols="50" id="training_type_desc"><?php echo $type->training_type_desc;?></textarea></td>
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
</script>