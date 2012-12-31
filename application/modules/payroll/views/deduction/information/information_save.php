<fieldset><legend><?php echo $page_name;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellspacing="5">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="23%" align="right"><label for="code">Code:</label></td>
      <td width="73%">
        <input name="code" type="text" id="code" value="<?php echo $deduction->code;?>" size="30" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="desc">Description:</label></td>
      <td>
        <input name="desc" type="text" id="desc" value="<?php echo $deduction->desc;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Agency:</td>
      <td><?php 
		$js = 'id = "agency_id"';
		echo form_dropdown('agency_id', $agencies, $deduction->deduction_agency_id); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Type:</td>
      <td>
        <?php 
		$js = 'id = "type"';
		echo form_dropdown('type', $this->config->item('deduction_type'), $deduction->type); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Mandatory:</td>
      <td><?php 
		$js = 'id = "mandatory"';
		echo form_dropdown('mandatory', $this->config->item('options_yes_no'), $deduction->mandatory); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Tax Exempted:</td>
      <td><?php 
		$js = 'id = "tax_exempted"';
		echo form_dropdown('tax_exempted', $this->config->item('options_yes_no'), $deduction->tax_exempted); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Government Share:</td>
      <td><?php 
		$js = 'id = "er_share"';
		echo form_dropdown('er_share', $this->config->item('options_yes_no'), $deduction->er_share); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Official:</td>
      <td><?php 
		$js = 'id = "official"';
		echo form_dropdown('official', $this->config->item('official'), $deduction->official); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Optional Amount:</td>
      <td><?php 
		$js = 'id = "optional_amount"';
		echo form_dropdown('optional_amount', $this->config->item('options_yes_no'), $deduction->optional_amount); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Amount:</td>
      <td><input name="amount" type="text" id="amount" value="<?php echo $deduction->amount;?>" size="8" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Max. Amount Exempted:</td>
      <td><input name="amount_exempted" type="text" id="amount_exempted" value="<?php echo $deduction->amount_exempted;?>" size="30" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Reference Table:</td>
      <td><?php echo form_dropdown('reference_table', array(
	  													'' 				=> '', 
	  													'philhealth' 	=> 'Phil Health',
														'pagibig'		=> 'Pagibig',
														'gsis'			=> 'GSIS',
														'sss'			=> 'SSS'
														), 
														$deduction->reference_table);?>&nbsp;the table where deduction will base</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><label for="report_order">Order:</label></td>
      <td>
        <input name="report_order" type="text" id="report_order" value="<?php echo $deduction->report_order;?>" size="5" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Line Number:</td>
      <td><?php 
		$js = 'id = "line_no"';
		echo form_dropdown('line_no', array('1' => 1, '2' => 2), $deduction->line_no); 
		?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" /> <a href="<?=base_url().'payroll/deduction/information'?>">Cancel</a>
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>