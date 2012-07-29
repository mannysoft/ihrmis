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
                                  <td colspan="2" align="center" valign="middle" >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="6%" align="center">Nature</td>
                                  <td width="6%" align="center">Name of Creditors</td>
                                  <td width="7%" align="center">Amount</td>
                                </tr>
                                <?php $i = 0;?>
                <?php foreach ($liabilities as $liability): ?>
				<tr>
				  <td align="center"><input name="nature[]" type="text" id="nature[]" value="<?php echo $liability->nature;?>" /></td>
				  <td align="center"><input name="name_creditors[]" type="text" id="name_creditors[]" value="<?php echo $liability->name_creditors;?>" /></td>
				  <td align="center"><input name="amount[]" type="text" id="amount[]" value="<?php echo $liability->amount;?>" /></td>
				  </tr>
                <?php $i ++;?>
                <?php endforeach; ?>
				
			
			 
			  	<?php if ($i <= 10): ?>
			  	 	<?php while($i != 10): ?>
			 
                        <tr>
                          <td align="center"><input name="nature[]" type="text" id="nature[]" value="" /></td>
                          <td align="center"><input name="name_creditors[]" type="text" id="name_creditors[]" value="" /></td>
                          <td align="center"><input name="amount[]" type="text" id="amount[]" value="" /></td>
                          </tr>
                        <?php $i ++;?>
                        
                     <?php endwhile;?>
				<?php endif; ?>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
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
