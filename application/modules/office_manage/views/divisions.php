<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url();?>office_manage/division_save/<?php echo $office_id?>">Add Division</a></td>
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
        <th width="23%" bgcolor="#D6D6D6">Division </th>
        <th width="26%" bgcolor="#D6D6D6">Description</th>
        <th width="10%" bgcolor="#D6D6D6">Order</th>
        <th width="10%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php foreach($rows as $row):?>
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $row->name;?></td>
        <td><?php echo $row->description;?></td>
        <td align="left"><?php echo $row->order;?></td>
        <td align="left"><a href="<?php echo base_url();?>office_manage/division_save/<?php echo $office_id;?>/<?php echo $row->id;?>">Edit</a> | <a href="<?php echo base_url();?>office_manage/division_delete/<?php echo $row->id;?>/<?php echo $office_id;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="2"><?php echo $this->pagination->create_links(); ?></td>
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