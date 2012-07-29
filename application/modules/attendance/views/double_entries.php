<div id="messages"></div>
<form id="myform" method="post" target="" enctype="multipart/form-data">
<table width="100%" border="0" class="type-one">
  <tr>
    <td colspan="5"><strong>
      <?php $js = 'id= "month"';echo form_dropdown('month', $month_options, $month_selected, $js);?>
      </strong><strong>
        <?php $js = 'id= "year"';echo form_dropdown('year', $year_options, $year_selected, $js);?>
        </strong>
      <input name="filter" type="submit" class="button" id="filter" value="Filter"/>
      <strong>
        <input name="op" type="hidden" id="op" value="1" />
      </strong></td>
    </tr>
  <tr>
    <th width="15%">Employee 
      ID</td>
    <th width="29%">Name</th>
    <th width="6%">&nbsp;</th>
    <th width="44%">Remove One</th>
    <th width="6%">&nbsp;</th>
  </tr>
  <?php foreach($rows as $row): ?>
  
  <?php
		$employee_id = $row['employee_id'];
		$log_date 	= $row['log_date'];
		
		$name = $this->Employee->get_employee_info($row['employee_id']);
		
		$logs = $this->Dtr->double_entries_employee($row['employee_id'], $row['log_date']);
				
		$bg = $this->Helps->set_line_colors();
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
    <td><?php echo $name['employee_id']?></td>
    <td><?php echo $name['lname'].', '. $name['fname'].' '.$name['mname']?></td>
    <td>&nbsp;</td>
    <td>
	<?php foreach( $logs as $log):?>
    <div id="<?php echo $log['id'];?>">Date: <?php echo $log['log_date'];?> -- am_login: <?php echo $log['am_login'];?>, am_logout: <?php echo $log['am_logout'];?>, pm_login: <?php echo $log['pm_login'];?>, pm_logout: <?php echo $log['pm_logout'];?><a href="#" dtr_id="<?php echo $log['id'];?>" class="remove_dtr">remove</a></div><br />
    <?php endforeach;?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<script>

$(".remove_dtr").click(function(){
 	
	var sure = confirm("Remove?");
	
	if ( sure == false)
	{
		return false;
	}
		
	$('#messages').hide('fast');
		
	$('#messages').addClass("clean-green");
		
	$('#messages').load("<?php echo base_url().('ajax/remove_dtr/'); ?>" + $(this).attr("dtr_id"));
	
	$('#messages').show('fast');
	
	// hide the dtr
	$('#'+$(this).attr("dtr_id")).hide('fast');	
});
</script>