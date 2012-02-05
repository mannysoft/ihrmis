<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
    <tr>
      <td width="17%" align="right" class="type-one">User ID: </td>
      <td>&nbsp;</td>
      <td align="left"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    </tr>
    <tr>
      <td align="right" class="type-one">Department / Office:</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('office_id', $options, $selected); ?></span></td>
    </tr>
    <tr>
      <td align="right" class="type-one">Last name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="last" type="text" id="last" value="<?php echo $lname;?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    </tr>
    <tr>
      <td align="right" class="type-one">First name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="first" type="text" id="first" value="<?php echo $fname;?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    </tr>
    <tr>
      <td align="right" class="type-one">Middle Name </td>
      <td>&nbsp;</td>
      <td align="left"><input name="middle" type="text" id="middle" value="<?php echo $mname;?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
    </tr>
    <tr>
      <td align="right" class="type-one">Password</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one">
        <input name="password" type="password" id="password" value="<?php echo $password;?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      </span></td>
    </tr>
    <tr>
      <td align="right" class="type-one">User Type:</td>
      <td>&nbsp;</td>
      <td align="left"><span class="type-one"><?php echo form_dropdown('user_type', $user_type_options, $user_type_selected); ?></span></td>
    </tr>
    <tr>
      <td width="17%" align="right"><strong>
        <input type="submit" name="button2" id="button" value="Update" class="button"/>
      </strong></td>
      <td width="2%">&nbsp;</td>
      <td width="81%" align="left"><input name="user_id" type="hidden" id="user_id" value="<?php echo $user_id;?>" />
        <strong>
        <input name="op" type="hidden" id="op" value="1" />
        </strong></td>
    </tr>
  </table>
  </form>