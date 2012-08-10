<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php elseif($msg !=''): ?>
	<div class="clean-green"><?php echo $msg ?></div>
<?php endif; ?>
<fieldset><legend><?php echo $legend;?></legend>
<br />
<form action="" method="post">
<br />

<table width="100%" border="0">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="63%"><a href="<?php echo base_url().$back_from;?>">Back to <?php echo $back_from;?></a>&nbsp;</td>
    <td width="33%">&nbsp;</td>
  </tr>
</table><br />
  <table width="100%" border="0" class="type-one">
    <tr class="type-one-header">
      <th width="2%" bgcolor="#D6D6D6">&nbsp;</th>
      <th width="20%" bgcolor="#D6D6D6">Modules</th>
      <th width="78%" bgcolor="#D6D6D6">Roles</th>
      </tr>
    <?php $p = new Permission_m();?>
	<?php foreach($permissions as $module_key => $row):?>
    <?php $bg = $this->Helps->set_line_colors();?>
    <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
      <td valign="top">
	  <?php
	  
	  
	  $class = 'class="select_all" module="'.$module_key.'"';
	   
	  $has_module_access = $p->has_module_access($group_id, $module_key);
	  echo form_checkbox('modules[]', $module_key, $has_module_access, $class);
	  echo form_hidden('main_modules[]', $module_key);
	  ?>
      </td>
      <td valign="top"><b><?=$row['name'];?></b></td>
      <td>
     <?php 
	 
	 $class = 'class="'.$module_key.'"';
	 
	foreach ($row['roles'] as $key => $val)
	{
		$p = new Permission_m();
		$p->where('module', $module_key);
		$p->where('group_id', $group_id);
		$roles = $p->get();
		
		$checked = FALSE;	
		
		$module_roles = json_decode($roles->roles);
		
		if (is_array($module_roles))
		{
			if (in_array($key, $module_roles))
			{
				$checked = TRUE;
			}
			else
			{
				$checked = FALSE;	
			}
		
		}
		
		$font = 'black';
		
		if ($checked == FALSE)
		{
			$font = 'red';
		}
				
		echo ' '.form_checkbox($module_key.'[]', $key, $checked, $class).' <font color="'.$font.'">'.$val.'</font> <br>';
	}
	?>
    </td>
      </tr>
    <?php endforeach;?>
    <tr>
      <td>&nbsp;</td>
      <td><?php //echo $this->pagination->create_links(); ?></td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <input name="op" type="hidden" id="op" value="1" /></td>
      </tr>
</table>
</form>
</fieldset>
<script>
$('.select_all').click(function(){
	
	if ($(this).attr("checked") == true)
	{
		$('.'+$(this).attr("module")).attr("checked", "checked");
	}
	else
	{
		$('.'+$(this).attr("module")).attr("checked", "");
	}
	
	
	//alert($(this).attr("module"))
	
	//$(this).attr("leave_apps_id");
});
</script>