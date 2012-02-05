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
    <td><a href="<?php echo base_url();?>training_manage/contact_type_save">Add Training Contact Type</a></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="58%">&nbsp;</td>
    <td width="33%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="8%" bgcolor="#D6D6D6">ID</th>
        <th width="20%" bgcolor="#D6D6D6"><strong>Type</strong></th>
        <th width="63%" bgcolor="#D6D6D6">Description</th>
        <th width="9%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php $c = new Training_contact_type();?>
	  <?php foreach($rows as $row):?>
        
         <?php $c->get_by_id( $row->contact_type_id );?>
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $row->contact_type;?></td>
	    <td><?php echo $row->contact_type_desc;?></td>
	    <td align="right"><a href="<?php echo base_url();?>training_manage/contact_type_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>training_manage/contact_type_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="2"><?php echo $this->pagination->create_links(); ?></td>
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

</script>