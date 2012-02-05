<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form action="" method="post">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td align="right">Name:</td>
    <td><input name="contact_name" type="text" id="contact_name" value="<?php echo $contact->contact_name;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Company:</td>
    <td><input name="contact_co" type="text" id="contact_co" value="<?php echo $contact->contact_co;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Address:</td>
    <td><input name="contact_address" type="text" id="contact_address" value="<?php echo $contact->contact_address;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">City/Municipality:</td>
    <td><input name="contact_city" type="text" id="contact_city" value="<?php echo $contact->contact_city;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Phone:</td>
    <td><input name="contact_phone" type="text" id="contact_phone" value="<?php echo $contact->contact_phone;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Fax:</td>
    <td><input name="contact_fax" type="text" id="contact_fax" value="<?php echo $contact->contact_fax;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Email:</td>
    <td><input name="contact_email" type="text" id="contact_email" value="<?php echo $contact->contact_email;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Specialization:</td>
    <td><input name="contact_specialty" type="text" id="contact_specialty" value="<?php echo $contact->contact_specialty;?>" size="50" /></td>
    <td></td>
  </tr>
  <tr>
    <td align="right">Contact Type:</td>
    <td><?php 
		$js = 'id = "contact_type_id"';
		echo form_dropdown('contact_type_id', training_contact_type(), $selected, $js); ?></td>
    <td></td>
  </tr>
  <tr>
    <td width="24%">&nbsp;</td>
    <td width="64%"><input type="submit" name="button" id="button" value="Save" />
      <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="12%"></td>
  </tr>
</table>
</form>