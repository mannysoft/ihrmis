<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th>ID</th>
    <th>Position Code</th>
    <th>Position Name</th>
    <th>Position Description</th>
    <th>Actions</th>
  </tr>
  <?php foreach ($positions as $position): ?>
  		<?php $bg = $this->Helps->set_line_colors();?>
      <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td><?php echo $position->id;?></td>
        <td><?php echo $position->position_code;?></td>
        <td><?php echo $position->name;?></td>
        <td><?php echo $position->position_description;?></td>
        <td>&nbsp;</td>
      </tr>
  <?php endforeach; ?>
  <tr>
    <td colspan="5"><?php echo $this->pagination->create_links();?></td>
  </tr>
</table>
