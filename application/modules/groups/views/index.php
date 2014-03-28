<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo anchor('groups/add', 'Add Group', 'class="btn-add-right"');?></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="79%">&nbsp;</td>
    <td width="12%"></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="24%" bgcolor="#D6D6D6">Name</th>
        <th width="38%" bgcolor="#D6D6D6">Description</th>
        <th width="38%" bgcolor="#D6D6D6">Actions</th>
  </tr>
	  <?php foreach($rows as $row):?>
	<?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" style="border-bottom: 1px solid #999999;">
	    <td><?=$row->name;?></td>
	    <td><?=$row->description;?></td>
	    <td align="right">
        	<a href="<?php echo base_url();?>groups/save/<?=$row->id;?>">Edit</a> |
            <a href="<?php echo base_url();?>permissions/group/<?=$row->id;?>/groups">Permissions</a>
        </td>
        </tr>
		<?php endforeach;?>
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
</table>
</form>