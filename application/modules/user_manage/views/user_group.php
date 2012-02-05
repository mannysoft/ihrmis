<form id="myform" method="post" action="" target="" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td width="88%"><div id="added"></div></td>
    <td width="1%">&nbsp;</td>
    <td width="11%"><a href="<?php echo base_url();?>user_manage/add_user_group">Add user group</a> </td>
  </tr>
</table>

<table width="100%" border="0" class="type-one">
      <tr class="type-one-header">
        <th width="4%" scope="col"><strong>id</strong></th>
        <th width="27%" scope="col"><strong>Name</strong></th>
        <th width="48%" scope="col"><strong>Description
          
        </strong></th>
        <th width="21%" scope="col"><strong>Action</strong></th>
  </tr>
      <?php foreach($groups as $row): ?>
	  <?php $bg 	= $this->Helps->set_line_colors();?>
        <tr bgcolor="<?php echo $bg;?>" onmouseover="this.bgColor = '#ABC7E9';this.style.color='#000000';" 
    onmouseout ="this.bgColor = '<?php echo $bg;?>';this.style.color='#000000'">
        <td bgcolor=""><?php echo $row['id'];?></td>
        <td bgcolor=""><strong><?php echo $row['name'];?></strong></td>
        <td bgcolor=""><?php echo $row['description'];?></td>
        <td bgcolor=""><?php //if($this->session->userdata('user_type')==1){?>
          <a href="<?php echo base_url();?>user_manage/edit_user_group/<?php echo $row['id'];?>">Edit</a> | 
		  <a href="#" onclick="delete_user('<?php echo $row['id'];?>','Delete User group <?php echo $row['name'];?>?', '<?php echo base_url();?>user_manage/delete_user_group/<?php echo $row['id'];?>')">Delete</a>
        </td>
        </tr>
	<?php endforeach; ?>
      <tr>
        <td><input name="op" type="hidden" id="op" value="1" /></td>
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
	//alert(url)
	window.location = url
}

</script>