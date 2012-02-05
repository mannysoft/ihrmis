<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="88%"><strong>User ID:</strong>
      <input name="username" type="text" id="username" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
      <div id="added"></div></td>
    <td width="1%">&nbsp;</td>
    <td width="11%"><a href="<?php echo base_url();?>index.php/user_manage/add_user">Add user</a> </td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" scope="col"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('user', '1');" value="1"/></th>
        <th width="9%" scope="col"><strong>User ID.</strong></th>
        <th width="20%" scope="col"><strong>Employee Name</strong></th>
        <th width="19%" scope="col"><strong>Department / Office</strong></th>
        <th width="9%" scope="col"><strong>Status</strong></th>
        <th width="16%" scope="col">Group</th>
        <th width="9%" scope="col"><strong>Position</strong><input name="op" type="hidden" id="op" value="1" /></th>
        <th width="16%" scope="col"><strong>Action</strong></th>
  </tr>
	  <?php foreach( $users as $row ): ?>
		 <?php $bg 	= $this->Helps->set_line_colors();?>
		<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td bgcolor=""><input name="user[]" type="checkbox" value="<?php echo $row['user_id'];?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		<td bgcolor=""><?php echo $row['username'];?></td>
        <td bgcolor=""><strong><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname'];?></strong></td>
        <td bgcolor=""><?php echo $row['office_name'];?></td>
        <td bgcolor=""><?php echo $row['stat'];?></td>
        <td bgcolor=""><?php echo $row['group_id'];?></td>
        <td bgcolor=""><?php echo $row['name'];?></td>
        <td bgcolor=""><?php //if($this->session->userdata('user_type')==1){?>
          <a href="<?php echo base_url();?>index.php/user_manage/edit_user/<?php echo $row['username'];?>">Edit</a> | 
		  <a href="#" onclick="delete_user('<?php echo $row['username'];?>','Delete User <?php echo $row['lname'].', '.$row['fname'];?>?', '<?php echo base_url();?>index.php/user_manage/delete_user/<?php echo $row['username'];?>')">Delete</a>
        </td>
        </tr>
		<?php endforeach;?>
      <tr>
        <td colspan="8"><select name="action" id="action" onchange="this.form.submit();">
          <option>With Selected:</option>
          <option value="0">Deactivate</option>
		  <option value="1">Activate</option>
        </select>
          <input name="op" type="hidden" id="op" value="1" /></td>
  </tr>
</table>
</form>
<script>
function delete_user(delete_id, msg, url)
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