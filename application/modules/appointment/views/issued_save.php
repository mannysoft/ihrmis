<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Code:</td>
    <td><input name="office_code" type="text" id="office_code" value="<?php echo set_value('office_code', $office['office_code']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Name:</td>
    <td><input name="office_name" type="text" id="office_name" value="<?php echo set_value('office_name', $office['office_name']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Address:</td>
    <td><input name="office_address" type="text" id="office_address" value="<?php echo set_value('office_address', $office['office_address']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Salary Grade to use:</td>
    <td><?php 
	$options = array(
                  ''  			=> 'Regular',
                  'hospital'    => 'Hospital'
                );
	$js = 'id= "salary_grade_type"';echo form_dropdown('salary_grade_type', $options, $office['salary_grade_type'], $js);?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Head:</td>
    <td><input name="office_head" type="text" id="office_head" value="<?php echo set_value('office_head', $office['office_head']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Employee ID:</td>
    <td><input name="employee_id" type="text" id="employee_id" value="<?php echo set_value('employee_id', $office['employee_id']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Position:</td>
    <td><input name="position" type="text" id="position" value="<?php echo set_value('position', $office['position']); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="40%"><input type="submit" name="button" id="button" value="Save" />
      <input name="op" type="hidden" id="op" value="1" /><a href="<?php echo base_url().'office_manage/view_offices'?>">Cancel</a></td>
    <td width="35%"></td>
  </tr>
</table>
</form>