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
      <legend>Position Details</legend>
      <table width="100%" border="0" cellpadding="5" cellspacing="5">
        <tr>
          <td width="17%" align="center"><strong>Item Number</strong></td>
          <td width="16%" align="center"><strong>Position</strong></td>
          <td width="24%" align="center"><strong>Department</strong></td>
          <td width="17%"><strong>Salary Grade-Step</strong></td>
          <td width="26%"><strong>Date of Last Increment</strong></td>
        </tr>
        <tr>
          <td align="center"><input name="item_number" type="text" id="item_number" value="<?php echo $profile->item_number;?>" /></td>
          <td rowspan="2" align="center" valign="top"><textarea name="position" id="position"><?php echo $profile->position;?></textarea></td>
          <td align="center"><?php 
		$js = 'id = "office_id" style="width:200px"';
		echo form_dropdown('office_id', $options, $selected, $js); ?></td>
          <td><input name="salary_grade" type="text" id="salary_grade" value="<?php echo $profile->salary_grade;?>" size="3" />
            -
              <input name="step" type="text" id="step" value="<?php echo $profile->step;?>" size="3" /></td>
          <td><input name="last_increment" type="text" id="last_increment" value="<?php echo $profile->last_increment;?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Appointment Status:</strong></td>
          <td><span class="type-one"><?php echo form_dropdown('permanent', $permanent_options, $permanent_selected); ?></span></td>
          <td align="right"><strong>Date of Last Promotion:</strong></td>
          <td><input name="last_promotion" type="text" id="last_promotion" value="<?php echo $profile->last_promotion;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Position Level:</strong></td>
          <td><input name="level" type="text" id="level" value="<?php echo $profile->level;?>" /></td>
          <td align="right"><strong>Eligibility:</strong></td>
          <td><input name="eligibility" type="text" id="eligibility" value="<?php echo $profile->eligibility;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>1st Day of Service:</strong></td>
          <td><input name="first_day_of_service" type="text" id="first_day_of_service" value="<?php echo $profile->first_day_of_service;?>" /></td>
          <td align="right"><strong>Graduated /Year Level:</strong></td>
          <td><input name="graduated" type="text" id="graduated" value="<?php echo $profile->graduated;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Course:</strong></td>
          <td><input name="course" type="text" id="course" value="<?php echo $profile->course;?>" /></td>
          <td align="right"><strong>Units Earned:</strong></td>
          <td><input name="units" type="text" id="units" value="<?php echo $profile->units;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Post Grad.:</strong></td>
          <td><input name="post_grad" type="text" id="post_grad" value="<?php echo $profile->post_grad;?>" /></td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><input name="op" type="hidden" id="op" value="1" />
            <span style="clear: both;">
            <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
            <input type="submit" name="button" id="button" value="Save" />
            </span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>