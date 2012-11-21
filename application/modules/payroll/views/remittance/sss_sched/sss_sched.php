<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><!--<a href="<?php echo base_url().'payroll/remittance/philhealth_sched_save/';?>">Add</a>--></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th colspan="3" rowspan="3">Range of Compensation</th>
    <th width="9%" rowspan="3">Monthly Salary Credit</th>
    <th colspan="7">Employer - Employee</th>
    <th>SE/ VM/ OFW</th>
  </tr>
  <tr class="type-one-header">
    <th colspan="3">Social Security</th>
    <th width="11%">EC</th>
    <th colspan="3">Total Contribution</th>
    <th width="11%" rowspan="2">Total Contribution</th>
  </tr>
  <tr class="type-one-header">
    <th width="7%">ER</th>
    <th width="8%">EE</th>
    <th width="9%">Total</th>
    <th>ER</th>
    <th width="10%">ER</th>
    <th width="9%">EE</th>
    <th width="9%">Total</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deduction_agency();
		
		$d->get_by_id($deduction->agency_id);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td width="8%" align="right"><?php echo number_format($deduction->range_from, 2);?></td>
        <td width="2%" align="center">-</td>
        <td width="7%" align="right"><?php echo number_format($deduction->range_to, 2);?></td>
        <td align="right"><?php echo number_format($deduction->monthly_salary, 2);?></td>
        <td align="right"><?php echo number_format($deduction->ss_er, 2);?></td>
        <td align="right"><?php echo number_format($deduction->ss_ee, 2);?></td>
        <td align="right"><?php echo number_format($deduction->ss_total, 2);?></td>
        <td align="right"><?php echo number_format($deduction->ec_er, 2);?></td>
        <td align="right"><?php echo number_format($deduction->tc_er, 2);?></td>
        <td align="right"><?php echo number_format($deduction->tc_ee, 2);?></td>
        <td align="right"><?php echo number_format($deduction->tc_total, 2);?></td>
        <td align="right"><?php echo number_format($deduction->total_contribution, 2);?></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td></td>
    <td></td>
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
  </tr>
</table>
