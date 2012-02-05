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
                                  <td align="right" valign="middle" >Spouse Name:</td>
                                  <td align="left" valign="middle" ><input name="s_lname" type="text" id="s_lname" value="<?php echo $info->s_lname;?>" />
                                  <br />
                                  Surname</td>
                                  <td align="center" valign="middle" ><input name="s_fname" type="text" id="s_fname" value="<?php echo $info->s_fname;?>" />
                                  <br />
                                  First Name&nbsp;</td>
                                  <td align="center" valign="middle" ><input name="s_mname" type="text" id="s_mname" value="<?php echo $info->s_mname;?>" />
                                  <br />
                                  MI&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" >Position:</td>
                                  <td align="left" valign="middle" ><input name="s_position" type="text" id="s_position" value="<?php echo $info->s_position;?>" /></td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" >Office:</td>
                                  <td align="left" valign="middle" ><input name="s_office" type="text" id="s_office" value="<?php echo $info->s_office;?>" /></td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                </tr>
                                <tr>
                                  <td width="14%" align="center" valign="middle" >&nbsp;</td>
                                  <td width="23%" align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" >&nbsp;</td>
                                  <td align="center" valign="middle" ><span style="clear: both;">
                                    <input name="op" type="hidden" id="op" value="1" />
                                    <input name="employee_id" type="hidden" id="employee_id" value="<?php echo $employee->employee_id;?>" />
                                    <input type="submit" name="button" id="button" value="Save" />
                                  </span></td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td width="20%">&nbsp;</td>
                                  <td width="23%">&nbsp;</td>
                                </tr>
                              </tbody>
      </table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
