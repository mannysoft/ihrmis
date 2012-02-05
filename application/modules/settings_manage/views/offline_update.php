<?php 
if(isset($_POST['op']))
{
	$target_path  = "../../ats_service/updates/";
	
	$final_path=$target_path;

	if(!basename( $_FILES['uploadedfile']['name']))
	{
		$error="<strong><font color=red>Please select file!</font></strong>";
	}
	else
	{
		/**
		 * Add the original
		 * filename to our target path.  
		 */
		 
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		$_FILES['uploadedfile']['tmp_name'];  
		//destinaton of file that the user attach
		
		$filename = $target_path;
	
		
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
		{
			$filename=basename( $_FILES['uploadedfile']['name']); 
		
		}
		
		echo "<script>download_updates('".$filename."')</script>";	
	}	
}

?>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Select the zip file </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
