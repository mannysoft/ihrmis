<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll_deductions/information_save/';?>">Add</a></td>
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
    <th>Code</th>
    <th>Description</th>
    <th>Agency</th>
    <th>Type</th>
    <th>Official</th>
    <th>Order</th>
    <th>Optional Amount</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deductions_agency();
		
		$d->get_by_id($deduction->agency_id);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td><?php //echo $position->id;?></td>
        <td><?php echo $deduction->code;?></td>
        <td><?php echo $deduction->desc;?></td>
        <td><?php echo $d->agency_name;?></td>
        <td><?php echo $deduction->type;?></td>
        <td><?php echo $deduction->official;?></td>
        <td><?php echo $deduction->report_order;?></td>
        <td><?php echo $deduction->optional_amount;?></td>
        <td><a href="<?php echo base_url().'payroll_deductions/information_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll_deductions/information_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="9"><?php echo $this->pagination->create_links();?></td>
  </tr>
</table>
