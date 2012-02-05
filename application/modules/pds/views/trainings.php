
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
      <legend>Trainings</legend>
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
        	<?php $i = 0;?>
			<?php foreach($trains as $train):?>
				<tr>
				  <td><input name="tra_name[]" type="text" id="tra_name[]" value="<?php echo $train->name;?>" size="45" /></td>
				  <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" value="<?php echo $train->date_from;?>" size="12" /></td>
				  <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" value="<?php echo $train->date_to;?>" size="12" /></td>
				  <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" value="<?php echo $train->number_hours;?>" size="12" /></td>
				  <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" value="<?php echo $train->conducted_by;?>" /></td>
				  <td><?php echo form_dropdown('tra_location[]', $tra_location_options, $train->location);?></td>
				  <td>&nbsp;</td>
				</tr>
			<?php $i ++;?>
			<?php endforeach;?>
			
            <?php if ($i <= 65):?> 
			 
				<?php while($i != 65):?> 
                      <tr>
                      <td><input name="tra_name[]" type="text" id="tra_name[]" size="45" /></td>
                      <td width="14%"><input name="tra_date_from[]" type="text" id="tra_date_from[]" size="12" /></td>
                      <td width="6%"><input name="tra_date_to[]" type="text" id="tra_date_to[]" size="12" /></td>
                      <td align="center"><input name="tra_hours[]" type="text" id="tra_hours[]" size="12" /></td>
                      <td align="center"><input name="tra_conduct[]" type="text" id="tra_conduct[]" /></td>
                      <td><?php echo form_dropdown('tra_location[]', $tra_location_options, 'local');?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <?php $i ++;?>
				<?php endwhile;?>
            <?php endif;?>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
          <td colspan="7"><input name="op" type="hidden" id="op" value="1" />
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
