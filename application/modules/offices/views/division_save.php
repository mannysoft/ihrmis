<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right"><strong>Office:</strong></td>
    <td>
	<?php 
	$o = new Office_m();
	$o->get_by_office_id($office_id);
	echo $o->office_name;
	?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right"><strong>Division Name:</strong></td>
    <td><input name="name" type="text" id="name" value="<?php echo $division->name;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right"><strong>Description:</strong></td>
    <td><input name="description" type="text" id="description" value="<?php echo $division->description;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right"><strong>Order:</strong></td>
    <td><input name="order" type="text" id="order" value="<?php echo $division->order;?>" size="5" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="64%"><input type="submit" name="button" id="button" value="Save" />
    <a href="<?=base_url().'office_manage/divisions/'.$office_id;?>">Cancel</a>
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