<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
    <tr>
      <td width="17%" align="right" class="type-one">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="17%" align="right" class="type-one">Name: </td>
      <td width="32%" align="left" class="type-one"><input name="name" type="text" class="ilaw" id="name" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';" onkeyup="check_id_available(this.form)" value="<?php echo set_value('name', $user_group['name']); ?>" size="35"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="type-one">Description: </td>
      <td align="left" class="type-one"><input name="description" type="text" id="description" value="<?php echo set_value('description', $user_group['description']); ?>" size="35" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/></td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="17%" align="right"><strong>
        <input type="submit" name="button2" id="button" value="Update" class="button"/>
      </strong></td>
      <td width="32%">&nbsp;</td>
      <td width="81%" align="left"><strong>
        <input name="op" type="hidden" id="op" value="1" />
        </strong></td>
    </tr>
  </table>
  </form>