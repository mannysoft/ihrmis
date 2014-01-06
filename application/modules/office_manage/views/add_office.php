<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif (Session::flashData('msg')): ?>
<div class="clean-green"><?php echo Session::flashData('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td colspan="2" align="center"><?php echo $msg;?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Code:</td>
    <td><input name="office_code" type="text" id="office_code" value="<?php echo set_value('office_code'); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Name:</td>
    <td><input name="office_name" type="text" id="office_name" value="<?php echo set_value('office_name'); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Address:</td>
    <td><input type="text" name="office_address" id="office_address" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Salary Grade to use:</td>
    <td><?php 
	$options = array(
                  ''  			=> 'Regular',
                  'hospital'    => 'Hospital'
                );
	$js = 'id= "salary_grade_type"';echo form_dropdown('salary_grade_type', $options, '', $js);?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Head:</td>
    <td><input type="text" name="office_head" id="office_head" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Employee ID of Office Head:</td>
    <td><input type="text" name="employee_id" id="employee_id" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Position of the Office Head:</td>
    <td><input type="text" name="position" id="position" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Location:</td>
    <td><?php 
	$options = array(
                  'internal'  	=> 'Internal',
                  'external'    => 'External'
                );
	$js = 'id= "office_location"';echo form_dropdown('office_location', $options, '', $js);?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Disbursing Officer:</td>
    <td><input name="disbursing_officer" type="text" id="disbursing_officer" value="<?php echo set_value('disbursing_officer'); ?>" /></td>
    <td>Use for payroll</td>
  </tr>
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="40%"><input type="submit" name="button" id="button" value="Add" />
      <input name="op" type="hidden" id="op" value="1" />
      <a href="<?php echo base_url().'office_manage/view_offices'?>">Cancel</a></td>
    <td width="35%"></td>
  </tr>
</table>
</form>