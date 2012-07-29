
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
      <legend>Voluntary Work</legend>
      <table width="100%" cellspacing="1" class="admintable">

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
			<?php $i = 0;?>
			<?php foreach ($orgs as $org):?>
			<tr>
			  <td><input name="org_name[]" type="text" id="org_name" value="<?php echo $org->name;?>" size="45" /></td>
			  <td width="14%"><input name="org_inclusive_date_from[]" type="text" id="org_inclusive_date_from[]" value="<?php echo $org->inclusive_date_from;?>" size="12" /></td>
			  <td width="6%"><input name="org_inclusive_date_to[]" type="text" id="org_inclusive_date_to[]" value="<?php echo $org->inclusive_date_to;?>" size="12" /></td>
			  <td align="center"><input name="org_number_of_hours[]" type="text" id="org_number_of_hours[]" value="<?php echo $org->number_of_hours;?>" size="12" /></td>
			  <td><input name="org_position[]" type="text" id="org_position[]" value="<?php echo $org->position;?>" size="30" /></td>
			  <td>&nbsp;</td>
		  </tr>
			  <?php $i ++;?>
              <?php endforeach;?>
			  
			 
              <?php if ($i <= 7):?>
			  	<?php while($i != 7):?>
                       <tr>
                      <td><input name="org_name[]" type="text" id="org_name" size="45" /></td>
                      <td width="14%"><input name="org_inclusive_date_from[]" type="text" id="org_inclusive_date_from[]" size="12" /></td>
                      <td width="6%"><input name="org_inclusive_date_to[]" type="text" id="org_inclusive_date_to[]" size="12" /></td>
                      <td align="center"><input name="org_number_of_hours[]" type="text" id="org_number_of_hours[]" size="12" /></td>
                      <td><input name="org_position[]" type="text" id="org_position[]" size="30" /></td>
                      <td>&nbsp;</td>
                  </tr>
                  <?php $i ++;?>
				<?php endwhile;?>
            <?php endif;?>
              <tr>
			              <td colspan="6">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="6">&nbsp;</td>
              </tr>
              <tr>
			  <td colspan="6"><input name="op" type="hidden" id="op" value="1" />
                <span style="clear: both;">
                <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
                <input type="submit" name="button" id="button" value="Save" />
                </span></td>
		  </tr>
		</tbody>
	</table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
