<table width="100%" border="0">
  <tr>
    <td width="19%" rowspan="3" valign="top"><table width="200" border="0">
    <tr>
      <td>
      <?php $this->load->view('menu');?>
</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>&nbsp;</td>
    <td width="79%" valign="top">
    <?php $this->load->view('name_tag');?>
    </td>
    <td width="2%">&nbsp;</td>
  </tr>
  <tr>
    <td>
    <?php if ($msg != ''): ?>
    <div class="clean-green"><?php echo $msg;?></div>
    <?php endif; ?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="" method="post">
    <fieldset class="adminform">
      <legend>Examinations</legend>
      <table width="100%" cellspacing="1" class="admintable">

		<tbody>

			<tr>
				<td width="23%" align="center" >CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE </td>
				<td width="7%" align="center" >RATING</td>
				<td width="13%" align="center" >DATE OF EXAMINATION/ CONFERMENT<br />
				  (yyyy-mm-dd)</td>
				<td width="18%" align="center" >PLACE OF EXAMINATION <br /></td>
				<td colspan="2" align="center">LICENSE (if applicable) </td>
		  </tr>
			
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td width="8%">NUMBER</td>
			  <td width="31%">DATE OF RELEASE </td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type" value="<?php echo $services['type'][0];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][0];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][0];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][0];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][0];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][0];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][1];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][1];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][1];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][1];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][1];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][1];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][2];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][2];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][2];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][2];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][2];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][2];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][3];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][3];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][3];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][3];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][3];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][3];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][4];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][4];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][4];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][4];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][4];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][4];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][5];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][5];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][5];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][5];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][5];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][5];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][6];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][6];?>" size="8" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][6];?>" size="12" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][6];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][6];?>" size="8" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][6];?>" size="12" /></td>
		  </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="op" type="hidden" id="op" value="1" />
			    <span style="clear: both;">
			    <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
			    </span></td>
			  <td><input type="submit" name="button" id="button" value="Save" /></td>
		  </tr>
		</tbody>
	</table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
