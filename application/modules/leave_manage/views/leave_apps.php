<div id="messages"></div>
<?php $show_leave_credits_leave_apps = Setting::getField( 'show_leave_credits_leave_apps' );?>
<form action="<?php echo base_url().'leave_manage/leave_apps'?>" method="post">
<table width="100%" border="0">
  <tr>
    <td width="27%" align="right">
    <strong> 
    <input name="tracking_no" type="text" id="tracking_no" placeholder="Tracking Number" />
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
    <th width="6%">Tracking No </th>
    <th width="6%"><strong>Employee ID </strong></th>
    <th width="14%"><strong>Employee Name </strong></th>
    <th width="15%">Office</th>
    <th width="13%"><strong>Date</strong></th>
    <th width="13%">Leave Type </th>
    <th width="8%">Status</th>
    <?php if($show_leave_credits_leave_apps == 'yes'):?>
    <th width="8%"><strong>Leave Credits</strong></th>
    <?php endif;?>
    <th width="17%">Actions</th>
  </tr>
  <?php if (count($rows) >= 1): ?>

  	<?php foreach($rows as $row): ?>
		
		<?php 
        $name = $this->Employee->get_employee_info($row['employee_id']);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		$month = $this->Helps->get_month_name($row['month']);
		
		$leave_name = $this->Leave_type->get_leave_name($row['leave_type_id']);
		
		if ($row['approved'] == 0)
		{
			$status = 'For approval';
		}
		if ($row['approved'] == 1)
		{
			$status = 'Approved';
		}
		if ($row['approved'] == 2)
		{
			$status = 'Disapproved';
		}
		
		$bg = $this->Helps->set_line_colors();
		
		$date_leave = $this->Helps->get_month_name($row['month']).' '.$row['multiple'].', '.$row['year'];
		
		if ($row['multiple5'] != '')
		{
			$date_leave .= ' - '.$this->Helps->get_month_name($row['month5']).' '.$row['multiple5'].', '.$row['year5'];
		}
		
		
		
  		?>
  <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';" id="tr-<?php echo $row['id'];?>" style="border-bottom: 1px solid #999999;">
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['employee_id'];?></td>
    <td class="small_text"><?php echo $name['lname'].', '.$name['fname'].' '.$name['mname'];?></td>
    <td class="small_text"><?php echo $office_name;?></td>
    <td class="small_text"><?php echo $date_leave;?></td>
    <td class="small_text"><?php echo $leave_name; ?></td>
    <td class="small_text" id="status_<?php echo $row['id'];?>"><?php echo $status;?></td>
    <?php if($show_leave_credits_leave_apps == 'yes'):?>
		<?php 
        $total_leave = $this->Leave_card->get_total_leave_credits($row['employee_id']);
            
        $last_earn = $this->Leave_card->get_last_earn($row['employee_id']);
            
        $last_earn = ($last_earn != '') ? date('F d, Y', strtotime($last_earn)) : date('F d, Y');
        
        ?>
    <td align="right" onmouseover="Tip('Leave Balance as of = <?php  echo '<b>'.$last_earn.'</b>';?><br>Vacation Leave = <?php echo  number_format($total_leave['vacation'], 3);?><br>Sick Leave = <?php  echo number_format($total_leave['sick'], 3);?><br>Total = <?php echo number_format($total_leave['sick'] + $total_leave['vacation'], 3);?><br>MC#6 Balance: = <?php echo $this->Leave_card->get_mc_balance($row['employee_id'], $row['year5']);?>', SHADOW, true, TITLE, 'Computation')" onmouseout="UnTip()"><?php echo number_format($total_leave['sick'] + $total_leave['vacation'], 3);?>
    </td>
    <?php endif?>
    <td>
    <?php if ( $this->session->userdata('user_type') == 5):?>
	
		<a href="#" onClick="openBrWindow('<?php echo base_url();?>leave_manage/reports/leave_apps/<?php echo $row['id'];?>','','scrollbars=yes,width=900,height=600')" style="cursor: pointer;">Print Preview</a>
			
		<?php if ($row['approved'] == 0):?>
			| <a href="#" class="user_cancel_leave" leave_apps_id = "<?php echo $row['id'];?>">Cancel</a>
		<?php endif;?>
        
	<?php else:?>
    
		<?php if ($row['approved'] == 1):?>
			<a href="#" id="cancel_link">Cancel</a>
		<?php endif;?>
		
		<?php if ($row['approved'] == 0):?>
	
			<a href="#" class="approved_leave" leave_apps_id = "<?php echo $row['id'];?>" id="approve_link">Approve</a> 
            | <a href="#" class="disapproved_leave" leave_apps_id = "<?php echo $row['id'];?>" id="disapprove_link">Disapprove</a>
		
		<?php endif;?>
	
	<?php endif;?>
    </td>
  </tr>
  
  <?php endforeach;?>
<?php endif;?>  
  <tr>
    <td colspan="4"><?php echo $this->pagination->create_links(); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <?php if($show_leave_credits_leave_apps == 'yes'):?>
    <td>&nbsp;</td>
    <?php endif;?>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

<script>


$(".approved_leave").click(function(){
 	
	var sure = confirm("Are you sure you want to approve this leave?");
	
	if ( sure == false)
	{
		return false;
	}
		
	$('#messages').hide('fast');
	
	
	$('#messages').addClass("clean-green");
	
	var url = "approved_leave/" + $(this).attr("leave_apps_id");
	
	$('#status_' + $(this).attr("leave_apps_id")).html('Approved');
	$('#approve_link').hide();
	$('#disapprove_link').hide();
	$('#cancel_link').show();
		
	$('#messages').load("<?php echo base_url().('ajax/file_leave/'); ?>" + url);
	
	$('#messages').show('fast');
	
	
	// to do
	// make script to load the table again using ajax
	
	//$('#messages').html("Loading...");
	
	//show_leave_details(); 
	//alert($(this).attr("leave_apps_id"))
});

$(".disapproved_leave").click(function(){
 	
	//alert("")
	//return false;
	
	var sure = confirm("Are you sure you want to disapprove this leave?");
	
	if ( sure == false)
	{
		return false;
	}
		
	$('#messages').hide('fast');
	
	
	$('#messages').addClass("clean-green");
	
	var url = $(this).attr("leave_apps_id");
	
	$('#messages').load("<?php echo base_url().('ajax/disapproved_leave/'); ?>" + url);
	
	$('#messages').show('fast');
	
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


</script>