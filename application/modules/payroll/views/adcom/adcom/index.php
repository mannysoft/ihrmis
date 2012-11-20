<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/adcom/save/';?>">Add</a></td>
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
    <th>Name</th>
    <th>Taxable</th>
    <th>Frequency</th>
    <th>Order</th>
    <th>Deductible</th>
    <th>Amount/Basis</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $deduction->code;?></td>
        <td><?php echo $deduction->name;?></td>
        <td><?php echo $deduction->taxable;?></td>
        <td><?php echo $deduction->frequency;?></td>
        <td><?php echo $deduction->order;?></td>
        <td><?php echo $deduction->deductible;?></td>
        <td><?php echo $deduction->basis;?></td>
        <td><a href="<?php echo base_url().'payroll/adcom/save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/adcom/delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="9"><?php echo $this->pagination->create_links();?></td>
  </tr>
</table>