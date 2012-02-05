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
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td colspan="2" align="center" valign="middle" >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="6%" align="center">Name</td>
                                  <td width="6%" align="center">Position</td>
                                  <td width="6%" align="center">Relationship</td>
                                  <td width="7%" align="center">Name/Address of Office</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($relatives as $relative): ?>
				<tr>
				  <td align="center"><input name="name[]" type="text" id="name[]" value="<?php echo $relative->name;?>" /></td>
				  <td align="center"><input name="position[]" type="text" id="position[]" value="<?php echo $relative->position;?>" /></td>
				  <td align="center"><input name="relationship[]" type="text" id="relationship[]" value="<?php echo $relative->relationship;?>" /></td>
				  <td align="center"><input name="name_address[]" type="text" id="name_address[]" value="<?php echo $relative->name_address;?>" /></td>
				  </tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 10): ?>
			  	 	<?php while($i != 10): ?>
			 
                        <tr>
                          <td align="center"><input name="name[]" type="text" id="name[]" value="" /></td>
                          <td align="center"><input name="position[]" type="text" id="position[]" value="" /></td>
                          <td align="center"><input name="relationship[]" type="text" id="relationship[]" /></td>
                          <td align="center"><input name="name_address[]" type="text" id="name_address[]" value="" /></td>
                          </tr>
                        <?php $i ++;?>
                        
                     <?php endwhile;?>
				<?php endif; ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
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
