<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right"><label for="start_range">Start of Range</label></td>
      <td width="73%">
        <input name="start_range" type="text" id="start_range" value="<?php echo $deduction->start_range;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="end_range">End of Range</label></td>
      <td>
        <input name="end_range" type="text" id="end_range" value="<?php echo $deduction->end_range;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Fix Amount</td>
      <td><input name="fix_amount" type="text" id="fix_amount" value="<?php echo $deduction->fix_amount;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Percentage</td>
      <td><input name="percentage" type="text" id="percentage" value="<?php echo $deduction->percentage;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="over_limit">Over Limit</label></td>
      <td><input name="over_limit" type="text" id="over_limit" value="<?php echo $deduction->over_limit;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/remittance/tax_table'?>">Cancel</a><input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>