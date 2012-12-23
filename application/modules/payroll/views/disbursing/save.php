<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td width="17%">&nbsp;</td>
      <td width="79%">&nbsp;</td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Name:</label></td>
      <td>
        <input name="name" type="text" id="name" value="<?php echo $row->name;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/disbursing'?>">Cancel</a>
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" value="<?php ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>
