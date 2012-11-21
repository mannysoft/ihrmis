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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="79%">&nbsp;</td>
    <td width="12%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="24%" bgcolor="#D6D6D6">Name</th>
        <th width="38%" bgcolor="#D6D6D6">Description</th>
        <th width="38%" bgcolor="#D6D6D6">Actions</th>
  </tr>
	  <?php foreach($rows as $row):?>
	<?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	    <td><?=$row->name;?></td>
	    <td><?=$row->description;?></td>
	    <td align="right">
            <a href="<?php echo base_url();?>permissions/group/<?=$row->id;?>/permissions">Permissions</a>
             <!--|
       	  	<a href="<?php echo base_url();?>students/delete/<?=$row->id;?>" class="delete_office">Delete</a> |
            <a href="<?php echo base_url();?>students/bill/<?=$row->id;?>" class="create_bill">Create Bill</a>-->
       	  
        </td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td><?php echo $this->pagination->create_links(); ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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