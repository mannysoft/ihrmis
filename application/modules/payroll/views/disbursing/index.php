<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="<?php echo base_url().'payroll/disbursing/save/';?>">Add</a></td>
  </tr>
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="68%">&nbsp;</td>
    <td width="13%"></td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="5%">ID</th>
    <th width="29%">Name</th>
    <th width="66%" align="left">Actions</th>
  </tr>
  <?php foreach ($rows as $row): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->name;?></td>
        <td><a href="<?php echo base_url().'payroll/disbursing/save/'.$row->id;?>">Edit</a> | <a href="<?php echo base_url().'payroll/disbursing/delete/'.$row->id;?>">Delete</a></td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>