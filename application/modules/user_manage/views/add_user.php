<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2">
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="14%" align="right" class="type-one">Username: </td>
      <td width="32%" align="left" class="type-one"><input name="username" type="text" class="ilaw" id="username" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" onkeyup="check_id_available(this.form)" value="<?php echo set_value('username'); ?>" size="35"/>
      </td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Department / Office:</td>
      <td align="left" class="type-one"><?php echo form_dropdown('office_id', $options, $selected); ?></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Last name: </td>
      <td align="left" class="type-one"><input name="last" type="text" id="last" value="<?php echo set_value('last'); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">First name: </td>
      <td align="left" class="type-one"><input name="first" type="text" id="first" value="<?php echo set_value('first'); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Middle Name: </td>
      <td align="left" class="type-one"><input name="middle" type="text" id="middle" value="<?php echo set_value('middle'); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Password:</td>
      <td align="left" class="type-one"><input name="password" type="password" id="password" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td width="54%" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Re - type password: </td>
      <td align="left" class="type-one"><input name="repassword" type="password" id="repassword" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">User Type:</td>
      <td align="left" class="type-one"><?php echo form_dropdown('user_type', $user_type_options, $user_type_selected); ?></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">&nbsp;</td>
      <td align="left" class="type-one"><strong>
        <input type="submit" name="button2" id="button" value="Add" class="button"/>
        </strong></td>
      <td align="left">&nbsp;</td>
    </tr>
</table>
<div></div>
</form>