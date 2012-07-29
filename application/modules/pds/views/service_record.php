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
      <legend>Service Record</legend>
      <table width="100%" cellspacing="1" class="admintable">
                              <tbody>
                                <tr>
                                  <td colspan="2" align="center" valign="middle" >SERVICE<br />
                                    (Inclusive Date)<br />
                                    (yyyy-mm-dd)</td>
                                  <td colspan="3" align="center" valign="middle">RECORDS OF APPOINTMENT</td>
                                  <td width="7%" align="center" valign="middle">OFFICE ENTITY /DIVISION</td>
                                  <td width="13%" align="center" valign="middle">L/V ABS W/O Pay</td>
                                  <td colspan="2" align="center">SEPARATION</td>
                                </tr>
                                <tr>
                                  <td width="6%" align="center">From                                  </td>
                                  <td width="7%" align="center">To</td>
                                  <td width="18%" align="center">Designation</td>
                                  <td width="18%" align="center">Status</td>
                                  <td width="7%" align="center">Salary</td>
                                  <td>Station / Place of Assignment /Branch</td>
                                  <td>&nbsp;</td>
                                  <td width="16%" align="center" valign="middle">Date</td>
                                  <td width="8%" align="center" valign="middle">Cause</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($services as $service): ?>
				<tr>
				  <td><input name="date_from[]" type="text" id="date_from" value="<?php echo $service->date_from;?>" size="8" /></td>
				  <td><input name="date_to[]" type="text" id="date_to[]" value="<?php echo $service->date_to;?>" size="8" /></td>
				  <td><input name="designation[]" type="text" id="designation[]" value="<?php echo $service->designation;?>" /></td>
				  <td><input name="status[]" type="text" id="status[]" value="<?php echo $service->status;?>" size="10" /></td>
				  <td><input name="salary[]" type="text" id="salary[]" value="<?php echo $service->salary;?>" size="8" /></td>
				  <td><input name="office_entity[]" type="text" id="office_entity[]" value="<?php echo $service->office_entity;?>" /></td>
				  <td><input name="lwop[]" type="text" id="lwop[]" value="<?php echo $service->lwop;?>" size="5" /></td>
				  <td><input name="separation_date[]" type="text" id="separation_date[]" value="<?php echo $service->separation_date;?>" size="10" /></td>
				  <td><input name="separation_cause[]" type="text" id="separation_cause[]" value="<?php echo $service->separation_cause;?>" size="10" /></td>
				</tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 50): ?>
			  	 	<?php while($i != 50): ?>
			 
                        <tr>
                          <td><input name="date_from[]" type="text" id="date_from" value="" size="8" /></td>
                          <td><input name="date_to[]" type="text" id="date_to[]" value="" size="8" /></td>
                          <td><input name="designation[]" type="text" id="designation[]" value="" /></td>
                          <td><input name="status[]" type="text" id="status[]" value="" size="10" /></td>
                          <td><input name="salary[]" type="text" id="salary[]" value="" size="8" /></td>
                          <td><input name="office_entity[]" type="text" id="office_entity[]" value="" /></td>
                          <td><input name="lwop[]" type="text" id="lwop[]" value="" size="5" /></td>
                          <td><input name="separation_date[]" type="text" id="separation_date[]" size="10" /></td>
                          <td><input name="separation_cause[]" type="text" id="separation_cause[]" size="10" /></td>
                        </tr>
                        <?php $i ++;?>
                        
                     <?php endwhile;?>
				<?php endif; ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
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
                                  <td>&nbsp;</td>
                                  <td><input name="op" type="hidden" id="op" value="1" />
                                    <span style="clear: both;">
                                    <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
                                  </span></td>
                                  <td><input type="submit" name="button" id="button" value="Save" /></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </tbody>
      </table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
