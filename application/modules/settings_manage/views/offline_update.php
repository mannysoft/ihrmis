<?php 
if($this->input->post('repair'))
{
	$this->load->dbutil();
	$this->dbutil->repair_table('ats_dtr');
	//echo $this->db->last_query();
	echo 'Table has been repaired.';
}
?>
<form action="" method="post">
<table width="100%" border="0">
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="56%">&nbsp;</td>
    <td width="37%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
  <tr>
    <td><input name="uploadedfile" type="file" id="uploadedfile" />
    <input name="restore" type="submit" class="button" id="restore" value="Go"/>
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000000"/>
    <input name="op" type="hidden" id="op" value="1" /></td>
    <td><input name="repair" type="submit" class="button" id="repair" value="Repair"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Select the zip file </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>