
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
      <legend>I. PERSONAL INFORMATION</legend>
      <table width="100%" cellspacing="1" class="admintable">
        <tr>
          <td width="20">2.</td>
          <td width="192" class="key"><label for="survey_year">SURNAME <span style="clear: both;">
            <input name="op" type="hidden" id="op" value="1" />
            <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $personal->employee_id;?>" />
            </span></label></td>
          <td width="144">
            <input name="lname" type="text" id="lname" value="<?php echo $personal->lname;?>" tabindex="1"/></td>
          <td width="20">&nbsp;</td>
          <td width="152" class="key">&nbsp;</td>
          <td align="left" id="t_item">&nbsp;</td>
          <td align="left" id="t_item">&nbsp;</td>
          </tr>
        <tr>
          <td >&nbsp;</td>
          <td valign="top" class="key"><span class="editlinktip hasTip" title="Resident::message here">
            <label for="resident">FIRST NAME </label>
            </span></td>
          <td><input name="fname" type="text" id="fname" value="<?php echo $personal->fname;?>" tabindex="2"/></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td width="179">&nbsp;</td>
          <td width="10">&nbsp;</td>
          </tr>
        <tr>
          <td >&nbsp;</td>
          <td class="key">MIDDLE NAME </td>
          
          <td><input name="mname" type="text" id="mname" value="<?php echo $personal->mname;?>" tabindex="3"/></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >3.</td>
          <td class="key">NAME EXTENSION (eg Jr, Sr) </td>
          <td><input name="extension" type="text" id="extension" value="<?php echo $personal->extension;?>" size="4" tabindex="4"/></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >4.</td>
          <td class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
          <td><input name="birth_date" type="text" id="birth_date" value="<?php echo $personal->birth_date;?>" tabindex="5"/></td>
          <td >&nbsp;</td>
          <td class="key">RESIDENTIAL ADDRESS</td>
          <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="res_address" rows="3" id="res_address" tabindex="16"><?php echo $personal->res_address;?></textarea></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"></td>
          </tr>
        <tr>
          <td >5.</td>
          <td class="key">PLACE OF BIRTH </td>
          <td><input name="birth_place" type="text" id="birth_place" value="<?php echo $personal->birth_place;?>" tabindex="6"/></td>
          <td >16.</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >6.</td>
          <td class="key">SEX</td>
          <td><?php echo form_dropdown('sex', $sex_options, $personal->sex);?></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >7.</td>
          <td class="key">CIVIL STATUS </td>
          <td><?php echo form_dropdown('civil_status', $civil_status_options, $personal->civil_status);?></td>
          <td >&nbsp;</td>
          <td class="key">ZIP CODE </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_zip" type="text" id="res_zip" value="<?php echo $personal->res_zip;?>" tabindex="17"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >8.</td>
          <td class="key">CITIZENSHIP</td>
          <td><input name="citizenship" type="text" id="citizenship" value="<?php echo $personal->citizenship;?>" tabindex="8"/></td>
          <td >17.</td>
          <td class="key">TELEPHONE NO. </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_tel" type="text" id="res_tel" value="<?php echo $personal->res_tel;?>" tabindex="18"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >9.</td>
          <td class="key">HEIGHT (m) </td>
          <td><input name="height" type="text" id="height" value="<?php echo $personal->height;?>" tabindex="9"/></td>
          <td >18</td>
          <td class="key">PERMANENT ADDRESS </td>
          <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="permanent_address" rows="3" id="permanent_address" tabindex="19"><?php echo $personal->permanent_address;?></textarea></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >10.</td>
          <td class="key">WEIGHT (kg) </td>
          <td><input name="weight" type="text" id="weight" value="<?php echo $personal->weight;?>" tabindex="10"/></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >11.</td>
          <td class="key">BLOOD TYPE </td>
          <td><input name="blood_type" type="text" id="blood_type" value="<?php echo $personal->blood_type;?>" tabindex="11"/></td>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >12.</td>
          <td class="key">GSIS ID NO. </td>
          <td><input name="gsis" type="text" id="gsis" value="<?php echo $personal->gsis;?>" tabindex="12"/></td>
          <td >&nbsp;</td>
          <td class="key">ZIP CODE </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_zip" type="text" id="permanent_zip" value="<?php echo $personal->permanent_zip;?>" tabindex="20"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >13.</td>
          <td class="key">PAG-IBIG ID NO. </td>
          <td><input name="pagibig" type="text" id="pagibig" value="<?php echo $personal->pagibig;?>" tabindex="13"/></td>
          <td >19</td>
          <td class="key">TELEPHONE NO. </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_tel" type="text" id="permanent_tel" value="<?php echo $personal->permanent_tel;?>" tabindex="21"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >14.</td>
          <td class="key">PHILHEALTH ID NO </td>
          <td><input name="philhealth" type="text" id="philhealth" value="<?php echo $personal->philhealth;?>" tabindex="14"/></td>
          <td >20</td>
          <td class="key">EMAIL ADDRESS (if any) </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="email" type="text" id="email" value="<?php echo $personal->email;?>" tabindex="22"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >15.</td>
          <td class="key">SSS NO. </td>
          <td><input name="sss" type="text" id="sss" value="<?php echo $personal->sss;?>" tabindex="15"/></td>
          <td >21..</td>
          <td class="key">CELLPHONE NO. (if any) </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="cp" type="text" id="cp" value="<?php echo $personal->cp;?>" tabindex="23"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td>&nbsp;</td>
          <td >22.</td>
          <td class="key">AGENCY EMPLOYEE NO. </td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="agency_employee_no" type="text" id="agency_employee_no" value="<?php echo $personal->agency_employee_no;?>" tabindex="24"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >&nbsp;</td>
          <td class="key">&nbsp;</td>
          <td>&nbsp;</td>
          <td >23.</td>
          <td class="key">TIN</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="tin" type="text" id="tin" value="<?php echo $personal->tin;?>" tabindex="25"/></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        <tr>
          <td >.</td>
          <td class="key">&nbsp;</td>
          <td>&nbsp;</td>
          <td >.</td>
          <td class="key">&nbsp;</td>
          <td align="left" nowrap="nowrap" id="t_unit_issue"><input type="submit" name="button" id="button" value="Save" /></td>
          <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
          </tr>
        
        </table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
