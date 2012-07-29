<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th colspan="2" align="center">Payment</th>
    <th>&nbsp;</th>
  </tr>
  <tr class="type-one-header">
    <th>ID</th>
    <th>Loan</th>
    <th>Status</th>
    <th>Date of Loan</th>
    <th>Loan Gross</th>
    <th>Months to Pay</th>
    <th>Amount</th>
    <th align="center">Start</th>
    <th align="center">End</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($loans as $loan): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deductions_agency();
		
		$d->get_by_id($loan->loan_agency_id);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td><?php //echo $position->id;?></td>
        <td><?php echo $d->agency_name;?></td>
        <td><?php echo $loan->status;?></td>
        <td><?php echo $loan->loan_date;?></td>
        <td align="right"><?php echo number_format($loan->loan_gross, 2);?></td>
        <td align="right"><?php echo $loan->months_to_pay;?></td>
        <td align="right"><?php echo number_format($loan->amount_monthly, 2);?></td>
        <td><?php echo $loan->pay_start;?></td>
        <td><?php echo $loan->pay_end;?></td>
        <td><a href="<?php //echo base_url().'payroll/deductions_information_save/'.$deduction->id;?>">Edit</a> | <a href="<?php //echo base_url().'payroll/deductions_information_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="10"><?php //echo $this->pagination->create_links();?></td>
  </tr>
</table>