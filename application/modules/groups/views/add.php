<fieldset><legend><?php echo $legend;?></legend>
<form action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="5" class="table-form">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="17%" align="right"><label for="name">Name:</label></td>
      <td width="79%">
        <input name="name" type="text" id="name" value="<?php echo Input::get('name');?>" size="45" /></td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Description:</td>
      <td>
        <input name="description" type="text" id="description" value="<?php echo Input::get('description');?>" size="45" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Save" />
        <a href="<?php echo Request::root().'/groups'?>">Cancel</a>
        <input name="op" type="hidden" id="op" value="1" />
        <input name="id" type="hidden" id="id" value="<?php ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
</fieldset>
<script>
$('.scholar').click(function(){
	
});
</script>
