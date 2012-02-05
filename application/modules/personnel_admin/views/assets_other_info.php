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
                                  <td align="right" valign="middle" >Spouse TIN:</td>
                                  <td align="left" valign="middle" ><input name="s_tin" type="text" id="s_tin" value="<?php echo $info->s_tin;?>" /></td>
                                  <td align="left" valign="middle" >&nbsp;</td>
                                  <td align="right" valign="middle" >Employee TIN:</td>
                                  <td align="left" valign="middle" ><input name="tin" type="text" id="tin" value="<?php echo $info->tin;?>" /></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" >Spouse Com. Cert. No.:</td>
                                  <td align="left" valign="middle" ><input name="s_cc_no" type="text" id="s_cc_no" value="<?php echo $info->s_cc_no;?>" /></td>
                                  <td align="left" valign="middle" >&nbsp;</td>
                                  <td align="right" valign="middle" >Employee Com. Cert. No.:</td>
                                  <td align="left" valign="middle" ><input name="cc_no" type="text" id="cc_no" value="<?php echo $info->cc_no;?>" /></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" >Issue at:</td>
                                  <td align="left" valign="middle" ><input name="s_issue_at" type="text" id="s_issue_at" value="<?php echo $info->s_issue_at;?>" /></td>
                                  <td align="left" valign="middle" >&nbsp;</td>
                                  <td align="right" valign="middle" >Issue at:</td>
                                  <td align="left" valign="middle" ><input name="issue_at" type="text" id="issue_at" value="<?php echo $info->issue_at;?>" /></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" >Date Issue:</td>
                                  <td align="left" valign="middle" ><input name="s_issue_date" type="text" id="s_issue_date" value="<?php echo $info->s_issue_date;?>" /></td>
                                  <td align="left" valign="middle" >&nbsp;</td>
                                  <td align="right" valign="middle" >Date Issue:</td>
                                  <td align="left" valign="middle" ><input name="issue_date" type="text" id="issue_date" value="<?php echo $info->issue_date;?>" /></td>
                                </tr>
                                <tr>
                                  <td width="25%" align="center" valign="middle" >&nbsp;</td>
                                  <td width="22%" align="center" valign="middle" >&nbsp;</td>
                                  <td width="7%" align="center" valign="middle" >&nbsp;</td>
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
                                  <td>&nbsp;</td>
                                  <td width="24%">&nbsp;</td>
                                  <td width="22%">&nbsp;</td>
                                </tr>
                              </tbody>
      </table>
</fieldset></form></td>
    <td>&nbsp;</td>
  </tr>
</table>
