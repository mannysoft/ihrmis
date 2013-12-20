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
      <legend>Work Experience</legend>
      <table width="100%" cellspacing="1" class="admintable">
                              <tbody>
                                <tr>
                                  <td colspan="2" align="center" valign="top" >Inclusive Dates<br />
                                    (yyyy-mm-dd)</td>
                                  <td width="18%" align="center">Position/Title <br />
                                    (Write in full) </td>
                                  <td width="18%" align="center">DEPARTMENT/ OFFICE/COMPANY<br />
                                    (Write in full)</td>
                                  <td width="7%" align="center">Monthly Salary</td>
                                  <td width="7%" align="center">SG &amp; STEP INC.<br />
                                    (Format &quot;00-0&quot;)</td>
                                  <td width="13%" align="center">Status of Appointment</td>
                                  <td width="16%" align="center">Movement</td>
                                  <td width="8%" align="center">Gov't Service<br />
                                    (Yes / No)</td>
                                </tr>
                                <tr>
                                  <td width="6%">From                                  </td>
                                  <td width="7%">To</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($works as $work): ?>
				<tr>
				  <td><input name="work_date1[]" type="text" id="work_date1" value="<?php echo $work->inclusive_date_from;?>" size="8" /></td>
				  <td><input name="work_date2[]" type="text" id="work_date2[]" value="<?php echo $work->inclusive_date_to;?>" size="8" /></td>
				  <td><input name="work_position[]" type="text" id="work_position[]" value="<?php echo $work->position;?>" /></td>
				  <td><input name="work_office[]" type="text" id="work_office[]" value="<?php echo $work->company;?>" /></td>
				  <td><input name="work_salary[]" type="text" id="work_salary[]" value="<?php echo $work->monthly_salary;?>" size="8" /></td>
				  <td><input name="work_sg[]" type="text" id="work_sg[]" value="<?php echo $work->salary_grade;?>" size="4" /></td>
				  <td><input name="work_status[]" type="text" id="work_status[]" value="<?php echo $work->status;?>" size="10" /></td>
				  <td><input name="movement[]" type="text" id="movement[]" value="<?php echo $work->movement;?>" size="10" /></td>
				  <td><?php echo form_dropdown('work_service[]', $govt_service_options, $work->govt_service);?></td>
				</tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 50): ?>
			  	 	<?php while($i != 50): ?>
			 
                        <tr>
                          <td><input name="work_date1[]" type="text" id="work_date1" value="" size="8" /></td>
                          <td><input name="work_date2[]" type="text" id="work_date2[]" value="" size="8" /></td>
                          <td><input name="work_position[]" type="text" id="work_position[]" value="" /></td>
                          <td><input name="work_office[]" type="text" id="work_office[]" value="" /></td>
                          <td><input name="work_salary[]" type="text" id="work_salary[]" value="" size="8" /></td>
                          <td><input name="work_sg[]" type="text" id="work_sg[]" value="" size="4" /></td>
                          <td><input name="work_status[]" type="text" id="work_status[]" value="" size="10" /></td>
                          <td><input name="movement[]" type="text" id="movement[]" size="10" /></td>
                          <td><?php echo form_dropdown('work_service[]', $govt_service_options, 1);?></td>
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
