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
   
    <div id="fragment-1">
       <table class="noshow">
					<tr>
						<td width="86%">
	<table width="100%" cellspacing="1" class="admintable">
		<tr>
		  <td width="20">2.</td>
			<td width="192" class="key"><label for="survey_year">SURNAME <span style="clear: both;">
			  <input name="op" type="hidden" id="op" value="1" />
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
		  <input name="lname" type="text" id="lname" size="30"/></td>
			<td width="20">&nbsp;</td>
			<td width="152" class="key">&nbsp;</td>
			<td width="179" align="left" id="t_item">&nbsp;</td>
			<td align="left" id="t_item">&nbsp;</td>
		</tr>
		<tr>
		  <td >&nbsp;</td>
			<td valign="top" class="key"><span class="editlinktip hasTip" title="Resident::message here">
			<label for="resident">FIRST NAME </label>
			</span></td>
			<td><input name="fname" type="text" id="fname"/></td>
			<td >&nbsp;</td>
			<td colspan="2" align="center" class="key" ><span style="display: none" id="saved">Employee record has been saved!</span></td>
			<td width="10">&nbsp;</td>
		</tr>
		<tr>
		  <td >&nbsp;</td>
			<td class="key">MIDDLE NAME </td>

			<td><input name="mname" type="text" id="mname"/></td>
			<td >&nbsp;</td>
			<td class="key">
            <?php 
			if ($saved == 1)
			{
				 ?>
                 <script>
				 $("#saved").show("fast");
            	 $("#saved").fadeOut(8000);
			     </script>
				<?php	
			}
            ?>
            </td>
			<td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
			<td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		</tr>
		<tr>
		  <td >3.</td>
		  <td class="key">NAME EXTENSION (eg Jr, Sr) </td>
		  <td><input name="extension" type="text" id="extension" size="4"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >4.</td>
		  <td class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
		  <td><input name="birth_date" type="text" id="birth_date"/></td>
		  <td >&nbsp;</td>
		  <td class="key">RESIDENTIAL ADDRESS</td>
		  <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="res_address" rows="3" id="res_address"></textarea></td>
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
		  <td><input name="birth_place" type="text" id="birth_place"/></td>
		  <td >16.</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		</tr>
		<tr>
		  <td >6.</td>
		  <td class="key">SEX</td>
		  <td><select name="sex" id="sex">
		    <option value="M">Male</option>
		    <option value="F">Female</option>
		    </select>		  </td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >7.</td>
		  <td class="key">CIVIL STATUS </td>
		  <td><select name="civil_status" id="civil_status">
            <option value="1">Single</option>
            <option value="2">Married</option>
            <option value="3">Annulled</option>
            <option value="4">Widowed</option>
            <option value="5">Separated</option>
            <option value="6">Others</option>
          </select></td>
		  <td >&nbsp;</td>
		  <td class="key">ZIP CODE </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_zip" type="text" id="res_zip"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >8.</td>
		  <td class="key">CITIZENSHIP</td>
		  <td><input name="citizenship" type="text" id="citizenship"/></td>
		  <td >17.</td>
		  <td class="key">TELEPHONE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="res_tel" type="text" id="res_tel"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >9.</td>
		  <td class="key">HEIGHT (m) </td>
		  <td><input name="height" type="text" id="height"/></td>
		  <td >18</td>
		  <td class="key">PERMANENT ADDRESS </td>
		  <td rowspan="3" align="left" nowrap="nowrap" id="t_unit_issue"><textarea name="permanent_address" rows="3" id="permanent_address"></textarea></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >10.</td>
		  <td class="key">WEIGHT (kg) </td>
		  <td><input name="weight" type="text" id="weight"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >11.</td>
		  <td class="key">BLOOD TYPE </td>
		  <td><input name="blood_type" type="text" id="blood_type"/></td>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >12.</td>
		  <td class="key">GSIS ID NO. </td>
		  <td><input name="gsis" type="text" id="gsis"/></td>
		  <td >&nbsp;</td>
		  <td class="key">ZIP CODE </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_zip" type="text" id="permanent_zip"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >13.</td>
		  <td class="key">PAG-IBIG ID NO. </td>
		  <td><input name="pagibig" type="text" id="pagibig"/></td>
		  <td >19</td>
		  <td class="key">TELEPHONE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="permanent_tel" type="text" id="permanent_tel"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >14.</td>
		  <td class="key">PHILHEALTH ID NO </td>
		  <td><input name="philhealth" type="text" id="philhealth"/></td>
		  <td >20</td>
		  <td class="key">EMAIL ADDRESS (if any) </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="email" type="text" id="email"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >15.</td>
		  <td class="key">SSS NO. </td>
		  <td><input name="sss" type="text" id="sss"/></td>
		  <td >21..</td>
		  <td class="key">CELLPHONE NO. (if any) </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="cp" type="text" id="cp"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td >22.</td>
		  <td class="key">AGENCY EMPLOYEE NO. </td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="agency_employee_no" type="text" id="agency_employee_no"/></td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue">&nbsp;</td>
		  </tr>
		<tr>
		  <td >&nbsp;</td>
		  <td class="key">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td >23.</td>
		  <td class="key">TIN</td>
		  <td align="left" nowrap="nowrap" id="t_unit_issue"><input name="tin" type="text" id="tin"/></td>
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
											  </td>
					</tr>
				</table>
    </div>
    <div id="fragment-2">
      <table width="94%" cellspacing="1" class="admintable">

		<tbody>
			<tr>
			  <td>24.</td>
			  <td class="key">SPOUSE'S SURNAME </td>
			  <td><input name="spouse_lname" type="text" id="spouse_lname"/></td>
			  <td class="key">25. NAME OF CHILD (Write full name and list all </td>
			  <td class="key">DATE OF BIRTH (yyyy-mm-dd) </td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="spouse_fname" type="text" id="spouse_fname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="spouse_mname" type="text" id="spouse_mname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">OCCUPATION</td>
			  <td><input name="spouse_occupation" type="text" id="spouse_occupation"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">EMPLOYER/BUS. NAME </td>
			  <td><input name="spouse_employer" type="text" id="spouse_employer"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">BUSINESS ADDRESS </td>
			  <td><input name="spouse_biz_ad" type="text" id="spouse_biz_ad"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">TELEPHONE NO. </td>
			  <td><input name="spouse_tel" type="text" id="spouse_tel"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >26.</td>
			  <td class="key">FATHER'S SURNAME </td>
			  <td><input name="father_lname" type="text" id="father_lname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="father_fname" type="text" id="father_fname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="father_mname" type="text" id="father_mname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >27.</td>
			  <td class="key">MOTHER'S MAIDEN NAME </td>
			  <td><input name="mother_lname" type="text" id="mother_lname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">FIRST NAME </td>
			  <td><input name="mother_fname" type="text" id="mother_fname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
		  </tr>
			<tr>
			  <td >&nbsp;</td>
			  <td class="key">MIDDLE NAME </td>
			  <td><input name="mother_mname" type="text" id="mother_mname"/></td>
			  <td><input name="children[]" type="text" id="children[]"/></td>
			  <td><input name="children_birth_day[]" type="text" id="children_birth_day[]"/></td>
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
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
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
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
		  </tr>
			<tr>
			  <td width="24" >&nbsp;</td>
			  <td width="243">&nbsp;</td>
			  <td width="198">&nbsp;</td>
			  <td width="361">&nbsp;</td>
			  <td width="243">&nbsp;</td>
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
				<td><textarea name="elem_school" cols="15" id="elem_school"></textarea></td>
				<td><textarea name="elem_degree" cols="15" id="elem_degree"></textarea></td>
				<td><textarea name="elem_grad" cols="5" id="elem_grad"></textarea></td>
				<td><textarea name="elem_units" cols="15" id="elem_units"></textarea></td>
				<td width="344"><textarea name="elem_date1" cols="15" id="elem_date1"></textarea></td>
				<td width="377"><textarea name="elem_date2" cols="15" id="elem_date2"></textarea></td>
				<td><textarea name="elem_scho" cols="15" id="elem_scho"></textarea></td>
			</tr>
			
			<tr>
			  <td class="key">SECONDARY</td>
			  <td><textarea name="sec_school" cols="15" id="sec_school"></textarea></td>
			  <td><textarea name="sec_degree" cols="15" id="sec_degree"></textarea></td>
			  <td><textarea name="sec_grad" cols="5" id="sec_grad"></textarea></td>
			  <td><textarea name="sec_units" cols="15" id="sec_units"></textarea></td>
			  <td><textarea name="sec_date1" cols="15" id="sec_date1"></textarea></td>
			  <td><textarea name="sec_date2" cols="15" id="sec_date2"></textarea></td>
			  <td><textarea name="sec_scho" cols="15" id="sec_scho"></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">VOCATIONAL/ TRADE COURSE </td>
			  <td><textarea name="voc_school" cols="15" id="voc_school"></textarea></td>
			  <td><textarea name="voc_degree" cols="15" id="voc_degree"></textarea></td>
			  <td><textarea name="voc_grad" cols="5" id="voc_grad"></textarea></td>
			  <td><textarea name="voc_units" cols="15" id="voc_units"></textarea></td>
			  <td><textarea name="voc_date1" cols="15" id="voc_date1"></textarea></td>
			  <td><textarea name="voc_date2" cols="15" id="voc_date2"></textarea></td>
			  <td><textarea name="voc_scho" cols="15" id="voc_scho"></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">COLLEGE</td>
			  <td><textarea name="col_school" cols="15" id="col_school"></textarea></td>
			  <td><textarea name="col_degree" cols="15" id="col_degree"></textarea></td>
			  <td><textarea name="col_grad" cols="5" id="col_grad"></textarea></td>
			  <td><textarea name="col_units" cols="15" id="col_units"></textarea></td>
			  <td><textarea name="col_date1" cols="15" id="col_date1"></textarea></td>
			  <td><textarea name="col_date2" cols="15" id="col_date2"></textarea></td>
			  <td><textarea name="col_scho" cols="15" id="col_scho"></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">GRADUATE STUDIES </td>
			  <td><textarea name="grad_school" cols="15" id="grad_school"></textarea></td>
			  <td><textarea name="grad_degree" cols="15" id="grad_degree"></textarea></td>
			  <td><textarea name="grad_grad" cols="5" id="grad_grad"></textarea></td>
			  <td><textarea name="grad_units" cols="15" id="grad_units"></textarea></td>
			  <td><textarea name="grad_date1" cols="15" id="grad_date1"></textarea></td>
			  <td><textarea name="grad_date2" cols="15" id="grad_date2"></textarea></td>
			  <td><textarea name="grad_scho" cols="15" id="grad_scho"></textarea></td>
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
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
		  </tr>
			<tr>
			  <td><input name="type[]" type="text" id="type[]" /></td>
			  <td><input name="rating[]" type="text" id="rating[]" /></td>
			  <td><input name="date_exam_conferment[]" type="text" id="date_exam_conferment[]" /></td>
			  <td><input name="place_exam_conferment[]" type="text" id="place_exam_conferment[]" /></td>
			  <td><input name="license_no[]" type="text" id="license_no[]" /></td>
			  <td><input name="license_release_date[]" type="text" id="license_release_date[]" /></td>
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
			for($i = 25; $i != 0; $i -- )
			{
			?>
                                <tr>
                                  <td><input name="work_date1[]" type="text" id="work_date1[]" size="12" /></td>
                                  <td><input name="work_date2[]" type="text" id="work_date2[]" size="12" /></td>
                                  <td><input name="work_position[]" type="text" id="work_position[]" /></td>
                                  <td><input name="work_office[]" type="text" id="work_office[]" /></td>
                                  <td><input name="work_salary[]" type="text" id="work_salary[]" size="12" /></td>
                                  <td><input name="work_sg[]" type="text" id="work_sg[]" size="12" /></td>
                                  <td><input name="work_status[]" type="text" id="work_status[]" /></td>
                                  <td><label>
                                  <select name="work_service[]" id="work_service[]">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                  </select>
                                  </label>
                                  <label></label></td>
                                </tr>
                                <?php 
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
        <table width="36%" cellspacing="1" class="admintable">

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
			for($i = 7; $i != 0; $i -- )
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
			for($i = 18; $i != 0; $i -- )
			{
			?>
        <tr>
          <td><input name="tra_name[]" type="text" id="tra_name[]" size="45" /></td>
          <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" size="12" /></td>
          <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" size="12" /></td>
          <td><input name="tra_hours[]" type="text" id="tra_hours[]" size="12" /></td>
          <td><input name="tra_conduct[]" type="text" id="tra_conduct[]" /></td>
          <td><select name="tra_location[]" id="tra_location[]">
            <option value="local">Local</option>
            <option value="regional">Regional</option>
            <option value="national">National</option>
            <option value="international">International</option>
          </select>
          </td>
          <td>&nbsp;</td>
        </tr>
        <?php 
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
			for($i = 10; $i != 0; $i -- )
			{
			?>
        <tr>
          <td><input name="skill[]" type="text" id="skill[]" size="30" /></td>
          <td width="14%"><input name="recognition[]" type="text" id="recognition[]" size="45" /></td>
          <td width="6%"><input name="membership_organization[]" type="text" id="membership_organization[]" size="30" /></td>
          <td>&nbsp;</td>
        </tr>
        <?php 
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
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">Appointing authority, recommeding authority, chief of office/bureau/department or person who has </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">immediate supervision over you in the Office, Bureau or Department where you will be appointed? </td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Within the fourth degree (for Local Government Employees) </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td height="25" colspan="3">Appointing authority or recommending authority where you will be appointed? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td height="24" colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
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
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">b.) Have you been guilty of administrative offense? </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">38.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been convicted of any crime or violation of any law, decree, ordinance or </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">regulation by any court or tribunal? </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">39.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been separate from the service in any of the following modes: resignation </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">retirement, cropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or  </td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">phased out, in the public or private sector? </td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td colspan="4">40.</td>
        </tr>
        <tr>
          <td colspan="3">Have you ever been candidate in the national or local election (except for barangay election) ? </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, give details </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
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
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="3">b.) Are you diffently abled? </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
        </tr>
        <tr>
          <td colspan="3">c.) Are you a solo parent? </td>
          <td><select name="q[]" id="q[]">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td>If yes, please specify </td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
          <td><input name="details[]" type="text" id="details[]" size="50" /></td>
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
			for($i = 3; $i != 0; $i -- )
			{
			?>
        <tr>
          <td><input name="ref_name[]" type="text" id="ref_name[]" /></td>
          <td><input name="ref_address[]" type="text" id="ref_address[]" /></td>
          <td><input name="ref_tel[]" type="text" id="ref_tel[]" /></td>
          <td>&nbsp;</td>
        </tr>
		<?php 
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
          <td align="center"><input name="profile_item_number" type="text" id="profile_item_number" /></td>
          <td align="center"><input name="profile_position" type="text" id="profile_position" /></td>
          <td align="center"><input name="profile_department" type="text" id="profile_department" /></td>
          <td align="center"><input name="profile_salary_grade" type="text" id="profile_salary_grade" /></td>
          <td align="center"><input name="profile_salary" type="text" id="profile_salary" /></td>
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
          <td><input name="profile_status" type="text" id="profile_status" /></td>
          <td>DATE OF LAST PROMOTION:</td>
          <td><input name="profile_last_promotion" type="text" id="profile_last_promotion" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>POSITION LEVEL:</td>
          <td><input name="profile_level" type="text" id="profile_level" /></td>
          <td>ELIGIBILITY:</td>
          <td><input name="profile_eligibility" type="text" id="profile_eligibility" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>1st DAY OF SERVICE:</td>
          <td><input name="profile_first_day" type="text" id="profile_first_day" /></td>
          <td>GRADUATED /YEARLEVEL:</td>
          <td><input name="profile_graduated" type="text" id="profile_graduated" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>COURSE:</td>
          <td><input name="profile_course" type="text" id="profile_course" /></td>
          <td>UNITS EARNED:</td>
          <td><input name="profile_units" type="text" id="profile_units" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>POST GRAD:</td>
          <td><input name="profile_post_grad" type="text" id="profile_post_grad" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    
    
</div></form>

</body>
</html>
