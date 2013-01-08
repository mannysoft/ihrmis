<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>illuminate/database/connection.php line 217 to show query</td>
    <td>
    <?php if ( $employee_id != '' ):?>
    <a href="<?php echo base_url().'payroll/deduction/loan_save/0/'.$employee_id;?>">Add Loan Schedule</a>
     <?php endif;?>
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
    <th width="12%">Loan</th>
    <th width="7%">Date of Loan</th>
    <th width="4%">Loan Gross</th>
    <th width="5%">Months to Pay</th>
    <th width="6%">Monthly Due</th>
    <th width="6%">Amounts Paid</th>
    <th width="6%">Balance</th>
    <th width="29%">Remaining Months</th>
    <th width="7%">Status</th>
    <th width="16%">Actions</th>
  </tr>
  <?php foreach ($loans as $row): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->deductionInformation->desc;?></td>
        <td><?php echo $row->date_loan;?></td>
        <td align="right"><?php echo $row->loan_gross;?></td>
        <td align="right"><?php echo $row->months_pay;?></td>
        <td align="right"><?php echo $row->monthly_pay;?></td>
        <td><?php echo $row->date_from;?></td>
        <td><?php echo $row->date_to;?></td>
        <td>&nbsp;</td>
        <td><?php echo $row->status?>&nbsp;</td>
        <td><a href="<?php echo base_url().'payroll/deduction/loan_save/'.$row->id.'/'.$employee_id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/deduction/loan_delete/'.$row->id.'/'.$employee_id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td><?php //echo $this->pagination->create_links();?></td>
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