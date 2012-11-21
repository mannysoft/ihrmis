<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/remittance/philhealth_sched_save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>Salary Bracket</th>
    <th>Salary Range</th>
    <th>Salary Based</th>
    <th>Total Monthly Premium</th>
    <th>Employee Share</th>
    <th>Employer Share</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deduction_agency();
		
		$d->get_by_id($deduction->agency_id);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $deduction->salary_bracket;?></td>
        <td><?php echo number_format($deduction->start_range, 2);?> to <?php echo number_format($deduction->end_range, 2);?></td>
        <td align="right"><?php echo number_format($deduction->salary_based, 2);?></td>
        <td align="right"><?php echo number_format($deduction->monthly_share, 2);?></td>
        <td align="right"><?php echo number_format($deduction->employee_share, 2);?></td>
        <td align="right"><?php echo number_format($deduction->employer_share, 2);?></td>
        <td><a href="<?php echo base_url().'payroll/remittance/philhealth_sched_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/remittance/philhealth_sched_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td><?php echo $this->pagination->create_links();?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
