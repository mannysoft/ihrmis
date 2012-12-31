<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/deduction/information_save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="3%">ID</th>
    <th width="13%">Code</th>
    <th width="14%">Description</th>
    <th width="15%">Agency</th>
    <th width="11%">Type</th>
    <th width="7%">Mandatory</th>
    <th width="10%">Official</th>
    <th width="9%">Govt Share</th>
    <th width="3%">Order</th>
    <th width="6%">Optional Amount</th>
    <th width="9%">Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
        <?php
		$d = new Deduction_agency();
		
		$d->get_by_id($deduction->deduction_agency_id);
		
		?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $deduction->code;?></td>
        <td><?php echo $deduction->desc;?></td>
        <td><?php echo $d->agency_name;?></td>
        <td><?php echo $deduction->type;?></td>
        <td><?php echo $deduction->mandatory;?></td>
        <td><?php echo $deduction->official;?></td>
        <td><?php echo $deduction->er_share;?></td>
        <td><?php echo $deduction->report_order;?></td>
        <td><?php echo $deduction->optional_amount;?></td>
        <td><a href="<?php echo base_url().'payroll/deduction/information_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/deduction/information_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="11"><?php echo $this->pagination->create_links();?></td>
  </tr>
</table>
