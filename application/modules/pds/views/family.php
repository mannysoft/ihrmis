
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
      <legend>I. Family Background</legend>
      <table width="94%" cellspacing="1" class="admintable">

		<tbody>
			<tr>
			  <td width="21">24.</td>
			  <td width="177" class="key">SPOUSE'S SURNAME </td>
			  <td width="179"><input name="spouse_lname" type="text" id="spouse_lname" value="<?php echo $family->spouse_lname;?>" tabindex="1"/></td>
			  <td width="201" class="key">25. NAME OF CHILD (Write full name and list all </td>
			  <td width="180" class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="spouse_fname" type="text" id="spouse_fname" value="<?php echo $family->spouse_fname;?>" tabindex="2"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][0];?>" size="30" tabindex="14"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][0];?>" size="30" tabindex="15"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="spouse_mname" type="text" id="spouse_mname" value="<?php echo $family->spouse_mname;?>" tabindex="3"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][1];?>" size="30" tabindex="16"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][1];?>" size="30" tabindex="17"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">OCCUPATION</td>
			  <td><input name="spouse_occupation" type="text" id="spouse_occupation" value="<?php echo $family->spouse_occupation;?>" tabindex="4"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][2];?>" size="30" tabindex="18"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][2];?>" size="30" tabindex="19"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">EMPLOYER/BUS. NAME </td>
			  <td><input name="spouse_employer" type="text" id="spouse_employer" value="<?php echo $family->spouse_employer;?>" tabindex="5"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][3];?>" size="30" tabindex="20"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][3];?>" size="30" tabindex="21"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">BUSINESS ADDRESS </td>
			  <td><input name="spouse_biz_ad" type="text" id="spouse_biz_ad" value="<?php echo $family->spouse_biz_ad;?>" tabindex="6"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][4];?>" size="30" tabindex="22"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][4];?>" size="30" tabindex="23"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">TELEPHONE NO. </td>
			  <td><input name="spouse_tel" type="text" id="spouse_tel" value="<?php echo $family->spouse_tel;?>" tabindex="7"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][5];?>" size="30" tabindex="24"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][5];?>" size="30" tabindex="25"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][6];?>" size="30" tabindex="26"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][6];?>" size="30" tabindex="27"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][7];?>" size="30" tabindex="28"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][7];?>" size="30" tabindex="29"/></td>
		  </tr>
			<tr>
			  <td >26.</td>
			  <td class="key">FATHER'S SURNAME </td>
			  <td><input name="father_lname" type="text" id="father_lname" value="<?php echo $family->father_lname;?>" tabindex="8"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][8];?>" size="30" tabindex="1" tabindex="30"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][8];?>" size="30" tabindex="31"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="father_fname" type="text" id="father_fname" value="<?php echo $family->father_fname;?>" tabindex="9"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][9];?>" size="30" tabindex="32"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][9];?>" size="30" tabindex="33"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="father_mname" type="text" id="father_mname" value="<?php echo $family->father_mname;?>" tabindex="10"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][10];?>" size="30" tabindex="34"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][10];?>" size="30" tabindex="35"/></td>
		  </tr>
			<tr>
			  <td >27.</td>
			  <td class="key">MOTHER'S MAIDEN NAME </td>
			  <td><input name="mother_lname" type="text" id="mother_lname" value="<?php echo $family->mother_lname;?>" tabindex="11"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][11];?>" size="30" tabindex="36"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][11];?>" size="30" tabindex="37"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="mother_fname" type="text" id="mother_fname" value="<?php echo $family->mother_fname;?>" tabindex="12"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][12];?>" size="30" tabindex="38"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][12];?>" size="30" tabindex="39"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="mother_mname" type="text" id="mother_mname" value="<?php echo $family->mother_mname;?>" tabindex="13"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][13];?>" size="30" tabindex="40"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][13];?>" size="30" tabindex="41"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><span style="clear: both;">
			    <input name="op" type="hidden" id="op" value="1" />
                <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $family->employee_id;?>" />
              </span></td>
			  <td><input type="submit" name="button" id="button" value="Save" /></td>
		  </tr>
		</tbody>
	</table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
