<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<table width="100%" border="0">
  <tr>
    <td><a href="<?php echo base_url();?>settings_manage/employee_schedule">Back</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <th width="56%" bgcolor="#D6D6D6">Name</th>
    <th width="44%" bgcolor="#D6D6D6">&nbsp;</th>
    </tr>
    <?php $oe  = new Employee_m();?>
  <?php foreach($employees as $employee):?>
   <?php $oe->get_by_employee_id( $employee );?>
  <?php $bg = $this->Helps->set_line_colors();?>
		
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td><?php echo $oe->lname.', '.$oe->fname;?></td>
    <td>&nbsp;</td>
    </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td> 
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