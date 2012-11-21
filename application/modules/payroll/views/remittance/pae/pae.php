<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/remittance/pae_save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>ID</th>
    <th>Tax Status</th>
    <th>Description</th>
    <th>Effectivity Date</th>
    <th>Ineffectivity Date</th>
    <th>Exemption</th>
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
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $deduction->tax_status;?></td>
        <td><?php echo $deduction->description;?></td>
        <td><?php echo $deduction->effectivity_date;?></td>
        <td><?php echo $deduction->effectivity_date_to;?></td>
        <td align="right"><?php echo number_format($deduction->exemption, 2);?></td>
        <td><a href="<?php echo base_url().'payroll/remittance/pae_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/remittance/pae_delete/'.$deduction->id;?>">Delete</a></td>
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
