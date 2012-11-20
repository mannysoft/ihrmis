<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right">Additional Compensation:</td>
      <td width="73%">
      <select name="additional_compensation_id" id="additional_compensation_id">
        <?php foreach ($informations as $information): ?>
        	
			<?php $selected = $information->id == $deduction->additional_compensation_id ? 'selected' : ''; ?>
        	
            <option value="<?=$information->id;?>" <?php echo $selected?>><?=$information->code;?></option>
        
		<?php endforeach; ?>
      </select>
      </td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Effectivity Date</td>
      <td><input name="effectivity_date" type="text" id="effectivity_date" value="<?php echo $deduction->effectivity_date;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Ineffectivity Date</td>
      <td><input name="ineffectivity_date" type="text" id="ineffectivity_date" value="<?php echo $deduction->ineffectivity_date;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Amount:</td>
      <td><input name="amount" type="text" id="amount" value="<?php echo $deduction->amount;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?=base_url().'payroll/adcom/staff_entitlement/'.$employee_id?>">Cancel</a><input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>