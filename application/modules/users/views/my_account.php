<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td width="17%"><strong>
      <input name="op" type="hidden" id="op" value="1" />
      <input name="id" type="hidden" id="id" value="<?php echo $user['username'];?>" />
      <input name="op2" type="hidden" id="op2" value="<?php //echo $op2;?>" />
    </strong></td>
    <td width="53%">
        <div id="outputtime"><?php echo validation_errors(); ?></div></td>
    <td width="14%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>User ID:</strong></td>
    <td><?php echo $user['username'];?></td>
    <td></td>
  </tr>
  <tr>
    <td align="right"><strong>Department / Office:</strong></td>
    <td><?php echo  $office_name;?>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>First Name: </strong></td>
    <td><?php echo $user['fname'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Middle Name: </strong></td>
    <td><?php echo $user['mname'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Last Name: </strong></td>
    <td><?php echo $user['lname'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>User type: </strong></td>
    <td><?php echo $user_type;?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Current password:</strong></td>
    <td><input name="password2" type="password" id="password2" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
    <input name="hidden_password" type="hidden" id="hidden_password" value="<?php echo $user['password'];?>" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>New Password: </strong></td>
    <td><input name="new_pass" type="password" id="new_pass" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong>Re - type new password: </strong></td>
    <td><input name="re_new_pass" type="password" id="re_new_pass" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input type="submit" name="Submit" value="Change password" class="button"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>