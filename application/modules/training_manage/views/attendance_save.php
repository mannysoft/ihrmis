<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Type:</td>
    <td><input name="contact_type" type="text" id="contact_type" value="<?php echo $attendance->contact_type;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Description:</td>
    <td><input name="contact_type_desc" type="text" id="contact_type_desc" value="<?php echo $attendance->contact_type_desc;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="64%"><input type="submit" name="button" id="button" value="Save" />
      <a href="<?=base_url().'training_manage/attendance'?>">Cancel</a><input name="op" type="hidden" id="op" value="1" /></td>
    <td width="12%"></td>
  </tr>
</table>
</form>