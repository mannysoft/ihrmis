
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
    <?php //echo 'Office list box and employee listbox here';?>
    <?php if ($msg != ''): ?>
    <div class="clean-green"><?php echo $msg;?></div>
    <?php endif; ?>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form action="" method="post">
    <fieldset class="adminform">
      <legend>Educational Background</legend>
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
				<td align="center"><textarea name="elem_school" cols="10" id="elem_school"><?php echo $educs1->school_name;?></textarea></td>
				<td align="center"><textarea name="elem_degree" cols="10" id="elem_degree"><?php echo $educs1->degree_course;?></textarea></td>
				<td align="center"><textarea name="elem_grad" cols="10" id="elem_grad"><?php echo $educs1->year_graduated;?></textarea></td>
				<td align="center"><textarea name="elem_units" cols="10" id="elem_units"><?php echo $educs1->highest_grade;?></textarea></td>
				<td width="344" align="center"><textarea name="elem_date1" cols="10" id="elem_date1"><?php echo $educs1->attend_from;?></textarea></td>
				<td width="377" align="center"><textarea name="elem_date2" cols="10" id="elem_date2"><?php echo $educs1->attend_to;?></textarea></td>
				<td align="center"><textarea name="elem_scho" cols="10" id="elem_scho"><?php echo $educs1->scholarship;?></textarea></td>
			</tr>
			
			<tr>
			  <td class="key">SECONDARY</td>
			  <td align="center"><textarea name="sec_school" cols="10" id="sec_school"><?php echo $educs2->school_name;?></textarea></td>
			  <td align="center"><textarea name="sec_degree" cols="10" id="sec_degree"><?php echo $educs2->degree_course;?></textarea></td>
			  <td align="center"><textarea name="sec_grad" cols="10" id="sec_grad"><?php echo $educs2->year_graduated;?></textarea></td>
			  <td align="center"><textarea name="sec_units" cols="10" id="sec_units"><?php echo $educs2->highest_grade;?></textarea></td>
			  <td align="center"><textarea name="sec_date1" cols="10" id="sec_date1"><?php echo $educs2->attend_from;?></textarea></td>
			  <td align="center"><textarea name="sec_date2" cols="10" id="sec_date2"><?php echo $educs2->attend_to;?></textarea></td>
			  <td align="center"><textarea name="sec_scho" cols="10" id="sec_scho"><?php echo $educs2->scholarship;?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">VOCATIONAL/ TRADE COURSE </td>
			  <td align="center"><textarea name="voc_school" cols="10" id="voc_school"><?php echo $educs3->school_name;?></textarea></td>
			  <td align="center"><textarea name="voc_degree" cols="10" id="voc_degree"><?php echo $educs3->degree_course;?></textarea></td>
			  <td align="center"><textarea name="voc_grad" cols="10" id="voc_grad"><?php echo $educs3->year_graduated;?></textarea></td>
			  <td align="center"><textarea name="voc_units" cols="10" id="voc_units"><?php echo $educs3->highest_grade;?></textarea></td>
			  <td align="center"><textarea name="voc_date1" cols="10" id="voc_date1"><?php echo $educs3->attend_from;?></textarea></td>
			  <td align="center"><textarea name="voc_date2" cols="10" id="voc_date2"><?php echo $educs3->attend_to;?></textarea></td>
			  <td align="center"><textarea name="voc_scho" cols="10" id="voc_scho"><?php echo $educs3->scholarship;?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">COLLEGE</td>
			  <td align="center"><textarea name="col_school" cols="10" id="col_school"><?php echo $educs4->school_name;?></textarea></td>
			  <td align="center"><textarea name="col_degree" cols="10" id="col_degree"><?php echo $educs4->degree_course;?></textarea></td>
			  <td align="center"><textarea name="col_grad" cols="10" id="col_grad"><?php echo $educs4->year_graduated;?></textarea></td>
			  <td align="center"><textarea name="col_units" cols="10" id="col_units"><?php echo $educs4->highest_grade;?></textarea></td>
			  <td align="center"><textarea name="col_date1" cols="10" id="col_date1"><?php echo $educs4->attend_from;?></textarea></td>
			  <td align="center"><textarea name="col_date2" cols="10" id="col_date2"><?php echo $educs4->attend_to;?></textarea></td>
			  <td align="center"><textarea name="col_scho" cols="10" id="col_scho"><?php echo $educs4->scholarship;?></textarea></td>
		  </tr>
			
			<tr>
			  <td class="key">GRADUATE STUDIES </td>
			  <td align="center"><textarea name="grad_school" cols="10" id="grad_school"><?php echo $educs5->school_name;?></textarea></td>
			  <td align="center"><textarea name="grad_degree" cols="10" id="grad_degree"><?php echo $educs5->degree_course;?></textarea></td>
			  <td align="center"><textarea name="grad_grad" cols="10" id="grad_grad"><?php echo $educs5->year_graduated;?></textarea></td>
			  <td align="center"><textarea name="grad_units" cols="10" id="grad_units"><?php echo $educs5->highest_grade;?></textarea></td>
			  <td align="center"><textarea name="grad_date1" cols="10" id="grad_date1"><?php echo $educs5->attend_from;?></textarea></td>
			  <td align="center"><textarea name="grad_date2" cols="10" id="grad_date2"><?php echo $educs5->attend_to;?></textarea></td>
			  <td align="center"><textarea name="grad_scho" cols="10" id="grad_scho"><?php echo $educs5->scholarship;?></textarea></td>
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
			  <td><span style="clear: both;">
			    <input name="op" type="hidden" id="op" value="1" />
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
