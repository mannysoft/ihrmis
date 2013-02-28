<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>illuminate/database/connection.php line 217 to show query</td>
    <td>
    </td>
  </tr>
  <tr>
    <td width="19%"><?php echo form_office_dropdown();?></td>
    <td width="56%"><select name="employee_id" id="employee_id">
      <option value="0">--All--</option>
    </select>
    <input type="submit" name="go" id="go" value="Go" />&nbsp;
    <input name="op" type="hidden" id="op" value="1" /></td>
    <td width="25%"></td>
  </tr>
</table>
</form>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="2%">ID</th>
    <th width="14%">Loan</th>
    <th width="10%">Date of Loan</th>
    <th width="9%">Loan Gross</th>
    <th width="5%">Months to Pay</th>
    <th width="9%">Monthly Due</th>
    <th width="9%">Amount Paid</th>
    <th width="10%">Balance</th>
    <th width="11%">Remaining Months</th>
    <th width="11%">Status</th>
    <th width="10%">&nbsp;</th>
  </tr>
  <?php foreach ($loans as $row): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->deductionInformation->desc;?></td>
        <td><?php echo $row->date_loan;?></td>
        <td align="right"><?php echo number_format($row->loan_gross, 2);?></td>
        <td align="right"><?php echo $row->months_pay;?></td>
        <td align="right"><?php echo number_format($row->monthly_pay, 2);?></td>
        <td align="right"><a href="<?php echo base_url().'payroll/report/loan_payments/'.$row->id.'/'.$employee_id?>"><?php echo number_format(Deductions::amountPaid($row->id), 2);?></a></td>
        <td align="right"><?php echo number_format($row->loan_gross - Deductions::amountPaid($row->id), 2);?></td>
        <td align="right"><?php echo $row->months_pay - Deductions::countMonthPaid($row->id);?></td>
        <td><?php echo $row->status?>&nbsp;</td>
        <td></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php $this->load->view('ajax/js'); // located at views/ajax/js.php?>