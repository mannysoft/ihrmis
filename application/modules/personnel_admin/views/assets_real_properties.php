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
      <legend><?php echo $section_name; ?></legend>
      <table width="100%" cellpadding="5" cellspacing="5" class="admintable">
                              <tbody>
                                <tr>
                                  <td align="center" valign="middle" ><br /></td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td colspan="2" align="center" valign="middle" >Acquisition Cost</td>
                                </tr>
                                <tr>
                                  <td width="6%" align="center">Kind</td>
                                  <td width="6%" align="center">Location</td>
                                  <td width="6%" align="center">Year Acquired</td>
                                  <td width="6%" align="center">Mode of Acquisition</td>
                                  <td width="6%" align="center">Nature of Property</td>
                                  <td width="6%" align="center">Assessed Value</td>
                                  <td width="6%" align="center">Current Fair Market Value</td>
                                  <td width="6%" align="center">Land; Bldg., etc.                                </td>
                                  <td width="7%" align="center">Improve-<br />
                                  ments</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($properties as $property): ?>
				<tr>
				  <td align="center"><input name="kind[]" type="text" id="kind[]" value="<?php echo $property->kind;?>" size="8" /></td>
				  <td align="center"><input name="location[]" type="text" id="location[]" value="<?php echo $property->location;?>" size="10" /></td>
				  <td align="center"><input name="year_acquired[]" type="text" id="year_acquired[]" value="<?php echo $property->year_acquired;?>" size="5" /></td>
				  <td align="center"><input name="mode_acquisition[]" type="text" id="mode_acquisition[]" value="<?php echo $property->mode_acquisition;?>" size="10" /></td>
				  <td align="center"><input name="nature_property[]" type="text" id="nature_property[]" value="<?php echo $property->nature_property;?>" size="12" /></td>
				  <td align="center"><input name="assessed_value[]" type="text" id="assessed_value[]" value="<?php echo $property->assessed_value;?>" size="12" /></td>
				  <td align="center"><input name="market_value[]" type="text" id="market_value[]" value="<?php echo $property->market_value;?>" size="12" /></td>
				  <td align="center"><input name="land_cost[]" type="text" id="land_cost[]" value="<?php echo $property->land_cost;?>" size="12" /></td>
				  <td align="center"><input name="improvement_cost[]" type="text" id="improvement_cost[]" value="<?php echo $property->improvement_cost;?>" size="12" /></td>
				  </tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 10): ?>
			  	 	<?php while($i != 10): ?>
			 
                        <tr>
                          <td align="center"><input name="kind[]" type="text" id="kind[]" value="" size="8" /></td>
                          <td align="center"><input name="location[]" type="text" id="location[]" value="" size="10" /></td>
                          <td align="center"><input name="year_acquired[]" type="text" id="year_acquired[]" value="" size="5" /></td>
                          <td align="center"><input name="mode_acquisition[]" type="text" id="mode_acquisition[]" value="" size="10" /></td>
                          <td align="center"><input name="nature_property[]" type="text" id="nature_property[]" value="" size="12" /></td>
                          <td align="center"><input name="assessed_value[]" type="text" id="assessed_value[]" value="" size="12" /></td>
                          <td align="center"><input name="market_value[]" type="text" id="market_value[]" value="" size="12" /></td>
                          <td align="center"><input name="land_cost[]" type="text" id="land_cost[]" value="" size="12" /></td>
                          <td align="center"><input name="improvement_cost[]" type="text" id="improvement_cost[]" value="" size="12" /></td>
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
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td align="center"><span style="clear: both;">
                                    <input name="op" type="hidden" id="op" value="1" />
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
