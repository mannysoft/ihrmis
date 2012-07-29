<?php if (validation_errors()): ?>
<div class="clean-red"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php elseif ($this->session->flashdata('msg')): ?>
<div class="clean-green"><?php echo validation_errors(); ?><?php echo $this->session->flashdata('msg');?></div>
<?php else: ?>
<?php endif; ?>
<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="88%"><strong>Username:</strong>
      <input name="username" type="text" id="username" class="ilaw" onfocus="this.style.margin = '0'; this.style.borderWidth = '2px'; this.style.backgroundColor = '#FFFFFF';" onblur="this.style.margin = '1px'; this.style.borderWidth = '1px'; this.style.backgroundColor = '#E9F0F5';"/>
      <input name="search_button" type="submit" id="search_button" value="Search" class="button"/>
      <div id="added"></div></td>
    <td width="1%">&nbsp;</td>
    <td width="11%"><a href="<?php echo base_url();?>users/save">Add user</a> </td>
  </tr>
</table>
<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="2%" scope="col"><input name="checkall" type="checkbox" id="checkall" onClick="select_all('user', '1');" value="1"/></th>
        <th width="9%" scope="col">Username</th>
        <th width="20%" scope="col">Name</th>
        <th width="19%" scope="col">Department / Office</th>
        <th width="9%" scope="col">Status</th>
        <th width="16%" scope="col">Group</th>
        <th width="16%" scope="col">Action</th>
  </tr>
  	<?php $o = new Office_m();?>
	  <?php foreach( $users as $row ): ?>
      	<?php 
		$g = new Group_m();
		$g->get_by_id($row->group_id);
		$o->get_by_office_id($row->office_id);
		?>
		 <?php $bg 	= $this->Helps->set_line_colors();?>
		<tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '<?php echo $this->config->item('mouseover_linecolor')?>';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';">
        <td bgcolor=""><input name="user[]" type="checkbox" value="<?php echo $row->id;?>" ONCLICK="highlightRow(this,'#ABC7E9');"/></td>
		<td bgcolor=""><?php echo $row->username;?></td>
        <td bgcolor=""><strong><?php echo $row->fname.' '.$row->mname.' '.$row->lname;?></strong></td>
        <td bgcolor=""><?php echo $o->office_name;?></td>
        <td bgcolor=""><?php echo $row->stat;?></td>
        <td bgcolor=""><?php echo $g->name;?></td>
        <td bgcolor=""><?php //if($this->session->userdata('user_type')==1){?>
          <a href="<?php echo base_url();?>users/save/<?php echo $row->id;?>">Edit</a> | 
		  <a href="#" onclick="delete_user('<?php echo $row->username;?>','Delete User <?php echo $row->lname.', '.$row->fname;?>?', '<?php echo base_url();?>users/delete/<?php echo $row->id;?>')">Delete</a>
        </td>
        </tr>
		<?php endforeach;?>
      <tr>
        <td colspan="2"><select name="action" id="action" onchange="this.form.submit();">
          <option>With Selected:</option>
          <option value="0">Deactivate</option>
		  <option value="1">Activate</option>
        </select>
          <input name="op" type="hidden" id="op" value="1" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
	
	window.location = url
}
</script>