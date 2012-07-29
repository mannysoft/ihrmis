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
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td colspan="2" align="center" valign="middle" >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="6%" align="center">Name</td>
                                  <td width="6%" align="center">Name of Firm/ Company</td>
                                  <td width="6%" align="center">Address</td>
                                  <td width="6%" align="center">Nature of Business Interest and/or Financial Connections</td>
                                  <td width="7%" align="center">Date of Acquisition or Connection</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($interests as $interest): ?>
				<tr>
				  <td align="center"><input name="name[]" type="text" id="name[]" value="<?php echo $interest->name;?>" /></td>
				  <td align="center"><input name="company[]" type="text" id="company[]" value="<?php echo $interest->company;?>" /></td>
				  <td align="center"><input name="address[]" type="text" id="address[]" value="<?php echo $interest->address;?>" /></td>
				  <td align="center"><input name="nature_business[]" type="text" id="nature_business[]" value="<?php echo $interest->nature_business;?>" /></td>
				  <td align="center"><input name="date_acquisition[]" type="text" id="date_acquisition[]" value="<?php echo $interest->date_acquisition;?>" /></td>
				  </tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 10): ?>
			  	 	<?php while($i != 10): ?>
			 
                        <tr>
                          <td align="center"><input name="name[]" type="text" id="name[]" value="" /></td>
                          <td align="center"><input name="company[]" type="text" id="company[]" value="" /></td>
                          <td align="center"><input name="address[]" type="text" id="address[]" value="" /></td>
                          <td align="center"><input name="nature_business[]" type="text" id="nature_business[]" /></td>
                          <td align="center"><input name="date_acquisition[]" type="text" id="date_acquisition[]" value="" /></td>
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
                                </tr>
                                <tr>
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
