<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><?php echo $msg;?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Name:</td>
    <td><input name="office_name" type="text" id="office_name" value="<?php echo set_value('office_name'); ?>" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Office Head:</td>
    <td><input type="text" name="office_head" id="office_head" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Position:</td>
    <td><input type="text" name="position" id="position" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="25%">&nbsp;</td>
    <td width="40%"><input type="submit" name="button" id="button" value="Add" />
      <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="35%"></td>
  </tr>
</table>
</form>