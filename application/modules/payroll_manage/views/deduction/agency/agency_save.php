<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="17%"><label for="code">Code:</label></td>
      <td width="79%">
        <input name="code" type="text" id="code" value="<?php echo $deduction->code;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td><label for="agency_name">Agency Name:</label></td>
      <td>
        <input name="agency_name" type="text" id="agency_name" value="<?php echo $deduction->agency_name;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label for="report_order">Order:</label></td>
      <td>
        <input name="report_order" type="text" id="report_order" value="<?php echo $deduction->report_order;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" value="<?php ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>
