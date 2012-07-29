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
      <table width="100%" border="0">
        <tr>
          <td width="24%" align="center">Item Number</td>
          <td width="19%" align="center">Position</td>
          <td width="31%" align="center">Department</td>
          <td width="19%" align="center">Salary Grade-Step</td>
          <td width="7%" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><input name="item_number" type="text" id="item_number" value="<?php echo $profile->item_number;?>" /></td>
          <td align="center"><input name="position" type="text" id="position" value="<?php echo $profile->position;?>" /></td>
          <td align="center"><?php 
		$js = 'id = "office_id"';
		echo form_dropdown('office_id', $options, $selected, $js); ?></td>
          <td align="center"><input name="salary_grade" type="text" id="salary_grade" value="<?php echo $profile->salary_grade;?>" size="3" />
            -
              <input name="step" type="text" id="step" value="<?php echo $profile->step;?>" size="3" /></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Appointment Status:</td>
          <td><span class="type-one"><?php echo form_dropdown('permanent', $permanent_options, $permanent_selected); ?></span></td>
          <td align="right">Date of Last Promotion:</td>
          <td><input name="last_promotion" type="text" id="last_promotion" value="<?php echo $profile->last_promotion;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Position Level:</td>
          <td><input name="level" type="text" id="level" value="<?php echo $profile->level;?>" /></td>
          <td align="right">Eligibility:</td>
          <td><input name="eligibility" type="text" id="eligibility" value="<?php echo $profile->eligibility;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">1st Day of Service:</td>
          <td><input name="first_day_of_service" type="text" id="first_day_of_service" value="<?php echo $profile->first_day_of_service;?>" /></td>
          <td align="right">Graduated /Year Level:</td>
          <td><input name="graduated" type="text" id="graduated" value="<?php echo $profile->graduated;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Course:</td>
          <td><input name="course" type="text" id="course" value="<?php echo $profile->course;?>" /></td>
          <td align="right">Units Earned:</td>
          <td><input name="units" type="text" id="units" value="<?php echo $profile->units;?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Post Grad.:</td>
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