<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="17%" align="right"><label for="code">Code:</label></td>
      <td width="79%">
        <input name="code" type="text" id="code" value="<?php echo $deduction->code;?>" size="45" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Name:</label></td>
      <td>
        <input name="name" type="text" id="name" value="<?php echo $deduction->name;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Taxable:</label></td>
      <td><input name="taxable" type="text" id="taxable" value="<?php echo $deduction->taxable;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Frequency:</label></td>
      <td><input name="frequency" type="text" id="frequency" value="<?php echo $deduction->frequency;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Order:</label></td>
      <td><input name="order" type="text" id="order" value="<?php echo $deduction->order;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="name">Deductible:</label></td>
      <td><input name="deductible" type="text" id="deductible" value="<?php echo $deduction->deductible;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="basis">Amount/Basis:</label></td>
      <td>
        <input name="basis" type="text" id="basis" value="<?php echo $deduction->basis;?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/adcom'?>">Cancel</a>
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" value="<?php ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>
