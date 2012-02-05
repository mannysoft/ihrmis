<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right"><label for="tax_status">Tax Status:</label></td>
      <td width="73%">
        <input name="tax_status" type="text" id="tax_status" value="<?php echo $deduction->tax_status;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="description">Description:</label></td>
      <td>
        <input name="description" type="text" id="description" value="<?php echo $deduction->description;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Effectivity Date:</td>
      <td><input name="effectivity_date" type="text" id="effectivity_date" value="<?php echo $deduction->effectivity_date;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Ineffectivity Date</td>
      <td><input name="effectivity_date_to" type="text" id="effectivity_date_to" value="<?php echo $deduction->effectivity_date_to;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="exemption">Exemption:</label></td>
      <td><input name="exemption" type="text" id="exemption" value="<?php echo $deduction->exemption;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/remittance/pae'?>">Cancel</a><input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>