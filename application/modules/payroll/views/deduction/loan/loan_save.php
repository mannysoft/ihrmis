<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right">Loan:</td>
      <td width="73%">
      <select name="deduction_information_id" id="deduction_information_id">
        <?php foreach ($informations as $information): ?>
        	
			<?php $selected = $information->id == $deduction->deduction_information_id ? 'selected' : ''; ?>
        	
            <option value="<?=$information->id;?>" <?php echo $selected?>><?=$information->desc;?></option>
        
		<?php endforeach; ?>
      </select>
      </td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Date Loan</td>
      <td><input name="date_loan" type="text" id="date_loan" value="<?php echo $deduction->date_loan;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Loan Gross</td>
      <td><input name="loan_gross" type="text" id="loan_gross" value="<?php echo $deduction->loan_gross;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Months to Pay</td>
      <td><input name="months_pay" type="text" id="months_pay" value="<?php echo $deduction->months_pay;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Monthly Due</td>
      <td><input name="monthly_pay" type="text" id="monthly_pay" value="<?php echo $deduction->monthly_pay;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Start:</td>
      <td><input name="date_from" type="text" id="date_from" value="<?php echo $deduction->date_from;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">End:</td>
      <td><input name="date_to" type="text" id="date_to" value="<?php echo $deduction->date_to;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Status:</td>
      <td>
	  <?php 
	  $checked = $deduction->status == 'active' ? TRUE : FALSE;
	  echo form_checkbox('status', 'active', $checked);
	  ?>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/deduction/loan/'.$employee_id?>">Cancel</a><input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>