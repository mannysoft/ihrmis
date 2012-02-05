<!DOCTYPE html>
<html>
<head>
  <!--<link href="<?php echo base_url();?>jqueryui/jquery-ui.css" rel="stylesheet" type="text/css"/>-->
  <link href="<?php echo base_url();?>jqueryui/css/ui-lightness/jquery-ui-1.8.5.custom.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo base_url();?>jqueryui/js/jquery-1.4.2.min.js"></script>
  <script src="<?php echo base_url();?>jqueryui/js/jquery-ui-1.8.5.custom.min.js"></script>
  <!--
  <script src="<?php echo base_url();?>jqueryui/jquery.min.js"></script>
  <script src="<?php echo base_url();?>jqueryui/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>jqueryui/libs/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jqueryui/libs/jquery-ui.min.js"></script>
-->
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<body style="font-size:62.5%;">
  <form action="" method="post">
<div id="tabs">
    <ul>
        <li><a href="#fragment-1"><span>PERSONAL INFORMATION</span></a></li>
        <li><a href="#fragment-2"><span>FAMILY BACKGROUND</span></a></li>
        <li><a href="#fragment-3"><span>EDUCATIONAL BACKGROUND</span></a></li>
        <li><a href="#fragment-4"><span>SERVICE ELIGIBILITY</span></a></li>
        <li><a href="#fragment-5"><span>WORK EXPERIENCE (page 1)</span></a></li>
         <li><a href="#fragment-9"><span>WORK EXPERIENCE (page 2)</span></a></li>
        <li><a href="#fragment-6"><span>VOLUNTARY WORK OR INVOLVEMENT</span></a></li>
        <li><a href="#fragment-7"><span>TRAINING PROGRAMS</span></a></li>
        <li><a href="#fragment-8"><span>OTHER INFORMATION</span></a></li>
        <li><a href="#fragment-10"><span>PROFILE</span></a></li>
    </ul>
    <SCRIPT>
	$(function() {
		$( "input:submit", ".demo2" ).button();
		$( "input:submit", ".demo2" ).click(function() { return true; });
	});
	</SCRIPT>
<DIV class=demo2><INPUT value="Save" type="submit"></DIV>
    <div id="fragment-1">
       <table class="noshow">
					<tr>
						<td width="86%">

							<fieldset class="adminform">
	<legend>I. PERSONAL INFORMATION</legend>
	<table width="100%" cellspacing="1" class="admintable">
		<tr>
		  <td width="20">2.</td>
			<td width="192" class="key"><label for="survey_year">SURNAME <span style="clear: both;">
			  <input name="op" type="hidden" id="op" value="1" />
			  <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee_id;?>" />
			</span></label></td>
			<td width="144"><script type="text/javascript">
		    Calendar.setup({
	          inputField     :    "date_register",     // id of the input field
	          ifFormat       :    "%Y-%m-%d", // format of the input field
	          button         :    "f_trigger_a",  // trigger for the calendar (button ID)
	          align          :    "Tl",    // alignment (defaults to "Bl")
	          singleClick    :    true
		    });
		</script>
		  <input name="lname" type="text" id="lname" value="<?php echo $personal['lname'];?>" tabindex="1"/></td>
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
			<td><input name="fname" type="text" id="fname" value="<?php echo $personal['fname'];?>" tabindex="2"/></td>
			<td >&nbsp;</td>
			<td class="key">&nbsp;</td>
			<td width="179">&nbsp;</td>
			<td width="10">&nbsp;</td>
		</tr>
		<tr>
		  <td >&nbsp;</td>
			<td class="key">MIDDLE NAME </td>

			<td><input name="mname" type="text" id="mname" value="<?php echo $personal['mname'];?>" tabindex="3"/></td>
			<td >&nbsp;</td>
			<td class="key">&nbsp;</td>
			<td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
			<td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		</tr>
		<tr>
		  <td >3.</td>
		  <td class="key">NAME EXTENSION (eg Jr, Sr) </td>
		  <td><input name="extension" type="text" id="extension" value="<?php echo $personal['extension'];?>" size="4" tabindex="4"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >4.</td>
		  <td class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
		  <td><input name="birth_date" type="text" id="birth_date" value="<?php echo $personal['birth_date'];?>" tabindex="5"/></td>
		  <td >&nbsp;</td>
		  <td class="key">RESIDENTIAL ADDRESS</td>
		  <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="res_address" rows="3" id="res_address" tabindex="16"><?php echo $personal['res_address'];?></textarea></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><script type="text/javascript">
		    Calendar.setup({
	          inputField     :    "birth_date",     // id of the input field
	          ifFormat       :    "%Y-%m-%d", // format of the input field
	          button         :    "f_trigger_b",  // trigger for the calendar (button ID)
	          align          :    "Tl",    // alignment (defaults to "Bl")
	          singleClick    :    true
		    });
		    </script></td>
		</tr>
		<tr>
		  <td >5.</td>
		  <td class="key">PLACE OF BIRTH </td>
		  <td><input name="birth_place" type="text" id="birth_place" value="<?php echo $personal['birth_place'];?>" tabindex="6"/></td>
		  <td >16.</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		</tr>
		<tr>
		  <td >6.</td>
		  <td class="key">SEX</td>
		  <td><?php echo form_dropdown('sex', $sex_options, $personal['sex']);?></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >7.</td>
		  <td class="key">CIVIL STATUS </td>
		  <td><?php echo form_dropdown('civil_status', $civil_status_options, $personal['civil_status']);?></td>
		  <td >&nbsp;</td>
		  <td class="key">ZIP CODE </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_zip" type="text" id="res_zip" value="<?php echo $personal['res_zip'];?>" tabindex="17"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >8.</td>
		  <td class="key">CITIZENSHIP</td>
		  <td><input name="citizenship" type="text" id="citizenship" value="<?php echo $personal['citizenship'];?>" tabindex="8"/></td>
		  <td >17.</td>
		  <td class="key">TELEPHONE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_tel" type="text" id="res_tel" value="<?php echo $personal['res_tel'];?>" tabindex="18"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >9.</td>
		  <td class="key">HEIGHT (m) </td>
		  <td><input name="height" type="text" id="height" value="<?php echo $personal['height'];?>" tabindex="9"/></td>
		  <td >18</td>
		  <td class="key">PERMANENT ADDRESS </td>
		  <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="permanent_address" rows="3" id="permanent_address" tabindex="19"><?php echo $personal['permanent_address'];?></textarea></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >10.</td>
		  <td class="key">WEIGHT (kg) </td>
		  <td><input name="weight" type="text" id="weight" value="<?php echo $personal['weight'];?>" tabindex="10"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >11.</td>
		  <td class="key">BLOOD TYPE </td>
		  <td><input name="blood_type" type="text" id="blood_type" value="<?php echo $personal['blood_type'];?>" tabindex="11"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >12.</td>
		  <td class="key">GSIS ID NO. </td>
		  <td><input name="gsis" type="text" id="gsis" value="<?php echo $personal['gsis'];?>" tabindex="12"/></td>
		  <td >&nbsp;</td>
		  <td class="key">ZIP CODE </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_zip" type="text" id="permanent_zip" value="<?php echo $personal['permanent_zip'];?>" tabindex="20"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >13.</td>
		  <td class="key">PAG-IBIG ID NO. </td>
		  <td><input name="pagibig" type="text" id="pagibig" value="<?php echo $personal['pagibig'];?>" tabindex="13"/></td>
		  <td >19</td>
		  <td class="key">TELEPHONE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_tel" type="text" id="permanent_tel" value="<?php echo $personal['permanent_tel'];?>" tabindex="21"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >14.</td>
		  <td class="key">PHILHEALTH ID NO </td>
		  <td><input name="philhealth" type="text" id="philhealth" value="<?php echo $personal['philhealth'];?>" tabindex="14"/></td>
		  <td >20</td>
		  <td class="key">EMAIL ADDRESS (if any) </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="email" type="text" id="email" value="<?php echo $personal['email'];?>" tabindex="22"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >15.</td>
		  <td class="key">SSS NO. </td>
		  <td><input name="sss" type="text" id="sss" value="<?php echo $personal['sss'];?>" tabindex="15"/></td>
		  <td >21..</td>
		  <td class="key">CELLPHONE NO. (if any) </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="cp" type="text" id="cp" value="<?php echo $personal['cp'];?>" tabindex="23"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td >22.</td>
		  <td class="key">AGENCY EMPLOYEE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="agency_employee_no" type="text" id="agency_employee_no" value="<?php echo $personal['agency_employee_no'];?>" tabindex="24"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td >23.</td>
		  <td class="key">TIN</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="tin" type="text" id="tin" value="<?php echo $personal['tin'];?>" tabindex="25"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >.</td>
		  <td class="key">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td >.</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		</tr>
	
	</table>
</fieldset>
					  </td>
					</tr>
	  </table>
    </div>
    <div id="fragment-2">
      <table width="94%" cellspacing="1" class="admintable">

		<tbody>
			<tr>
			  <td width="24">24.</td>
			  <td width="243" class="key">SPOUSE'S SURNAME </td>
			  <td width="198"><input name="spouse_lname" type="text" id="spouse_lname" value="<?php echo $family['spouse_lname'];?>"/></td>
			  <td width="361" class="key">25. NAME OF CHILD (Write full name and list all </td>
			  <td width="243" class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="spouse_fname" type="text" id="spouse_fname" value="<?php echo $family['spouse_fname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][0];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][0];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="spouse_mname" type="text" id="spouse_mname" value="<?php echo $family['spouse_mname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][1];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][1];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">OCCUPATION</td>
			  <td><input name="spouse_occupation" type="text" id="spouse_occupation" value="<?php echo $family['spouse_occupation'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][2];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][2];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">EMPLOYER/BUS. NAME </td>
			  <td><input name="spouse_employer" type="text" id="spouse_employer" value="<?php echo $family['spouse_employer'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][3];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][3];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">BUSINESS ADDRESS </td>
			  <td><input name="spouse_biz_ad" type="text" id="spouse_biz_ad" value="<?php echo $family['spouse_biz_ad'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][4];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][4];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">TELEPHONE NO. </td>
			  <td><input name="spouse_tel" type="text" id="spouse_tel" value="<?php echo $family['spouse_tel'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][5];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][5];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][6];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][6];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][7];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][7];?>"/></td>
		  </tr>
			<tr>
			  <td >26.</td>
			  <td class="key">FATHER'S SURNAME </td>
			  <td><input name="father_lname" type="text" id="father_lname" value="<?php echo $family['father_lname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][8];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][8];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="father_fname" type="text" id="father_fname" value="<?php echo $family['father_fname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][9];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][9];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="father_mname" type="text" id="father_mname" value="<?php echo $family['father_mname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][10];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][10];?>"/></td>
		  </tr>
			<tr>
			  <td >27.</td>
			  <td class="key">MOTHER'S MAIDEN NAME </td>
			  <td><input name="mother_lname" type="text" id="mother_lname" value="<?php echo $family['mother_lname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][11];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][11];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="mother_fname" type="text" id="mother_fname" value="<?php echo $family['mother_fname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][12];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][12];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="mother_mname" type="text" id="mother_mname" value="<?php echo $family['mother_mname'];?>"/></td>
			  <td><input name="children[]" type="text" id="children[]" value="<?php echo $children['name'][13];?>"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]" value="<?php echo $children['birth_date'][13];?>"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		  </tr>
		</tbody>
	</table>
</div>
    <div id="fragment-3">
        <table width="100%" cellspacing="1" class="admintable">

		<tbody>

			<tr>
				<td width="215" valign="middle" class="key">LEVEL</td>
				<td width="344" align="center">NAME OF SCHOOL<br />
			  (Write in full) </td>
				<td width="344" align="center">DEGREE COURSE (Write in full) </td>
				<td width="344" align="center">YEAR GRADUATED (If graduated) </td>
				<td width="344" align="center">HIGHEST GRADE/ LEVEL/ UNITS EARNED (If not graduated) </td>
				<td colspan="2" align="center">INCLUSIVE DATES OF ATTENDANCE  </td>
				<td width="377" align="center">SCHOLARSHIP/ ACADEMIC HONORS RECEIVED </td>
		  </tr>
			<tr>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td align="center">From</td>
			  <td align="center">To</td>
			  <td>&nbsp;</td>
		  </tr>
			<tr>
				<td class="key">ELEMENTARY</td>
				<td align="center"><textarea name="elem_school" cols="15" id="elem_school"><?php echo $educs1['school_name'];?></textarea></td>
				<td align="center"><textarea name="elem_degree" cols="15" id="elem_degree"><?php echo $educs1['degree_course'];?></textarea></td>
				<td align="center"><textarea name="elem_grad" cols="10" id="elem_grad"><?php echo $educs1['year_graduated'];?></textarea></td>
				<td align="center"><textarea name="elem_units" cols="15" id="elem_units"><?php echo $educs1['highest_grade'];?></textarea></td>
				<td width="344" align="center"><textarea name="elem_date1" cols="15" id="elem_date1"><?php echo $educs1['attend_from'];?></textarea></td>
				<td width="377" align="center"><textarea name="elem_date2" cols="15" id="elem_date2"><?php echo $educs1['attend_to'];?></textarea></td>
				<td align="center"><textarea name="elem_scho" cols="15" id="elem_scho"><?php echo $educs1['scholarship'];?></textarea></td>
			</tr>
			
			<tr>
			  <td class="key">SECONDARY</td>
			  <td align="center"><textarea name="sec_school" cols="15" id="sec_school"><?php echo $educs2['school_name'];?></textarea></td>
			  <td align="center"><textarea name="sec_degree" cols="15" id="sec_degree"><?php echo $educs2['degree_course'];?></textarea></td>
			  <td align="center"><textarea name="sec_grad" cols="10" id="sec_grad"><?php echo $educs2['year_graduated'];?></textarea></td>
			  <td align="center"><textarea name="sec_units" cols="15" id="sec_units"><?php echo $educs2['highest_grade'];?></textarea></td>
			  <td align="center"><textarea name="sec_date1" cols="15" id="sec_date1"><?php echo $educs2['attend_from'];?></textarea></td>
			  <td align="center"><textarea name="sec_date2" cols="15" id="sec_date2"><?php echo $educs2['attend_to'];?></textarea></td>
			  <td align="center"><textarea name="sec_scho" cols="15" id="sec_scho"><?php echo $educs2['scholarship'];?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">VOCATIONAL/ TRADE COURSE </td>
			  <td align="center"><textarea name="voc_school" cols="15" id="voc_school"><?php echo $educs3['school_name'];?></textarea></td>
			  <td align="center"><textarea name="voc_degree" cols="15" id="voc_degree"><?php echo $educs3['degree_course'];?></textarea></td>
			  <td align="center"><textarea name="voc_grad" cols="10" id="voc_grad"><?php echo $educs3['year_graduated'];?></textarea></td>
			  <td align="center"><textarea name="voc_units" cols="15" id="voc_units"><?php echo $educs3['highest_grade'];?></textarea></td>
			  <td align="center"><textarea name="voc_date1" cols="15" id="voc_date1"><?php echo $educs3['attend_from'];?></textarea></td>
			  <td align="center"><textarea name="voc_date2" cols="15" id="voc_date2"><?php echo $educs3['attend_to'];?></textarea></td>
			  <td align="center"><textarea name="voc_scho" cols="15" id="voc_scho"><?php echo $educs3['scholarship'];?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">COLLEGE</td>
			  <td align="center"><textarea name="col_school" cols="15" id="col_school"><?php echo $educs4['school_name'];?></textarea></td>
			  <td align="center"><textarea name="col_degree" cols="15" id="col_degree"><?php echo $educs4['degree_course'];?></textarea></td>
			  <td align="center"><textarea name="col_grad" cols="10" id="col_grad"><?php echo $educs4['year_graduated'];?></textarea></td>
			  <td align="center"><textarea name="col_units" cols="15" id="col_units"><?php echo $educs4['highest_grade'];?></textarea></td>
			  <td align="center"><textarea name="col_date1" cols="15" id="col_date1"><?php echo $educs4['attend_from'];?></textarea></td>
			  <td align="center"><textarea name="col_date2" cols="15" id="col_date2"><?php echo $educs4['attend_to'];?></textarea></td>
			  <td align="center"><textarea name="col_scho" cols="15" id="col_scho"><?php echo $educs4['scholarship'];?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">GRADUATE STUDIES </td>
			  <td align="center"><textarea name="grad_school" cols="15" id="grad_school"><?php echo $educs5['school_name'];?></textarea></td>
			  <td align="center"><textarea name="grad_degree" cols="15" id="grad_degree"><?php echo $educs5['degree_course'];?></textarea></td>
			  <td align="center"><textarea name="grad_grad" cols="10" id="grad_grad"><?php echo $educs5['year_graduated'];?></textarea></td>
			  <td align="center"><textarea name="grad_units" cols="15" id="grad_units"><?php echo $educs5['highest_grade'];?></textarea></td>
			  <td align="center"><textarea name="grad_date1" cols="15" id="grad_date1"><?php echo $educs5['attend_from'];?></textarea></td>
			  <td align="center"><textarea name="grad_date2" cols="15" id="grad_date2"><?php echo $educs5['attend_to'];?></textarea></td>
			  <td align="center"><textarea name="grad_scho" cols="15" id="grad_scho"><?php echo $educs5['scholarship'];?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		  </tr>
		</tbody>
	</table>
</div>
     <div id="fragment-4">
       <table width="100%" cellspacing="1" class="admintable">

		<tbody>

			<tr>
				<td width="23%" >CAREER SERVICE/RA 1080 (BOARD/BAR) UNDER SPECIAL LAWS/CES/CSEE </td>
				<td width="11%" >RATING</td>
				<td width="16%" >DATE OF EXAMINATION/ CONFERMENT<br />
				  (yyyy-mm-dd)</td>
				<td width="16%" >PLACE OF EXAMINATION <br /></td>
				<td colspan="2" align="center">LICENSE (if applicable) </td>
		  </tr>
			
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td width="16%">NUMBER</td>
			  <td width="18%">DATE OF RELEASE </td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][0];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][0];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][0];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][0];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][0];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][0];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][1];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][1];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][1];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][1];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][1];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][1];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][2];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][2];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][2];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][2];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][2];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][2];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][3];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][3];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][3];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][3];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][3];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][3];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][4];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][4];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][4];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][4];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][4];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][4];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][5];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][5];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][5];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][5];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][5];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][5];?>" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" value="<?php echo $services['type'][6];?>" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" value="<?php echo $services['rating'][6];?>" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" value="<?php echo $services['date_exam_conferment'][6];?>" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" value="<?php echo $services['place_exam_conferment'][6];?>" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" value="<?php echo $services['license_no'][6];?>" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" value="<?php echo $services['license_release_date'][6];?>" /></td>
		  </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		  </tr>
		</tbody>
	</table>
</div>
    <div id="fragment-5">
        <table width="100%" cellspacing="1" class="admintable">
                              <tbody>
                                <tr>
                                  <td colspan="2" align="center" valign="top" >INCLUSIVE DATES<br />
                                    (yyyy-mm-dd)</td>
                                  <td width="16%" align="center">POSITION/ TITLE <br />
                                    (Write in full) </td>
                                  <td width="17%" align="center">DEPARTMENT/ OFFICE/COPANY<br />
                                    (Write in full)</td>
                                  <td width="10%" align="center">MONTHLY SALARY </td>
                                  <td width="13%" align="center">SALARY GRADE/ &amp; STEP INC.<br />
                                    (Format &quot;00-0&quot;)</td>
                                  <td width="16%" align="center">STATUS OF APPOINTMENT </td>
                                  <td width="10%" align="center">GOV'T SERVICE<br />
                                    (Yes / No)</td>
                                </tr>
                                <tr>
                                  <td width="9%">From                                  </td>
                                  <td width="9%">To</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <?php 
								$i = 0;
			//for($i = 25; $i != 0; $i -- )
			foreach ($works as $work)
			{
				?>
				<tr>
				  <td><input name="work_date1[]" type="text" id="work_date1[]" value="<?php echo $work['inclusive_date_from'];?>" size="12" /></td>
				  <td><input name="work_date2[]" type="text" id="work_date2[]" value="<?php echo $work['inclusive_date_to'];?>" size="12" /></td>
				  <td><input name="work_position[]" type="text" id="work_position[]" value="<?php echo $work['position'];?>" /></td>
				  <td><input name="work_office[]" type="text" id="work_office[]" value="<?php echo $work['company'];?>" /></td>
				  <td><input name="work_salary[]" type="text" id="work_salary[]" value="<?php echo $work['monthly_salary'];?>" size="12" /></td>
				  <td><input name="work_sg[]" type="text" id="work_sg[]" value="<?php echo $work['salary_grade'];?>" size="12" /></td>
				  <td><input name="work_status[]" type="text" id="work_status[]" value="<?php echo $work['status'];?>" /></td>
				  <td><?php echo form_dropdown('work_service[]', $govt_service_options, $work['govt_service']);?></td>
				</tr>
				<?php 
				
				$i ++;
			
			 }
			  
			  
			 if ($i <= 40)
			 {
					while($i != 40)
					{
						
						?>
                        <tr>
                          <td><input name="work_date1[]" type="text" id="work_date1[]" value="" size="12" /></td>
                          <td><input name="work_date2[]" type="text" id="work_date2[]" value="" size="12" /></td>
                          <td><input name="work_position[]" type="text" id="work_position[]" value="" /></td>
                          <td><input name="work_office[]" type="text" id="work_office[]" value="" /></td>
                          <td><input name="work_salary[]" type="text" id="work_salary[]" value="" size="12" /></td>
                          <td><input name="work_sg[]" type="text" id="work_sg[]" value="" size="12" /></td>
                          <td><input name="work_status[]" type="text" id="work_status[]" value="" /></td>
                          <td><?php echo form_dropdown('work_service[]', $govt_service_options, 1);?></td>
                        </tr>
                        <?php 
						
						$i ++;
					}
			 }
			  
			  
			  
			  ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </tbody>
      </table>
</div>
    <div id="fragment-6">
        <table width="72%" cellspacing="1" class="admintable">

		<tbody>

			<tr>
			  <td width="14%" align="center" valign="top">NAME &amp; ADDRESS OF ORGANIZATION<br />
			    (Write in full)</td>
				<td colspan="2" align="center" valign="top" >INCLUSIVE DATES<br />
				  (yyyy-mm-dd)</td>
				<td width="16%" align="center" valign="top" >NUMBER OF HOURS </td>
				<td width="0%" align="center" valign="top" >POSITION/NATURE OF WORK </td>
				<td width="0%" valign="top" >&nbsp;</td>
		  </tr>
			  <?php 
			  $i = 0;
			//for($i = 7; $i != 0; $i -- )
			foreach ($orgs as $org)
			{
			?>
			
			<tr>
			  <td><input name="org_name[]" type="text" id="org_name[]" value="<?php echo $org['name'];?>" size="45" /></td>
			  <td width="14%"><input name="org_inclusive_date_from[]" type="text" id="org_inclusive_date_from[]" value="<?php echo $org['inclusive_date_from'];?>" size="12" /></td>
			  <td width="6%"><input name="org_inclusive_date_to[]" type="text" id="org_inclusive_date_to[]" value="<?php echo $org['inclusive_date_to'];?>" size="12" /></td>
			  <td><input name="org_number_of_hours[]" type="text" id="org_number_of_hours[]" value="<?php echo $org['number_of_hours'];?>" size="12" /></td>
			  <td><input name="org_position[]" type="text" id="org_position[]" value="<?php echo $org['position'];?>" /></td>
			  <td>&nbsp;</td>
		  </tr>
			 
			  <?php 
			  
			  $i ++;
			  }
			  
			  
			  
			  if ($i <= 7)
			 {
					while($i != 7)
					{
						
						?>
                       <tr>
                      <td><input name="org_name[]" type="text" id="org_name[]" size="45" /></td>
                      <td width="14%"><input name="org_inclusive_date_from[]" type="text" id="org_inclusive_date_from[]" size="12" /></td>
                      <td width="6%"><input name="org_inclusive_date_to[]" type="text" id="org_inclusive_date_to[]" size="12" /></td>
                      <td><input name="org_number_of_hours[]" type="text" id="org_number_of_hours[]" size="12" /></td>
                      <td><input name="org_position[]" type="text" id="org_position[]" /></td>
                      <td>&nbsp;</td>
                  </tr>
                        <?php 
						
						$i ++;
					}
			 }
			  
			  
			  
			  ?>
			<tr>
			  <td colspan="6">&nbsp;</td>
		  </tr>
		</tbody>
	</table>
</div>
     <div id="fragment-7">
       <table width="100%" cellspacing="1" class="admintable">
      <tbody>
        <tr>
          <td width="14%" align="center" valign="top">TITLE OF SEMINAR/CONFERENCES/WORKSHOP/SHORT COURSES <br />
            (Write in full)</td>
          <td colspan="2" align="center" valign="top" >INCLUSIVE DATES<br />
            (yyyy-mm-dd)</td>
          <td width="16%" align="center" valign="top" >NUMBER OF HOURS </td>
          <td width="0%" align="center" valign="top" >CONDUCTED/ SPONSORED BY<br>
            (Write in full)</td>
          <td width="0%" valign="top" >&nbsp;</td>
          <td width="0%" valign="top" >&nbsp;</td>
        </tr>
        <?php 
			//for($i = 18; $i != 0; $i -- )
			$i = 0;
			foreach($trains as $train)
			{
				?>
				<tr>
				  <td><input name="tra_name[]" type="text" id="tra_name[]" value="<?php echo $train['name'];?>" size="45" /></td>
				  <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" value="<?php echo $train['date_from'];?>" size="12" /></td>
				  <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" value="<?php echo $train['date_to'];?>" size="12" /></td>
				  <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" value="<?php echo $train['number_hours'];?>" size="12" /></td>
				  <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" value="<?php echo $train['conducted_by'];?>" /></td>
				  <td><?php echo form_dropdown('tra_location[]', $tra_location_options, $train['location']);?></td>
				  <td>&nbsp;</td>
				</tr>
				<?php
				$i ++;
			 }
			 
			 
			  if ($i <= 40)
			 {
					while($i != 40)
					{
						
						?>
                      <tr>
                      <td><input name="tra_name[]" type="text" id="tra_name[]" size="45" /></td>
                      <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" size="12" /></td>
                      <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" size="12" /></td>
                      <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" size="12" /></td>
                      <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" /></td>
                      <td><?php echo form_dropdown('tra_location[]', $tra_location_options, 'local');?></td>
                      <td>&nbsp;</td>
                    </tr>
                        <?php 
						
						$i ++;
					}
			 }
			  
			 
			 
			 
			 ?>
        <tr>
          <td colspan="7">&nbsp;</td>
        </tr>
      </tbody>
    </table>
</div>
    <div id="fragment-8">
        <table width="97%" cellspacing="1" class="admintable">
      <tbody>
        <tr>
          <td width="14%" align="center" valign="top">SPECIAL SKILLS/HOBBIES </td>
          <td align="center" valign="top" >NON-ACADEMIC DISTINCTIONS/ RECOGNITION </td>
          <td align="center" valign="top" >MEMBERSHIP IN ASSOCIATION/ ORGANIZATION<br />
            (Write in full) </td>
          <td width="0%" valign="top" >&nbsp;</td>
        </tr>
        <?php 
			//for($i = 10; $i != 0; $i -- )
			$i = 0;
			foreach ($infos as $info)
			{
				?>
                <tr>
                  <td><input name="skill[]" type="text" id="skill[]" value="<?php echo $info['special_skills'];?>" size="30" /></td>
                  <td width="14%"><input name="recognition[]" type="text" id="recognition[]" value="<?php echo $info['recognition'];?>" size="45" /></td>
                  <td width="6%"><input name="membership_organization[]" type="text" id="membership_organization[]" value="<?php echo $info['membership_organization'];?>" size="30" /></td>
                  <td>&nbsp;</td>
                </tr>
                <?php
				$i ++;
		
			  }
			  
			  if ($i <= 7)
			 {
					while($i != 7)
					{
						
						?>
                        <tr>
                          <td><input name="skill[]" type="text" id="skill[]" size="30" /></td>
                          <td width="14%"><input name="recognition[]" type="text" id="recognition[]" size="45" /></td>
                          <td width="6%"><input name="membership_organization[]" type="text" id="membership_organization[]" size="30" /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php
						
						$i ++;
					}
			 }
			  
			  ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">36. Are you related by consanguinity or affinity to any of the following: </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">a.) Within the third degree (For National Government Employees) </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question1['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">Appointing authority, recommeding authority, chief of office/bureau/department or person who has </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">immediate supervision over you in the Office, Bureau or Department where you will be appointed? </td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question1['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Within the fourth degree (for Local Government Employees) </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question2['answer']);?></td>
        </tr>
        <tr>
          <td height="25" colspan="3">Appointing authority or recommending authority where you will be appointed? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td height="24" colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question2['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">37.</td>
        </tr>
        <tr>
          <td colspan="3">a.) Have you ever been formaly charged? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question3['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question3['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Have you been guilty of administrative offense? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question4['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question4['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">38.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been convicted of any crime or violation of any law, decree, ordinance or </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question5['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">regulation by any court or tribunal? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question5['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">39.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been separate from the service in any of the following modes: resignation </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question6['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">retirement, cropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or  </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">phased out, in the public or private sector? </td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question6['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">40.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been candidate in the national or local election (except for barangay election) ? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question7['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question7['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="3">41. Pursuant to: (a) Indigenous People's Act (RA 8371) (b) Magna Carla for disabled persons (RA 727)</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">and (c) Solo Parents Welfare Act of 2000 (RA 8972) please answer the following items: </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">a.) Are you a member of indigenous group? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question8['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question8['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="3">b.) Are you diffently abled? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question9['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question9['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="3">c.) Are you a solo parent? </td>
          <td><?php echo form_dropdown('q[]', $question_options, $question10['answer']);?></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" value="<?php echo $question10['details'];?>" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">42. REFERENCES (Person not related by consanguinity or affinity to applicant / appontee) </td>
        </tr>
        <tr>
          <td>NAME</td>
          <td>ADDRESS</td>
          <td>TEL. NO </td>
          <td>&nbsp;</td>
        </tr>
		 <?php 
			//for($i = 3; $i != 0; $i -- )
			$i = 0;
			foreach ($references as $reference)
			{
			?>
        <tr>
          <td><input name="ref_name[]" type="text" id="ref_name[]" value="<?php echo $reference['name'];?>" /></td>
          <td><input name="ref_address[]" type="text" id="ref_address[]" value="<?php echo $reference['address'];?>" /></td>
          <td><input name="ref_tel[]" type="text" id="ref_tel[]" value="<?php echo $reference['tel_no'];?>" /></td>
          <td>&nbsp;</td>
        </tr>
		<?php 
		$i ++;
		}
		
		
		 if ($i <= 3)
			 {
					while($i != 3)
					{
						
						?>
                         <tr>
                          <td><input name="ref_name[]" type="text" id="ref_name[]" /></td>
                          <td><input name="ref_address[]" type="text" id="ref_address[]" /></td>
                          <td><input name="ref_tel[]" type="text" id="ref_tel[]" /></td>
                          <td>&nbsp;</td>
                        </tr>
                        <?php
						
						$i ++;
					}
			 }
		
		
		?>
		</tbody>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><SCRIPT>
	$(function() {
		$( "input:submit", ".demo" ).button();
		$( "input:submit", ".demo" ).click(function() { return true; });
	});
	</SCRIPT>
<DIV class=demo><INPUT value="Save" type="submit"></DIV></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
      </tbody>
    </table>
    </div>
    
    
     <div id="fragment-10">
      <table width="100%" border="0">
        <tr>
          <td align="center">Item Number</td>
          <td align="center">Position</td>
          <td align="center">Department</td>
          <td align="center">Salary Grade</td>
          <td align="center">Salary</td>
        </tr>
        <tr>
          <td align="center"><input name="profile_item_number" type="text" id="profile_item_number" value="<?php echo$profile['item_number'];?>" /></td>
          <td align="center"><input name="profile_position" type="text" id="profile_position" value="<?php echo$profile['position'];?>" /></td>
          <td align="center"><input name="profile_department" type="text" id="profile_department" value="<?php echo$profile['department'];?>" /></td>
          <td align="center"><input name="profile_salary_grade" type="text" id="profile_salary_grade" value="<?php echo$profile['salary_grade'];?>" /></td>
          <td align="center"><input name="profile_salary" type="text" id="profile_salary" value="<?php echo$profile['salary'];?>" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>APPOINTMENT STATUS:</td>
          <td><input name="profile_status" type="text" id="profile_status" value="<?php echo $profile['status'];?>" /></td>
          <td>DATE OF LAST PROMOTION:</td>
          <td><input name="profile_last_promotion" type="text" id="profile_last_promotion" value="<?php echo $profile['last_promotion'];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>POSITION LEVEL:</td>
          <td><input name="profile_level" type="text" id="profile_level" value="<?php echo $profile['level'];?>" /></td>
          <td>ELIGIBILITY:</td>
          <td><input name="profile_eligibility" type="text" id="profile_eligibility" value="<?php echo $profile['eligibility'];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>1st DAY OF SERVICE:</td>
          <td><input name="profile_first_day" type="text" id="profile_first_day" value="<?php echo $profile['first_day'];?>" /></td>
          <td>GRADUATED /YEARLEVEL:</td>
          <td><input name="profile_graduated" type="text" id="profile_graduated" value="<?php echo $profile['graduated'];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>COURSE:</td>
          <td><input name="profile_course" type="text" id="profile_course" value="<?php echo $profile['course'];?>" /></td>
          <td>UNITS EARNED:</td>
          <td><input name="profile_units" type="text" id="profile_units" value="<?php echo $profile['units'];?>" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>POST GRAD:</td>
          <td><input name="profile_post_grad" type="text" id="profile_post_grad" value="<?php echo $profile['post_grad'];?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    
    
    
</div></form>

</body>
</html>
