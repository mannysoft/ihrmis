<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/remittance/tax_table_save/';?>">Add</a></td>
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
    <th>Taxable Income Range</th>
    <th>Tax Due</th>
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
        <td>over <?php echo number_format($deduction->start_range, 2);?> 
        <?php if ( $deduction->end_range != '' ): ?>
        but not over <?php echo number_format($deduction->end_range, 2);?>
         <?php endif;?>
        </td>
        <td> 
		<?php if ( $deduction->fix_amount != '0' ): ?>
        	<?php echo number_format($deduction->fix_amount, 2);?> + 
        <?php endif;?>
        
   
        <?php echo $deduction->percentage;?>%  
        
        <?php if ( $deduction->over_limit != '0' ): ?>
        	of the excess over <?php echo number_format($deduction->over_limit, 2);?>
        <?php endif;?>
       
         </td>
        <td><a href="<?php echo base_url().'payroll/remittance/tax_table_save/'.$deduction->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/remittance/tax_table_delete/'.$deduction->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td><?php echo $this->pagination->create_links();?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
