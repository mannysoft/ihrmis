<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right"><label for="start_range">Start of Range:</label></td>
      <td width="73%">
        <input name="start_range" type="text" id="start_range" value="<?php echo $deduction->start_range;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="end_range">End of Range:</label></td>
      <td>
        <input name="end_range" type="text" id="end_range" value="<?php echo $deduction->end_range;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Salary Based:</td>
      <td><input name="salary_based" type="text" id="salary_based" value="<?php echo $deduction->salary_based;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Monthly Share</td>
      <td><input name="monthly_share" type="text" id="monthly_share" value="<?php echo $deduction->monthly_share;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="employee_share">Employee Share:</label></td>
      <td><input name="employee_share" type="text" id="employee_share" value="<?php echo $deduction->employee_share;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="employee_share">Employer Share:</label></td>
      <td><input name="employer_share" type="text" id="employer_share" value="<?php echo $deduction->employer_share;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/remittance/philhealth_sched'?>">Cancel</a><input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>