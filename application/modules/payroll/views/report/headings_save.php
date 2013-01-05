<form action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Type:</td>
      <td><?php echo form_dropdown('type', ['additional' => 'additional', 'deductions' => 'deductions'], $row->type);?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Line:</td>
      <td><?php echo form_dropdown('line', ['1' => '1', '2' => '2'], $row->line);?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Additional Compensation:</td>
      <td><?php echo form_dropdown('additional_compensation_id', $compensations, $row->additional_compensation_id);?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="29%" align="right"><label for="code">Deduction:</label></td>
      <td width="67%"><?php echo form_dropdown('deduction_id', $deductions, $row->deduction_id);?></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Caption:</td>
      <td><input name="caption" type="text" id="caption" value="<?php echo $row->caption;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" /> <a href="<?=base_url().'payroll/report/headings'?>">Cancel</a>
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" value="<?php ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
