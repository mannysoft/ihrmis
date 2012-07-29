<form method="post">
<table width="100%" border="0">
  <tr>
    <td><?php 
	if(isset($_GET['msg']))
	{
		echo '<font color=red><strong>Database restoration success!</strong></font>';
	}
	?>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="<?php echo base_url();?>settings_manage/backup_database">Back Up Database</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="56%">Restore Database: </td>
    <td width="37%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="uploadedfile" type="file" id="uploadedfile" />
    <input name="restore" type="submit" class="button" id="restore" value="Restore Database"/>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
    <input name="op" type="hidden" id="op" value="1" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Select the file backup.zip </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>