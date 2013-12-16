<?php if ($pop_up == 1): ?>
<script src="<?php echo base_url();?>js/function.js"></script>
<script>openBrWindow('<?php echo base_url().$report_file;?>','','scrollbars=yes,width=900,height=700')</script>
<?php endif; ?>


<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo $this->session->flashdata('msg');?></div><br />
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="17%" align="right">&nbsp;</td>
    <td width="30%">&nbsp;</td>
    <td width="10%" align="right">&nbsp;</td>
    <td width="43%" align="right"><?php echo $cart; ?> <?php echo $btn_cart; ?> <a href="<?php echo base_url();?>employees/index"> Cancel</a></td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="8%" bgcolor="#D6D6D6"><strong>Employee No.</strong></th>
        <th width="25%" bgcolor="#D6D6D6"><strong>Employee Name</strong></th>
        <th width="30%" bgcolor="#D6D6D6"><strong>Department / Office</strong></th>
      <th width="8%" bgcolor="#D6D6D6"><strong>Status</strong></th>
          <th width="10%" bgcolor="#D6D6D6"><strong>Date Requested</strong></th>
        <th width="30%" bgcolor="#D6D6D6"><strong>Action</strong></th>
  </tr>
	  
	  <?php 
	$add_to_cart ='';
	
	foreach($results as $result)
	{	
		//get by employee ID
		$e = new Employee_m();
		$rows = $e->get_by_id($result->employee_id);
		
		if($e->count() >= '1'):
			foreach($rows as $row):
				if($row->id == $result->employee_id):
					$add_to_cart ="<a href='".base_url()."employees/remove_cart/".$page."/".$row->id."/1'>Remove to Request<a>";
				endif;
			endforeach;	
		endif;
		
		$office_name = $this->Office->get_office_name($row->office_id);
		
		$pics = $row->pics;	
		if($pics == "" || !file_exists("pics/$pics"))
		{
			$pics = 'not_available.jpg';
		}

		$bg = $this->Helps->set_line_colors();
		
		?><tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
		<td bgcolor=""><?php echo $row->employee_id;?></td>
        <td bgcolor=""><?php echo strtoupper($row->lname.', '.$row->fname.' '.$row->mname);?></td>
        <td bgcolor=""><?php echo $office_name;?></td>
        <td bgcolor=""><?php echo ucwords($result->status);?></td>
        <td bgcolor=""><?php echo $result->date_request;?></td>
        <td align="right" bgcolor="">

       	<?php echo $add_to_cart; ?> <a href="#" onmouseover="Tip('<img src=\'<?php echo base_url();?>pics/<?php echo $pics;?>\'><br><center><?php echo $row->position;?></center>', SHADOW, true, TITLE, '<?php echo $row->fname.' '.$row->mname.' '.$row->lname.' Details';?>')" onmouseout="UnTip()" style="cursor: pointer;">Picture</a></td>
        </tr>
		<?php } ?>
        <tr>
          <td colspan="2"><input name="op" type="hidden" id="op" value="1" /></td>
          <td colspan="5"><?php echo $this->mi_pagination->create_links(); ?></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="5"></td>
  </tr>
</table>
</form>



<script>

$('#delete_employee').click(function(){

	
	alert("2")
});

$('#office_id').change(function(){

	$('#loading').html("Loading...");
	$('#myform').submit();
	
});

function delete_employee(delete_id, msg, url)
{
	var answer = confirm(msg)
	
	if (!answer)
	{
		return false;
	}
	//alert(url)
	window.location = url
}
</script>

<?php 
if($count == 0):
	return Redirect::to('employees');
endif;
?>
