<div id="messages"></div>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td width="27%" align="right">
    <strong>Tracking No: 
    <input name="tracking_no" type="text" id="tracking_no" />
    </strong></td>
    <td width="12%"><strong>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
      <input name="op" type="hidden" id="op" value="1" />
    </strong>
    </td>
    <td width="61%"><div id="msg"></div></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
  <tr class="type-one-header">
    <th width="7%">Tracking No </th>
    <th width="7%"><strong>Employee ID </strong></th>
    <th width="18%"><strong>Employee Name </strong></th>
    <th width="12%">Office</th>
    <th width="14%"><strong>Days Applied For</strong></th>
    <th width="16%">Actions</th>
    <th width="10%">Status</th>
  </tr>
  <?php if (count($rows) >= 1):?>
  	<?php foreach($rows as $row): ?>
   	<?php
		
		$name = $this->Employee->get_employee_info($row['employee_id']);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		$month = $this->Helps->get_month_name($row['month']);
				
		if ($row['status'] == 'inactive')
		{
			$status = 'For approval';
		}
		if ($row['status'] == 'active')
		{
			$status = 'Approved';
		}
		if ($row['status'] == 2)
		{
			$status = 'Disapproved';
		}
		
		$bg = $this->Helps->set_line_colors();
		
  ?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" id="tr-<?php echo $row['id'];?>" style="border-bottom: 1px solid #999999;">
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['employee_id'];?></td>
    <td><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td><?php echo $office_name;?></td>
    <td><?php echo $this->Helps->get_month_name($row['month']).' '.$row['dates'].' ,'.$row['year'];?></td>
    <td>
      <!--If leave manager -->
	  <?php if ( $this->session->userdata('user_type') == 5):?>
      	<a href="#" onClick="print_preview(<?php echo intval($row['id']);?>)" style="cursor: pointer;">Print Preview</a>
      	<?php if($row['status'] == 'active'):?>
		<?php else:?>
      		| <a href="#" class="user_cancel_leave" leave_apps_id = "<?php echo $row['id'];?>">Cancel</a>
      	<?php endif;?>
        
		<?php else:?>
            <?php if ($row['status'] == 'active'):?>
            	<a href="#">Cancel</a>
            <?php endif;?>
            <?php if ($row['status'] == 'inactive'):?>
          		<a href="#" class="approved_leave" leave_apps_id = "<?php echo $row['id'];?>">Approve</a> | <a href="<?php echo base_url();?>leave_manage/disapproved_leave/<?php echo $row['id'];?>" >Disapprove</a>
          	<?php endif;?>
        
        
     <?php endif;?>
    </td>
    <td><?php echo $status;?></td>
  </tr>
  
  	<?php endforeach;?>
  <?php endif;?>
  <tr>
    <td colspan="3"><?php echo $this->pagination->create_links(); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<script>

$(".approved_leave").click(function(){
 	
	var sure = confirm("Are you sure you want to approve this CTO?");
	
	if ( sure == false)
	{
		return false;
	}
	
	$('#messages').hide('fast');
	
	$('#messages').addClass("clean-green");
	
	$.post("<?php echo base_url().('ajax/file_cto/'); ?>", 
			
			{	
				id:$(this).attr("leave_apps_id"), 
				process:2
			}, 
			function(data) {
	  		$('#messages').html(data);
	});
	
	$('#messages').show('fast');
	
	
	// to do
	// make script to load the table again using ajax
	
	//$('#messages').html("Loading...");
	
	//show_leave_details(); 
	//alert($(this).attr("leave_apps_id"))
});

$(".user_cancel_leave").click(function(){
 	
	//alert($(this).attr("leave_apps_id"))
	
	var sure = confirm("Are you sure you want to cancel this leave?");
	
	if ( sure == false)
	{
		return false;
	}
	
	//alert(sure);
	
	//return	
	$('#messages').hide('fast');
	
	
	$('#messages').addClass("clean-green");
	$.get("<?php echo base_url().('leave_manage/cancel_leave_apps/'); ?>" + $(this).attr("leave_apps_id"));
	//$('#messages').load("<?php echo base_url().('leave_manage/cancel_leave_apps/'); ?>" + $(this).attr("leave_apps_id"));
	$('#messages').html('Leave has been cancelled!<br>');
	//$('#messages').show(100);
	$('#messages').slideDown('slow');
	
	$('#tr-' + $(this).attr("leave_apps_id")).remove();
	
	$('#messages').fadeOut(10000);
	

});

function print_preview(leave_apps_id)
{
	openBrWindow('<?php echo base_url();?>leave_manage/reports/cto_apps/'+leave_apps_id,'','scrollbars=yes,width=900,height=600');
	//alert(param)
}
</script>