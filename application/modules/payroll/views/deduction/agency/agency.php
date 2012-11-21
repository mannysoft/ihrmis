<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/deduction/agency_save/';?>">Add</a></td>
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
    <th>Agency</th>
    <th>Order</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($deductions as $deduction): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $deduction->id;?></td>
        <td><?php echo $deduction->code;?></td>
        <td><?php echo $deduction->agency_name;?></td>
        <td><?php echo $deduction->report_order;?></td>
        <td><a href="<?php echo base_url().'payroll/deduction/agency_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/deduction/agency_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="5"><?php echo $this->pagination->create_links();?></td>
  </tr>
</table>