<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="<?php echo base_url().'training_manage/contact_info';?>" method="post" id="form_contact_info">
<table width="100%" border="0">
  <tr>
    <td align="right">Filter:</td>
    <td><strong>
      <?php 
	  $js = 'id = "contact_type_id"';
	  echo form_dropdown('contact_type_id', $this->options->training_contact_type_options(), Input::get('contact_type_id'), $js);?>
    </strong></td>
    <td><a href="<?php echo base_url();?>training_manage/contact_info_save">Add Training Contact Information</a></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="58%">&nbsp;</td>
    <td width="33%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="3%" bgcolor="#D6D6D6">ID</th>
        <th width="12%" bgcolor="#D6D6D6"><strong>Name</strong></th>
        <th width="11%" bgcolor="#D6D6D6">Company</th>
        <th width="14%" bgcolor="#D6D6D6">Address</th>
        <th width="13%" bgcolor="#D6D6D6">City/Municipality</th>
        <th width="7%" bgcolor="#D6D6D6">Phone</th>
        <th width="7%" bgcolor="#D6D6D6">Fax</th>
        <th width="5%" bgcolor="#D6D6D6">Email</th>
        <th width="11%" bgcolor="#D6D6D6">Specialization</th>
        <th width="8%" bgcolor="#D6D6D6">Contact Type</th>
        <th width="9%" bgcolor="#D6D6D6"><strong>Actions</strong></th>
  </tr>
	  <?php $c = new Training_contact_type();?>
	  <?php foreach($rows as $row):?>
        
         <?php $c->get_by_id( $row->contact_type_id );?>
		<?php $bg = $this->Helps->set_line_colors(); ?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	    <td><?php echo $row->id;?></td>
	    <td><?php echo $row->contact_name;?></td>
	    <td><?php echo $row->contact_co;?></td>
	    <td><?php echo $row->contact_address;?></td>
	    <td><?php echo $row->contact_city;?></td>
	    <td><?php echo $row->contact_phone;?></td>
	    <td><?php echo $row->contact_fax;?></td>
	    <td><?php echo $row->contact_email;?></td>
	    <td><?php echo $row->contact_specialty;?></td>
	    <td><?php echo $c->contact_type;?></td>
	    <td align="right"><a href="<?php echo base_url();?>training_manage/contact_info_save/<?php echo $row->id;?>/<?php echo $page;?>">Edit</a> | <a href="<?php echo base_url();?>training_manage/contact_info_delete/<?php echo $row->id;?>/<?php echo $page;?>" class="delete_row">Delete</a></td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td colspan="4">
		  <?php if (! Input::get('contact_type_id'))
		  {
			  echo $this->pagination->create_links(); 
			} ?></td>
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
$('#contact_type_id').change(function(){

	$('#form_contact_info').submit();
});
$('.delete_row').click(function(){

	var answer = confirm("Are you sure?")
	
	if (!answer)
	{
		return false;
	}
});

</script>